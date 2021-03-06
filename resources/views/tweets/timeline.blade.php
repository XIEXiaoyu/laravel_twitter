@extends('app')

@section('content')
<div class="outer">
	<div class="page_container">
		<div class="profile">
			<div class="profile_bg"></div>
			<div class="img_name_wrapper">
				<a class="profile_card_img_a" href="#">
					<img class="Profile_card_img" src="{{ $user->pro_img_path }}" alt="">
				</a>
				<a class="profile_card_user" href="{{ url('profile?user_id=' . $user->id) }}">
					<span class="profile_card_name">{{ $user->name }}</span>
					<span class="profile_card_userName">{{ '@' . $user->user_name }}</span>		
				</a>
			</div>

			<ul class="stats_links">
				<li>
					<a href="{{ url('profile?user_id=' . $user->id) }}">
						<span class="links_text links_tweets">Tweets</span>
						<span class="links_number_text links_tweets_number">number</span>
					</a>
				</li>
				<li>
					<a href="{{ url('already_followed') }}">
						<span class="links_text links_following">Following</span>
						<span class="links_number_text links_following_number">number</span>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="links_text links_followers">Followers</span>
						<span class="links_number_text links_followers_number">number</span>
					</a>
				</li>
			</ul>		
		</div>						

		<div class="main">
			<div class="above_pre_and_next">
				@if (count($followingTweets) == 0)
				<p class="no_tweet">Hi, you didn't follow any body by now.</p>
				@else
				@foreach ($followingTweets as $tweet)
				<div class="tweet">
					@include('partials.user-info', ['user' => $followings[$tweet->user_id], 'tweet' => $tweet])

					@include('partials.function-links', ['tweet' => $tweet])
				</div>
				@endforeach
				@endif
			</div>
			
			{!! $followingTweets->appends(['user_id'=>$me_id])->render() !!}
		</div>

		<div class="people">
			<div class="follow_bar">
				<a class="who_to_follow_a" href="{{ url('who_to_follow') }}">
					Who to follow
				</a>

				<a class="view_all_a" href="{{ url('all_users') }}">
					View all
				</a>
			</div>
			<div class="strangers">
				@foreach($notFollowings as $notFollowing)
					<div class="profile_stranger_card">	
						<div class="stranger_left_photo">
							<img class="srtanger_left_img" src="{{$notFollowing->pro_img_path}}" alt="">
						</div>
						<div class="stranger_right_text">
							<a class="stranger_right_text_up" href="">
								<span class="stranger_name">
									{{ $notFollowing->name}}
								</span>
								<span class="stranger_user_name">
									{{ '@' . $notFollowing->user_name }}
								</span>
							</a>

							<button class="follow_button">
								<span class="icon-user-add follow_add"></span>
								Follow
							</button>						
						</div>					
					</div>
				@endforeach
			</div>		
		</div>		
	</div>
</div>

{{-- 			@if (count($tweets) == 0)
			<p class="no_tweet">Hi, you have no tweets by now.</p>
			@else
			@foreach ($tweets as $tweet)
			<div class="tweet">
				@include('partials.user-info', ['user' => $user, 'tweet' => $tweet])

				@include('partials.function-links', ['tweet' => $tweet])

				</div>
			</div>
			@endforeach
			@endif --}}

@stop