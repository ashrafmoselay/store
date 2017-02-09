@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>['clients.update',$item->id],'method'=>'put']) !!}
				<div class="form-group">
					<label for="">{{ trans('app.Client Name') }}</label>
					<input name="name" type="text" value="{{$item->name}}" class="form-control" required="required" placeholder="{{ trans('app.Client Name') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Mobile') }}</label>
					<input name="mobile" type="text" value="{{$item->mobile}}" class="form-control"  placeholder="{{ trans('app.Mobile') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Total') }}</label>
					<input name="total" type="text" value="{{$item->total}}" class="form-control total"  placeholder="{{ trans('app.Mobile') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Paid') }}</label>
					<input name="paid" type="text" value="{{$item->paid}}" class="form-control paid"  placeholder="{{ trans('app.Paid') }} ">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Due') }}</label>
					<input name="due" readonly="" type="text" value="{{$item->due}}" class="form-control due"  placeholder="{{ trans('app.Due') }}">
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
		$(document).on("input",".total,.paid",function(e){
			e.preventDefault();
			var due = parseFloat($(".total").val()) - parseFloat($(".paid").val());
			$(".due").val(due);
		});
	});
</script>
@stop()