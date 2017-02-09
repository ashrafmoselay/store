@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>['purchaseInvoice.update',$item->id],'method'=>'put']) !!}
				<div class="form-group">
					<label for="">Name</label>
					<input name="name" type="text" value="{{$item->name}}" class="form-control" required="required" placeholder="Name">
				</div>
				<div class="form-group">
					<label for="">Mobile</label>
					<input name="mobile" type="text" value="{{$item->mobile}}" class="form-control" required="required" placeholder="Mobile">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()