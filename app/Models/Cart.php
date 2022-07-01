<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = ['customer_id'];

    public function services() {
        return $this->hasMany(CartServices::class , 'cart_id')->where('type' , 0);
    }

    public function allServices() {
        return $this->hasMany(CartServices::class , 'cart_id');

    }

    public function extra_services() {
        return $this->hasMany(CartServices::class , 'cart_id')->where('type' , 1)->get('service_id');
    }
}
