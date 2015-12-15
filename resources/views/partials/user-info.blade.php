<div class="left_photo">
	<img src="{{ $user->pro_img_path }}" alt="Photograph of Zhiyan" class="profile-photo">
</div>
<div class="right_text">
	<p class="twitterer">{{ $user->name }} <span class="at_message">{{ '@' . $user->user_name }} · {{ $tweet->created_at}}</span></p>
	<p class="twitter_message">{{ $tweet->message}}
	</p>