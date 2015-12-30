<div class="follow_card_left_photo">
	<img class="follow_card_profile_photo" src="{{ $user->pro_img_path }}" alt="Photograph of {{ $user->name}}">
</div>
<div class="follow_card_right_text">
	<p class="follow_card_user">
		<span class="follow_card_name">
			{{ $user->name }}
		</span>
		<span class="follow_card_user_name">
			{{ '@' . ' ' . $user->user_name }}
		</span>
	</p>
	<p class="follow_card_signature">
		{{ $user->signature }}
	</p>
</div>