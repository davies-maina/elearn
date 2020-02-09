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
     <div class="col-6">
      <ul class="list-group">
      @foreach ($series->getOrderedLessons() as $eachLesson)
          <li class="list-group-item">
          <a href="{{route('series.watch',['series'=>$series->slug,'lesson'=>$eachLesson->id])}}">{{$eachLesson->title}}</a>
          </li>
      @endforeach
      </ul>
    </div>
    <div class="col-6">
      
    <v-player rawlessons="{{$lesson}}"></v-player>
    <div>
      @if ($lesson->getPreviousLesson())
       <a href="{{route('series.watch',['series' => $series->slug, 'lesson' => $lesson->getPreviousLesson()->id ])}}" class="btn btn-primary">Previous lesson</a> 
    @endif
    
    @if ($lesson->getNextLesson())
        <a href="{{route('series.watch', ['series' => $series->slug, 'lesson' => $lesson->getNextLesson()->id ])}}" class="btn btn-primary">Next lesson</a>
    @endif
    </div>
    
    </div>
   
  </div>
</div>
@endsection