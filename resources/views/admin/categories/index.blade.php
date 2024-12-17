@extends('admin.layouts.app')

@section('title', 'Категории')

@section('content')
<div class="categories-page">
    <div class="page-header">
        <h1>Категории</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary">
            Добавить категорию
        </a>
    </div>

    <div class="categories-list">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Slug</th>
                    <th>Родительская категория</th>
                    <th>Кол-во товаров</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                    <td>{{ $category->parts_count }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn-edit">
                            Редактировать
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Вы уверены?')">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 