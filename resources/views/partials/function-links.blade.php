<div class="function_links">
	<ul>
		<li class="reply-func">
			<a href="{{ url('reply?tweet_id=' . $tweet->id . '&user_id=' . $tweet->user_id) }}"><span class="icon-reply icon-func"></span>Reply</a>
		</li>
		<li>
			<a href="{{ url('like?tweet_id=' . $tweet->id . '&user_id=' . $tweet->user_id) }}"><span class="icon-like icon-func"></span>Like</a>
			@if( !empty($tweet->like) )
			<span class="like">{{ $tweet->like }}</span>
			@endif
		</li>
		<li>
			<a href=""><span class="icon-share2 icon-func"></span>Share</a>
		</li>
	</ul>
</div>