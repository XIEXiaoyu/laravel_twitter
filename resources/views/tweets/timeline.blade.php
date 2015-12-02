@extends('app')

@section('content')

<div class="wrapper">
	
	@foreach ($all_followed_posts as $post)
	<div class="tweet">
		<div class="left_photo">
			<img src="{{'asset/img/zhiyan_head.png'}}" alt="Photograph of Zhiyan" class="profile-photo">
		</div>
		<div class="right_text">
			<p class="twitterer">{{ $post->name }}</p>
			<p class="at_message">{{ '@' . $post->user_name . $post->created_at }}</p>
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

	<div class="pre_and_next">
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