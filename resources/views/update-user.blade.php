@extends('master')

@section('content_here')
<div class="col-5 pt-4">
	<div class="container breadcrumb text-danger">
		<h4>Update User</h4>

		<img src="{{asset('').$user->profile_picture}}" class="profile" width="120">
		<form method="post" action="/update-user" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$user->id}}">
			<div class="form-group mb-2">
				<input type="file" class="form-control-file m-0-auto" id="profileImage" name="profile_picture">
			</div>
			<div class="form-group mb-2">
				<input type="email" class="form-control" id="email" value="{{$user->email}}" name="email">
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="gender" id="male" value="male"> Male
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="gender" id="female" value="female"> Female
				</label>
			</div>
			<div class="form-group mb-2">
				<input type="text" class="form-control" id="dob" value="{{$user->date_of_birth}}" name="date_of_birth">
			</div>
			<div class="form-group mb-2">
				<textarea class="form-control" id="address" rows="3" name="address">{{$user->address}}</textarea>
			</div>
			<button type="submit" class="btn btn-primary mb-4">Edit</button>
		</form>
	</div>
</div>
<script>
	$(document).ready(function () {
	    $gender = '{{$user->gender}}';
        $("#"+$gender).attr('checked', 'checked');
    });
</script>

@stop