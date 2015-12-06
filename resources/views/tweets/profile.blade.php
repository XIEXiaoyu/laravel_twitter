@extends('app')

@section('content')
<div class="below_heading">
	<div class="banner"></div>
	<div class="follow_and_tweets">
		<ul class="below_banner">
			<li class="below_banner_links tweets">
				<a href="{{ url('profile?user_id=' . $user->id) }}">Tweets</a>
			</li>
			<li class="below_banner_links following">
				<a href="{{ url('already_followed') }}">Following</a>
			</li>
			<li class="below_banner_links followers">
				<a href="">Followers</a>
			</li>
		</ul>
	</div>
	<div class="main_body">
		<div class="particulars">
			<img class="particulars_photo" src="{{ $user->pro_img_path }}" alt="">
			<a class="particulars_name" href="{{ url('profile?user_id=' . $user->id) }}">
				{{ $user->name }}</a>
			<a class="particulars_user_name" href="{{ url('profile?user_id=' . $user->id) }}">
				{{ '@' . $user->user_name }}</a>
			<p>{{ $user->signature }}</p>
			<p>{{ 'location' }}</p>
			<p>{{ 'when joined' }}</p>
		</div>

		<div class="wrapper">
			@if($isMyself == false)
			<div class="follow">
				@if($isFollowed == false)
				<form action="{{ 'profile?user_id=' . $me }}" method="post">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<input type="hidden" name="follow">
					<input type="hidden" name="follow_who" value="{{ $user->id }}">
					<input class="follow_submit" type="submit" value="Follow me">
				</form>	
				@else
				<button class="follow_submit">Already followed</button>
				@endif	
			</div>
			@endif

			@if (count($posts) == 0)
			<p class="no_post">No posts by now.</p>
			@else
			@foreach ($posts as $post)
			<div class="tweet">
				<div class="left_photo">
					<img src="{{ $user->pro_img_path }}" alt="Photograph of Zhiyan" class="profile-photo">
				</div>
				<div class="right_text">
					<p class="twitterer">{{ $user->name }}</p>
					<p class="at_message">{{ '@' . $user->user_name }} · {{ $post->created_at}}</p>
					<p class="twitter_message">{{ $post->tweet_msg}}
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
			@endif

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

		<div class="persons">
			<div class="view_all">
				<p class="who_to_follow">Who to follow</p>
				<a href="{{ url('all_users') }}">View all</a>
			</div>
			<div class="partial_list"></div>
			<p class="find_friends">Find friends</p>		
		</div>

	</div>	<!-- end of main_body -->
</div>  <!-- end of below_heading -->

@stop