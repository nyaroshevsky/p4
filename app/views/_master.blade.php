<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Fodler')</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='{{ URL::asset('/stylesheet.css') }}' type='text/css'>
	
	@yield('head')


</head>
<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<nav>
		
		 <!-- Header navigation -->

        <ul>

        	@if(Auth::check())
        	<li id='home_icon'><a href='/'>Pult</a></li>
            
            <li class='nav_icons'>Welcome {{ Auth::user()->email; }}</li>

            <li class='nav_icons'>|</li>

            <li class='nav_icons'><a href='/logout'>Sign Out</a></li>
            @else
            <li id='home_icon'><a href='/'>Pult</a></li>
            
            <li class='nav_icons'><a href='/join'>Join</a></li>

            <li class='nav_icons'>|</li>

            <li class='nav_icons'><a href='/login'>Sign In</a></li>
			@endif

            <!-- Empty div to clear floats -->
            <li><span id='empty_span'></span></li>

        </ul>

	</nav>

	

	@yield('content')

	@yield('/body')

	<br>
	<br>
	<a href='https://github.com/nyaroshevsky/p4'>View on Github</a>

</body>
</html>