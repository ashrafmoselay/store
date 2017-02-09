
{!! Form::open(['route'=>'clients.store','method'=>'post']) !!}
	<div class="form-group">
		<label for="">{{ trans('app.Client Name') }}</label>
		<input name="name" type="text" class="form-control" required="required" placeholder="{{ trans('app.Client Name') }}">
	</div>
	<div class="form-group">
		<label for="">{{ trans('app.Mobile') }}</label>
		<input name="mobile" type="text" class="form-control"  placeholder="{{ trans('app.Mobile') }}">
	</div>
	<div class="form-group">
		<label for="">{{ trans('app.Total') }}</label>
		<input name="total" type="text" class="form-control total" required="required" placeholder="{{ trans('app.Total') }}">
	</div>
	<div class="form-group">
		<label for="">{{ trans('app.Paid') }}</label>
		<input name="paid" type="text" class="form-control paid" required="required" placeholder="{{ trans('app.Paid') }} ">
	</div>
	<div class="form-group">
		<label for="">{{ trans('app.Due') }}</label>
		<input name="due" readonly="" type="text" class="form-control due" required="required" placeholder="{{ trans('app.Due') }}">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
{!! Form::close() !!}