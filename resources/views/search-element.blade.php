@extends('master')

@section('content_here')
<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger">
		<h4>Update Element</h4>
		<img src="{{asset('assets/element.png')}}" width="400" alt="">
		<form action="/search-element" method="post">
			{{csrf_field()}}
			<select class="form-control wp-150 mb-3" name="id">
				<option value="0" selected>Choose...</option>
				@foreach($elements as $element)
					<option value= "{{$element->id}}">{{$element->name}}</option>
				@endforeach
			</select>
			<button type="submit" class="btn btn-primary mb-4">Search</button>
		</form>
		@if($errors->any())
			{{$errors->first()}}
		@endif
	</div>
</div>
@stop