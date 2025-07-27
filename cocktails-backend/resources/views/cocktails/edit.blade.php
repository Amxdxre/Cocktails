@extends('layouts.app')

@section('content')
    <h1>Отредач кокетль!</h1>
    <form method="POST" action="{{ route('cocktails.update', $cocktail->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" class="form-control" value="{{ $cocktail->name }}" required>
        </div>
        <div class="form-group">
            <label for="content">Описание</label>
            <textarea name="content" class="form-control" required>{{ $cocktail->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($cocktail->image)
                <img src="{{ asset('storage/' . $cocktail->image) }}" alt="{{ $cocktail->name }}" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
@endsection
