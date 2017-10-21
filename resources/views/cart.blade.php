@extends('master')

@section('content_here')
<div class="col-5 pt-2">
	<div class="container breadcrumb text-danger">
		<h6>Your Cart <i class="fa fa-shopping-cart"></i></h6>

		<div class="row">
			<div class="col-md-2 p-0">Image</div>
			<div class="col-md-2 p-0">Name</div>
			<div class="col-md-2 p-0">Qty</div>
			<div class="col-md-2 p-0">Price</div>
			<div class="col-md-2 p-0">Sub Total</div>
		</div>
		<hr/>
		@foreach($carts as $cart)
		<form method="post" action="{{url('/delete-cart')}}">
			{{csrf_field()}}
			{{method_field("delete")}}
			<div class="row">
				<div class="col-2 p-0">
					<img src="{{asset('assets/pokemon_list/'.$cart->image)}}" width="50" alt="">
				</div>
				<div class="col-md-2 p-0 lh-50">{{$cart->name}}</div>
				<div class="col-md-2 p-0 lh-50">{{$cart->qty}}</div>
				<div class="col-md-2 p-0 lh-50">{{$cart->pokemon_price}}</div>
				<div class="col-md-2 p-0 lh-50">{{$cart->pokemon_price * $cart->qty}} </div>
				<input type="hidden" name ="id" value="{{$cart->id}}">
				<div class="col-md-2 p-0 lh-50">
					<button type="submit" class="btn btn-primary mb-2 wpc-70 text-danger fs-11">Delete</button>
				</div>
			</div>
		</form>
		<hr/>
		@endforeach

		<form method="post" action="{{url('/payment')}}">
			{{csrf_field()}}
			<div>Total Quantity : <span>{{$total_qty}}</span></div>
			<div>Total Price : <span>{{$total_price}}</span></div>
			<button type="submit" class="btn btn-primary mb-2 wpc-70 text-danger">Complete the Payment</button>
		</form>
	</div>
</div>
@stop