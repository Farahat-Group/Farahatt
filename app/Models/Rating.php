<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = "rating";
    protected $guarded = [];

    public function customer() {
        return $this->belongsTo(Customer::class , 'customer_id');
    }
    public function service() {
        return $this->belongsTo(Service::class , 'service_id');
    }
}
