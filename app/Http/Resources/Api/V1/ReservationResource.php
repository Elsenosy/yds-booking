<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'id' => (int) $this->id,
            'customer' => [
                'id'    => (int) $this->customer->id,
                'name'  => $this->customer->name,
                'email' => $this->customer->email,
            ],
            'studio' => [
                'id'   => (int) $this->studio->id,
                'name' => $this->studio->name,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
