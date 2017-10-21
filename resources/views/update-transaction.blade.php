@extends('master')

@section('content_here')
<div class="col-5 pt-2">
	<div class="container breadcrumb text-danger min-h-600">
		<h4>Update Transaction <i class="fa fa-shopping-cart"></i></h4>

		<div class="row fs-12">
			<div class="col-md-1 p-0">ID</div>
			<div class="col-md-3 p-0">Email</div>
			<div class="col-md-2 p-0">Date</div>
			<div class="col-md-1 p-0">Status</div>
		</div>
		@foreach($transactions as $transaction)
			<hr class="m-0"/>
			<div class="row fs-12">
				<div class="col-md-1 p-0 lh-50">{{$transaction->id}}</div>
				<div class="col-md-3 p-0 lh-50">{{$transaction->email}}</div>
				<div class="col-md-2 p-0 lh-50">{{$transaction->purchase_date}}</div>
				<div class="col-md-1 p-0 lh-50">{{$transaction->status}}</div>
				<div class="col-md-5 p-0 lh-50">
					<form method = "post" action = "/update-transaction">
						{{csrf_field()}}
						{{method_field("put")}}
						<input type="hidden" name = "id" value = "{{$transaction->id}}">
						<button type="submit" name = "btnStatus" value = "accept" class="btn btn-primary mb-2 wpc-30 text-danger fs-11 d-inline-block">Accept</button>
						<button type="submit" name = "btnStatus" value = "decline" class="btn btn-primary mb-2 wpc-30 text-danger fs-11 d-inline-block">Decline</button>
						<button type="submit" name = "btnStatus" value = "detail" class="btn btn-primary mb-2 wpc-30 text-danger fs-11 d-inline-block">Detail</button>
					</form>
				</div>
			</div>
		@endforeach
		<hr class="m-0"/>
	</div>
</div>
@stop