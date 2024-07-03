<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsDataCollection extends JsonResource
{

    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'image' => $this->image,
            'is_active' => $this->is_active,
        ];
    }
}
