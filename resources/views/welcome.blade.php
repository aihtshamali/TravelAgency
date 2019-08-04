@extends('layouts.app')
@section('styleTags')
  <style>
    .card
    {
      min-height:220px !important;
    }
    body {
	font-family: Impact !important;
	
}
a{
	color:#fff !important;
}
.button {
	height: 100px!important;
	width: 220px!important;
	cursor: pointer!important;
	margin: 40px auto!important;
	padding:0 50px 0 50px!important;
	float:left!important;
}
.button .outer {
	position: relative!important;
	width: 100%!important;
	height: 100%!important;
	padding: 10px!important;
	background: rgba(0,0,0,0.65)!important;
	border-radius: 14px!important;
	-webkit-border-radius: 14px!important;
	-moz-border-radius: 14px!important;
	box-shadow: inset rgba(0,0,0,0.85) 0px 1px 5px!important;
	-webkit-box-shadow: inset rgba(0,0,0,0.85) 0px 1px 5px!important;
	-moz-box-shadow: inset rgba(0,0,0,0.85) 0px 1px 5px!important;
	-webkit-transform: perspective(500px) rotateX(35deg)!important;
	-moz-transform: perspective(500px) rotateX(35deg)!important;
}
.button .outer .height {
	position: relative!important;
	height: 100%!important;
	margin-top: -15px!important;
	padding-bottom: 15px!important;
	background: maroon!important;
	border-radius: 16px!important;
	-webkit-border-radius: 16px!important;
	-moz-border-radius: 16px!important;
	box-shadow: rgba(0,0,0,0.85) 0px 1px 1px, inset rgba(0,0,0,0.35) 0px -2px 8px!important;
	-webkit-box-shadow: rgba(0,0,0,0.85) 0px 1px 1px, inset rgba(0,0,0,0.35) 0px -2px 8px!important;
	-moz-box-shadow: rgba(0,0,0,0.85) 0px 1px 1px, inset rgba(0,0,0,0.35) 0px -2px 8px!important;
	-webkit-transition: all 0.1s ease-in-out!important;
	-moz-transition: all 0.1s ease-in-out!important;
}       
.button:hover .outer .height {
	margin-top: -10px!important;
	padding-bottom: 10px!important;
	background: maroon!important;
	box-shadow: rgba(0,0,0,0.25) 0px 1px 1px, inset rgba(0,0,0,0.35) 0px -2px 6px!important;
	-webkit-box-shadow: rgba(0,0,0,0.25) 0px 1px 1px, inset rgba(0,0,0,0.35) 0px -2px 6px!important;
	-moz-box-shadow: rgba( 0,0,0,0.25) 0px 1px 1px, inset rgba(0,0,0,0.35) 0px -2px 6px!important;
}
.button:active .outer .height {
	margin-top: 0px!important;
	padding-bottom: 0px!important;
}
.button .outer .height .inner {
	line-height: 2.8em!important;
	font-size:32px!important;
	letter-spacing: .05em!important;
	position: relative!important;
	height: 100%!important;
	text-align: center!important;
	text-shadow: #8aff7b 0px 0px 1px!important;
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#a90329+0,8f0222+44,6d0019+100;Brown+Red+3D */
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#6d0019+0,8f0222+56,a90329+100 */
background:rgba(0, 0, 0, 0) linear-gradient(to bottom, #6d0019 0%, #da0222 56%, #e10329 100%) repeat scroll 0 0!important;
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6d0019', endColorstr='#a90329',GradientType=0 )!important; /* IE6-9 */
	border-radius: 12px!important;
	-webkit-border-radius: 12px!important;
	-moz-border-radius: 12px!important;
	box-shadow: inset rgba(255,255,255,0.85) 0px 0px 1px!important;
	-webkit-box-shadow: inset rgba(255,255,255,0.85) 0px 0px 1px!important;
	-moz-box-shadow: inset rgba(255,255,255,0.85) 0px 0px 1px!important;
	-webkit-transition: all 0.1s ease-in-out!important;
	-moz-transition: all 0.1s ease-in-out!important;
}
.button:hover .outer .height .inner{
	text-shadow: #99f48d 0px 0px 1px!important;
/* Permalink - use to edit and share this!important gradient: http://colorzilla.com/gradient-editor/#a90329+0,8f0222+44,6d0019+100 */
background: #a90329; /* Old browsers */
background: -moz-linear-gradient(top, #a90329 0%, #8f0222 44%, #6d0019 100%)!important; /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a90329), color-stop(44%,#8f0222), color-stop(100%,#6d0019))!important; /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%)!important; /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%)!important; /* Opera 11.10+ */
background: -ms-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%)!important; /* IE10+ */
background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%)!important; /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a90329', endColorstr='#6d0019',GradientType=0 )!important; /* IE6-9 */
}
.button:active .outer .height .inner{
	text-shadow: #319926 0px 1px 0px!important;
	border-radius: 16px!important;
	-webkit-border-radius: 16px!important;
	-moz-border-radius: 16px!importan!important
	box-shadow: inset rgba(0,0,0,0.9) 0px 0px 8px!important;
	-webkit-box-shadow: inset rgba(0,0,0,0.9) 0px 0px 8px!important;
	-moz-box-shadow: inset rgba(0,0,0,0.9) 0px 0px 8px!important;
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#a90329+0,8f0222+44,6d0019+100 */
background: #a90329!important; /* Old browsers */
background: -moz-linear-gradient(top, #a90329 0%, #8f0222 44%, #6d0019 100%)!important; /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a90329), color-stop(44%,#8f0222), color-stop(100%,#6d0019))!important; /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%)!important; /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%)!important; /* Opera 11.10+ */
background: -ms-linear-gradient(top, #a90329 0%,#8f0222 44%,#6d0019 100%)!important; /* IE10+ */
background: linear-gradient(to bottom, #a90329 0%,#8f0222 44%,#6d0019 100%)!important; /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a90329', endColorstr='#6d0019',GradientType=0 )!important; /* IE6-9 */
}

.button a:hover
{
	text-decoration:none!important;
}

#cont
{
	min-height:400px;
	width:1000px;
	margin:auto;
}
.upper
{
	height:170px;
	width:100%;

}
.lower
{
	height:200px;
	width:70%;
	margin:auto;
	
}

  </style>
@endsection
@section('content')
<div class="container">
    <div id="cont">
    <div class="upper">
        <div class="button"><div class="outer"><div class="height"><a href="#"><div class="inner">CRM</div></a></div></div></div>
        
        <div class="button"><div class="outer"><div class="height"><a href="#"><div class="inner">Visa Uploads</div></a></div></div></div>
        
        <div class="button"><div class="outer"><div class="height"><a href="#"><div class="inner">Ummrah</div></a></div></div></div></div>
        
        <div class="lower">
        <div class="button"><div class="outer"><div class="height"><a href="#"><div class="inner">Accounts</div></a></div></div></div>
        
        <div class="button"><div class="outer"><div class="height"><a href="#"><div class="inner">Hotel Vocher</div></a></div></div></div></div>
        
        </div>
        </div>
    
</div>
@endsection
