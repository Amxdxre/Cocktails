@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $cocktail->name }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-4">
                    @if($cocktail->image)
                        <img src="{{ asset('storage/' . $cocktail->image) }}" class="img-fluid rounded-start" alt="{{ $cocktail->name }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 100%;">
                            <p class="text-muted">Изображение не указано</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text">{{ $cocktail->description }}</p>

                        <div class="mt-4">
                            <a href="{{ route('cocktails.edit', $cocktail->id) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                            <a href="{{ route('cocktails.index') }}" class="btn btn-secondary">Назад к списку</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
