@extends('app')

@section('content')

<div class="outer">
	<div class="page_container">
		<div class="not_profile_main">
			@if(empty($flag))
				@foreach($users as $user)
				<div class="tweet">
					@include('partials.follow_card', ['user' => $user])

					<div class="follow_who">
						@if(in_array($user->id, $unfollowed_ids))
						@include('partials.follow_card_button')	
						@else
						<button class="follow_submit">Following</button>
						@endif
					</div>
				</div>
				@endforeach
			@else
				@if($flag == 'followed')				
					@foreach($users as $user)
						<div class="tweet">
							@include('partials.follow_card', ['user' => $user])

							<div class="follow_who">
								<button class="follow_submit">following</button>
							</div>
						</div>
					@endforeach

				@else	
					@foreach($users as $user)				
						<div class="tweet">
							@include('partials.follow_card', ['user' => $user])
							<div class="follow_who">
							@include('partials.follow_card_button')	
							</div>
						</div>
					@endforeach
				@endif		
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
		</div>  <!-- end of not_profile_main --> 
	</div> <!-- end of page_container --> 
</div>  <!-- end of outer -->

@stop