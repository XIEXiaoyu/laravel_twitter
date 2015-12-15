@extends('login_register')

@section('content')

<div class="wrapper">
	<div class="content">
		<p class="form_title">Register to be a memeber</p>

		@if ($errors->any())			
				@foreach($errors->all() as $error)
				<p class="error_message">{{ $error }}</p> 
				@endforeach
		@else
			<p class="below_form_title">Start taking notes today</p>
		@endif

		<div class="form_wrapper_left_and_right">
				<div class="left_indication_text">
					<p class="user_input">Email</p>
					<p class="user_input">User Name</p>
					<p class="user_input">Password</p>
					<p class="user_input">Confirm Password</p>
					<p class="user_input">Name</p>
				</div>

				<div class="right_form_wrapper">
					<form action="{{ url('register') }}" method="post">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input name="email" type="email" class="email" placeholder="Your email address">
						<input name="user_name" type="text" class="name"
						placeholder="e.g. princess">
						<input name="password" type="password" class="password" placeholder="********">
						<input name="password_confirmation" type="password" class="conform_password" placeholder="********">
						<input name="name" type="text" class="text"placeholder="e.g. Alice">
						<button type="submit"><span class="icon-reply icon-reply-button"></span>Signup</button>
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
