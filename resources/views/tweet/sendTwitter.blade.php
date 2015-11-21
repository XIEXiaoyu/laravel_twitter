@extends('app')

@section('content')

<div class="wrapper">
	<section>
		<div class="post new_post">
			<div class="left_photo">
				<img src="{{'asset/img/73.jpg'}}" alt="Photograph of Chris" class="profile-photo">
			</div>

			<div class="right_text form">
				<form action="{{ url('sendTwitter') }}" method="post">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<textarea   class="tweet leave_a_message"
							    placeholder="Join the conversation ..." name="tweet_msg"></textarea> 
					<!-- opening and closing tag of textarea must be on the same line -->
					<button class="reply">Post</button>
				</from>				
			</div>
		</div>
	</section>
</div>

@stop
