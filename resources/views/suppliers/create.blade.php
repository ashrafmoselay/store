@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>'suppliers.store','method'=>'post']) !!}
				<div class="form-group">
					<label for="">{{ trans('app.Supplier Name') }}</label>
					<input name="name" type="text" class="form-control" required="required" placeholder="{{ trans('app.Supplier Name') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Mobile') }}</label>
					<input name="mobile" type="text" class="form-control"  placeholder="{{ trans('app.Mobile') }}">
				</div>
				<button type="submit" class="btn btn-primary">{{ trans('app.Submit') }}</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()
