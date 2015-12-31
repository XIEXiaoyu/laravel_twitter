<form action="{{ 'profile' }}" method="post">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
	<input type="hidden" name="follow_who" value="{{$user->id }}">
	<input class="follow_button" type="submit" value="Follow"></span>
</form>