@extends('layouts.app')

@section('content')
    <h1>Все ингредиенты</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Изображение</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ingredients as $ingredient)
            <tr>
                <td>{{ $ingredient->name }}</td>
                <td>{{ $ingredient->description }}</td>
                <td>
                    @if($ingredient->image)
                        <img src="{{ asset('storage/' . $ingredient->image) }}" alt="{{ $ingredient->name }}" width="100">
                    @else
                        Изображение не указано
                    @endif
                </td>
                <td>
                    <a href="{{ route('ingredients.show', $ingredient->id) }}" class="btn btn-info">Посмотреть</a>
                    <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Создать новый</a>
@endsection
