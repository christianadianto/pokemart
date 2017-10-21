@extends('master')

@section('content_here')
<div class="col-5 pt-2">
	<div class="container breadcrumb text-danger min-h-600">
		<h4>Delete Transaction <i class="fa fa-shopping-cart"></i></h4>

		<div class="row fs-12">
			<div class="col-md-1 p-0">ID</div>
			<div class="col-md-4 p-0">Email</div>
			<div class="col-md-2 p-0">Date</div>
			<div class="col-md-2 p-0">Status</div>
		</div>
		@foreach($transactions as $transaction)
		<hr class="m-0"/>
		<div class="row fs-12">
			<div class="col-md-1 p-0 lh-50">{{$transaction->id}}</div>
			<div class="col-md-4 p-0 lh-50">{{$transaction->email}}</div>
			<div class="col-md-2 p-0 lh-50">{{$transaction->purchase_date}}</div>
			<div class="col-md-2 p-0 lh-50">{{$transaction->status}}</div>


				<div class="col-md-3 p-0 lh-50">
					<form method = "post" action = "/delete-transaction">
						{{csrf_field()}}
						{{method_field("delete")}}
						<input type="hidden" name = "transaction_id" value="{{$transaction->id}}">
						<button type="submit" class="btn btn-primary mb-2 wpc-70 text-danger fs-11 d-inline-block">Delete</button>
					</form>
				</div>

		</div>
		@endforeach
		<hr class="m-0"/>
	</div>
</div>
@stop