<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'year_from',
        'year_to'
    ];

    public function brand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    public function parts()
    {
        return $this->belongsToMany(Part::class, 'part_car_model');
    }
} 