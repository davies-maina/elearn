@extends('layouts.app')


@section('header')
 <div class="container py-5">
    {{-- <div class="jumbotron text-white jumbotron-image shadow overlay bg-primary bg-a-50 p-6 text-white" style="background-image: url({{$series->image_path}});">
      <h2 class="mb-4 text-white">
        Jumbotron with background image
      </h2>
      <p class="mb-4">
        Hey, check this out.
      </p>
      <a href="https://bootstrapious.com/snippets" class="btn btn-primary">More Bootstrap Snippets</a>
    </div> --}}
    <div class="jumbotron" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.7) 0%,rgba(0,0,0,0.7) 100%), url({{$series->image_path}});">
    <h1 class="display-4" style="opacity:1;color:white">{{$series->title}}</h1>
    <p class="lead" style="color:white">{{$series->description}}</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  @if (auth()->user())
      @if (auth()->user()->hasStartedSeries($series))
          <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Resume</a>
  </p>
      @else
      <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Begin</a>
  </p>
   @endif
  @else
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Begin learning</a>
  </p>
          
     
  @endif
</div>
  </div>
    
@endsection


@section('content')

<section id="action" class="responsive">
        <div class="vertical-center">
             <div class="container">
                 <small></small>
                <div class="row">
                    <div class="action take-tour">
                        <div class="col-sm-7 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                            <h1 class="title">Triangle Corporate Template</h1>
                            <p>A responsive, retina-ready &amp; wide multipurpose template.</p>
                        </div>
                        <div class="col-sm-5 text-center wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                            <div class="tour-button">
                                <a href="#" class="btn btn-common">TAKE THE TOUR</a>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </section>
    
@endsection