@extends('master')

@section('content_here')
<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger">
		<h4>Update Element</h4>
		<img src="{{asset('assets/element.png')}}" width="400" alt="">
		<form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group mb-2">
				<input type="text" class="form-control" id="element-name" placeholder="Element Name" name="element-name">
			</div>
			<button type="submit" class="btn btn-primary mb-4">Edit</button>
		</form>
	</div>
</div>
@stop