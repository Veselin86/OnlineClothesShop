<?php

namespace App\Http\Resources;

use App\Http\Controllers\AddressController;
use Illuminate\Http\Resources\Json\JsonResource;
class UserResource extends JsonResource
{
    public function toArray($request)
    {
// Retorna un arreglo con los atributos que quieres mostrar en la respuesta JSON
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'addresses' => AddressResource::collection($this->addresses),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
            // Puedo añadir cualquier otro atributo o relación que necesito             
      ];
    }
}
