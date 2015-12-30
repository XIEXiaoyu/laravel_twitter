<form action="{{ 'profile' }}" method="post">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
	<input type="hidden" name="follow_who" value="{{$user->id }}">
	<input class="follow_submit" type="submit" value="Following">
</form>