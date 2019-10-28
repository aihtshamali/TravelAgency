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
	 position: relative;
	 max-width: 262px;
	 min-width: 262px;
	 background-color: #f2f8f9;
	 border-radius: 4px;
	 padding: 32px 24px;
	 margin: 12px;
	 text-decoration: none;
	 z-index: 0;
	 overflow: hidden;
}
 .card1:before {
	 content: "";
	 position: absolute;
	 z-index: -1;
	 top: -16px;
	 right: -16px;
	 background: #00838d;
	 height: 32px;
	 width: 32px;
	 border-radius: 32px;
	 transform: scale(1);
	 transform-origin: 50% 50%;
	 transition: transform 0.25s ease-out;
}
 .card1:hover:before {
	 transform: scale(21);
}
 .card1:hover p {
	 transition: all 0.3s ease-out;
	 color: rgba(255, 255, 255, 0.8);
}
 .card1:hover h3 {
	 transition: all 0.3s ease-out;
	 color: #fff;
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
	 text-decoration: none;
	 z-index: 0;
	 overflow: hidden;
	 border: 1px solid #f2f8f9;
}
 .card2:hover {
	 transition: all 0.2s ease-out;
	 box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
	 top: -4px;
	 border: 1px solid #ccc;
	 background-color: white;
}
 .card2:before {
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
}
 .card2:hover:before {
	 transform: scale(2.15);
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
	 text-decoration: none;
	 overflow: hidden;
	 border: 1px solid #f2f8f9;
}
 .card3 .go-corner {
	 opacity: 0.7;
}
 .card3:hover {
	 border: 1px solid #00838d;
	 box-shadow: 0px 0px 999px 999px rgba(255, 255, 255, 0.5);
	 z-index: 500;
}
 .card3:hover p {
	 color: #00838d;
}
 .card3:hover .go-corner {
	 transition: opactiy 0.3s linear;
	 opacity: 1;
}
 .card4 {
	 display: block;
	 top: 0px;
	 position: relative;
	 max-width: 262px;
	 background-color: #fff;
	 border-radius: 4px;
	 padding: 32px 24px;
	 margin: 12px;
	 text-decoration: none;
	 overflow: hidden;
	 border: 1px solid #ccc;
}
 .card4 .go-corner {
	 background-color: #00838d;
	 height: 100%;
	 width: 16px;
	 padding-right: 9px;
	 border-radius: 0;
	 transform: skew(6deg);
	 margin-right: -36px;
	 align-items: start;
	 background-image: linear-gradient(-45deg, #8f479a 1%, #dc2a74 100%);
}
 .card4 .go-arrow {
	 transform: skew(-6deg);
	 margin-left: -2px;
	 margin-top: 9px;
	 opacity: 0;
}
 .card4:hover {
	 border: 1px solid #cd3d73;
}
 .card4 h3 {
	 margin-top: 8px;
}
 .card4:hover .go-corner {
	 margin-right: -12px;
}
 .card4:hover .go-arrow {
	 opacity: 1;
}
 
</style>
@endsection
@section('content')
<div class="container">
    <div class="content-wrapper ml-0 mt-5">
        @include('inc/flashMessages')

		<div class="container">
  <a class="card1" href="{{route('home')}}">
    <h3>CRM</h3>
    <p class="small">CRM Dashboard.</p>
    <div class="go-corner" href="#">
      <div class="go-arrow">
        →
      </div>
    </div>
  </a>
  
  <a class="card2" href="#">
    <h3>This is option 2</h3>
    <p class="small">Card description with lots of great facts and interesting details.</p>
    
    <div class="go-corner" href="#">
      <div class="go-arrow">
        →
      </div>
    </div>
  </a>
  
  <a class="card3" href="#">
    <h3>This is option 3</h3>
    <p class="small">Card description with lots of great facts and interesting details.</p>
    <div class="dimmer"></div>
    <div class="go-corner" href="#">
      <div class="go-arrow">
        →
      </div>
    </div>
  </a>
  
  <a class="card4" href="#">
    
<svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 51.3 (57544) - http://www.bohemiancoding.com/sketch -->
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Artboard-Copy-19" transform="translate(-874.000000, -1729.000000)" stroke-width="1.5">
            <g id="Group-22" transform="translate(0.000000, 1672.000000)">
                <g id="Group-46" transform="translate(688.000000, 33.000000)">
                    <g id="Group-42" transform="translate(166.000000, 0.000000)">
                        <g id="Group-25" transform="translate(21.000000, 25.000000)">
                            <g id="Group-9" transform="translate(0.000000, 17.666667)">
                                <path d="M14,8.33306667 L14,12.3330667" id="Stroke-3" stroke="#CD3D73"></path>
                                <polyline id="Stroke-1" stroke="#666666" points="18 4.33306667 18 12.3330667 10 12.3330667"></polyline>
                                <polyline id="Stroke-5" stroke="#666666" points="10 5.1332 10 12.3332 2 12.3332 2 6.3332"></polyline>
                                <polygon id="Stroke-7" stroke="#666666" points="9 6.33306667 14 0.333066667 5 0.333066667 0 6.33306667"></polygon>
                            </g>
                            <path d="M20,23.9997333 L14,17.9997333" id="Stroke-10" stroke="#666666"></path>
                            <g id="Group-15" transform="translate(5.666667, 0.000000)" stroke="#666666">
                                <polygon id="Stroke-11" points="9.28906667 7.99973333 16.3330667 -0.000266666667 7.33306667 -0.000266666667 0.289066667 7.99973333"></polygon>
                                <path d="M24.3333333,7.99973333 L16.3333333,-0.000266666667" id="Stroke-13"></path>
                            </g>
                            <path d="M16,6.8148 L16,14.0001333" id="Stroke-16" stroke="#666666"></path>
                            <polyline id="Stroke-17" stroke="#666666" points="28 5.99973333 28 23.9997333 24 23.9997333"></polyline>
                            <path d="M8,13.9997333 L8,7.99973333" id="Stroke-19" stroke="#666666"></path>
                            <path d="M20,8.99973333 L20,9.99973333" id="Stroke-20" stroke="#CD3D73"></path>
                            <path d="M24,8.99973333 L24,9.99973333" id="Stroke-21" stroke="#CD3D73"></path>
                            <path d="M20,13.9997333 L20,14.9997333" id="Stroke-22" stroke="#CD3D73"></path>
                            <path d="M24,13.9997333 L24,14.9997333" id="Stroke-23" stroke="#CD3D73"></path>
                            <path d="M24,18.9997333 L24,19.9997333" id="Stroke-24" stroke="#CD3D73"></path>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>
    <h3>This is option 4</h3>
    <p class="small">Card description with lots of great facts and interesting details.</p>
    <div class="dimmer"></div>
    <div class="go-corner" href="#">
      <div class="go-arrow">
        →
      </div>
    </div>
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
