<table class="table table-hover display">
<thead>
	<tr>
		<th>@sortablelink('id',trans('app.ID'))</th>
		<th>@sortablelink('title',trans('app.Title'))</th>
		<th>@sortablelink('cost',trans('app.Cost Price'))</th>
		<th>@sortablelink('price',trans('app.Sale Price'))</th>
		<th>@sortablelink('quantity',trans('app.Qantity'))</th>
		<th>@sortablelink('sale_count',trans('app.Sale Count'))</th>
		<th>@sortablelink('av',trans('app.Avilable Qty'))</th>
		<th>{{ trans('app.action') }}</th>
	</tr>
</thead>
<tbody>
	
	@foreach($list as $item)
		<tr>
			<td> {{ $item->id }} </td>
			<td> {{ $item->title }} </td>
			<td> {{ $item->cost }} </td>
			<td> {{ $item->price }} </td>
			<td> <a class="btn btn-warning btn-md" href="{{url('products/qtyDetailes',$item->id)}}">{{ $item->quantity }}</a> </td>
			<td> <a class="btn btn-info btn-md" href="{{url('products/salesDetailes',$item->id)}}">{{ $item->sale_count }}</a> </td>
			<td> {{ $item->quantity-$item->sale_count }} </td>
			<td>
			<a class="btn btn-primary" href="products/{{ $item->id }}/edit" role="button">{{ trans('app.Edit') }}</a> 
			<a class="btn btn-danger" href="products/destroy/{{ $item->id }}" role="button">{{ trans('app.Delete') }}</a>

			</td>
		</tr>
	@endforeach
</tbody>
</table>
<div class="row text-center">
	{!! $list->appends(\Request::except('page'))->render() !!}
</div>