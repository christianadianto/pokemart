@extends('master')

@section('content_here')
<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger">
		<img src="{{asset('assets/pokemon_list/pikachu.png')}}" width="100" alt="">
		<form method="POST" action="{{ url('/update-pokemon') }}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group mb-2">
				<input type="file" class="form-control-file m-0-auto" id="pokemon-image" name="pokemon-image">
			</div>

			<div class="form-group mb-2">
				<input type="pokemon-name" class="form-control" id="pokemon-name" placeholder="Your pokemon name" name="pokemon-name">
			</div>
			<select class="form-control wp-150 mb-3">
				<option selected>Choose...</option>
				<option value="fire">Fire</option>
				<option value="water">Water</option>
				<option value="electric">Electric</option>
				<option value="poison">Poison</option>
			</select>

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
			<button type="submit" class="btn btn-primary mb-4">Edit</button>
		</form>
	</div>
</div>
@stop