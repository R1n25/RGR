@extends('layouts.app')

@section('content')
<div class="catalog-container">
    <aside class="filters">
        <h3>Фильтры</h3>
        <form action="{{ route('parts.index') }}" method="GET">
            <div class="filter-group">
                <label>Марка автомобиля</label>
                <select name="brand">
                    <option value="">Все марки</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-group">
                <label>Категория</label>
                <select name="category">
                    <option value="">Все категории</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn-filter">Применить</button>
        </form>
    </aside>

    <div class="catalog">
        @foreach($parts as $part)
        <div class="part-card">
            <img src="{{ $part->image_url }}" alt="{{ $part->name }}">
            <h3>{{ $part->name }}</h3>
            <p class="brand">{{ $part->brand }} {{ $part->model }}</p>
            <p class="price">{{ number_format($part->price, 0, ',', ' ') }} ₽</p>
            <button class="btn-add-cart" data-id="{{ $part->id }}">В корзину</button>
        </div>
        @endforeach
    </div>
</div>
@endsection 