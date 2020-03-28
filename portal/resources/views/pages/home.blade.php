@extends('layouts.default')

@section('content')

    <div id="preloader"></div>
    <!--start header area with background video-->
    <section class="header_area version2-hero">

        <!--   start welcome text area     -->
        <div class="table">
            <div class="cell">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <div class="welcome_text version-2">
                                <div class="hero-slider">
                                    <div class="single-hero-slider">
                                        <h1>Get the fastest service </h1>
                                        <h1>for your product</h1>
                                        <div class="welcome_p">
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam </p>
                                            <p>nibh euismod tincidunt ut laoreet dolore magna.</p>
                                        </div>
                                    </div>
                                    <div class="single-hero-slider">
                                        <h1>Get the fastest service </h1>
                                        <h1>for your product</h1>
                                        <div class="welcome_p">
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam </p>
                                            <p>nibh euismod tincidunt ut laoreet dolore magna.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--        end of welcome text area-->
    </section>
    <!--end of header area-->

    <!--   start about top area-->
    <section class="about_top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="about_single_item">
                        <div class="item_icon">
                            <img src="{{asset('assets/img/item_icon.png')}}" alt="item">
                        </div>
                        <div class="about_single_item_content">
                            <h4>Fastest Delivery</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="about_single_item">
                        <div class="item_icon">
                            <img src="{{asset('assets/img/item_icon.png')}}" alt="item">
                        </div>
                        <div class="about_single_item_content">
                            <h4>Fastest Delivery</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="about_single_item">
                        <div class="item_icon">
                            <img src="{{asset('assets/img/item_icon.png')}}" alt="item">
                        </div>
                        <div class="about_single_item_content">
                            <h4>Fastest Delivery</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    end of about top area-->
    <!--    start about us area-->
    <section class="about_us_area" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="about_us_content">
                        <h2>about us</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                        <a href="#">read more <span  class="fa fa-long-arrow-right"></span></a>
                    </div>
                </div>
                <div class="col-md-offset-1 col-sm-6 col-md-5">
                    <div class="about_car">
                        <img src="{{asset('assets/img/item_icon.png')}}" alt="car">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--   end of about us area-->
    <!--start counter up area-->
    <section class="couter_up_area" id="service">
        <div class="table">
            <div class="cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-3 text-center">
                            <div class="single_count">
                                <h1 class="counter">126</h1>
                                <h5>Satisfied clients</h5>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-md-offset-1 text-center">
                            <div class="single_count">
                                <h1 class="counter">34</h1>
                                <h5>Branches</h5>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-md-offset-1 text-center">
                            <div class="single_count">
                                <h1 class="counter">120</h1>
                                <h5>Active workers</h5>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-md-offset-1 text-center">
                            <div class="single_count">
                                <h1 class="counter">3546</h1>
                                <h5>Product delivered s</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    end of counter up area-->

@stop
