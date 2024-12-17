<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_amount',
        'status',
        'notes'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function routeNotificationForMail()
    {
        return $this->customer_email;
    }
} 