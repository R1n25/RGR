<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автозапчасти</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
</head>
<body>
    <header class="header">
        <div class="top-menu">
            <nav class="menu">
                <a href="/" class="logo">АвтоЗапчасти</a>
                <div class="menu-items">
                    <a href="/">Главная страница</a>
                    <a href="/news">Новости и акции</a>
                    <div class="dropdown">
                        <a href="/catalog">Запчасти</a>
                        <div class="dropdown-content">
                            <a href="/catalog/brands">Марки авто</a>
                            <a href="/catalog/models">Модели</a>
                            <a href="/catalog/parts">Запчасти</a>
                            <a href="/catalog/order">Заказ</a>
                        </div>
                    </div>
                    <a href="/about">О компании</a>
                    <a href="/contacts">Контакты</a>
                    <a href="/map">Схема проезда</a>
                    <a href="/sitemap">Карта сайта</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html> 