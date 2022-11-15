<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => (int) $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'user_type' => $this->user_type,
            'employee_studios'   => $this->whenLoaded('employeeStudios', function(){
                return $this->employeeStudios;
            }),
        ];
    }
}
