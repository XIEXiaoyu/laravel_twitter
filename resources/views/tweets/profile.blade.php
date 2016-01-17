@extends('app')

@section('content')

<div class="wrapper">
	
	@foreach ($followed_posts as $post)
	<div class="tweet">
		<div class="left_photo">
			<img src="{{ $followed_userInfo[$post->user_id]->pro_img_path }}" alt="Photograph of {{ $followed_userInfo[$post->user_id]->name }}" class="profile-photo">
		</div>
		<div class="right_text">
			<p class="twitterer">{{ $followed_userInfo[$post->user_id]->name }}</p>
			<p class="at_message">{{ '@ ' . $followed_userInfo[$post->user_id]->user_name . ' ' . $post->created_at }}</p>
			<p class="twitter_message">
				{{ $post->tweet_msg }}
			</p>
			<div class="function_links">
				<ul>
					<li class="reply-func">
						<a href="url"><span class="icon-reply icon-func"></span>Reply</a>
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

   	{!! $followed_posts->render() !!}

</div>  <!-- end of wrapper -->

@stop