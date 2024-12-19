<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'book_name' => $this->book_name,
            'creator' => $this->creator,
            'price' => $this->price,
            'description' => $this->description,
            'category' => new CategoryResource($this->category), // Menyertakan relasi category
            'image' => $this->image, // Menyertakan gambar
        ];
    }
}
