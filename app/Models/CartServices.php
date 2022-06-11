<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartServices extends Model
{
    use HasFactory;
    protected $table = 'cart_services';
    protected $guarded = [];

    public function cart() {
        return $this->belongsTo(Cart::class , 'cart_id');
    }

}
