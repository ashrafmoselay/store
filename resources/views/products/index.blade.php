@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
       		<div class="form-group pull-right">
			    <input type="text" class="search form-control" placeholder="{{ trans('app.What you looking for?') }}">
			</div>
       		<div class="form-group pull-left">
			    <a class="btn btn-success" href="products/create" role="button">{{ trans('app.Create') }}</a>
			</div>
			
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<div id="list">
				{!! View::make('products._list',compact('list'))!!}
			 </div>
		</div>
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
		$(document).on("input",".search",function(e){
			e.preventDefault();
			//if (e.which == 13) {
				var url_ = "{{url('products/search')}}/"+$('.search').val();
				$.ajax({
					url:url_,
					type:'GET',
					success:function(result){
						$("#list").html(result);
					}
				});
			//}
		});
	});
</script>
@stop()