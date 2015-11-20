<!DOCTYPE html>
<html>
<head>
	<link href="{{ 'asset/css/normalize.css' }}" rel="stylesheet">
	<link href="{{ 'asset/css/tweet.css' }}" rel="stylesheet" type="text/css">
	<link href="{{ 'asset/icomoon/style.css' }}" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="heading">
		<header>			
			<a href="" class="note"><span class="icon-quill"></span>Notes</a>
			<nav>
				<ul>
					<li class="selected">					
						<a href=""><span class="icon-home3 icon"></span>Home</a>
					</li>
					<li>						
						<a href=""><span class="icon-drawer icon"></span>Messages</a>
					</li>
					<li>						
						<a href=""><span class="icon-heart icon"></span>Favorites</a>
					</li>
					<li>
						<a href=""><span class="icon-signup icon"></span>Signup</a>
					</li>
					<li>
						<a href=""><span class="icon-login icon"></span>Login</a>
					</li>
				</ul>
			</nav>
			<img src="{{'asset/img/73.jpg'}}" alt="Photograph of Chris" class="nav-photo">
		</header>
    </div>

    @yield('content')
    
</body>
</html>