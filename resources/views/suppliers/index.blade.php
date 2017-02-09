@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
       		<div class="form-group pull-left">
			    <a class="btn btn-success" href="suppliers/create" role="button">{{ trans('app.Create') }}</a>
			</div>
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<table class="table table-hover display">
				<thead>
					<tr>
						<th>@sortablelink('id',trans('app.ID'))</th>
						<th>@sortablelink('name',trans('app.Supplier Name'))</th>
						<th>@sortablelink('mobile',trans('app.Mobile'))</th>
						<th>{{ trans('app.action') }}</th>
					</tr>
				</thead> 
				<tbody>
					@foreach($list as $item)
						<tr>
							<td> {{ $item->id }} </td>
							<td> {{ $item->name }} </td>
							<td> {{ $item->mobile }} </td>
							<td>
							<a class="btn btn-primary" href="suppliers/{{ $item->id }}/edit" role="button">{{ trans('app.Edit') }}</a> 
							<a class="btn btn-danger" href="suppliers/destroy/{{ $item->id }}" role="button">{{ trans('app.Delete') }}</a>

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	 <div class="row text-center">
	 	{!! $list->appends(\Request::except('page'))->render() !!}
	 </div>
</div>
@stop()


@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("click",".btn-danger",function(e){
			e.preventDefault();
			if(!confirm('Are you sure you want to delete this item?')) return false;
			var btn = $(this);
			var url_ = btn.attr('href');
			$.ajax({
				url:url_,
				success:function(result){
					btn.closest('tr').fadeOut();
				}
			});
		});
	});
</script>
@stop()