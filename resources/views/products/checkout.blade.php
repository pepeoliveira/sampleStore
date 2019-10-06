@extends('layouts.frontLayout.front_design')
@section('content')

    <section><!--form-->
        <div class="container">
            <form action="#" style="margin-bottom: 40px">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h2 style="color: rgb(0, 60, 113)">Bill to</h2>
                                <div class="form-group">
                                    <input type="text" name="billing_name" id="billing_name" placeholder="Billing Name" value="{{$userDetails->name}}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="billing_address" id="billing_address" placeholder="Billing Address" value="{{$userDetails->address}}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="billing_city" id="billing_city" placeholder="Billing City" value="{{$userDetails->city}}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <select id="billing_country" name="billing_country" class="form-control">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->country_name }}"
                                            @if($country->country_name == $userDetails->country)
                                                selected @endif> {{ $country->country_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="billing_zip" id="billing_zip" placeholder="Billing Zip-Code" value="{{$userDetails->zipcode}}" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="billing_phone" id="billing_phone" placeholder="Billing Phone"  value="{{$userDetails->phone}}"class="form-control"/>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="copyAddress" name="copyAddress">
                                    <label class="form-check-label" for="copyAddress">Shipping Address same as Billing Adress</label>
                                </div>
                        </div><!--/login form-->
                    </div>
                    <div class="col-sm-1">
                        <h2 class="or">OR</h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="signup-form"><!--sign up form-->
                            <h2 style="color: rgb(0, 60, 113)">Ship To</h2>
                                <div class="form-group">
                                    <input type="text" id="shipping_name" name="shipping_name" placeholder="Shipping Name" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="shipping_address" name="shipping_address" placeholder="Shipping Address" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="shipping_city" name="shipping_city" placeholder="Shipping City" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <select id="shipping_country" name="shipping_country" class="form-control">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->country_name }}"
                                                    @if($country->country_name == $userDetails->country)
                                                    selected @endif> {{ $country->country_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="shipping_zipcode" name="shipping_zipcode" placeholder="Shipping Zip-code" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="shipping_phone" name="shipping_phone" placeholder="Shipping Phone" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn" value="Check Out" style="border-color: rgb(0, 114, 182);">
                                </div>
                        </div><!--/sign up form-->
                    </div>

                </div>
            </form>
        </div>
    </section><!--/form-->



@endsection
