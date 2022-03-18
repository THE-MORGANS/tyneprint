@extends('layouts.app')

@section('content')

	<main class="main">
		<section class="header-page">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 hidden-xs">
						<h1 class="mh-title">Checkout</h1>
					</div>
					<div class="breadcrumb-w col-sm-9">
						<ul class="breadcrumb">
							<li>
								<a href="{{route('index')}}">Home</a>
							</li>
							<li>
								<span>Payment</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>


	<section id="checkout" class="pr-main">
			<div class="container">	
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="cart-top">
				</div>
			</div>	
				<div class="cart-view-top">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<h1>Shopping Cart</h1>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 right">
							<h1>Continue Shopping</h1>
						</div>
						@if(Session()->has('message'))
						<div class="col-md-12 col-sm-12 col-xs-12" style="padding:20px">
							
								<span class="alert alert-{{Session::get('alert')}}"> 
								{{Session()->get('message')}}
								@if(Session()->has('reset'))
								<a class="btn-info" style="padding:5px"  href="{{route('password.request')}}"> Reset Password </a>
								@endif
								</span>
							</div>
								@endif
							

							<div id="login-pane" class="col-md-12 col-sm-12 col-xs-12">
							<p>Please complete Order payment.
							</p>
							</div>
						
								
				</div>
								
								
{{Form::open(['action'=>'CheckoutController@storeOrder', 'method'=>'post', 'id'=>'form1'])}}
@csrf
											
	<div class="onepage">
				<div  class="col-md-7 col-sm-6 col-xs-12">
				<div id="div_billto">
				<!-- user info -->
					<div class="pane round-box">
						<h3 class="title"><span class="icon icon-one">1</span>Customer Information</h3>
						<div class="pane-inner">
							<ul id="table_billto" class="adminform user-details no-border">
								<li class="short">
									<div class="field-wrapper">
										<label for="company_field" class="company">Name</label>
										<br>
										<input type="text" name="name" maxlength="64"@auth value=" {{auth()->user()->name}}" @endauth value="{{old('name')}}" class="@error('name') is-invalid @enderror" placeholder="Full Name" @auth readOnly @endauth> 
											@error('name')
												<span class="btn-danger" role="alert">
												<small> {{$message}}</small>
												</span>
												@enderror
									</div>
								</li>

								<li class="short right">
									<div class="field-wrapper">

									<label for="email_field" class="email">Email<em>*</em>	</label>
									<br>
									<input type="email" name="email" value="@auth {{auth()->user()->email}} @endauth {{old('email')}} " class="@error('email') is-invalid @enderror" placeholder="Email Address" @auth readOnly @endauth>
											@error('email')
												<span class="btn-danger" role="alert">
												<small> {{$message}}</small>
												</span>
												@enderror
										</div>
								</li>
									<li class="long">
									<div class="field-wrapper">
										<label for="phone_2_field" class="phone_2">Mobile phone	</label><br>
								<input type="text" name="phone" @auth value=" {{auth()->user()->phone}} @endauth" value="{{old('phone')}}" class="@error('phone') is-invalid @enderror" placeholder="Phone number" @auth readOnly @endauth>
									@error('phone')
										<span class="btn-danger" role="alert">
										<small> {{$message}}</small>
										</span>
									@enderror
								</div>
								</li>
								
								</ul>

						</div>
					</div>
					<!-- end of user info -->
					<div class="pane round-box">
						<h3 class="title"><span class="icon icon-one">2</span>SHIPING INFORMATION</h3>
						<div class="pane-inner">
							<ul id="table_billto" class="adminform user-details no-border">
								<li class="short">
									<div class="field-wrapper">
										<label for="company_field" class="company">Name	</label>
										<br>
									<input type="text" name="receiver_name"  @if(isset($address->receiver_name)) value="{{$address->receiver_name}}" @endif value="{{old('receiver_name')}}" class="@error('receiver_name') is-invalid @enderror" placeholder="First Name">
											@error('receiver_name')
												<span class="btn-danger" role="alert">
												<small> {{$message}}</small>
												</span>
												@enderror
									</div>
								</li>

								<li class="short right">
									<div class="field-wrapper">

									<label for="email_field" class="email">E-Mail<em>*</em>	</label>
									<br>
									<input type="email" name="receiver_email" @if(isset($address->receiver_email)) value="{{$address->receiver_email}}" @endif value="{{old('receiver_email')}}" class="@error('receiver_email') is-invalid @enderror" placeholder="Email Address">
											@error('receiver_email')
												<span class="btn-danger" role="alert">
												<small> {{$message}}</small>
												</span>
												@enderror
									</div>
								</li>

								<li class="short">
									<div class="field-wrapper">
									<label for="middle_name_field" class="middle_name">Phone</label>
									<br>
									<input type="text" @if(isset($address->receiver_phone)) value="{{$address->receiver_phone}}" @endif name="receiver_phone"    value="{{old('receiver_phone')}}" class="@error('receiver_phone') is-invalid @enderror" placeholder="Phone number">
											@error('receiver_phone')
												<span class="btn-danger" role="alert">
												<small> {{$message}}</small>
												</span>
												@enderror
									</div>
								</li>

								<li class="short right">
									<div class="field-wrapper">
									<label for="zip_field" class="zip">Zip / Postal Code<em>*</em>	</label><br>
									<input type="text" name="zip_code"   @if(isset($address->zip_code)) value="{{$address->zip_code}}" @endif value="{{old('zip_code')}}"   class="@error('zip_code') is-invalid @enderror" placeholder="Zip Code">	
										</div>
								</li>

								<li class="short">
									<div class="field-wrapper">
									<label for="virtuemart_city" class="virtuemart_state_id">City<em>*</em></label>
									<br>
									<input type="text" name="city"  @if(isset($address->city)) value="{{$address->city}}" @endif value="{{old('city')}}"   class="@error('city') is-invalid @enderror" placeholder="Town/City">
											@error('city')
												<span class="btn-danger" role="alert">
												<small> {{$message}}</small>
												</span>
												@enderror
									</div>
								</li>
									

								<li class="short right">
									<div class="field-wrapper">
									<label for="virtuemart_state_id_field" class="virtuemart_state_id">State<em>*</em>					</label>
									<br>
								<input type="text"  name="state"   @if(isset($address->state)) value="{{$address->state}}" @endif value="{{old('state')}}"   class="@error('state') is-invalid @enderror" placeholder="State">
											@error('state')
												<span class="btn-danger" role="alert">
												<small> {{$message}}</small>
												</span>
												@enderror
									</div>
								</li>

								<li class="long">
									<div class="field-wrapper">
										<label for="address_1_field" class="address_1">Address 1<em>*</em></label>	<br>
									<input type="text" name="address"@if(isset($address->address)) value="{{$address->address}}" @endif value="{{old('address')}}"  class="@error('address') is-invalid @enderror"placeholder="Address">
											@error('address')
												<span class="btn-danger" role="alert">
												<small> {{$message}}</small>
												</span>
												@enderror
									</div>
								</li>
								</ul>

						</div>
					</div>
				</div>
				<!-- Cos 2 -->
        <!-- shipping_info -->
