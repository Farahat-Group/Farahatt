<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'nortfications';

    public function customer() {
        return $this->belongsTo(Customer::class , 'customer_id');
    }
}
