@extends('layouts.app')

@section('content')
    <h1 class="display-3">Инструкции</h1>
    <form action="/search" method="POST" class="form-inline">
        @csrf

        <input class="form-control form-control-sm mr-3 w-45" name="query" type="text" placeholder="Поиск" aria-label="Search">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search" aria-hidden="true"></i></button>
    </form>


    <ul class="list-group">
        @foreach ($instructions as $instruction)
            <li><a href="/instruction/{{$instruction->id}}" class="list-group-item list-grop-item-action">{{$instruction->title}}</a></li>
        @endforeach
    </ul>
@endsection
