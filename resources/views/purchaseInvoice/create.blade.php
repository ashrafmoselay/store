@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>'purchaseInvoice.store','method'=>'post']) !!}
				<div class="form-group">
					<label for="">{{ trans('app.Supplier Name') }}</label>
					<select name="supplier_id"  class="form-control" required="required">
					<option value="">{{ trans('app.--- Select Supplier ---') }}</option>
					@foreach(\App\Suppliers::get() as $supplier)
						<option value="{{$supplier->id}}">{{$supplier->name}}</option>
					@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">{{ trans('app.Total') }}</label>
					<input name="total" readonly="" type="text" class="form-control totalCost"  placeholder="{{ trans('app.Total') }}">
				</div>
				<div class="row productList">
				  <div class="col-md-4">
				  	<div class="form-group">
						<label for="">{{ trans('app.Products') }} </label>
						<input name="product_id[]" class="typeahead form-control" required=""  type="text">
					</div>
				  </div>
				  <div class="col-md-2">
				  	<div class="form-group">
						<label for="">{{ trans('app.Cost Price') }}</label>
						<input name="cost[]" class="form-control cost" required=""  type="text">
					</div>
				  </div>
				  <div class="col-md-2">
				  	<div class="form-group">
						<label for="">{{ trans('app.Qantity') }}</label>
						<input name="quantity[]" class="form-control qty" required=""  type="text">
					</div>
				  </div>
				  <div class="col-md-2">
				  	<div class="form-group">
						<label for="">{{ trans('app.Total') }} </label>
						<input name="totalcost[]" class="form-control total" required="" type="text">
					</div>
				  </div>
				  <div style="margin-top: 23px;" class="col-md-2">
				  		<a class="btn btn-primary addnewproducts" href="#" role="button">+</a>
				  </div>
				</div>
				<button type="submit" class="btn btn-primary">{{ trans('app.Submit') }}</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){    
    initTypeahead();
	$(document).on("click",".btn-danger",function(e){
		e.preventDefault();
		$(this).closest('div').parent('div').remove();
		calculateCost();
	});
	$(".addnewproducts").click(function(e){
		e.preventDefault();
		var clone = $('.cloneDiv').html();
		$(".productList:last:visible").after(clone);
		initTypeahead();
	});
	$(document).on("input",".cost,.qty",function(e){
		e.preventDefault();
		var parent = $(this).closest('div').parents('.productList');
		var qty = parseInt(parent.find(".qty").val());
		var cost = parseFloat(parent.find(".cost").val());
		var total = qty * cost;
		if(isNaN(total))total=0;
		parent.find(".total").val(total);
		calculateCost();
	});
});
function initTypeahead(){
	var path = "{{ route('autocomplete') }}";
	$('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });	
}
function calculateCost(){
	var totalCost =0;
	$(".total:visible").each(function() {
		if (!isNaN($(this).val())) {
			totalCost += parseFloat($(this).val());
		}
	});
	$(".totalCost").val(totalCost);
}
</script>
@stop()


<div style="display: none;" class="row cloneDiv">
	<div class="row productList">
	  <div class="col-md-4">
	  	<div class="form-group">
			<label for="">{{ trans('app.Products') }} </label>
			<input name="product_id[]" class="typeahead form-control" required=""  type="text">
		</div>
	  </div>
	  <div class="col-md-2">
	  	<div class="form-group">
			<label for="">{{ trans('app.Cost Price') }}</label>
			<input name="cost[]" class="form-control cost" required=""  type="text">
		</div>
	  </div>
	  <div class="col-md-2">
	  	<div class="form-group">
			<label for="">{{ trans('app.Qantity') }}</label>
			<input name="quantity[]" class="form-control qty" required=""  type="text">
		</div>
	  </div>
	  <div class="col-md-2">
	  	<div class="form-group">
			<label for="">{{ trans('app.Total') }} </label>
			<input name="totalcost[]" class="form-control total" required=""  type="text">
		</div>
	  </div>
	  <div style="margin-top: 23px;" class="col-md-2">
			<a class="btn btn-danger" href="#" role="button">-</a>
	  </div>
	</div>
</div>