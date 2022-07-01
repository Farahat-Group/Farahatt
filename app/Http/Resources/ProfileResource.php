<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image ? url("images/customer/profile/" . $this->image) : "No Image",
            'address' => $this->address ?? "Not Set",
            'phone' => $this->phone_number ?? "Not Set",
            'lat' => $this->lat ?? "Not Set",
            'lon' => $this->lon ?? "Not Set"
        ];
    }
}
