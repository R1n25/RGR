@extends('layouts.app')

@section('content')
<div class="cart-page">
    <h1>Корзина</h1>
    
    <div class="cart-items">
        <div class="cart-list" id="cartList">
            <!-- Сюда будут добавляться товары через JavaScript -->
        </div>
        
        <div class="cart-summary">
            <h3>Итого</h3>
            <p class="total-price">0 ₽</p>
            
            <form id="orderForm" class="order-form">
                <div class="form-group">
                    <label>ФИО</label>
                    <input type="text" name="name" required>
                </div>
                
                <div class="form-group">
                    <label>Телефон</label>
                    <input type="tel" name="phone" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                
                <button type="submit" class="btn-order">Оформить заказ</button>
            </form>
        </div>
    </div>
</div>
@endsection 