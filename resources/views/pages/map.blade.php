@extends('layouts.app')

@section('content')
<div class="container">
    <div class="map-section">
        <h1>Схема проезда</h1>
        
        <div class="contact-info">
            <div class="address">
                <h3>Наш адрес:</h3>
                <p>г. Симферополь, ул. Ленина, д. 21</p>
                <p>Время работы: Пн-Пт 9:00-18:00</p>
                <p>Телефон: +7 (999) 123-45-67</p>
            </div>
        </div>

        <div class="map-container">
            <div id="map" style="height: 500px; width: 100%;"></div>
        </div>

        <div class="directions">
            <h3>Как добраться:</h3>
            <div class="transport-options">
                <div class="option">
                    <h4>На автомобиле:</h4>
                    <p>С проспекта Кирова поверните на ул. Ленина, магазин находится в 200 метрах справа</p>
                </div>
                <div class="option">
                    <h4>Общественным транспортом:</h4>
                    <p>От остановки "Центральный рынок" троллейбусы №1, №3</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Подключение API Яндекс.Карт -->
<script src="https://api-maps.yandex.ru/2.1/?apikey=ваш_api_ключ&lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    function init(){
        // Создание карты
        var myMap = new ymaps.Map("map", {
            center: [44.9521, 34.1024], // Координаты Симферополя, ул. Ленина, 21
            zoom: 16
        });

        // Создание метки
        var myPlacemark = new ymaps.Placemark([44.9521, 34.1024], {
            balloonContentHeader: "Магазин автозапчастей",
            balloonContentBody: `
                <p>г. Симферополь, ул. Ленина, д. 21</p>
                <p>Тел: +7 (999) 123-45-67</p>
                <p>Пн-Пт: 9:00-18:00</p>
            `,
            hintContent: "Магазин автозапчастей"
        }, {
            preset: 'islands#blueAutoIcon'
        });

        // Добавление метки на карту
        myMap.geoObjects.add(myPlacemark);

        // Настройки отображения элементов управления
        myMap.controls.remove('trafficControl');
        myMap.controls.remove('searchControl');
        myMap.controls.remove('typeSelector');
        myMap.controls.remove('fullscreenControl');
        myMap.controls.remove('rulerControl');

        // Добавляем необходимые элементы управления
        myMap.controls
            .add('zoomControl', { position: {right: 10, top: 50} })
            .add('routeButtonControl', { position: {right: 10, top: 150} });

        // Открываем балун при загрузке
        myPlacemark.balloon.open();
    }
</script>
@endpush 