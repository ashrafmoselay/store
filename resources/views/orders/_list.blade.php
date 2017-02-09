
<table class="table table-hover display">
	<thead>
		<tr>
			<th>@sortablelink('id',trans('app.ID'))</th> 
			<th>@sortablelink('client_id',trans('app.Client Name'))</th>
			<th>@sortablelink('payment_type',trans('app.Payment Type'))</th>
			<th>@sortablelink('total',trans('app.Total'))</th>
			<th>@sortablelink('paid',trans('app.Paid'))</th>
			<th>@sortablelink('due',trans('app.Due'))</th>
			<th>@sortablelink('created_at',trans('app.Created'))</th>
			<th>{{ trans('app.action') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($list as $item)
			<tr>
				<td> {{ $item->id }} </td>
				<td> {{ $item->client->name }} </td>
				<td> {{ $item->payment_type }} </td>
				<td> {{ $item->total }} </td>
				<td> {{ $item->paid }} </td>
				<td> {{ $item->due }} </td>
				<td> {{ $item->created_at }} </td>
				<td>
				<a class="btn btn-primary" href="orders/{{ $item->id }}" role="button">{{ trans('app.Show') }}</a>
				</td>
			</tr>
		@endforeach
	</tbody>
    <tfoot>
        <tr class="danger">
        	<td colspan="3">المجموع</td>
        	<td>{{$list->sum('total')}}</td>
        	<td>{{$list->sum('paid')}}</td>
        	<td>{{$list->sum('due')}}</td>
        	<td></td>
        	<td></td>
        </tr>
    </tfoot>
</table>
 <div class="row text-center">
 	{!! $list->appends(\Request::except('page'))->render() !!}
 </div>