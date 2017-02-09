@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
			<table class="table table-bordered">
				<tbody>
				<tr class="warning">
					<td>{{ trans('app.ID') }}</td>
					<td>{{$client->id}}</td>
				</tr>
				<tr class="danger">
					<td>{{ trans('app.Client Name') }}</td>
					<td>{{$client->name}}</td>
				</tr>
				<tr class="active">
					<td>{{ trans('app.Total') }}</td>
					<td>{{$client->total}}</td>
				</tr>
				<tr class="active">
					<td>{{ trans('app.Paid') }}</td>
					<td>{{$client->paid}}</td>
				</tr>
				<tr class="active">
					<td>{{ trans('app.Due') }}</td>
					<td>{{$client->due}}</td>
				</tr>
				<tr class="info">
					<td>{{ trans('app.Created') }}</td>
					<td>{{$client->created_at}}</td>
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
						<th>{{ trans('app.Created') }}</th>
						<th>{{ trans('app.Total') }}</th>
						<th>{{ trans('app.Paid') }}</th>
						<th>{{ trans('app.Due') }}</th>
					</tr>
				</thead>
				<tbody>
				@foreach($client->installment as $key=>$clt)
				<tr>
					<td>{{$key+1}}</td>
					<td>{{date('Y-m-d', strtotime($clt->created_at))}}</td>
					<td>{{$clt->total}}</td>
					<td>{{$clt->paid}}</td>
					<td>{{$clt->due}}</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop()