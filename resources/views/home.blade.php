@extends('layouts.app')

@section('content')
<div class="container">
    <div class="catalog-section">
        <div class="catalog-filters">
            <h2>Поиск запчастей</h2>
            <form action="{{ route('parts.search') }}" method="GET">
                <div class="filter-group">
                    <label>Марка автомобиля</label>
                    <select name="brand" required>
                        <option value="">Выберите марку</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label>Модель</label>
                    <select name="model" disabled>
                        <option value="">Сначала выберите марку</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Запчасти</label>
                    <select name="category">
                        <option value="">Все запчасти</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-search">Найти запчасти</button>
            </form>
        </div>

        <div class="catalog-content">
            <h1>Каталог автозапчастей</h1>
            <div class="parts-grid">
                @foreach($popularParts as $part)
                    <div class="part-card">
                        @if($part->images)
                            <img src="{{ json_decode($part->images)[0] }}" alt="{{ $part->name }}">
                        @endif
                        <h3>{{ $part->name }}</h3>
                        <p class="brand">{{ $part->brand }}</p>
                        <p class="price">{{ number_format($part->price, 0, ',', ' ') }} ₽</p>
                        <button class="btn-add-cart" data-id="{{ $part->id }}">В корзину</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 