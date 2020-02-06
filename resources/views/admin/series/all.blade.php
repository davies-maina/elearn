@extends('layouts.app')
@section('header')

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">All series</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>

@endsection
    


@section('content')
<div class="container">
<table class="table">
    <thead>
        <th>Title</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
        @forelse ($series as $eachSeries)
            <tr>
            <td><a href="{{route('series.show', $eachSeries->slug)}}">{{$eachSeries->title}}</a></td>
            <td>
            <a href="{{route('series.edit',$eachSeries->slug)}}" class="btn btn-default">Edit</a>
            </td>
             <td>
                <a href="" class="btn btn-danger">Delete</a>
            </td>
            </tr>
        @empty
            <p class="text-center">You have no series</p>
        @endforelse
    </tbody>
</table>
</div>

@endsection