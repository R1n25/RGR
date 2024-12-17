<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'image'];

    public function models()
    {
        return $this->hasMany(CarModel::class);
    }
} 