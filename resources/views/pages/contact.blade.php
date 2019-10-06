@extends('layouts.frontLayout.front_design')

@section('content')

    <section>
        <div class="container" style="margin-left: 150px; margin-right: 150px;">
            <div class="row">

                <div class="col-12">
                    <h2 class="title-text-center">Contact us</h2><br>
                    {{--                       CONTACT FORM--}}
                    <div class="row">
                        <div class="contact-form">
                            <div class="status alert alert-success" style="display: none"></div>
                            <form id="main-contact-form" class="contact-form row" name="contact-form" method="post"
                                  action="{{url('/page/contact')}}">
                                @csrf
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" required="required"
                                           placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" required="required"
                                           placeholder="Email">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="subject" class="form-control" required="required"
                                           placeholder="Subject">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea name="message" id="message" required="required" class="form-control"
                                              rows="8" placeholder="Your Message Here"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="submit" name="submit" class="btn btn-primary pull-right"
                                           value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 50px;">
                        <div class="col-sm-6">
                            <div class="contact-info">
                                <h2 class="title">Contact Info</h2>
                                <address>
                                    <p>SPORTS E-SHOPER Portugal Ltd.</p>
                                    <p>Rua do CESAE, 100 - Porto, PORTUGAL</p>
                                    <p>Phone: +351 22 217 38 93</p>
                                    <p>Email: info@sportseshopper.com</p>
                                </address>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-networks">
                                <h2 class="title text-center">Our Social Networks</h2>
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
