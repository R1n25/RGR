@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="login-form">
        <h1>Вход в систему</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Войти</button>
        </form>
    </div>
</div>
@endsection 