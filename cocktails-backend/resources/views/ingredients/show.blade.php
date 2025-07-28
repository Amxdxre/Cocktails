@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $ingredient->name }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($ingredient->image)
                        <img src="{{ asset('storage/' . $ingredient->image) }}" class="img-fluid rounded-start" alt="{{ $ingredient->name }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 100%;">
                            <p class="text-muted">Изображение не указано</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text">{{ $ingredient->description }}</p>

                        <div class="mt-4">
                            <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                            <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Назад к списку</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
