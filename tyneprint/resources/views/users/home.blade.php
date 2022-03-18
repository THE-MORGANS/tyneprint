@extends('layouts.app')
@section('content')
<main class="main index">
		<!--Home slider : Begin-->
		<section class="home-slidershow">
			<div class="slide-show">
				<div class="vt-slideshow" style="height:56px">
					<ul>
						<li class="slide1" data-transition="random" ><img src="{{asset('/frontend/images/product/slide.jpg')}}"  alt="" />
							<div class="tp-caption lfr" data-x="right"  data-hoffset="-56" data-y="100" data-start="800" data-speed="2000" data-endspeed="300"><span class="style1"><span class="textcolor">Flyers</span> & Leaflets</span></div> 
							<div class="tp-caption lfb" data-x="right"  data-hoffset="-15" data-y="155" data-start="800" data-speed="2000" data-endspeed="300">	<span class="style2">
									Our A5 flyers and leaflets are our bestselling size.<br> 
									This is because they're perfect for potential prospects<br>  
									to carry around and are extremely cost effective. 
									
								</span>
							</div>
							<div class="tp-caption lfr" data-x="right" data-hoffset="-315" data-y="275" data-start="1300" data-speed="2000" data-easing="easeInOutQuint" data-endspeed="300"><a class="btn-sn" href="{{route('register')}}">Get Started</a></div> 
						</li>
					</ul> 
				</div>
			</div>
		</section>
		<!--Home Trust : Begin-->
		<section class="trust-w hidden-xs">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 block-trust trust-col-quantity">
						<div class="tr-icon"><i class="fa fa-thumbs-up"></i></div>
						<div class="tr-text">
							<h3>Quality Printing</h3>
							<span class="tr-line"></span>
							<p>Bright inks. Thick Paper. Precise cuts. We believe that quality printing matters.  That quality printing matters.</p>
							
						</div>
					</div>
					<div class="col-md-3 col-sm-6 block-trust trust-col-time-delivery">
						<div class="tr-icon"><i class="fa fa-paper-plane"></i></div>
						<div class="tr-text">
							<h3>Timely Delivery</h3>
							<span class="tr-line"></span>
							<p>No printer is faster. Order today by 8:00pm EST and you can even get it tomorrow.</p>
							
						</div>
					</div>
					<div class="col-md-3 col-sm-6 block-trust trust-col-eco-minded">
						<div class="tr-icon"><i class="fa fa-leaf"></i></div>
						<div class="tr-text">
							<h3>Eco-Minded</h3>
							<span class="tr-line"></span>
							<p>
								Overnight Prints is the greenest online printer in the world. See our Waterless technology. 
							</p>
							
						</div>
					</div>
					<div class="col-md-3 col-sm-6 block-trust trust-col-eco-money">
						<div class="tr-icon"><i class="fa fa-money"></i></div>
						<div class="tr-text">
							<h3>Money Back Guaranteed</h3>
							<span class="tr-line"></span>
							<p>
								Most sellers work with buyers to quickly resolve issues, but if a solution isn't reached, we can help.
							</p>
							
						</div>
					</div>
				</div>
			</div>
		</section><!--Home Trust : End-->
		<!--Home Promotions Products : Begin -->       
        <section class="or-service">
			<div class="container">
				<div class="row">
					<div class="block-title-w">
						<h2 class="block-title">FEATURED DESIGNS</h2>
						<span class="icon-title">
							<span></span>
							<i class="fa fa-star"></i>
						</span>
						
					</div>
					<div class="or-service-w">

                    @foreach ($products as $prod )
                       @php
                        $name = preg_replace("[\(|\)|/|\"|\"]", '-', $prod->name);  
                         @endphp
						<div class="col-md-3 col-sm-6 col-xs-6 or-block" style="padding-bottom:20px">
							<div class="or-image">
								<a href="{{url('/products/details',$name.'_'.encrypt($prod->id))}}">
									<img src="{{asset('/images/products/'.$prod->image)}}" alt="service-01"/>
								</a>
							</div>
							<div class="or-title">
								<a href="{{url('/products/details',$name.'_'.encrypt($prod->id))}}">{{$prod->name}}</a>
							</div>
							<div class="or-text">
								<p>
									From 	<span class="normal-price">₦{{number_format($prod->sale_price,2)}}</span>
								</p>
							</div>
							<a href="{{url('/products/details',$name.'_'.encrypt($prod->id))}}" class="btn-readmore order-now">Order now</a>
						</div>

                       @endforeach
					   
				
					</div>
				</div>
			</div>
		<center><div>{{$products->links()}}</div></center>	
		</section><!--Home Promotions Products : End -->
		<!--Home New print Template : Begin -->
		
	
		<!--Home make print : Begin -->
	
		<!--Home capabilitie : Begin -->
		<section class="">
			<div class="container">
				<div class="row">
					<div class="block-capabititie-w">
					</div>
				</div>
			</div>
		</section>
		<!--Home ours service : Begin -->
	
		<!--Home out recent : Begin -->
	
	
	</main> 

@endsection