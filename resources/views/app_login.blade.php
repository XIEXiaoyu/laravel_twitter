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
					<li>
						<a href="{{ url('register') }}"><span class="icon-signup icon"></span>Signup</a>
					</li>
					<li>
						<a href="{{ url('login') }}"><span class="icon-login icon"></span>Login</a>
					</li>
				</ul>
			</nav>
			<a href="{{ url('preference') }}"><img src="{{'asset/img/73.jpg'}}" alt="Photograph of Chris" class="nav-photo"></a>
		</header>
    </div>
    @yield('content')
    
</body>
</html>