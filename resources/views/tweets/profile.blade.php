@extends('app')

@section('content')
<div class="outer">
	<div class="page_container">
		<div class="profile_left">
			<div class="profile_card">
				<p class="profile_card_bg"></p>
				<div class="profile_card_content">
					<a class="profile_card_image_wrapper" href="#">
						<img class="Profile_card_img" src="{{ $me->pro_img_path }}" alt="">
					</a>
					<div class="DashboardProfileCard_userFields">
						<div class="DashboardProfileCard-name">
							
						</div>
						<span>
							<a class="u-textInheritColor" href="#">
								{{ $me->name }}
							</a>
						</span>
						
					</div>
					<div class="ProfileCardStats">
						
					</div>
					
				</div>				
			</div>
			
		</div>

		<div class="main">
			
		</div>

		<div class="dashboard dashboard-right">
			
		</div>		
	</div>
</div>
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
				<form action="{{ 'profile?user_id=' . $me_id }}" method="post">
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

			@if (count($tweets) == 0)
			<p class="no_post">No posts by now.</p>
			@else
			@foreach ($tweets as $tweet)
			<div class="tweet">
				@include('partials.user-info', ['user' => $user, 'tweet' => $tweet])

				@include('partials.function-links', ['tweet' => $tweet])

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