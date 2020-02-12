@extends('layouts.app')

@section('header')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
  <h1 class="display-4">Name</h1>
  <p class="lead">Title</p>
  </div>
</div>
@stop
@section('content')
<section class="section" id="section-vtab">
    <div class="container">
        <header class="section-header">
        <h2>Series being watched ...</h2>
        <hr>
        </header>


        <div class="row gap-5">
           
                <div class="card mb-30">
                <div class="row">
                    <div class="col-12 col-md-4 align-self-center">
                    <a href=""><img src="" alt="..."></a>
                    </div>

                    <div class="col-12 col-md-8">
                    <div class="card-block">
                        <h4 class="card-title"></h4>
                    
                        <p class="card-text"></p>
                        <a class="fw-600 fs-12" href="">Read more <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
                    </div>
                    </div>
                </div>
                </div>
         

        </div>
        </div>
</section>    
<section class="section bg-gray" id="section-vtab">
    <div class="container">
        <header class="section-header">
        <h2>Edit your profile</h2>
        <hr>
        </header>


        <div class="row gap-5">
        

        <div class="col-12 col-md-4">
            <ul class="nav nav-vertical">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home-2">
                <h6>Personal details</h6>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#messages-2">
                <h6>Payments & Subscriptions</h6>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings-2">
                <h6>Settings</h6>
                </a>
            </li>
            </ul>
            </div>


        <div class="col-12 col-md-8 align-self-center">
            <div class="tab-content">
            <div class="tab-pane fade show active" id="home-2">
                <form action="" method="POST" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="name" placeholder="Your name">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" type="text" name="email" placeholder="Your email">
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Save changes</button>
                    </form>
            </div>

            <div class="tab-pane fade" id="profile-2">
                <p class="text-center"><img src="assets/img/blog-2.jpg" alt="..."></p>
            </div>

            <div class="tab-pane fade" id="messages-2">
                <p class="text-center"><img src="assets/img/blog-3.jpg" alt="..."></p>
            </div>

            <div class="tab-pane fade" id="settings-2">
                <p class="text-center"><img src="assets/img/blog-4.jpg" alt="..."></p>
            </div>

            </div>
        </div>


        </div>


    </div>
</section>    

@endsection