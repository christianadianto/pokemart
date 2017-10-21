@extends('master')

@section('content_here')

<div class="col-5 pt-1">
	<div class="container breadcrumb text-danger text-left breadcrumb-p">
		<h4>Pokemon List</h4>
		<form action="/pokemon-search">
		<div class="form-group mb-2 d-inline">
			<input type="text" class=" form-control m-0 d-inline wp-200" id="searchTxt" placeholder="By Name, By Element" name="txtSearch">
		</div>	
		<button type="submit" class="btn btn-primary d-inline btn-width">Search</button>
		<select class="form-control d-inline wp-150" name = "searchBy">
			<option selected>Choose...</option>
			<option value="name">Name</option>
			<option value="element">Element</option>
		</select>
		</form>
		@if(isset($pokemons))
			@foreach($pokemons as $pokemon)
				<div class = "pokemon-list" style="display: inline-block; margin: 2%;">
					<div style ="background-image: url('assets/pokemon_list/{{$pokemon->image}}'); background-size: 100%; width: 120px; height: 120px;"></div>
					<div style = "text-align: center">{{$pokemon->name}} </div>
					<form method = "get" action="/pokemon-detail/{{$pokemon->id}}">
						<button type="submit" class="btn btn-primary mb-4">Display</button>
					</form>

				</div>
			@endforeach
		@endif

		{{$pokemons->links()}}

	</div>
</div>
@stop