@extends('master')

@section('content_here')
<div class="col-5 pt-4">
	<div class="container breadcrumb text-danger">
		<h4>Profile</h4>
		<img class="profile" width="120">
		<form method="POST" action="{{ url('/profile') }}" enctype="multipart/form-data">
			{{method_field('put')}}
			{{csrf_field()}}
			<div class="form-group mb-2">
				<input type="file" class="form-control-file m-0-auto" id="profileImage" name="profile_picture">
			</div>
			<div class="form-group mb-2">
				<input type="email" class="form-control" id="email" name="email">
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
			<button type="submit" class="btn btn-primary mb-4">Edit</button>
		</form>
	</div>
	@if($errors->any())
		{{$errors->first()}}
	@endif
</div>
	<script>
        $(document).ready(function() {
            var request = $.get('/checkUser');
            request.done(function(response) {

                var img = response.user.profile_picture;
                var email = response.user.email;
                var gender = response.user.gender;
                var date_of_birth = response.user.date_of_birth;
                var address = response.user.address;

                $('.profile').attr('src',"{{asset('')}}"+ img);
                $('#email').val(email);
                $("#"+gender).attr('checked', 'checked');
                $('#dob').val(date_of_birth);
                $('#address').text(address);
            });
        });
	</script>
@stop