@extends('layouts.app')
@section('header')

<div class="jumbotron jumbotron-fluid">
  <div class="container">
  <h1 class="display-4">{{$series->title}}</h1>
  <p class="lead">{{$lesson->title}}</p>
  </div>
</div>

@endsection
    


@section('content')

{{-- <vue-lessons dblessons="{{$series->lessons}}" series-id="{{$series->id}}"></vue-lessons> --}}
@endsection