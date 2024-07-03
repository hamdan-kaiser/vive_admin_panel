<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WarrantyCollection extends JsonResource
{

    public function toArray($request)
    {
        return [
            'activation_date' => $this->activation_date,
            'expiration_date' => $this->expiration_date,
            'customer' => new CustomerCollection($this->details),
        ];
    }
}
