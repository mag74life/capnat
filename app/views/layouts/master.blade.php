<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
		@section('head')
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>@if(isset($title)) {{$title}} – @endif CAPNAT</title>
			<meta name="description" content="">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

			<link rel="stylesheet" href="/css/normalize.css">
			<link rel="stylesheet" href="/css/main.css">
			{{-- <script src="/js/vendor/modernizr.js"></script>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<script>window.jQuery || document.write('<script src="js/vendor/jquery.js"><\/script>')</script> --}}
		@show
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<div id="page">
			<header id="header">
				<h1>CAPNAT</h1>
				@if (Session::get('userRole') === 0)
					<div id="logout"><a href="{{ URL::to('logout') }}">log out</a></div>
				@elseif (Session::get('userRole') === 1)
					<div id="logout"><a href="{{ URL::to('staff-logout') }}">log out</a></div>
				@endif
			</header>
			<div id="content">
				@yield('content')
			</div>
			<div id="footer">
				@yield('footer')
			</div>
		</div>
    </body>
</html>
