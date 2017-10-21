@extends('master')

@section('content_here')
<div class="col-5 pt-2">
	<div class="container breadcrumb text-danger min-h-600 po-r">
		<h6>Detail Transaction <i class="fa fa-shopping-cart"></i></h6>

		<div class="row">
			<div class="col-md-4 p-0">Pokemon Name</div>
			<div class="col-md-4 p-0">Price</div>
			<div class="col-md-4 p-0">Qty</div>
		</div>
		<hr/>
		@foreach($details as $detail)
			<div class="row">
				<div class="col-md-4 p-0">{{$detail->pokemon->name}}</div>
				<div class="col-md-4 p-0">{{$detail->pokemon->price}}</div>
				<div class="col-md-4 p-0">{{$detail->qty}}</div>
			</div>
			<hr/>
		@endforeach
		<form method="get" action="/update-transaction" class="po-a b-0 wpc-100">
			<div>Total Quantity : <span>{{$total_qty}}</span></div>
			<div>Total Price : <span>{{$total_price}}</span></div>
			<button type="submit" class="btn btn-primary mb-2 wpc-70 text-danger">Back</button>
		</form>
	</div>
</div>
@stop