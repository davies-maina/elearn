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

<div class="container">
  <div class="row gap-y text-center">
    <div class="col-12">
    <v-player rawlessons="{{$lesson}}"></v-player>
    </div>
  </div>
</div>
@endsection