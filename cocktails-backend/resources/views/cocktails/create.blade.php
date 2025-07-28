@extends('layouts.app')

@section('content')
    <h1>Создание нового коктейля</h1>
    <form method="POST" action="{{ route('cocktails.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" class="form-control" required>
        </div><br>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" class="form-control" rows="5" required></textarea>
        </div><br>
        <div class="form-group">
            <label for="image">Главное изображение</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Создать</button>
    </form>
@endsection
