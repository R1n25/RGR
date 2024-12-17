@extends('admin.layouts.app')

@section('title', 'Панель управления')

@section('content')
<div class="dashboard">
    <h1>Панель управления</h1>

    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Заказы</h3>
            <p class="stat-value">{{ $stats['orders_count'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Товары</h3>
            <p class="stat-value">{{ $stats['parts_count'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Категории</h3>
            <p class="stat-value">{{ $stats['categories_count'] }}</p>
        </div>
    </div>

    <div class="dashboard-tables">
        <div class="recent-orders">
            <h2>Последние заказы</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Клиент</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                        <th>Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_orders'] as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ number_format($order->total_amount, 0, ',', ' ') }} ₽</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 