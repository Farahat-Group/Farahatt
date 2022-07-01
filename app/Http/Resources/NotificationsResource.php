<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;


class NotificationsResource extends JsonResource
{

    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'title' => $this->title,
            'message' => $this->message,
            'price' => $this->price,
            'created_at' => Carbon::make($this->created_at)->toDateString()
        ];
    }
}
