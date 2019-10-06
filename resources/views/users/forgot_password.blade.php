@extends('layouts.frontLayout.front_design')
@section('content')

    <section id="form" style="margin-top: 0px;"><!--form-->
        <div class="container">
            <div class="row">
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>   {!! session('flash_message_error') !!}</strong>
                    </div>
                @endif
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>   {!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Forgot Password ?</h2>
                        <form id="forgotPWform" name="forgotPWform" method="post" action="{{url('forgot-password')}}">
                            @csrf
                            <input name="email" type="email" placeholder="Email Address" required />
                            <br><br>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Register new user</h2>
                        <form id="registerForm" name="registerForm" action="{{ url('/user-register') }}" method="POST">
                            @csrf
                            <input id="name" name="name" type="text" placeholder="Name"/>
                            <input id="email" name="email" type="email" placeholder="Email Address"/>
                            <input id="myPassword" name="password" type="password" placeholder="Password"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->


@endsection