</div>
	<div class="col-md-5 col-sm-5 col-xs-12">
            <div id="right-pane-top" class="col-md-12 col-sm-12 col-xs-12">    
 		<div id="payment_method" class="col-md-12 col-sm-12 col-xs-12">
					<div class="payment-pane">
					<div class="pane round-box">
						<h3 class="title">
							<span class="icon icon-four">3</span>
							Delivery method		</h3>
						<div class="pane-inner">
						Select Delivery method
						<fieldset id="payments">
					<input type="radio" id="home_delivery" value="home_delivery" @if($address->delivery_method == 'home_delivery')  checked @endif class="@error('delivery_method') is-invalid  @enderror toggleM"	name="delivery_method">
					<label for="payment_id_1">
					<span class="vmpayment">
					<span class="vmpayment_name">Home Delivery</span></span> </label><br>
					
					<p id="home_de" @if($address->delivery_method != 'home_delivery') hidden @endif> This item will be delivered to
					{{$address->receiver_name. ', '. $address->receiver_phone.', '.$address->address.', '.$address->city}} at the shipping fee of  ₦{{number_format($fare->delivery_fee)}}</p>
					<br>
					<input type="radio" id="pickup" value="pickup" @if($address->delivery_method == 'pickup')  checked @endif class="@error('delivery_method') is-invalid @enderror toggleM" name="delivery_method">
					<label for="payment_id_2">
					<span class="vmpayment @error('delivery_method') is-invalid @enderror">
					<span class="vmpayment_name">Pickup Delivery</span></span>  </label><br>
					<p id="pickup_de" @if($address->delivery_method != 'pickup') hidden @endif>You will visit 2nd Floor, 1 Adeola Adeoye Street, Off Olowu Street or Toyin Street,
					Ikeja, Lagos Nigeria to pick up your item</p>
					<br></fieldset>	
					@error('delivery_method')
						<span class="btn-danger" role="alert">
						<small> {{$message}}</small>
						</span>
						@enderror
						</div>
						</div>
					</div>
                </div>
</div>
</div>
<div id="checkfull" class="col-md-5 col-sm-5 col-xs-12">
<div  class="col-md-12 col-sm-12 col-xs-12" >
 <!-- render layout -->
  
    <fieldset class="round-box" id="cart-contents">
