@extends('master')

@section('content_here')
<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger">
		<h4>Register</h4>
		<img src="{{asset('assets/logo.png')}}" width="70" alt="">
		<form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group mb-2">
				<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="youremail@example.com" name="email">
			</div>
			<div class="form-group mb-2">
				<input type="password" class="form-control" id="password" placeholder="password" name="password">
			</div>
			<div class="form-group mb-2">
				<input type="password" class="form-control" id="confirmPassword" placeholder="retype password" name="password_confirmation">
			</div>
			<div class="form-group mb-2">
				<input type="file" class="form-control-file m-0-auto" id="profileImage" name="profile_picture">
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
				<input type="text" class="form-control" id="dob" placeholder="yyyy-MM-dd" name="date_of_birth">
			</div>
			<div class="form-group mb-2">
				<textarea class="form-control" id="address" rows="3" placeholder="Address" name="address"></textarea>
			</div>
			<button type="submit" class="btn btn-primary mb-4">Register</button>
		</form>
	</div>
	@if($errors->any())
		{{$errors->first()}}
	@endif
</div>
@stop