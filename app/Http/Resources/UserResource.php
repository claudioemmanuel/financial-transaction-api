<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'user_type_id'  => $this->user_type_id,
            'name'          => $this->name,
            'cpf_cnpj'      => $this->cpf_cnpj,
            'email'         => $this->email,
            'wallet'        => $this->wallet,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
