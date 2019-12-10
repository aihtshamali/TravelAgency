@extends('layouts.app')
@section('styleTags')
  <style>
	  .card-body{
		  text-align:center
	  }
	  .content-wrapper{
		  background-color:#f8fafc;
	  }

	* {
		transition: all 0.3s ease-out;
	}
	html, body {
		height: 100%;
		font-family: "Nunito", sans-serif;
		font-size: 16px;
	
	}
	.container {
		width: 100%;
		height: 100%;
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: center;
	}
	h3 {
		color: #262626;
		font-size: 17px;
		line-height: 24px;
		font-weight: 700;
		margin-bottom: 4px;
	}
	p {
		font-size: 17px;
		font-weight: 400;
		line-height: 20px;
		color: #666;
	}
	p.small {
		font-size: 14px;
	}
	.go-corner {
		display: flex;
		align-items: center;
		justify-content: center;
		position: absolute;
		width: 32px;
		height: 32px;
		overflow: hidden;
		top: 0;
		right: 0;
		background-color: #00838d;
		border-radius: 0 4px 0 32px;
	}
	.go-arrow {
		margin-top: -4px;
		margin-right: -4px;
		color: white;
		font-family: courier, sans;
	}
	.card1 {
		display: block;
		top: 0px;
		position: relative;
		max-width: 262px;
		min-width: 262px;
		background-color: #f2f8f9;
		border-radius: 4px;
		padding: 32px 24px;
		margin: 12px;
		text-decoration-line: none !important;
		z-index: 0;
		overflow: hidden;
		border: 1px solid #f2f8f9;
	}
	/* .card1:before {
		content: "";
		position: absolute;
		z-index: -1;
		top: -16px;
		right: -16px;
		background: #00838d;
		height: 32px;
		width: 32px;
		border-radius: 32px;
		transform: scale(2);
		transform-origin: 50% 50%;
		transition: transform 0.15s ease-out;
	} */
	.card1:hover:before {
		transform: scale(2.15);
	}
	.card1:hover {
		transition: all 0.2s ease-out;
		box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
		top: -4px;
		border: 1px solid #ccc;
		background-color: white;
	}
	.card1 img{
		
		height: 64px;
		width: 64px;
	}
	.card2 {
		display: block;
		top: 0px;
		position: relative;
		max-width: 262px;
		min-width: 262px;
		background-color: #f2f8f9;
		border-radius: 4px;
		padding: 32px 24px;
		margin: 12px;
		text-decoration-line: none !important;
		z-index: 0;
		overflow: hidden;
		border: 1px solid #f2f8f9;
	}
	/* .card2:before {
		content: "";
		position: absolute;
		z-index: -1;
		top: -16px;
		right: -16px;
		background: #00838d;
		height: 32px;
		width: 32px;
		border-radius: 32px;
		transform: scale(2);
		transform-origin: 50% 50%;
		transition: transform 0.15s ease-out;
	} */
	.card2:hover:before {
		transform: scale(2.15);
	}
	.card2:hover {
		transition: all 0.2s ease-out;
		box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
		top: -4px;
		border: 1px solid #ccc;
		background-color: white;
	}
	.card2 img{
		
		height: 64px;
		width: 64px;
	}
	.card3 {
			display: block;
		top: 0px;
		position: relative;
		max-width: 262px;
		min-width: 262px;
		background-color: #f2f8f9;
		border-radius: 4px;
		padding: 32px 24px;
		margin: 12px;
	text-decoration-line: none !important; 
		z-index: 0;
		overflow: hidden;
		border: 1px solid #f2f8f9;
	}
	.card3 .go-corner {
		opacity: 0.7;
	}
	.card3:hover {
		transition: all 0.2s ease-out;
		box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
		top: -4px;
		border: 1px solid #ccc;
		background-color: white;
	}
	.card3:hover p {
		color: #00838d;
	}
	.card3:hover .go-corner {
		transition: opactiy 0.3s linear;
		opacity: 1;
	}
	.card3 img{
		
		height: 64px;
		width: 64px;
	}
	.card4 {
		display: block;
		top: 0px;
		position: relative;
		max-width: 262px;
		min-width: 262px;
		background-color: #f2f8f9;
		border-radius: 4px;
		padding: 32px 24px;
		margin: 12px;
	text-decoration-line: none !important;
		z-index: 0;
		overflow: hidden;
		border: 1px solid #f2f8f9;
	}
	/* .card4:before {
		content: "";
		position: absolute;
		z-index: -1;
		top: -16px;
		right: -16px;
		background: #00838d;
		height: 32px;
		width: 32px;
		border-radius: 32px;
		transform: scale(2);
		transform-origin: 50% 50%;
		transition: transform 0.15s ease-out;
	} */
	.card4:hover:before {
		transform: scale(2.15);
	}
	.card4:hover {
		transition: all 0.2s ease-out;
		box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
		top: -4px;
		border: 1px solid #ccc;
		background-color: white;
	}
	.card4 img{
		
		height: 64px;
		width: 64px;
	}
</style>
@endsection
@section('content')
<div class="container">
    <div class="content-wrapper ml-0 mt-5">
        @include('inc/flashMessages')

		<div class="container">
			<a class="card1 text-center" href="{{route('home')}}">
				<img alt=""  src="{{asset('images/crm.png')}}">
				<h3>CRM</h3>
				{{-- <p class="small">CRM Dashboard.</p> --}}
				{{-- <div class="go-corner" href="#">
				<div class="go-arrow">
					→
				</div>
				</div> --}}
			</a>
  
				<a class="card2 text-center" href="{{route('User.index')}}">
				<img alt="" src="{{asset('images/user.png')}}">
				<h3>User Management</h3>
				{{-- <p class="small">User Management</p> --}}
				{{-- <div class="go-corner" href="#">
				<div class="go-arrow">
					→
				</div>
				</div> --}}
			</a>
			<a class="card3 text-center" href="{{route('cashbookIndex')}}">
			<img alt="" src="{{asset('images/accounts.png')}}">
				<h3 >Cashbook</h3>
				{{-- <div class="go-corner" href="#">
				<div class="go-arrow">
					→
				</div>
				</div> --}}
			</a>
			
			<a class="card4 text-center" href="#">
			<img alt="" src="{{asset('images/db.png')}}">
				<h3>Databases</h3>
				{{-- <div class="go-corner" href="#">
				<div class="go-arrow">
					→
				</div>
				</div> --}}
			</a>
			
		</div>

		{{-- <div class="row">
			<div class="col-md-3">
				  <a class="card1" href="#">
						<h3>CRM</h3>
						<p class="small">CRM Dashboard</p>
						<div class="go-corner" href="#">
						<div class="go-arrow">
							→
						</div>
						</div>
					</a>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						Cash Book
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						User Management
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						Data Base
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-body">
						My Profile
					</div>
				</div>
			</div>
		</div> --}}
	</div>
</div>
@endsection
