@extends('layouts.app')
@section('content')
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Наименование</th>
            <th scope="col">Файл</th>
            <th scope="col">Статус</th>
            <th><span class="fa fa-check"></span></th>
            <th><span class="fa fa-trash"></span></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($instructions as $instruction)
        <tr>
            <th scope="row">{{$instruction->id}}</th>
            <td>{{$instruction->title}}</td>
            <td><a href="/manage/instructions/{{$instruction->id}}/downloadAdmin">Скачать файл</a></td>
            <td>{{$instruction->is_approved ? "Одобрено" : "На рассмотрении"}}</td>
            <td>
                @if ($instruction->is_approved !== 1)
                <a href="/manage/instructions/{{$instruction->id}}/state" class="badge badge-info" style="padding:10px;">Одобрить</a>
                @else
                <a href="/manage/instructions/{{$instruction->id}}/state" class="badge badge-warning" style="padding:10px;">Отказаться</a>
                @endif

            </td>
            <td><a href="{{route('admin.instructions.destroy', $instruction->id)}}" class="badge badge-danger" style="padding:10px;" role="button">Удалить</a></td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
