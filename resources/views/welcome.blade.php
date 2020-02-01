@extends('layouts.app')

@section('header')

<section id="home-slider">
        <div class="container">
            <div class="row">
                <div class="main-slider">
                    <div class="slide-text">
                        <h1>We Are Creative Nerds</h1>
                        <p>Boudin doner frankfurter pig. Cow shank bresaola pork loin tri-tip tongue venison pork belly meatloaf short loin landjaeger biltong beef ribs shankle chicken andouille.</p>

                        
                        @guest
                            <a href="#loginModal" class="btn btn-common" data-toggle="modal">Log in</a>
                        @endguest
                        
                    </div>
                    <img src="/images/home/slider/hill.png" class="slider-hill" alt="slider image">
                    <img src="/images/home/slider/house.png" class="slider-house" alt="slider image">
                    <img src="/images/home/slider/sun.png" class="slider-sun" alt="slider image">
                    <img src="/images/home/slider/birds1.png" class="slider-birds1" alt="slider image">
                    <img src="/images/home/slider/birds2.png" class="slider-birds2" alt="slider image">
                </div>
            </div>
        </div>
        <div class="preloader"><i class="fa fa-sun-o fa-spin"></i></div>
    </section>
    <!--/#home-slider-->
    @endsection

    @section('content')
    @auth
        
    
    <section id="features" class="my-3">
        <div class="container">
            <div><h1 class="text-center my-2">Featured series</h1></div>
            <div class="row">
                @forelse ($series as $eachSeries)
                    <div class="single-features">
                    <div class="col-sm-5 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                        <img src="{{asset('storage/' . $eachSeries->image_url)}}" class="img-responsive" alt="">
                    </div>
                    <div class="col-sm-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                    <h2>{{$eachSeries->title}}</h2>
                        <P>{{$eachSeries->description}}</P>
                        {{-- <P>{{$eachSeries->image_url}}</P> --}}
                    </div>
                </div>
                @empty
                    
                @endforelse
                
            </div>
        </div>
    </section>
    @endauth
        <div class="row">
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="300ms">
                            <img src="/images/home/icon1.png" alt="">
                        </div>
                        <h2>Incredibly Responsive</h2>
                        <p>Ground round tenderloin flank shank ribeye. Hamkevin meatball swine. Cow shankle beef sirloin chicken ground round.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="600ms">
                            <img src="images/home/icon2.png" alt="">
                        </div>
                        <h2>Superior Typography</h2>
                        <p>Hamburger ribeye drumstick turkey, strip steak sausage ground round shank pastrami beef brisket pancetta venison.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="900ms">
                            <img src="images/home/icon3.png" alt="">
                        </div>
                        <h2>Swift Page Builder</h2>
                        <p>Venison tongue, salami corned beef ball tip meatloaf bacon. Fatback pork belly bresaola tenderloin bone pork kevin shankle.</p>
                    </div>
                </div>
            </div>
    <!--/#services-->
    @endsection