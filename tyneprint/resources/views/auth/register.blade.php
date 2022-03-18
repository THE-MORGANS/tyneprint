@extends('layouts.app')

@section('content')
<main class="main">
		<section class="header-page">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 hidden-xs">
						<h1 class="mh-title">Register</h1>
					</div>
					<div class="breadcrumb-w col-sm-9">
						<ul class="breadcrumb">
							<li>
								<a href="">Home</a>
							</li>
							<li>
								<span>Register</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section class="pr-main" id="pr-register">	
			<div class="container">	
                       <div class="col-md-4 col-sm-4 col-xs-12 right">
                	<img src="{{asset('/images/3.jpg')}}" />
				
                </div>
				<div class="col-md-8 col-sm-8 col-xs-12">		
					<div class="col-md-6 col-sm-6 col-xs-12 left">
						<h1>Create an Account</h1>
						<h4>Personal Information</h4>
						<form id="register-form" class="form-validate form-horizontal" method="post" action="#">
						@csrf
                        <p>Name <span class="star">*</span></p>
							<input class="name" placeholder="name"  type="text" class="form-control @error('name') is-invalid @enderror"  name="name"> <br>
                              @error('name')
                                    <span class="btn-danger" role="alert">
                                        <strong >{{ $message }}</strong>
                                    </span>
                                @enderror
                            <p>Email Address <span class="star">*</span></p>
							<input class="email" placeholder="email" type="text" class="form-control @error('email') is-invalid @enderror"  name="email"> <br>
                              @error('email')
                                    <span class="btn-danger" role="alert">
                                        <strong >{{ $message }}</strong>
                                    </span>
                                @enderror
                            <p>Phone Number <span class="star">*</span></p>
							<input class="email" type="text" placeholder="phone Number"  class="form-control @error('phone') is-invalid @enderror"  name="phone"> <br>
                              @error('phone')
                                    <span class="btn-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            	<p>Password <span class="star">*</span></p>
							<input class="password" placeholder="password"  id="password" type="password"  name="password"   class="form-control @error('password') is-invalid @enderror" ><br>
                             @error('password')
                                    <span class="btn-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="input-group-append">
                                <span class=" input-group-text " onclick="myFunction()">View Password<i class="fa fa-fw fa-eye"></i></span>
                                </div> 
						 <button type="submit" class="btn btn-primary" style="padding: 10px 100px">
                                    {{ __('Register') }}
                                </button>
                         <a class="btn btn-link" href="{{ route('login') }}">
                                         {{ __('Have account already?') }} Login
                                    </a>
                        </form>
                        </div>
                    
				</div>
				
				  
			</div>
		</section>
	</main>
@endsection

@section('script')

 <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
            </script>

@endsection
