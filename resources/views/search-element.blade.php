@extends('master')

@section('content_here')
<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger">
		<h4>Update Element</h4>
		<img src="{{asset('assets/element.png')}}" width="400" alt="">
		<form action="/update-element">
			<select class="form-control wp-150 mb-3">
				<option selected>Choose...</option>
				@foreach($elements as $element)
					<option value= "{{$element->id}}">{{$element->name}}</option>
				@endforeach
			</select>
			<button type="submit" class="btn btn-primary mb-4">Search</button>
		</form>
	</div>
</div>
@stop