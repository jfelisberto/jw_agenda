<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Address as endereco;
use App\Components\FlashMessages;

class Address extends Controller
{
    use FlashMessages;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            foreach ($request->address as $value) {
                $address = [
                    'contact_id'    => $value['contact_id'],
                    'type'          => $value['type'],
                    'zipcode'       => $value['zipcode'],
                    'ibge'          => $value['ibge'],
                    'siafi'         => $value['siafi'],
                    'public_place'  => $value['public_place'],
                    'address'       => $value['address'],
                    'number'        => $value['number'],
                    'complement'    => $value['complement'],
                    'district'      => $value['district'],
                    'city'          => $value['city'],
                    'state'         => $value['state'],
                    'country'       => $value['country']
                ];
                if (Address::create($address)) {
                    $message[] = "Endereço ({$value['public_place']} {$value['address']}), cadastrado com sucesso";
                    $status = 'success';
                } else {
                    $message[] = "Houve um erro ao cadastrar o endreço: {$value['public_place']} {$value['address']}";
                    $status = "warning";
                }
            }

            $result = [
                'message'   => $message,
                'status'    => $status
            ];

            return Response::json($result, 200);
        } catch (\Exception $e) {
            return Response::json(['message' => 'Houve um erro ao processar seus dados', 'status' => 'error', 'e_error' => $e->getMessage(),$request->all()], 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            foreach ($request->address as $value) {
                if (!empty($value['id'])) {
                    $data = Address::find($value['id']);
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
                    $data->fill($address);

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
                        $data[] = Address::create($address);
                    }
                }

                if ($data->save()) {
                    $msgAddr[] = "<br />Endereço ({$value['public_place']} {$value['address']}), atualizado com sucesso";
                } else {
                    $msgAddr[] = "<br />Houve um erro ao cadastrar o endreço: {$value['public_place']} {$value['address']}";
                    $status = "warning";
                }
            }
            $message = "Contato atualizado com sucesso";
            $status = "success";
            $code = 200;

            $result = [
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
            $data = Address::destroy($id);

            if ($data) {
                $message = 'Endereço excluido com sucesso';
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
