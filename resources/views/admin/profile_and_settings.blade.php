@extends('app')

@section('content')

<div class="wrapper">
	<section>
		<div class="post new_post">
			<div class="left_photo">
				<img src="{{ $me->pro_img_path }}" alt="Photograph of{{ $me->name }}" class="profile-photo">
			</div>

			<div class="right_text form">
				<form action="{{ url('profile_and_settings') }}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<textarea   class="tweet write_a_signature"
							    placeholder="Write something about your self or your characteristics ..." name="signature"></textarea> 
					<!-- opening and closing tag of textarea must be on the same line -->
					<p>upload your image</p>
					<input type="file" name="pro_img" >
					<button class="reply">publish</button>
				</from>				
			</div>
		</div>
	</section>
</div>

@stop