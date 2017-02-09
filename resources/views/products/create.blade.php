@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>'products.store','method'=>'post']) !!}
				<div class="form-group">
					<label for="">{{ trans('app.Title') }}</label>
					<input name="title" type="text" class="form-control" required="required" placeholder="{{ trans('app.Title') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Short Description') }}</label>
					<textarea class="form-control" name="description"></textarea>
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Cost Price') }}</label>
					<input name="cost" type="text" class="form-control" required="required" placeholder="{{ trans('app.Cost Price') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Sale Price') }}</label>
					<input name="price" type="text" class="form-control" required="required" placeholder="{{ trans('app.Sale Price') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Qantity') }}</label>
					<input name="quantity" type="text" class="form-control" required="required" placeholder="{{ trans('app.Qantity') }}">
				</div>
				<button type="submit" class="btn btn-primary">{{ trans('app.Submit') }}</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()