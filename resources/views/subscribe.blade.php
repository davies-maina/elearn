@extends('layouts.app')

@section('header')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
  <h1 class="display-4">Subscribe</h1>
  {{-- <p class="lead">Username</p> --}}
  
 {{--  <h1 class="display-4"></h1>
  <p class="lead">Lessons completed</p> --}}
  </div>
</div>
@stop
@section('content')
<section class="section" id="section-vtab">
    <div class="container">
    <v-stripe email="{{auth()->user()->email}}"></v-stripe>
</section>    

@endsection

@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
@endsection