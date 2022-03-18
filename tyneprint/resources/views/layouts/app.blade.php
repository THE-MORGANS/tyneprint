<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>@if(isset($title)) {{$title}} | Tyneprints @else Tyneprints @endif </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
	<meta name="description" content="">
	<meta name="author" content="">
	 <link rel="icon" href="{{asset('/images/fav.png')}}">
	<!--Add css lib--> 
	<link rel="stylesheet" type="text/css" href="{{asset('/frontend/css/style-main.css')}}">  
  	<link href='http://fonts.googleapis.com/css?family=Roboto:500,300,700,400' rel='stylesheet' type='text/css'>
  	<link href='https://fonts.googleapis.com/css?family=Arimo:500,300,700,400' rel='stylesheet' type='text/css'>
  	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:500,300,700,400' rel='stylesheet' type='text/css'>
</head>
<body>
	<!--Header: Begin-->
	<header>
		<!--Top Header: Begin-->
		<section id="top-header" class="clearfix">
			<div class="container">
				<div class="row">
					<div class="top-links col-lg-7 col-md-6 col-sm-5 col-xs-6">
						<ul>
							<li class="hidden-xs">
								<a target="_blank" href="https://web.facebook.com/tyneprints9ja">
									<i class="fa fa-facebook"></i>
									<!-- Connect with facebook -->
								</a>
							</li>
							<li class="hidden-xs">
								<a target="_blank" href=" https://twitter.com/tyneprints1">
									<i class="fa fa-twitter"></i> 
								</a>
							</li>
							<li class="hidden-xs">
								<a target="_blank" href="https://www.instagram.com/tynesideinnovation/">
									<i class="fa fa-instagram"></i> 
								</a>
							</li> 
							<li class="hidden-xs">
								<a target="_blank" href="https://www.linkedin.com/company/70461660/">
									<i class="fa fa-linkedin"></i>
								</a>
							</li>
						</ul>
					</div>
					<div class="top-header-right f-right col-lg-5 col-md-6 col-sm-7 col-xs-6">
						<div class="w-header-right">
							<div class="block-currency">
								<div class="currency-active">
										  
                                    @auth    
									<span class="currency-name">
									 {{substr(auth()->user()->name,0,15)}} 
									 	<i class="fa fa-angle-down"></i>
									 </span>
									 @else
									 <span class="currency-name">
									Login here
										<i class="fa fa-angle-down"></i>
									</span>
									@endauth
								</div>
								<ul>
								
										 @auth  
										 	<li>
										 <a href="{{route('user.index')}}" title="My Account">
											<span>My Account</span></a>
											</li>
												<li>
											 <a href="{{route('user.account')}}" title="My Profile">
											<span>My Profile</span></a>
											</li>
											<li>
											 <a href="{{route('user.transactions')}}" title="Transactions">
											<span>Transactions</span></a>
											</li>
											<li>
											 <a href="{{route('user.notification')}}" title="Notifications">
											<span>Notifications</span></a>
											</li>
										<li>
									<a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit()" title="Logout">
										<span>Logout</span>
										</a>
										</li>
											@else
                                            <li>
											<a href="{{route('login')}}" title="Login">
											<span>Login</span></a>
											</li>
											
											<li>
											  <a href="{{route('register')}}"  title="register">
									        	<span>Register</span></a>
											</li>
											@endauth
								
								
								<form id="logout" action="{{route('logout')}}" method="post">
								@csrf
								</form>
									</li>
								</ul>
							</div>
							<div class="language-w clearfix">
								<div class="language-active">
									<span class="language-name">Currency: <span>NG</span>
						        </span>
								</div>
							</div> 
							<div class="th-hotline">
								<i class="fa fa-phone"></i>
								<span>+2349153414314</span>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</section><!--Top Header: End-->
		<!--Main Header: Begin-->
		<section class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 w-logo">
						<div class="logo hd-pd ">
							<a href="{{route('index')}}">
								<img src="{{asset('/frontend/images/logo.png')}}"  width="150px" alt="">
							</a>
						</div>	
					</div>
					<div class="col-lg-7 col-md-8 visible-md visible-lg">
						<nav id="main-menu" class="main-menu clearfix">
							<ul>
								<li class="level0 parent col1 all-product hd-pd">
									<a href="#"><span>All Designs</span><i class="fa fa-chevron-down"></i></a>
									<ul class="level0">
										<li class="level1">
											<ul class="level1">
                                            @foreach( $menu_categories as $cat )
												<li class="level2">
													<a href="{{route('user.category', encrypt($cat->id))}}" title="{{$cat->name}}"><i class="fa fa-chevron-right"> </i> {{$cat->name}}</a>
													<ul class="level2">
                                                     @foreach ($cat->products as $prod)
														<li>
															<a href="{{url('/products/details', $cat->name.'_'.encrypt($prod->id))}}" >{{$prod->name}}</a>
														</li>
                                                        @endforeach
														<li><img src="{{asset('/images/category/'.$cat->image)}}" alt="{{$cat->name}}" ></li>
													</ul>
												</li>
                                                 @endforeach
												
											</ul>
										</li>
									</ul>
								</li>
								<li class="level0 hd-pd">
									<a href="{{route('index')}}">Home</a>
								</li>
								 @foreach ($menu as $menus)
								<li class="level0 hd-pd">
									<a href="{{route('pages', encrypt($menus->id))}}">{{$menus->name}}</a>
								</li>
                                @endforeach
							</ul>
						</nav>
					</div>
					<div class="col-sm-1 visible-sm visible-xs mbmenu-icon-w">
						<span class="mbmenu-icon hd-pd">
							<i class="fa fa-bars"></i>
						</span>
					</div>
					<div class="col-lg-1 col-md-2 col-sm-2 col-xs-3 headerCS">
						<div class="cart-w SC-w hd-pd ">
							<span class="mcart-icon dropdowSCIcon">
								<i class="fa fa-shopping-cart"></i>
								<a href="{{route('carts.index')}}"> <span class="mcart-dd-qty"> @if(Cart::count()> 0){{Cart::count()}}  @else 0 @endif</span></a>
							</span>
						</div>
						<div class="search-w SC-w hd-pd ">
							<span class="search-icon dropdowSCIcon">
								<i class="fa fa-search"></i>
							</span>
							<div class="search-safari">
								<div class="search-form dropdowSCContent">
									<form method="get" action="{{route('search')}}">
										<input type="text" name="search" placeholder="Search" />
										<input type="submit" >
										<i class="fa fa-search"></i>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!--Main Header: End-->
	</header><!--Header: End-->


