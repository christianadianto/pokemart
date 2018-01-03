@extends('master')

@section('content_here')
<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger">
		<h4>Update Element</h4>
		<img src="{{asset('assets/element.png')}}" width="400" alt="">
		<form method="POST" action="{{ url('/update-element') }}">
			{{csrf_field()}}
			{{method_field('put')}}
			<div class="form-group mb-2">
				<input type="hidden" name="id" value="{{$id}}">
				<input type="text" class="form-control" id="element-name" placeholder="Element Name" name="element-name">
			</div>
			<button type="submit" class="btn btn-primary mb-4">Edit</button>
		</form>
		@if($errors->any())
			{{$errors->first()}}
		@endif
	</div>
</div>
@stop