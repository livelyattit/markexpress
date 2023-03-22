@extends('layouts.default')

@section('content')
<div class="main-wrapper">
            <section id="intro-section" class="section">

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="single-hero-slider">
                                <h1>Get the fastest service for your product </h1>
                                <div class="intro-banner-btns">
                                    <a href="#about-us-section">About us</a>
                                    <a href="#">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

             <!--    start about us area-->
             <section id="about-us-section" class="about_us_area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="about_us_content">
                                <h2>about us</h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="about_car">
                                <img src="./assets/img/about-us.jpg" alt="delivery bike">
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
                        <div class="col-3 text-center">
                            <div class="single_count">
                                <h1 class="counter">126</h1>
                                <h5>Satisfied clients</h5>
                            </div>
                        </div>
                        <div class="col-3 text-center">
                            <div class="single_count">
                                <h1 class="counter">34</h1>
                                <h5>Branches</h5>
                            </div>
                        </div>
                        <div class="col-3 text-center">
                            <div class="single_count">
                                <h1 class="counter">120</h1>
                                <h5>Active workers</h5>
                            </div>
                        </div>
                        <div class="col-3 text-center">
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


        </div>
@stop
