@extends('layouts.app')
@section('header')

<div class="jumbotron jumbotron-fluid">
  <div class="container">
  <h1 class="display-4">Edit : {{$series->title}}</h1>
    <p class="lead">Editing series page</p>
  </div>
</div>

@endsection
    


@section('content')
<div class="container">
<form method="POST" action="{{route('series.update',$series->slug)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PUT')}}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Series title">Title</label>
    <input type="text" class="form-control" id="" value="{{$series->title}}" placeholder="series title" name="title">
    </div>
    
  <div class="form-group col-md-6">
       <label for="series description">Description</label>
  <textarea class="form-control" placeholder="description" cols="10" rows="4" name="description">{{$series->description}}</textarea>

  </div>

 
  
    <div class="input-group">
      <label for="exampleFormControlFile1">Choose file</label>
    <input type="file" class="form-control-file"  name="image">
    </div>
    <br>
 
  
  
  
  {{-- <div class="input-group-prepend">
    <span class="input-group-text">With textarea</span>
  </div> --}}
  
  <button type="submit" class="btn btn-primary">Update series</button>
</form>
</div>

@endsection