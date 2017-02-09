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
   			<div class="row pull-right">
			  <div class="col-md-6">
			  	<div class="form-group ">
					<input type="text" class="fromdate form-control datepicker" placeholder="{{ trans('app.From Date') }}">
				</div>
			  </div>
			  <div class="col-md-6">
			  	<div class="form-group"> 
					<input type="text" class="todate form-control datepicker" placeholder="{{ trans('app.To Date') }}">
				</div>
			  </div>
			 </div>
       		<div class="form-group pull-left">
			    <a class="btn btn-success" href="orders/create" role="button">{{ trans('app.Create') }}</a>
			</div>
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" /> 
			<div id="list">
				{!! View::make('orders._list',compact('list'))!!}
			 </div>
		</div>
	</div>
</div>
@stop()


@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').datepicker({format: 'yyyy-mm-dd',rtl: true});
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
		$(document).on("change",".fromdate,.todate",function(e){
			e.preventDefault();
			var from = $(".fromdate").val();
			var to = $(".todate").val();
			var url_ = "{{url('orders/search')}}";
			$.ajax({
				url:url_,
				type:'GET',
				data:{from:from,to:to},
				success:function(result){
					$("#list").html(result);
				}
			});
		});
	});
</script>
@stop()