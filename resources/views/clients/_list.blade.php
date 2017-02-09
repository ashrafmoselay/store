<table class="table table-hover display">
	<thead>
		<tr>
			<th>@sortablelink('id',trans('app.ID'))</th>
			<th>@sortablelink('name',trans('app.Client Name'))</th>
			<th>@sortablelink('mobile',trans('app.Mobile'))</th>
			<th>@sortablelink('total',trans('app.Total'))</th>
			<th>@sortablelink('paid',trans('app.Paid'))</th>
			<th>@sortablelink('due',trans('app.Due'))</th>
			<th>{{ trans('app.action') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($list as $item)
			<tr>
				<td> {{ $item->id }} </td>
				<td> {{ $item->name }} </td>
				<td> {{ $item->mobile }} </td>
				<td> {{ $item->total }} </td>
				<td> {{ $item->paid }} </td>
				<td> {{ $item->due }} </td>
				<td>

				<a class="btn btn-primary" href="clients/{{ $item->id }}/edit" role="button">{{ trans('app.Edit') }}</a> 
				<a class="btn btn-danger" href="clients/destroy/{{ $item->id }}" role="button">{{ trans('app.Delete') }}</a>
				@if($item->due>0)
				<a class="btn btn-success" href="clients/pay/{{ $item->id }}" role="button">{{ trans('app.pay') }}</a>
				@endif
				<a class="btn btn-default" href="clients/{{ $item->id }}" role="button">{{ trans('app.Show') }}</a>

				</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr class="danger">
			<td colspan="3">{{trans('app.Total')}}</td>
			<td>{{$list->sum('total')}}</td>
			<td>{{$list->sum('paid')}}</td>
			<td>{{$list->sum('due')}}</td>
		</tr>
	</tfoot>
</table>
 <div class="row text-center">
 	{!! $list->appends(\Request::except('page'))->render() !!}
 </div>