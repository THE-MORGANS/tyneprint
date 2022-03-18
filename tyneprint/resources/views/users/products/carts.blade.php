@extends('layouts.app')
@section('content')
<main id="main" class="cart">
		<section class="header-page">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 hidden-xs">
						<h1 class="mh-title">Shopping Cart</h1>
					</div>
					<div class="breadcrumb-w col-sm-9">
						<ul class="breadcrumb">
							<li>
								<a href="{{route('index')}}">Home</a>
							</li>
							<li>
								<span>Shopping cart</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section class="cart-content parten-bg">
			<div class="container">
			<div class="row">
					<div class="col-md-12 cart-banner-top hidden-xs">
					</div>
				</div>
				<!--Cart top banner : End-->
				<!-- Cart title-->
				<div class="row cart-header hidden-xs">
					<div class="col-md-6 col-sm-10 cart-title">
						<h1>Shopping cart ({{count(\Cart::content())}}) </h1>
					</div>
					<div class="col-md-3 col-sm-2 continue-shopping">
						<a href="{{route('index')}}" title="Continue shopping">
							Continue Shopping 
							<i class="fa fa-arrow-circle-o-right"></i>
						</a>
					</div>
				</div><!-- Cart title : End -->
				@if(Session::has('message'))
					<span class="alert alert-success"> {{Session::get('message')}}
				@endif
					@if(count($carts)>0)
				<div class="row">
					<!--Cart main content : Begin -->
					<section class="cart-main col-md-8 col-xs-12">
						<!--Cart Item-->
						<p class="visible-xs mobile-cart-title">There are {{count(\Cart::content())}} items in your cart.</p>
						<div class="table-responsive">
                            <table cellspacing="0" class="table-cart table">
                                <thead class="hidden-xs">
                                    <tr>
                                        <th class="product-info">Products</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Qty</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
								@foreach ($carts as $cart )
                                    <tr class="cart_item">
                                        <td class="product-info">
                                            <div class="product-image-col">
                                                <a class="product-image" title="product card">
                                                        <img src="{{asset('/frontend/images/product/cart/product-card.jpg')}}" alt="product card">
                                                </a>
                                                <div class="product-action hidden-sm">
												  {{Form::open(['action'=> ['CartController@destroy',$cart->rowId], 'id'=> 'form2', 'method'=>'post'])}}
                                                @csrf 
													<input hidden  class="qty-text increments" name="rowId" type="text"  value="{{$cart->rowId}}">
												<button  style="border:none" class="cart-delete" title="Remove from Cart">
                                                                <small class="fa fa-times btn-danger">remove</small>
                                                        </button>
												 {{Form::hidden('_method', 'DELETE')}}
                                                </form>    
                                                </div>
                                        </div>
                                        <div class="product-info-col">
                                                <h3 class="product-name">{{$cart->model->name}}</h3>
                                        </div>
                                        </td>
                                        <td class="product-price hidden-xs">
                                            <span>₦{{number_format($cart->price,2)}}</span>
                                        </td>
									
                                        <td class="product-quantity hidden-xs"> 
										<form  action="{{route('carts.update', encrypt($cart->model->id))}}" method="post">
                                     	@csrf
										 	
											 <select class="form-control" onchange="this.form.submit()"  name="qty" value="{{$cart->qty}}">
										     @foreach ($cart->model->pricelist as $qty )
                                        	<option value="{{$qty->qty}}" @if($cart->qty == $qty->qty) selected @endif> {{$qty->qty}} </option>
											@endforeach
											</select>
											<input type="hidden"  class="qty-text increments" name="rowId" type="text"  value="{{$cart->rowId}}">
              								@method('PUT')
											  </form>
                                        </td>
										
                                        <td class="product-subtotal hidden-xs">
                                        	<span>₦{{number_format($cart->price,2)}}</span>
                                        </td>
                                    </tr>
								@endforeach
                                 
                                </tbody>
                            </table>
                        </div>
						<!--Cart Item-->
						<div class="row update-wishlist">
							<div class="col-sm-12 hidden-xs">
							TOTAL: <button type="button" name="update-wishlist" class="gbtn btn-update-wishlist">
									₦{{number_format(\Cart::priceTotalFloat(),2)}}
								</button>
							</div>
						</div>
					
					</section><!-- Cart main content : End -->
					<!--Cart right banner: Begin-->
					<section class="col-sm-4 row cart-bottom">
						<div class="subtotal">
						  <form action="{{route('checkout.index')}}" method="get">
                            @csrf
								<h3>Cart Summary</h3>

								<ul>
									<li>
										<span class="sub-title">Sub Total</span>
										<span class="sub-value">₦{{\Cart::subtotal()}}</span>
									</li> 
								<li>
										<span class="sub-title">Tax</span>
										<span class="sub-value">₦{{\Cart::tax()}}</span>
									</li> 
									<li class="grand-total">
										<span class="sub-title">Grand Total</span>
										<span class="sub-value">₦{{number_format(\Cart::TotalFloat() ,2)}} </span>
									</li>
								</ul>
								<button type="submit" class="btn btn-primary" style="padding:10px 50px">Proceed Checkout</button>
							</form>
							</div>
					</section><!--Cart right banner: End-->
				</div>

				@else
						<div class="col-12" style="padding-bottom:20px">

					<div style="background:#eee; text-align:center;">
              <center> <img src="{{asset('/frontend/images/empty.png')}}"> </center>
           <h5 style="color:#fed700"> Your Cart is Empty </h5>
                          <p>Click <a href="{{route('index')}}"> Here to Start Shopping </a> </p>
                               </div>
							   </div>
									@endif
				
			</div>
		</section>
	</main>

@endsection
