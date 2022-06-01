<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    protected $guarded = [];

    protected $hidden = ['password'];

    protected function setPasswordAttribute($val){
        $this->attributes['password'] = Hash::make($val);
    }
}
