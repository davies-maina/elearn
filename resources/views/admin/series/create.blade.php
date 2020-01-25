@extends('layouts.app')
@section('header')

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Fluid jumbotron</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>

@endsection
    


@section('content')
<div class="container">
<form method="POST" action="{{route('series.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Series title">Title</label>
      <input type="text" class="form-control" id="" placeholder="series title" name="title">
    </div>
    
  <div class="form-group col-md-6">
       <label for="series description">Description</label>
  <textarea class="form-control" aria-label="With textarea" placeholder="description" name="description"></textarea>

  </div>

 
  
    <div class="input-group">
      <label for="exampleFormControlFile1">Choose file</label>
    <input type="file" class="form-control-file"  name="image">
    </div>
    <br>
 
  
  
  
  {{-- <div class="input-group-prepend">
    <span class="input-group-text">With textarea</span>
  </div> --}}
  
  <button type="submit" class="btn btn-primary">Create series</button>
</form>
</div>

@endsection