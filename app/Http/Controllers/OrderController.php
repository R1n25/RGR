<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Part;
use App\Notifications\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email',
                'customer_phone' => 'required|string|max:20',
                'items' => 'required|array|min:1',
                'items.*.part_id' => 'required|exists:parts,id',
                'items.*.quantity' => 'required|integer|min:1'
            ]);

            return DB::transaction(function () use ($validated) {
                // Создаем заказ
                $order = Order::create([
                    'order_number' => $this->generateOrderNumber(),
                    'customer_name' => $validated['customer_name'],
                    'customer_email' => $validated['customer_email'],
                    'customer_phone' => $validated['customer_phone'],
                    'status' => 'pending',
                    'total_amount' => 0
                ]);

                $totalAmount = 0;
                $orderItems = [];

                // Обрабатываем каждый товар в заказе
                foreach ($validated['items'] as $item) {
                    $part = Part::findOrFail($item['part_id']);
                    
                    // Проверяем наличие товара
                    if ($part->quantity < $item['quantity']) {
                        throw new \Exception("Недостаточное количество товара {$part->name}");
                    }

                    // Создаем позицию заказа
                    $orderItem = OrderItem::create([
                        'order_id' => $order->id,
                        'part_id' => $part->id,
                        'quantity' => $item['quantity'],
                        'price' => $part->price
                    ]);

                    // Уменьшаем количество товара на складе
                    $part->decrement('quantity', $item['quantity']);
                    
                    $totalAmount += $part->price * $item['quantity'];
                    $orderItems[] = $orderItem;
                }

                // Обновляем общую сумму заказа
                $order->update(['total_amount' => $totalAmount]);

                // Отправляем уведомление о заказе
                try {
                    $order->notify(new OrderCreated($order));
                } catch (\Exception $e) {
                    Log::error('Ошибка отправки уведомления о заказе: ' . $e->getMessage());
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Заказ успешно создан',
                    'order' => [
                        'id' => $order->id,
                        'order_number' => $order->order_number,
                        'total_amount' => $order->total_amount,
                        'redirect_url' => route('orders.success', $order)
                    ]
                ]);
            });

        } catch (\Exception $e) {
            Log::error('Ошибка создания заказа: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при создании заказа: ' . $e->getMessage()
            ], 422);
        }
    }

    public function success(Order $order)
    {
        return view('orders.success', [
            'order' => $order->load('items.part')
        ]);
    }

    private function generateOrderNumber()
    {
        $prefix = 'ORD-';
        $date = now()->format('Ymd');
        $lastOrder = Order::whereDate('created_at', today())
            ->latest()
            ->first();

        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder->order_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $date . '-' . $newNumber;
    }
} 