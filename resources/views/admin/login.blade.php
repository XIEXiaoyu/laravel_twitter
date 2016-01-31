@extends('login_register')

@section('content')

<div class="wrapper">
	<div class="content">	
		<p class="form_title">Login to loveConnet</p>	
		@if(session('error_msg'))
		<p class="error_message">{{ session('error_msg') }}</p>
		@else
		<p class="below_form_title">Start connecting today</p>
		@endif

		<div class="form_wrapper_left_and_right login_form_wrapper_left_and_right">

				<div class="left_indication_text">
					<p class="user_input">Email</p>
					<p class="user_input">Password</p>
				</div>

				<div class="right_form_wrapper">
					<form action="{{ url('login') }}" method="post">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input name="email" type="email" class="email" placeholder="Your email address">
						<input name="password" type="password" class="password" placeholder="********">
						<button type="submit"><span class="icon-reply icon-reply-button"></span>Login</button>
					</form>  			
				</div>
		</div>
	</div>
</div>  <!-- end of wrapper -->

@stop
