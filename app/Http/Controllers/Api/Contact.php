<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Contact as Societe;
use App\Models\Address;
use App\Components\FlashMessages;

class Contact extends Controller
{
    use FlashMessages;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Societe::all();
            #$data = Societe::with('address')->withTrashed()->get();

            if (count($data) >= 1) {
                $message = 'Exibindo os registros';
                $status = 'success';
            } else {
                $message = "Não há registros a serem exibidos";
                $status = "error";
            }

            $result = [
                'data'      => $data,
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = 'success';
        try {
            if (empty(trim($request->email))) {
                return Response::json(['message' => 'E-mail é obrigatório para o cadastrado',
                    'status' => 'warning'], 200);
            }
            $email = Societe::where('email', '=', $request->email)->select('id')->first();
            if (isSet($email->id)) {
                if ($email->id) {
                    return Response::json(['message' => 'E-mail já cadastrado, tente outro',
                    'status' => 'warning'], 200);
                }
            }

            if (empty(trim($request->mobile))) {
                return Response::json(['message' => 'Celular é obrigatório para o cadastrado',
                    'status' => 'warning'], 200);
            }
            $mobile = Societe::where('mobile', '=', $request->mobile)->select('id')->first();
            if (isSet($mobile->id)) {
                if ($mobile->id) {
                    return Response::json(['message' => 'Celular já cadastrado, tente outro',
                    'status' => 'warning'], 200);
                }
            }

            $data = Societe::create($request->all());

            if ($data) {
                foreach ($request->address as $value) {
                    if (!empty(trim($value['zipcode']))) {
                        $address = [
                            'contact_id'    => $data->id,
                            'type'          => $value['type'],
                            'ibge'          => $value['ibge'],
                            'siafi'         => $value['siafi'],
                            'zipcode'       => $value['zipcode'],
                            'public_place'  => $value['public_place'],
                            'address'       => $value['address'],
                            'number'        => $value['number'],
                            'complement'    => $value['complement'],
                            'district'      => $value['district'],
                            'city'          => $value['city'],
                            'state'         => $value['state'],
                            'country'       => $value['country']
                        ];
                        $data_address[] = Address::create($address);
                    }
                }

                $message = "Contato cadastrado com sucesso";
                $code = 200;
            } else {
                $data_address = null;
                $message = "Houve um erro ao cadastrar o contato";
                $status = "error";
                $code = 500;
            }

            $result = [
                'data'      => $data->id,
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, $code);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Societe::find($id);

            if ($data) {
                $addresses = $data->address()->get();
                $data->address = $addresses ? $addresses : 'Sem endereço para o contato.';
                $message = 'Exibindo o registro';
                $status = 'success';
            } else {
                $message = "Não há registro a ser exibido";
                $status = "error";
            }

            $result = [
                'data'      => $data,
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = Societe::find($id);

            if ($data) {
                $addresses = $data->address()->get();
                $data->address = $addresses ? $addresses : [];
                $message = 'Dados carregados com sucesso';
                $status = 'success';
            } else {
                $message = "Não há registro a ser exibido";
                $status = "error";
            }

            $result = [
                'data'      => $data,
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if (empty(trim($request->email))) {
                return Response::json(['message' => 'E-mail é obrigatório para o cadastrado',
                    'status' => 'warning'], 200);
            }
            $email = Societe::where('email', '=', $request->email)->select('id')->first();
            if (isSet($email->id)) {
                if ($email->id <> $id) {
                    return Response::json(['message' => 'E-mail já cadastrado, tente outro',
                    'status' => 'warning'], 200);
                }
            }

            if (empty(trim($request->mobile))) {
                return Response::json(['message' => 'Celular é obrigatório para o cadastrado',
                    'status' => 'warning'], 200);
            }
            $mobile = Societe::where('mobile', '=', $request->mobile)->select('id')->first();
            if (isSet($mobile->id)) {
                if ($mobile->id <> $id) {
                    return Response::json(['message' => 'Celular já cadastrado, tente outro',
                    'status' => 'warning'], 200);
                }
            }

            $data = Societe::find($id);
            $data->fill($request->all());
            if ($data->save()) {
                foreach ($request->address as $value) {
                    if (!empty($value['id'])) {
                        $dataAddress = Address::find($value['id']);
                        $address = [
                            'contact_id'    => $value['contact_id'],
                            'type'          => $value['type'],
                            'ibge'          => $value['ibge'],
                            'siafi'         => $value['siafi'],
                            'zipcode'       => $value['zipcode'],
                            'public_place'  => $value['public_place'],
                            'address'       => $value['address'],
                            'number'        => $value['number'],
                            'complement'    => $value['complement'],
                            'district'      => $value['district'],
                            'city'          => $value['city'],
                            'state'         => $value['state'],
                            'country'       => $value['country']
                        ];
                        $dataAddress->fill($address);

                        if ($dataAddress->save()) {
                            $msgAddr[] = "<br />Endereço ({$value['public_place']} {$value['address']}), atualizado com sucesso";
                        } else {
                            $msgAddr[] = "<br />Houve um erro ao cadastrar o endreço: {$value['public_place']} {$value['address']}";
                            $status = "warning";
                        }
                    } else {
                        if (!empty(trim($value['zipcode']))) {
                            $address = [
                                'contact_id'    => $id,
                                'type'          => $value['type'],
                                'ibge'          => $value['ibge'],
                                'siafi'         => $value['siafi'],
                                'zipcode'       => $value['zipcode'],
                                'public_place'  => $value['public_place'],
                                'address'       => $value['address'],
                                'number'        => $value['number'],
                                'complement'    => $value['complement'],
                                'district'      => $value['district'],
                                'city'          => $value['city'],
                                'state'         => $value['state'],
                                'country'       => $value['country']
                            ];
                            $data_address[] = Address::create($address);
                        }
                    }
                }
                $message = "Contato atualizado com sucesso";
                $status = "success";
                $code = 200;
            } else {
                $data_address = '';
                $message = "Houve um erro ao atualizar o contato";
                $status = "error";
                $code = 500;
            }

            $result = [
                'data'      => [$data,$request->all()],
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, $code);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Update: Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage(),$request->all()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Societe::destroy($id);

            if ($data) {
                $message = 'Contato excluido com sucesso';
                $status = 'success';
            } else {
                $message = "Não possível excluir o registro";
                $status = "error";
            }

            $result = [
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage()], 500);
        }
    }
}
