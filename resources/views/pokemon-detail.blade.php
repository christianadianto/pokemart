@extends('master')

@section('content_here')
<div class="col-5 pt-2">
	<div class="container breadcrumb text-danger">
		<form method = "post" action="/add-cart">
			{{csrf_field()}}
		<h6>{{$pokemons->name}}</h6>

		<input type="hidden" name="id" value="{{$pokemons->id}}">
		<input type="hidden" name="price" value="{{$pokemons->price}}">

		<img src="{{asset('assets/pokemon_list/'.$pokemons->image)}}" width="80" alt="">

		<div class="text-left container pr-5 pl-5 breadcrumb-font-size">
			<div class="price">
				<i class="fa fa-credit-card"></i>
				Price :
				<span>{{$pokemons->price}}</span>
			</div>
			<div class="element">
				<i class="fa fa-globe"></i>
				Element :
				<span>{{$elements[0]->name}}</span>
			</div>
			<div class="price">
				<i class="fa fa-venus-mars"></i>
				Gender :
				<span>{{$pokemons->gender}}</span>
			</div>
		</div>

		<div class="text-left m-3">
			<p class="fs-11">
				{{$pokemons->description}}
			</p>
		</div>

		<div class="comment-display text-left mr-5 ml-5 fs-15">
			<div>Comments:</div>
			<hr class="m-0" />
			<div class="pre-scrollable fs-12">
				@foreach($comments as $comment)
					<div class="row mb-2">
						<div class="col-6">
							<strong>{{$comment->email}}</strong>
							<div>{{$comment->comment}}</div>
						</div>
						<div class="col-6 text-right">
							{{$comment->created_at}}
						</div>
					</div>
				@endforeach
			</div>
		</div>
			<div class="form-group mb-05">
				Qty:
				<input type="number" class="form-control d-inline-block wp-80 p-1" id="qty" name="qty" min="1" value="1">
			</div>
			<button type="submit" class="btn btn-primary mb-05 text-danger wpc-70">
				Add to Cart 
				<i class="fa fa-shopping-cart"></i>
			</button>
		</form>


		<form method = "post" action="/insert-comment">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$pokemons->id}}">
			<div class="form-group mb-05">
				<input type="text" class="form-control wpc-70" name="comment" placeholder="Insert your comment here" name="password">
			</div>
			<button type="submit" class="btn btn-primary mb-2 wp-150 text-danger">Insert Comment</button>
		</form>
	</div>
	@if($errors->any())
		{{$errors->first()}}
	@endif
</div>
@stop