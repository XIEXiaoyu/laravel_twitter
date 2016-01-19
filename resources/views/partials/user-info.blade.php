<div class="left_photo">
	<img src="{{ $user->pro_img_path }}" alt="Photograph of {{ $user->user_name}}" class="profile-photo">
</div>
<div class="right_text">
	<p class="twitterer">
		<span>
			{{ $user->name }} 
		</span>
		<span>
			{{ '@' . $user->user_name }} · {{ $tweet->created_at}}
		</span>
	</p>
	<p class="twitter_message">{{ $tweet->message}}
	</p>
</div>