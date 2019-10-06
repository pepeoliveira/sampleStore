@extends('layouts.frontLayout.front_design')
@section('content')

    <section>
        <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Order Review</li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form">
                            <h2 style="color: rgb(0, 60, 113)">Billing Details</h2>
                            <div class="form-group">
                                {{$userDetails->name}}
                            </div>
                            <div class="form-group">
                              {{$userDetails->address}}
                            </div>
                            <div class="form-group">
                                {{$userDetails->city}}
                            </div>
                            <div class="form-group">
                                {{$userDetails->country}}
                            </div>
                            <div class="form-group">
                                {{$userDetails->zipcode}}
                            </div>
                            <div class="form-group">
                                {{$userDetails->phone}}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="signup-form"><!--sign up form-->
                            <h2 style="color: rgb(0, 60, 113)">Shipping Details</h2>
                            <div class="form-group">
                               {{ $shippingDetails->name }}
                            </div>
                            <div class="form-group">
                               {{ $shippingDetails->address }}
                            </div>
                            <div class="form-group">
                                {{ $shippingDetails->city }}
                            </div>
                            <div class="form-group">
                                 {{ $shippingDetails->country }}
                            </div>
                            <div class="form-group">
                                 {{ $shippingDetails->zipcode }}
                            </div>
                            <div class="form-group">
                                {{ $shippingDetails->phone }}
                            </div>
                        </div><!--/sign up form-->
                    </div>

                </div>
        </div>
    </section><!--/form-->

    <section id="cart_items">
        <div class="container">
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu" style="background-color: #0072B6">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total_amount = 0 @endphp
                    @foreach($userCart as $cart)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img style="width:100px; border: 1px solid black"  src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $cart->product_name }}</a></h4>
                                <p>{{ $cart->product_code }}</p>
                            </td>
                            <td class="cart_price">
                                <p  style="color: #0072B6"><b>€ {{ $cart->price }}</b></p>
                            </td>
                            <td class="cart_price">
                                <p>{{ $cart->quantity }}</p>
                            </td>
                            <td class="cart_price">
                                <p>€ {{ $cart->price*$cart->quantity }}</p>
                            </td>
                            <td class="cart_delete">
                            </td>
                        </tr>
                        @php $total_amount = $total_amount + ($cart->price * $cart->quantity)@endphp
                    @endforeach
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>€ {{$total_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Tax</td>
                                        <td name="tax">@if($total_amount>=60)
                                                {{ $tax = 0 }}
                                            @endif
                                            @if($total_amount<60)
                                                {{ $tax = 15 }}.0
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>@if($total_amount>=60)
                                                <span style="color: green">Free</span>
                                            @endif
                                            @if($total_amount<60)
                                                € {{ $tax_amount = $total_amount * $tax/100 }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span>
                                                @if($total_amount>=60)
                                                    € {{ $payment = $total_amount }}
                                                @endif
                                                @if($total_amount<60)
                                                    € {{ $payment = $total_amount + $tax_amount }}
                                                @endif
                                            </span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form id="paymentForm" name="paymentForm" action="{{ url('/place-order') }}" method="post">{{ csrf_field() }}
                <input type="hidden" name="payment" value="{{ $payment }}">
                <div class="payment-options">
					<span>
						<label><strong> Select Payment Method: </strong></label>
					</span>
                    <span>
						<label><input type="radio" name="payment_method" id="COD" value="COD"> Cash on Delivery</label>
					</span>
                    <span>
						<label><input type="radio" name="payment_method" id="paypal" value="paypal"> Paypal</label>
					</span>
                    <span>
                        <button type="submit" style="float: right" class="botao btn btn-success" onclick="selectPayment();">Confirm Order</button>
                    </span>
                </div>
            </form>


    </section> <!--/#cart_items-->



@endsection
