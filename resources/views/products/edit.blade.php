@extends('layouts.app')
@section('content')
<div class="container">
 	<div class="row">
	    <div class="col-xs-12">
			@if(count($errors) >0)
			<ul class="alert alert-danger">
			@foreach($errors->all() as $err)
			<li>{{$err}}</li>
			@endforeach
			</ul>
			@endif
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>['products.update',$item->id],'method'=>'put']) !!}
				<div class="form-group">
					<label for="">{{ trans('app.Title') }}</label>
					<input name="title" type="text" value="{{$item->title}}" class="form-control" required="required" placeholder="{{ trans('app.Title') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Short Description') }}</label>
					<textarea class="form-control" name="description">{{$item->description}}</textarea>
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Cost Price') }}</label>
					<input readonly="" name="cost" value="{{$item->cost}}" type="text" class="form-control" required="required" placeholder="{{ trans('app.Cost Price') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Sale Price') }}</label>
					<input name="price" value="{{$item->price}}" type="text" class="form-control" required="required" placeholder="{{ trans('app.Sale Price') }}">
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Qantity') }}</label>
					<input readonly="" name="quantity" value="{{$item->quantity}}" type="text" class="form-control" required="required" placeholder="{{ trans('app.Qantity') }}">
				</div>
				<button type="submit" class="btn btn-primary">{{ trans('app.Submit') }}</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()