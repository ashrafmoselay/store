@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
	    <div class="flash-message">
	    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
	      @if(Session::has('alert-' . $msg))

	      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	      @endif
	    @endforeach
	  </div> <!-- end .flash-message -->
        <div class="col-md-12">
       		<div class="form-group pull-left">
			    <a class="btn btn-success" href="purchaseInvoice/create" role="button">{{ trans('app.Create') }}</a>
			</div>
			 
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<table class="table table-hover display">
				<thead>
					<tr>
						<th>@sortablelink('id',trans('app.ID'))</th>
						<th>@sortablelink('supplier_id',trans('app.Supplier Name'))</th>
						<th>@sortablelink('total',trans('app.Total'))</th>
						<th>@sortablelink('created_at',trans('app.Created'))</th>
						<th>{{ trans('app.action') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($list as $item)
						<tr>
							<td> {{ $item->id }} </td>
							<td> {{ $item->supplier->name }} </td>
							<td> {{ $item->total }} </td>
							<td> {{ $item->created_at }} </td>
							<td>
							<a class="btn btn-primary" href="purchaseInvoice/{{ $item->id }}" role="button">{{ trans('app.Show') }}</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			    <tfoot>
			        <tr class="danger">
			        	<td colspan="2">المجموع</td>
			        	<td colspan="3">{{$list->sum('total')}}</td>
			        </tr>
			    </tfoot>
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