@yield('content')


<footer>
		<div class="footer-main">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-4 col-xs-12 about-us footer-col">
						<h2>About Us</h2>
						<div class="footer-content">
							<a href="{{route('index')}}" title="Cmsmart logo footer" class="logo-footer">
								<img src="{{asset('/frontend/images/logo.png')}}"  width="100px" alt="logo footer">
							</a>
							<ul class="info">
								<li>
									<i class="fa fa-home"></i>
									<span>UK office: 24 Holborn Viaduct, London, England, EC1A 2BN, United Kingdom</span>
									<span>NG office: 2nd Floor, 1 Adeola Adeoye Street, Off Olowu Street or Toyin Street,
Ikeja, Lagos Nigeria</span>
								</li>
								<li>
									<i class="fa fa-phone"></i>
									<span>+23417001770 ,+2349153414314</span>
								</li>
								<li>
									<i class="fa fa-envelope-o"></i>
									<span><a href="mailto:info@tynesideinnovation.com" title="send mail to Cmsmart">enquiries@tyneprints.com</a></span>
								</li>
							</ul>
							<ul class="footer-social">
								<li>
									<a target="_blank" href="https://web.facebook.com/tyneprints9ja" title="Facebook">
										<i class="fa fa-facebook"></i>
									</a>
								</li>
									<li>
									<a target="_blank" href="https://www.linkedin.com/company/70461660/" title="LinkedIn">
										<i class="fa fa-linkedin"></i>
									</a>
								</li>
								<li>
									<a target="_blank" href="https://twitter.com/tyneprints1" title="Twiter">
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<li>
									<a target="_blank" href="https://www.instagram.com/tynesideinnovation/" title="Instagram">
										<i class="fa fa-instagram"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12 corporate footer-col">
						<h2>Corporate</h2>
						<div class="footer-content">
							<ul>
								<li>
									<a href="https://morgansconsortium.com/" >Morgans Consortium</a>
								</li>
								<li>
									<a href="http://tynesideinnovation.com/">Tyne Innovations</a>
								</li>
								<li>
									<a href="https://portrec.co.uk/" >Portrec</a>
								</li>
								<li>
									<a href="https://grcfinancialcrime.com/" >Grcfinancialcrime.</a>
								</li>
								
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12 support footer-col">
						<h2>Easy Links</h2>
						<div class="footer-content">
							<ul>
								<li>
									<a href="{{route('user.index')}}" title="My Account">My Account</a>
								</li>
								<li>
									<a href="{{route('user.account')}}" >Contact Us</a>
								</li>
								<li>
									<a href="#" >About Us</a>
								</li>
								<li>
									<a href="{{route('pages',5)}}" >How it works</a>
								</li>
								<li>
									<a href="#" title="Contact Us">Contact Us</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-3 col-xs-12 other-info footer-col hidden-sm">
						<h2>Other Info</h2>
						<div class="footer-content">
							<p>
						Tyneprints provides fast printing for both homes and businesses. We provide high quality business cards, flyers, brochures, stationery and other premium print products</p>
						
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copy-right">Copyright © <script>document.write(new Date().getFullYear())</script>. All Rights Reserved</p>
						<a href="#" id="back-to-top">
							<i class="fa fa-chevron-up"></i>
							Top
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<div id="sitebodyoverlay"></div>
	<nav id="mb-main-menu" class="main-menu">
		<div class="mb-menu-title">
			<h3>Navigation</h3>
			<span id="close-mb-menu">
				<i class="fa fa-times-circle"></i>
			</span>
		</div>
		<ul  class="cate_list">
			<li class="level0 parent col1 all-product">
				<a href="#">
					<span>All Designs</span>
					<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-right"></i>
				</a>
				<ul class="level0">
                    @foreach( $menu_categories as $cat )
                        <li class="level1">
                            <a href="{{route('user.category', encrypt($cat->id))}}" title="Calendar">{{$cat->name}}</a>
                        </li>
                            @endforeach
                        
                    </ul>
            </li>
            @foreach ($menu as $menus)
			<li class="level0">
				<a href="{{route('pages', encrypt($menus->id))}}" >{{$menus->name}} </a>
			</li>
			 @endforeach
		
    </ul>
	</nav> 
	<!--Add js lib-->
	<script type="text/javascript" src="{{asset('/frontend/js/jquery/jquery-1.11.3.min.js')}}"></script> 
	<script type="text/javascript" src="{{asset('/frontend/js/bootstrap.min.js')}}"></script> 
    <script type="text/javascript" src="{{asset('/frontend/js/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/frontend/js/Chart.js')}}"></script> 
    <script type="text/javascript" src="{{asset('/frontend/js/doughnutit.js')}}"></script>
  <!--   <script type="text/javascript" src="/frontend/js/jquery.subscribe-better.js"></script> -->
    <script type="text/javascript" src="{{asset('/frontend/js/slideshow/jquery.themepunch.revolution.js')}}"></script>   
	<script type="text/javascript" src="{{asset('/frontend/js/slideshow/jquery.themepunch.plugins.min.js')}}"></script>  
    <script type="text/javascript" src="{{asset('/frontend/js/theme-home.js')}}"></script>  
	  
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  	<![endif]-->
	

	@yield('script')
</body>
</html>
