<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'name',
        'article_number',
        'category_id',
        'brand',
        'model',
        'description',
        'price',
        'quantity',
        'images',
        'specifications',
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'specifications' => 'array',
        'is_active' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carModels()
    {
        return $this->belongsToMany(CarModel::class, 'part_car_model');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
} 