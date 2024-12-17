@extends('admin.layouts.app')

@section('title', 'Создать категорию')

@section('content')
<div class="category-form-page">
    <h1>Создать категорию</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required>
            @error('slug')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="parent_id">Родительская категория</label>
            <select name="parent_id" id="parent_id">
                <option value="">Нет</option>
                @foreach($parentCategories as $category)
                    <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Создать</button>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary">Отмена</a>
        </div>
    </form>
</div>
@endsection 