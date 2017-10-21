@extends('master')

@section('content_here')
<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger">
		<h4>Update User</h4>
		<img src="{{asset('assets/logo.png')}}" width="300" alt="">
		<form method="get" action="/update-user">
			<select class="form-control mb-3" name="user">
				<option selected>Choose...</option>
				@foreach($users as $user)
					<option name="id" value= "{{$user->id}}">{{$user->email}}</option>
				@endforeach
			</select>
			<button type="submit" class="btn btn-primary mb-4">Edit User</button>
		</form>
	</div>
</div>
@stop