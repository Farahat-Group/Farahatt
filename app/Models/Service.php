<?php

namespace App\Models;

use App\Services\ServiceRatingHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function rating() {
        return $this->hasMany(Rating::class , 'service_id')->get('rating');
    }


    public static function filter(){
        $service = Service::query();
        if (request()->has('title')){
            $service->where('title' , 'LIKE' , '%' . request()->get('title') .'%');
        }
        return $service->get();
    }
}
