<!DOCTYPE html>
<html>
<head>
	<link href="/asset/css/normalize.css" rel="stylesheet">
	<link href="/asset/icomoon/style.css" rel="stylesheet" type="text/css">
	<link href="/asset/css/tweet.css" rel="stylesheet" type="text/css">
	<link href="/asset/css/responsive.css" rel="stylesheet" type="text/css">
</head>

<body>
	<header>
		<div class="container">
		<div class="nav">
			<ul>
				<li>					
					<a href="{{ url('profile?user_id=' . session('me_id')) }}">
						<span class="icon-home3"></span>
						<span class="text_home">Home</span>
					</a>
				</li>
				<li>						
					<a href="#">
						<span class="icon-heart"></span>
						<span class="text_heart">Favorites</span>		
					</a>
				</li>				
			</ul>
		</div>
		
		<h1 class="icon-quill icon_header_center"></h1>

		<div class="header_right">
			<div class="global_search_wrapper">
				<form action="#" class="global_search_form">
					<input type="text" name="global_search" class="global_search_input" placeholder="Search Twitter">
					<input type="submit" value="Go" class="global_search_submit">
				</form>
			</div>
			
			<div class="global_profile_wrapper">
				<a href="{{ url('profile_and_settings') }}"><img src="
				{{ $me->pro_img_path }}" alt="Photograph of {{ $me->name }}" class="global_profile">
				</a>			
			</div>
			
			<div class="global_tweet_wrapper">
				<a href="{{ url('sendTwitter') }}"><button class="global_tweet"><span class="icon-compose icon"></span>Tweet</button></a>
			</div>	
		</div>
		</div>		
	</header>

    @yield('content')
    
</body>
</html>