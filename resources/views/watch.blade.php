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
@php
    $nextLesson=$lesson->getNextLesson();
    $previousLesson=$lesson->getPreviousLesson();
@endphp
<div class="container">
  <div class="row gap-y text-center">
     <div class="col-6">
      <ul class="list-group" >
      @foreach ($series->getOrderedLessons() as $eachLesson)
          <li class="list-group-item 
          
         @if($eachLesson->id==$lesson->id)

           disabled
         @endif

          
          
          ">
           @if($eachLesson->id==$lesson->id)

           <b><small>Showing</small></b>
         @endif
          @if (auth()->user()->hasCompletedLesson($eachLesson))
              <b><small>Completed</small></b>
          @endif
          <a href="{{route('series.watch',['series'=>$series->slug,'lesson'=>$eachLesson->id])}}">{{$eachLesson->title}}</a>
          </li>
      @endforeach
      </ul>
    </div>
   
      
    <v-player rawlessons="{{$lesson}}" 
    @if ($nextLesson)
        
    
     nextlesson="{{route('series.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id ])}}">
      @endif
  </v-player>
    <div>
      @if ($previousLesson)
       <a href="{{route('series.watch',['series' => $series->slug, 'lesson' => $previousLesson->id ])}}" class="btn btn-primary">Previous lesson</a> 
    @endif
    
    @if ($nextLesson)
        <a href="{{route('series.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id ])}}" class="btn btn-primary">Next lesson</a>
    @endif
    </div>
    
    
   
  </div>
</div>
@endsection