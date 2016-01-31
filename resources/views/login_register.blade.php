<!DOCTYPE html>
<html>
<head>
	<link href="{{ 'asset/css/normalize.css' }}" rel="stylesheet">
	<link href="{{ 'asset/css/tweet.css' }}" rel="stylesheet" type="text/css">
	<link href="{{ 'asset/icomoon/style.css' }}" rel="stylesheet" type="text/css">
	<link href="/asset/css/responsive.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="heading">
		<header>			
			<a href="" class="about"><span class="icon-quill quill-login"></span >About</a>
			<nav class="login_nav">
				<ul>
					<li>
						<a href="{{ url('register') }}"><span class="icon-signup icon"></span>Signup</a>
					</li>
					<li>
						<a href="{{ url('login') }}"><span class="icon-login icon"></span>Login</a>
					</li>
				</ul>
			</nav>
		</header>
    </div>
    @yield('content')
    
</body>
</html>