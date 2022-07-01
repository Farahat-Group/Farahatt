<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer() {
        return $this->belongsTo(Customer::class , 'customer_id');
    }

    public function services() {
        return $this->hasMany(OrderProducts::class , 'order_id')->where('type' , 0);
    }

    public function allServices() {
        return $this->hasMany(OrderProducts::class , 'order_id');
    }

    public function extraServices() {
        return $this->hasMany(OrderProducts::class , 'order_id')->where('type' , 1);
    }
}
