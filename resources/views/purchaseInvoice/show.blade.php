@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
			<table class="table table-bordered">
				<tbody>
				<tr class="warning">
					<td>{{ trans('app.ID') }}</td>
					<td>{{$invoice->id}}</td>
				</tr>
				<tr class="danger">
					<td>{{ trans('app.Supplier Name') }}</td>
					<td>{{$invoice->supplier->name}}</td>
				</tr>
				<tr class="active">
					<td>{{ trans('app.Total') }}</td>
					<td>{{$invoice->total}}</td>
				</tr>
				<tr class="info">
					<td>{{ trans('app.Created') }}</td>
					<td>{{$invoice->created_at}}</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr class="active">
						<th>{{ trans('app.ID') }}</th>
						<th>{{ trans('app.Products') }}</th>
						<th>{{ trans('app.Cost Price') }}</th>
						<th>{{ trans('app.Qantity') }}</th>
						<th>{{ trans('app.Total') }}</th>
					</tr>
				</thead>
				<tbody>
				@foreach($invoice->details as $key=>$prod)
				<tr>
					<td>{{$key+1}}</td>
					<td>{{$prod->product->title}}</td>
					<td>{{$prod->cost}}</td>
					<td>{{$prod->qty}}</td>
					<td>{{$prod->total}}</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop()