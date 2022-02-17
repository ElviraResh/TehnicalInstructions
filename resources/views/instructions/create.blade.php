@extends('layouts.app')

@section('content')
<div class="alert alert-info" role="alert" style="font-size:18px;">
    Добавьте новую инструкцию, используя форму ниже.
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
<form action="/instruction" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Наименование: </label>
        <input class="form-control col-md-6" id="title" name="title" required />
    </div>
    <div class="form-group">
        <label for="file">Файл инструкции: </label>
        <input id="file" name="file" required type="file" />
    </div>

    <button type="submit" class="btn btn-primary mb-2">Отправить</button>
</form>
@endsection
