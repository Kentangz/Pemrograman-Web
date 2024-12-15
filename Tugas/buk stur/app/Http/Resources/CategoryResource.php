<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
            'description' => $this->description,
            'books' => BookResource::collection($this->whenLoaded('books')), // Menyertakan koleksi books jika dimuat
        ];
    }
}
