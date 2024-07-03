<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReturnProductCollection extends JsonResource
{

    public function toArray($request)
    {
        return [
                'id' => $this->product_id,
                'rm_number' => $this->rm_number,
                'product' => new ProductCollection($this->product),
                'reason' => $this->reason,
                'return_date' => $this->return_date
        ];
    }
}
