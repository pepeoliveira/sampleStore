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
                    <div class="login-form">
                        <h2>Update account</h2>
                        <form id="accountForm" name="accountForm" action="{{ url('/account') }}" method="POST">
                            @csrf
                            <input value="{{$userDetails->name}}" id="name" name="name" type="text" placeholder="Name"/>
                            <input value="{{$userDetails->address}}" id="address" name="address" type="text" placeholder="Address"/>
                            <input value="{{$userDetails->city}}" id="city" name="city" type="text" placeholder="City"/>
                            <select name="country" id="country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                            <input value="{{$userDetails->zipcode}}" style="margin-top:10px;" id="zipcode" name="zipcode" type="text" placeholder="Zip-Code"/>
                            <input value="{{$userDetails->phone}}" id="phone" name="phone" type="text" placeholder="Phone"/>

                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <h2>Update Password</h2>
                        <form id="pwvalidation" name="passwordForm" action="{{ url('/update-user-pwd') }}" method="POST">
                            @csrf
                            <input id="current_pass" name="current_pass" type="password" placeholder="Current Password"/>
                            <span id="checkpass"></span>
                            <input id="new_pass" name="new_pass" type="password" placeholder="New Password"/>
                            <input  id="confirm_pass" name="confirm_pass" type="password" placeholder="Confirm Password"/>
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/form-->


@endsection
