<!DOCTYPE html>
<html>
<head>
	<link href="/asset/css/normalize.css" rel="stylesheet">
	<link href="/asset/css/tweet.css" rel="stylesheet" type="text/css">
	<link href="/asset/icomoon/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="heading">
		<header>			
			<a href="" class="note"><span class="icon-quill"></span>Notes</a>
			<nav>
				<ul>
					<li class="selected">					
						<a href="{{ url('timeline?user_id=' . session('user_id')) }}"><span class="icon-home3 icon"></span>timeline</a>
					</li>
					<li>						
						<a href="{{ url('profile?user_id=' . session
						('user_id')) }}"><span class="icon-drawer icon"></span>profile</a>
					</li>
					<li>						
						<a href=""><span class="icon-heart icon"></span>Favorites</a>
					</li>
					<li>						
						<a href="{{ url('sendTwitter') }}"><span class="icon-compose icon"></span>Post</a>
					</li>
					<li>
						<a href="{{ url('logout') }}"><span class="icon-logout icon"></span>Logout</a>
					</li>				
				</ul>
			</nav>
			<a href="{{ url('profile_and_settings') }}"><img src="
				{{ $user->pro_img_path }}" alt="Photograph of {{ $user->name }}" class="nav-photo">
			</a>
		</header>
    </div>
    @yield('content')
    
</body>
</html>