@extends('app')

@section('content')

<div class="wrapper">
	<div class="content">	
		<p class="form_title">Login to twitter</p>	
		@if(session('login_error_msg'))
		<p class="error_message">{{ session('login_error_msg') }}</p>
		@else
		<p class="below_form_title">Start taking notes today</p>
		@endif

		<div class="form_wrapper_left_and_right">

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

	<div class="pre_and_next pre_and_next_signUp">
		<ul>
			<li class="prev paging">					
				<a href=""><span class="icon-previous2"></span>Prev</a>
			</li>
			<li class="next paging">						
				<a href="">Next<span class="icon-next2"></span></a>
			</li>				
		</ul>
    </div>
</div>  <!-- end of wrapper -->

@stop
