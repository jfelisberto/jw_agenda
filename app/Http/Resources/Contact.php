<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (isSet($this->id)) {
            return [
                'data'      => [
                    'id'        => $this->id,
                    'name'      => $this->name,
                    'email'     => $this->email,
                    'mobile'    => $this->mobile,
                    'phone'     => $this->phone,
                    'cnpj'      => $this->cnpj,
                    'company'   => $this->company,
                    'address'   => $this->address()->get()
                ],
                'message'   => 'Dados carregados com sucesso',
                'status'    => 'success'
            ];
        } else {
            return [
                'data'      => null,
                'message'   => 'Não há registro a ser exibido',
                'status'    => 'error',
            ];
        }
    }
}
