@extends('app')

@section('content')

<div class="wrapper">
	@foreach ($users as $user)
	<div class="tweet">
		<div class="left_photo">
			<img src="{{'asset/img/zhiyan_head.png'}}" alt="Photograph of Zhiyan" class="profile-photo">
		</div>
		<div class="right_text">
			<p class="twitterer">{{ $user->name }}</p>
			<p class="at_message">{{ '@' . ' ' . $user->user_name }}</p>
			<p class="twitter_message">
				{{ $user->signature }}
			</p>
			<div class="follow_who">
				@if(isset($flag))
					@if($flag == 'unfollowed')
					<form action="{{ 'profile' }}" method="post">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<input type="hidden" name="follow_who" value="{{$user->id }}">
					<input class="follow_submit" type="submit" value="Follow">
					</form>	
					@else
					<button>Already followed</button>
					@endif
				@else					
					@if (in_array($user->id, $unfollowed))
					<form action="{{ 'profile' }}" method="post">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<input type="hidden" name="follow_who" value="{{$user->id }}">
					<input class="follow_submit" type="submit" value="Follow">
					</form>	
    				@else
					<button>Already followed</button>
    				@endif
				@endif
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