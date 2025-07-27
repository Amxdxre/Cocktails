@extends('layouts.app')

@section('content')
    <h1>Все кокетели</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Пикча</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cocktails as $cocktail)
            <tr>
                <td>{{ $cocktail->name }}</td>
                <td>
                    @if($cocktail->image)
                        <img src="{{ asset('storage/' . $cocktail->image) }}" alt="{{ $cocktail->name }}" width="100">
                    @else
                        Где пикча, душара?
                    @endif
                </td>
                <td>
                    <a href="{{ route('cocktails.show', $cocktail->id) }}" class="btn btn-info">Смари</a>
                    <a href="{{ route('cocktails.edit', $cocktail->id) }}" class="btn btn-warning">Редач</a>
                    <form action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ебаш</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('cocktails.create') }}" class="btn btn-primary">Заебашить новый кокетль</a>
@endsection
