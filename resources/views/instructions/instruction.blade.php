@extends('layouts.app')

@section('content')
    <h1 class="display-3" style="display:inline;">{{$instruction->title}} </h1>
    <h1 style="display:inline;"><span class="badge badge-info">by {{$instruction->author->name}}</span></h1>
    &nbsp;&nbsp;
    <a style="font-size:22px;" href="/instructions/{{$instruction->id}}/download">Download instruction</a>
    <hr>

    @auth
        <div class="alert alert-danger" role="alert" style="font-size:25px;">
            Do you have something to report? Use the form below!
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
        <form action="/report" method="POST">
            @csrf
            <div class="form-group">
                <label for="txtarea">Report description</label>
                <textarea class="form-control" id="txtarea" rows="3" name="description" required></textarea>
            </div>
            <input type="hidden" name="instruction" value="{{$instruction->id}}">
            <button type="submit" class="btn btn-primary mb-2">Send</button>
        </form>
    @endauth

@endsection
