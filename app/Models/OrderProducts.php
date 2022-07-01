<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $table = 'orders_services';
    use HasFactory;

    public function service( ) {
        return $this->belongsTo(Service::class , 'service_id');
    }
}
