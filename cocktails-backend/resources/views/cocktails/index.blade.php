@extends('layouts.app')

@section('content')
    <h1>Все коктейли</h1>
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
        @foreach($cocktails as $cocktail)
            <tr>
                <td>{{ $cocktail->name }}</td>
                <td>{{ $cocktail->description }}</td>
                <td>
                    @if($cocktail->image)
                        <img src="{{ asset('storage/' . $cocktail->image) }}" alt="{{ $cocktail->name }}" width="100">
                    @else
                        Изображение не указано
                    @endif
                </td>
                <td>
                    <a href="{{ route('cocktails.show', $cocktail->id) }}" class="btn btn-info">Посмотреть</a>
                    <a href="{{ route('cocktails.edit', $cocktail->id) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('cocktails.create') }}" class="btn btn-primary">Создать новый</a>
@endsection
