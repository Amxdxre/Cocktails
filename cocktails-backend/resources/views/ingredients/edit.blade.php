@extends('layouts.app')

@section('content')
    <h1>Редактирование ингредиента</h1>
    <form method="POST" action="{{ route('ingredients.update', $ingredient->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" class="form-control" value="{{ $ingredient->name }}" required>
        </div>
        <div class="form-group">
            <label for="content">Описание</label>
            <textarea name="content" class="form-control" required>{{ $ingredient->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($ingredient->image)
                <img src="{{ asset('storage/' . $ingredient->image) }}" alt="{{ $ingredient->name }}" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-3">Обновить</button>
    </form>
@endsection
