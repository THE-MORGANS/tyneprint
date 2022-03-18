@extends('layouts.app')
@section('content')
	<main class="main">
		<section class="header-page">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 hidden-xs">
						<h1 class="mh-title">Login</h1>
					</div>
					<div class="breadcrumb-w col-sm-9">
						<ul class="breadcrumb">
							<li>
								<a href="http://netbaseteam.com/">Home</a>
							</li>
							<li>
								<span>Login</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section class="pr-main" id="pr-login">	
			<div class="container">	
				<div class="col-md-12 col-sm-4 col-xs-12">
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<img src="{{asset('/images/3.jpg')}}" />
				
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
					<h1 class="ct-header">Login</h1>			
						<h4>Returning Customers</h4>
                          <form method="POST" action="{{ route('login') }}" class="form-validate form-horizontal">
                        @csrf
							<p>Email Address <span class="star">*</span></p>
							<input class="email" type="text" class="form-control @error('email') is-invalid @enderror"  name="email"> <br>
                              @error('email')
                                    <span class="btn-danger" role="alert">
                                        <strong class="">{{ $message }}</strong>
                                    </span>
                                @enderror
							<p>Password <span class="star">*</span></p>
							<input class="password" type="password"  id="password" name="password"   class="form-control @error('password') is-invalid @enderror" ><br>
                             @error('password')
                                    <span class="btn-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
								 <div class="input-group-append">
                                <span class=" input-group-text " onclick="myFunction()">View Password<i class="fa fa-fw fa-eye"></i></span>
                                </div>
								<br>
								
                                <button type="submit" class="btn btn-primary" style="padding: 10px 100px">
                                    {{ __('Login') }}
                                </button>
								

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
								 <a class="btn btn-link" href="{{ route('register') }}">
                                         {{ __('Don\'t have account?') }} Register
                                    </a>
                            </div>
                        </div>
						</form>
						
					</div>
		</section>
	</main><!--Main index : End-->


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