@extends('master')

@section('content_here')
<div class="col-5 pt-4">
	<div class="container breadcrumb text-danger">
		<h4>Login</h4>
		<img src="{{asset('assets/logo.png')}}" width="220" alt="">
		<form method="POST" action="{{url('/login')}}">
			{{csrf_field()}}
			<div class="form-group">
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$email}}" placeholder="youremail@example.com" name="email">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="password" name="password">
			</div>
			<div class="form-check">
				<label class="form-check-label">
					<input type="checkbox" class="form-check-input" name="remember">
					Remember me
				</label>
			</div>
			<button type="submit" class="btn btn-primary mb-4">Login</button>
		</form>
	</div>
</div>
@stop