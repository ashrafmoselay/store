@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>'addpay','method'=>'post']) !!}
				<div class="form-group">
					<label for="">{{ trans('app.Client Name') }}</label>
					<input disabled="" value="{{$client->name}}" type="text" class="form-control">
					<input value="{{$client->id}}" name="client_id" type="hidden" class="form-control" >
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Total') }}</label>
					<input readonly="" name="total" value="{{$client->due}}"  type="text" class="form-control total" required="required" placeholder="{{ trans('app.Total') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Paid') }}</label>
					<input name="paid" type="text" class="form-control paid" required="required" placeholder="{{ trans('app.Paid') }} ">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Due') }}</label>
					<input name="due" readonly="" type="text" class="form-control due" required="required" placeholder="{{ trans('app.Due') }}">
				</div>
				<button type="submit" class="btn btn-primary">{{ trans('app.Submit') }}</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()

@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("input",".paid",function(e){
			e.preventDefault();
			var due = parseFloat($(".total").val()) - parseFloat($(".paid").val());
			$(".due").val(due);
		});
	});
</script>
@stop()