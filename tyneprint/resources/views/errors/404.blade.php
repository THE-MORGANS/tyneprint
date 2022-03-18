@extends('layouts.app')

@section('content')

<main class="main">
		<section class="header-page">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 hidden-xs">
						<h1 class="mh-title">Home</h1>
					</div>
					<div class="breadcrumb-w col-sm-9">
					
						<ul class="breadcrumb">
							<li>
								<a href="index.html">Home</a>
							</li>
							<li>
								<span>Errors</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		
		<section class="product-info-w">
			<div class="container">
				<div class="row" style="padding-top:100px">
				
				
				</div>

				<div class="row">
					<div class="tab-content clearfix">
					    <div role="tabpanel" class="tab-pane active" id="features">
					    	<div class="product-image v-middle">
						    	<div class="col-sm-12 col-xs-12">
						    		<img src="{{asset('/error.png')}}" alt="ideal 1">
						    	</div>
						    </div>
						    <div class="product-shortdescript v-middle">
								<div class="col-sm-12 col-xs-12">
									<div class="v-middle">
										<h3>An error Occured</h3>
							    		<ul>
							    			<li><i class="fa fa-check"></i> This page cannot be found on this server</li>
							    			<a href="{{route('index')}}" class="btn btn-primary"> Return Home</a>
										
							    		</ul>
							    	</div>
								</div>
							</div>
					    </div>
				
					   
					</div>
				</div>
			</div>
		</section>

@endsection