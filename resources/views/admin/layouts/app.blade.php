<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="logo">
                <h1>Админ-панель</h1>
            </div>
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <i class="fas fa-home"></i> Главная
                </a>
                <div class="nav-group">
                    <h3>Каталог</h3>
                    <a href="{{ route('admin.categories.index') }}" class="nav-item">Категории</a>
                    <a href="{{ route('admin.parts.index') }}" class="nav-item">Запчасти</a>
                    <a href="{{ route('admin.brands.index') }}" class="nav-item">Бренды</a>
                </div>
                <div class="nav-group">
                    <h3>Заказы</h3>
                    <a href="{{ route('admin.orders.index') }}" class="nav-item">Все заказы</a>
                    <a href="{{ route('admin.orders.index', ['status' => 'new']) }}" class="nav-item">Новые</a>
                </div>
                <a href="{{ route('admin.settings') }}" class="nav-item">
                    <i class="fas fa-cog"></i> Настройки
                </a>
            </nav>
        </aside>

        <main class="content">
            <header class="admin-header">
                <div class="user-menu">
                    <span>{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Выход</button>
                    </form>
                </div>
            </header>

            <div class="main-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html> 