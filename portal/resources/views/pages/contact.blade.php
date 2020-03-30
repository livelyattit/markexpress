
@extends('layouts.default')
@section('content')

<!--    start contact page content-->
<section class="contact-page-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                <div class="about_us_content_title">
                    <h2>contact us</h2>
                    <h5>no about us more</h5>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <div class="about_us_content_title">
                    <ul class="breadcrumbs">
                        <li><a href="#">home</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="contact-form">
                    <h2 class="contact_page_headings">Send us a message</h2>
                    <form method="post" action="http://crazycafe.net">
                        <input type="text" name="username" placeholder="Your name">
                        <input type="email" name="email_address" placeholder="Email address">
                        <input type="text" name="subject" placeholder="Subject">
                        <textarea name="messages" placeholder="Message"></textarea>
                        <input type="submit" name="submit" value="send">
                    </form>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1 col-sm-6">
                <div class="google-map">
                    <div id="googleMap"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
