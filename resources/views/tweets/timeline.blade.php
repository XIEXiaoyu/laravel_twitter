@extends('app')

@section('content')

<div class="wrapper">
	
	@foreach ($all_followed_posts as $post)
	<div class="tweet">
		<div class="left_photo">
			<img src="/asset/img/zhiyan_head.png" alt="Photograph of Zhiyan" class="profile-photo">
		</div>
		<div class="right_text">
			<p class="twitterer">{{ $all_followed_userInfo[$post->user_id]->name }}</p>
			<p class="at_message">{{ '@ ' . $all_followed_userInfo[$post->user_id]->user_name . ' ' . $post->created_at }}</p>
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

   	{!! $all_followed_posts->render() !!}

</div>  <!-- end of wrapper -->

@stop