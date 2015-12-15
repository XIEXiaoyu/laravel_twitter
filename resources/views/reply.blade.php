@extends('app')

@section('content')

<div class="wrapper">
	@if (isset($tag))
		@foreach($tweets as $tweet)
		<div class="tweet">
			<div class="left_photo">
				<img src="{{ $users[$tweet->user_id]->pro_img_path }}" alt="Photo of Zhiyan" class="profile-photo">
			</div>
			<div class="right_text">
				<p class="twitter">
					{{ $users[$tweet->user_id]->name . '@' . 
						$users[$tweet->user_id]->user_name . ' ' .
						$tweet->created_at }}
				</p>
				<p class="twitter_message">
					{{ $tweet->message }}
				</p>
				<div class="function_links">
				<ul>
					<li class="reply-func">
						<a href="{{ url('reply?tweet_id=' . $tweet->id . '&user_id=' . $tweet->user_id) }}"><span class="icon-reply icon-func"></span>Reply</a>
					</li>
					<li>
						<a href=""><span class="icon-like icon-func"></span>Like</a>
					</li>
					<li>
						<a href=""><span class="icon-share2 icon-func"></span>Share</a>
					</li>
				</ul>
				</div>
			</div>
		</div>
		@endforeach
	
	@else
		@foreach($tweets as $tweet)
		<div class="tweet">
			<div class="left_photo">
				<img src="{{ $users[$tweet->user_id]->pro_img_path }}" alt="Photograph of Zhiyan" class="profile-photo">
			</div>
			<div class="right_text">
				<p class="twitterer">{{ $users[$tweet->user_id]->name }}
					{{ '@' . $users[$tweet->user_id]->user_name . ' ' . $tweet->created_at }} 
				</p>
				<p class="twitter_message">
					{{ $tweet->message }}
				</p>
				<div class="function_links">
					<ul>
						<li class="reply-func">
							<a href="{{ url('reply?tweet_id=' . $tweet->id . '&user_id=' . $tweet->user_id) }}"><span class="icon-reply icon-func"></span>Reply</a>
						</li>
						<li>
							<a href=""><span class="icon-like icon-func"></span>Like</a>
						</li>
						<li>
							<a href=""><span class="icon-share2 icon-func"></span>Share</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		@endforeach

		<div class="tweet tweet_reply">
			<div class="left_photo">
				<img src="{{ $me->pro_img_path }}" alt="Photograph of Zhiyan" class="profile-photo">
			</div>
			<div class="right_text">
				<p class="twitterer">{{ $me->name }}
				{{ '@' . $me->user_name }} 
				</p>

				<form action="{{ url('reply') }}" method="post">
					{{ csrf_field() }}			
					<input type="hidden" name="user_id" value="{{ $me_id }}">
					<input type="hidden" name="reply_to" value="{{ $user_id }}">
					<input type="hidden" name="thread_id" value="{{ $thread_id }}">				
					<textarea class="reply_form" name="message"></textarea>
					<input type="submit" value="Send">
				</form>
			</div>
		</div>
	@endif


</div>  <!-- end of wrapper -->

@stop