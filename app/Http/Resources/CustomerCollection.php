<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends JsonResource
{

    public function toArray($request)
    {
        return [
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone
        ];
    }
}
