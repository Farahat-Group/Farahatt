<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->images ?? "No Images",
            'price' =>$this->price . '$',
            'sale' => $this->sale == 0 ? "No Sale" : $this->sale,
            'category' => $this->category->get(['id' , 'title'])
        ];
    }
}
