@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr class="active">
						<th>{{ trans('app.ID') }}</th>
						<th>{{ trans('app.Invoice ID') }}</th>
						<th>{{ trans('app.Created') }}</th>
						<th>{{ trans('app.Products') }}</th>
						<th>{{ trans('app.Cost Price') }}</th>
						<th>{{ trans('app.Sale Price') }}</th>
						<th>{{ trans('app.Qantity') }}</th>
						<th>{{ trans('app.Total') }}</th>
					</tr>
				</thead>
				<tbody>
				@foreach($list as $key=>$prod)
				<tr>
					<td>{{$key+1}}</td>
					<td>{{$prod->order_id}}</td>
					<td>{{$prod->invoice->created_at}}</td>
					<td>{{$prod->product->title}}</td>
					<td>{{$prod->cost}}</td>
					<td>{{$prod->price}}</td>
					<td>{{$prod->qty}}</td>
					<td>{{$prod->total}}</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<div class="row text-center">
				{!! $list->appends(\Request::except('page'))->render() !!}
			</div>
		</div>
	</div>
</div>
@stop()