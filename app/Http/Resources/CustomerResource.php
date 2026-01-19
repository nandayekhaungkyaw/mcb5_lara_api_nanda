<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

    return [
        'id' => $this->id,
        'name' => $this->name,
        'birth' => $this->birth,
        'email' => $this->email,
        'phone' => $this->phone,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        'township' => $this->township,
        'division' => $this->division,
        'user_id' => $this->user_id,
        'user' =>[
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]





    ];
}
}