<h3 class="title"><span class="icon fa fa-check"></span>ORDER DETAILS</h3>
	<table cellspacing="0" cellpadding="0" border="0" class="cart-summary no-border">
	 <tr class="pr-total">
		   <td colspan="1">
			   <table>                             
					<tbody>
						<tr class="first">
							<td>SubTotal:</td>
							<td class="pr-right"><div class="PricesalesPrice vm-display vm-price-value"><span class="vm-price-desc"></span>
							<span class="PricesalesPrice">₦{{\Cart::subtotal()}}</span></div></td>
						</tr>
						<tr>
							<td>Tax:</td>
							<td class="pr-right"><span id="total_tax" class="priceColor2">₦{{\Cart::tax()}}</span></td>
						</tr>
						<tr>
						<input type="hidden" id="fee" value="@if($address->delivery_method == 'home_delivery'){{$fare->delivery_fee}} @else 0 @endif">
							<td>Shipment:</td>
							<td class="pr-right"><span id="shipment" class="priceColor2">@if($address->delivery_method == 'home_delivery')  ₦{{number_format($fare->delivery_fee)}} @endif</span></td>
						</tr>
														<tr class="last">
							<td>Total:</td>
							<td class="pr-right"><strong id="total_paid">₦ @if($address->delivery_method == 'home_delivery') {{number_format(\Cart::totalFloat() + $fare->delivery_fee) }} @else {{number_format(\Cart::totalFloat())}} @endif</strong></td>
						</tr>
					</tbody>
			   </table>
			</td>
		</tr>
	   <!--  End Total -->
		<tr class="coupon-pane">
				<td align="right" class="border-radius-lb" colspan="6">
				<input id="tos" class="terms-of-service" type="checkbox"  name="tos" checked>
			<span>Click here to read terms of service and check the box to accept them.</span>
			 <form>
			<script src="https://checkout.flutterwave.com/v3.js"></script>
			<button type="button"  onClick="makePayment()" id="btnsubmit2" class="btn btn-primary btn-lg w-100">Complete Payment</button>
			</form>
			</td>
		</tr>
		
	</tbody></table>
</fieldset>
<!-- right-pane-bottom -->
</div>
		</div>
	</div>
	{{Form::close()}}
		</section>
	</main>
@endsection


@section('script')
<script>

let total_paid = {!! json_encode(\Cart::Totalfloat())!!};
let fare = {!! json_encode($fare->delivery_fee)!!};
let total = parseInt(total_paid) + parseInt(fare);
$('.toggleM').on('change', function(){
	//alert(document.getElementById('fees').value);
	if(document.getElementById('home_delivery').checked == true){
	 $('#shipment').html('<span class="font-weight-bold">'+'₦'+thousands_separators(fare)+'</span>'); 
	 $('#home_de').attr('hidden', false);
	 $('#pickup_de').attr('hidden', true);
	 $('#fee').attr('value', fare);
	  $('#total_paid').html('₦'+thousands_separators(total)); 
	}else{
 	$('#shipment').html('<span class="font-weight-bold">'+'₦'+0+'</span>'); 
		$('#pickup_de').attr('hidden', false);
		 $('#fees').attr('value', 0);
		$('#total_paid').html('₦'+thousands_separators(total_paid)); 
		$('#home_de').attr('hidden', true);
	}
});



var _token = {!! json_encode(config('app.FLUTTERWAVE_KEY')) !!};
let email = {!! json_encode(auth()->user()->email) !!};
let phone = {!! json_encode(auth()->user()->phone) !!};
let name = {!! json_encode(auth()->user()->name) !!};
let amounts = {!! json_encode(\Cart::Totalfloat())!!}
let fee = document.getElementById('fee').value;
let total_pay = amounts + parseInt(fee);

 function makePayment() {
    FlutterwaveCheckout({
      public_key: _token,
      tx_ref: "TNE"+Math.floor((Math.random() * 1000000) + 1),
      amount: total_pay,
      currency: "NGN",
      country: "NG",
      payment_options: "card, ussd",
     // redirect_url: // specified redirect URL
       // https://callbacks.piedpiper.com/flutterwave.aspx?ismobile=34",
      meta: {
        consumer_id: 1,
        consumer_mac: "92a3-912ba-1192a",
        purpose: "Payment for Order",
        
      },
      customer: {
        email: email,
        phone_number: phone,
        name: name,
      },
      
       callback: function (response) {
          var trx_id = response.transaction_id;
           console.log(response);
          $.ajax({
              url: 'http://tyneprints.local/payment/'+ trx_id,
              method: 'get',
              success: function (response) {
                // console.log(response);
                // the transaction status is in response.data.status
                var data = $.parseJSON(response);
                console.log(data);
                var iamount = parseFloat(data.data.amount);
                if(data.data.status == 'successful' ){
                        $('#form1').submit(); 
                }
            },
      });
      },
      onclose: function() {
        // close modal
      },
      customizations: {
        title: "TynePrints",
        description: "Payment for Order",
       logo: "http://tyneprints.local/frontend/image/logo.png",
      },
    });
  };
function thousands_separators(num)
  {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
  }
  
</script>

@endsection