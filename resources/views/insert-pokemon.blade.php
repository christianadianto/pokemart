@extends('master')

@section('content_here')
<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger">
		<h4>Register</h4>
		<img src="{{asset('assets/logo.png')}}" width="70" alt="">
		<form method="POST" action="{{ url('/insert-pokemon') }}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group mb-2">
				<input type="text" class="form-control" id="pokemon-name" placeholder="Your pokemon name" name="name">
			</div>
			<select class="form-control d-inline wp-150 mb-3" name="element">
				<option value = "0" selected>Choose...</option>
				@foreach($elements as $element)
					<option value= "{{$element->id}}">{{$element->name}}</option>
				@endforeach
			</select>

			<div class="form-group mb-2">
				<input type="file" class="form-control-file m-0-auto" id="pokemon-image" name="image">
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
				<textarea class="form-control" id="description" rows="3" placeholder="Description" name="description"></textarea>
			</div>
			<div class="form-group mb-2">
				<input type="text" class="form-control" id="price" placeholder="Price" name="price">
			</div>
			<button type="submit" class="btn btn-primary mb-4">Insert New Pokemon</button>
		</form>
		@if($errors->any())
			{{$errors->first()}}
		@endif
	</div>
</div>
	<script>
		$(document).ready(function () {

        });
	</script>
@stop