<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreated extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Заказ #' . $this->order->order_number . ' создан')
            ->greeting('Здравствуйте, ' . $this->order->customer_name . '!')
            ->line('Спасибо за ваш заказ!')
            ->line('Номер заказа: ' . $this->order->order_number)
            ->line('Сумма заказа: ' . number_format($this->order->total_amount, 2, ',', ' ') . ' ₽')
            ->action('Просмотреть заказ', route('orders.success', $this->order))
            ->line('Мы свяжемся с вами в ближайшее время для подтверждения заказа.');
    }
} 