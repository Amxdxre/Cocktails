@extends('layouts.app')

@section('content')
    <h1>Заебаш кокетль!</h1>
    <form method="POST" action="{{ route('cocktails.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Описание <i style="text-decoration:line-through">маразма</i></label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Главное изображение</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
@endsection
