<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Components\FlashMessages;

class Autocomplete extends Controller
{
    use FlashMessages;
    /*
    * Função de busca CEP
    * consulta bases:
    *   Viacep
    *   Republicavirtual
    */
    public function getCEP(Request $request) {
        try {
            $zipcode = $request->zipcode;
            $zipControl = $request->zipControl;
            $zipPrefix = $request->zipPrefix;
            $country_id = $request->country_id;

            $zipcode = $this->clear_data($zipcode);
            $url = "https://viacep.com.br/ws/{$zipcode}/json/";
            $fields = array(
                'cep' => $zipcode
            );
            $parameters = array(
                'headers' => array(
                'GET searchCEP/jefweb.com.br HTTP/1.1',
                'Content-Type: application/json; charset=utf-8'
                ),
                'customRequest' => 'GET',
                'fields' => json_encode($fields)
            );
            $response = $this->send_curl_request($url, $parameters);

            if ($response['status'] == 'success') {
                $return = $this->send_curl_request("http://cep.republicavirtual.com.br/web_cep.php?cep={$zipcode}&formato=json", $parameters);

                $res = (array)json_decode($response['response']);
                $res2 = (array)json_decode($return['response']);

                $result['zipControl'] = $zipControl;
                $result['zipPrefix'] = $zipPrefix;
                $result['public_place'] = $res2['resultado'] ? $res2['tipo_logradouro'] : '';
                $result['address'] = trim(!empty($res2['tipo_logradouro']) ? str_replace($res2['tipo_logradouro'], '', $res['logradouro']) : $res['logradouro']);
                $result['district'] = $res['bairro'];
                $result['city'] = $res['localidade'];
                $result['state'] = $res['uf'];
                $result['country'] = 'Brasil';
                $result['ibge'] = $res['ibge'];
                $result['siafi'] = $res['siafi'];
                $result['gia'] = $res['gia'];
                $result['ddd'] = $res['ddd'];
                $result['complemento'] = $res['complemento'];

                $message = 'CEP consultado com sucesso';
                $status = 'success';
            } else {
                $result = $response;
                $message = 'Houve um erro ao consultar o CEP.';
                $status = 'error';
            }

            $result = [
                'data'      => $result,
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage(),$request->all()], 500);
        }
    }
    public function getCNPJ(Request $request) {
        try {
            $zipControl = $request->zipControl;
            $zipPrefix = $request->zipPrefix;
            $country_id = $request->country_id;

            $parameters = array(
                'headers' => array(
                    'GET searchCNPJ/jefweb.com.br HTTP/1.1',
                    'Content-Type: text/html; charset=utf-8'
                ),
                'customRequest' => 'GET',
            );
            $document = $this->clear_data($request->cnpj);

            $url = "https://cnpjs.rocks/cnpj/{$document}";
            $result = $this->send_curl_request($url, $parameters);

            if ($result['status'] == 'success') {
                preg_match_all('!<ul>.*?<li.*?>.*?</li>.*?</ul>!', $result['response'], $newData);

                if (count($newData[0]) >= 1) {
                    foreach ($newData[0] as $key => $value) {
                        $newValue = explode("<ul>", $value);
                        foreach ($newValue as $ky => $vl) {
                            if (!empty($vl)) {
                                $newVL = explode("<li>", $vl);
                                foreach ($newVL as $k => $v) {
                                    if (!empty($v)) {
                                        $newRes = str_replace(": ", "#", $v);
                                        $newRes = str_replace("<strong>", "", $newRes);
                                        $newRes = str_replace("</strong>", "", $newRes);
                                        $newRes = str_replace("</li>", "", $newRes);
                                        $newRes = str_replace("</ul>", "", $newRes);
                                        $newDatalist1[] = $newRes;
                                    }
                                }
                            }
                        }
                    }

                    foreach ($newDatalist1 as $value) {
                        $newValue = explode('#', $value);
                        $key = $this->remove_accentuation(str_replace('-', '_', str_replace(' ', '_', strtolower($newValue[0]))));
                        switch ($key) {
                            case 'telefone':
                                $phone = explode('/', $newValue[1]);
                                if (count($phone) >= 1) {
                                    foreach ($phone as $v) {
                                        $phoneData[] = str_replace(' ', '', trim($v));
                                    }
                                    $newDatalist2[$key] = $phoneData;
                                    $newDatalist2['phone'] = $phoneData[0];
                                } else {
                                    $newDatalist2[$key] = str_replace(' ', '', trim($newValue[1]));
                                    $newDatalist2['phone'] = str_replace(' ', '', trim($newValue[1]));
                                }
                                break;
                            case 'capital_social':
                                $newDatalist2[$key] = str_replace('.', ',', trim($newValue[1]));
                                break;
                            case 'natureza_juridica':
                                $natureza_juridica_id = explode(' - ', str_replace('.', ',', trim($newValue[1])));
                                $newDatalist2['natureza_juridica_id'] = $natureza_juridica_id[0];
                                $newDatalist2[$key] = str_replace('.', ',', trim($newValue[1]));
                                unset($natureza_juridica_id);
                                break;
                            case 'uf':
                                $newDatalist2[$key] = trim($newValue[1]);
                                break;
                            case 'cep':
                                $newDatalist2[$key] = str_replace('.', '', trim($newValue[1]));
                                break;
                            default:
                                $newDatalist2[$key] = trim($newValue[1]);
                            break;
                        }
                    }

                    if (empty($newDatalist2['complemento'])) {
                        $newDatalist2['complemento'] = '';
                    }
                    $result = $newDatalist2;
                    $result['e_mail'] = strtolower($newDatalist2['e_mail']);
                    #$result['data']['socio'] = ucwords(strtolower($newDatalist2['socio']));
                    $result['zipControl'] = $zipControl;
                    $result['zipPrefix'] = $zipPrefix;
                    $result['country_id'] = $country_id;
                    /*
                    $result['public_place'] = $resZipcode['tipo_logradouro'];
                    $result['logradouro'] = $resZipcode['logradouro'];
                    $result['ibge'] = $resZipcode['ibge'];
                    $result['siafi'] = $resZipcode['siafi'];
                    $resZipcode = $this->getCEP($newDatalist2['cep']);
                    $result['public_place'] = $resZipcode['tipo_logradouro'];
                    $result['logradouro'] = $resZipcode['logradouro'];
                    $result['ibge'] = $resZipcode['ibge'];
                    $result['siafi'] = $resZipcode['siafi'];
                    */
                    $message = 'CNPJ consultado com sucesso';
                    $status = 'success';
                } else {
                    $status = 'error';
                    $message = 'Não foi possível resolver a consulta para o CNPJ ' . $document;
                }
            } else {
                $result = $response;
                $message = 'Houve um erro ao consultar o CNPJ.';
                $status = 'error';
            }

            $result = [
                'data'      => $result,
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage(),$request->all()], 500);
        }
    }

    public function remove_accentuation($text) {
        $text = utf8_decode(trim($text));
        $text = strtr($text, utf8_decode("ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöùúûüýÿ"), "AAAAAAACEEEEIIIIDNOOOOOUUUUYBaaaaaaaceeeeiiiionooooouuuuyy");
        $text = strtr($text, "\xE1\xE8\xEF\xEC\xE9\xED\xF2", "\x61\x63\x64\x65\x65\x69\x6E");
        $text = strtr($text, "\xF3\xF8\x9A\x9D\xF9\xFA\xFD\x9E\xF4\xBC\xBE", "\x6F\x72\x73\x74\x75\x75\x79\x7A\x6F\x4C\x6C");
        $text = strtr($text, "\xC1\xC8\xCF\xCC\xC9\xCD\xC2\xD3\xD8", "\x41\x43\x44\x45\x45\x49\x4E\x4F\x52");
        $text = strtr($text, "\x8A\x8D\xDA\xDD\x8E\xD2\xD9\xEF\xCF", "\x53\x54\x55\x59\x5A\x4E\x55\x64\x44");
        return $text;
    }

    public function clear_data($text, $mask=false) {
        $valid = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $bs = array("_", "|", "&", "&amp;", ":", "\"", "\'", "\\", "/", "----", "---", "--", "--", "-", ".", ",");
        $rp = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $text = str_replace($bs, $rp, stripslashes(strip_tags($text)));
        $final = '';
        for ($x = 0; $x < strlen($text); $x++) {
            $chr = substr($text, $x, 1);
            if (strpos($valid, $chr) !== false) {
            $final .= $chr;
            }
        }

        if ($mask) {
            $final = stringAddCharacter($final, $mask['occurrence'], $mask['string']);
        }
        return $final;
    }

    public function send_curl_request($url, $parameters) {
        function_exists('curl_version') or die('cURL Extension needed'.PHP_EOL);
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            if (isSet($parameters['timeout'])) {
                curl_setopt($ch, CURLOPT_TIMEOUT, $parameters['timeout']);
            }
            if (isSet($parameters['port'])) {
                curl_setopt($ch, CURLOPT_PORT, $parameters['port']);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_ENCODING, "utf-8");
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            if (isSet($parameters['customRequest'])) {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $parameters['customRequest']);
            } else {
                curl_setopt($ch, CURLOPT_POST, true);
            }
            if (isSet($parameters['fields'])) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters['fields']);
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $parameters['headers']);

            #curl_setopt($ch, CURLOPT_USERAGENT, $defined_vars['HTTP_USER_AGENT']);
            if (isSet($parameters['view_headers'])) {
                curl_setopt($ch, CURLOPT_HEADER, true);
            }
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            if (isSet($parameters['ssl_verifyhost'])) {
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $parameters['ssl_verifyhost']);
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            #curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            #curl_setopt($ch, CURLOPT_PROXY, '');

            $result['response'] = curl_exec($ch);
            $result['header'] = curl_getinfo($ch);
            $result['status'] = 'success';
            curl_close($ch);

            return $result;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}
