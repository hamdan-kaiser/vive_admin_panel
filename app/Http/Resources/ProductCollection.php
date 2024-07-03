<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{

    public function toArray($request)
    {
        return [
                'category' => new ProductCategoryCollection($this->category),
                'serial_no' => $this->serial_no,
                'material_no' => $this->material_no,
                'material_description' => $this->material_description,
                'batch' => $this->batch,
               'warranty' => new WarrantyCollection($this->warranty),
        ];
    }
}
