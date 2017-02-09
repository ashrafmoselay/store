@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row"> 	 
		<div class="col-md-12 orderContainer">
			{!! Form::open(['route'=>'orders.store','method'=>'post']) !!}
				<div class="row">
				  <div class="col-md-10">
						<div class="form-group">
							<label for="">{{trans('app.Client Name')}}</label>
							<select id="clientsList" name="client_id"  class="form-control" required="required">
							<option value="">{{trans('app.--- Select Client ---')}}</option>
							@foreach(\App\Clients::get() as $client)
								<option value="{{$client->id}}">{{$client->name}}</option>
							@endforeach
							</select>
						</div>
					</div>
					<div style="margin-top: 23px;" class="col-md-2">
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">{{trans('app.New Client')}}</span></button>
					</div>
				</div>
				<div class="form-group">
					<label for="">{{trans('app.Payment Type')}}</label>
					<select name="payment_type"  class="form-control" required="required">
					<option value="1">{{trans('app.Cash Payment')}}</option>
					<option value="2">{{trans('app.Payment in installments')}}</option>
					
					</select>
				</div>
				<div class="form-group">
					<label for="">{{trans('app.Total')}}</label>
					<input name="total" readonly="" type="text" class="form-control totalCost"  placeholder="{{trans('app.Total')}}">
				</div>
				<div class="form-group">
					<label for="">{{trans('app.Paid')}}</label>
					<input name="paid"  type="text" class="form-control paid"  placeholder="{{trans('app.Paid')}}">
				</div>
				<div class="form-group">
					<label for="">{{trans('app.Due')}}</label>
					<input name="due" readonly="" type="text" class="form-control due"  placeholder="{{trans('app.Due')}}">
				</div>
				<div class="row productList">
				  <div class="col-md-4">
				  	<div class="form-group">
						<label for="">{{trans('app.Products')}} </label>
						<input name="product_id[]" class="typeahead form-control" required=""  type="text">
					</div>
				  </div>
				  <div class="col-md-2">
				  	<div class="form-group">
						<label for="">{{trans('app.Sale Price')}}</label>
						<input name="price[]" class="form-control price" required=""  type="text">
					</div>
				  </div>
				  <div class="col-md-2">
				  	<div class="form-group">
						<label for="">{{trans('app.Qantity')}}</label>
						<input name="quantity[]" class="form-control qty" required=""  type="text">
					</div>
				  </div>
				  <div class="col-md-2">
				  	<div class="form-group">
						<label for="">{{trans('app.Total')}} </label>
						<input name="totalcost[]" class="form-control total" required="" type="text">
					</div>
				  </div>
				  <div style="margin-top: 23px;" class="col-md-2">
				  		<a class="btn btn-primary addnewproducts" href="#" role="button">+</a>
				  </div>
				</div>
				<button type="submit" class="btn btn-primary">{{trans('app.Submit')}}</button>
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
	$(document).on("input",".price,.qty",function(e){
		e.preventDefault();
		var parent = $(this).closest('div').parents('.productList');
		var qty = parseInt(parent.find(".qty").val());
		var cost = parseFloat(parent.find(".price").val());
		var total = qty * cost;
		if(isNaN(total))total=0;
		parent.find(".total").val(total);
		calculateCost();
	});
	$(document).on("input",".modal-body .total,.modal-body .paid",function(e){
			e.preventDefault();
			var due = parseFloat($(".modal-body .total").val()) - parseFloat($(".modal-body .paid").val());
			$(".modal-body .due").val(due);
	});
	$(document).on("input",".orderContainer .paid,.orderContainer .totalCost",function(e){
		e.preventDefault();
		var totalCost = parseFloat($(".totalCost").val());
		var paid = parseFloat($(".orderContainer .paid").val());
		var due = totalCost - paid;
		if(isNaN(due))due=$(".totalCost").val();
		$(".orderContainer .due").val(due);
	});
	$(document).on("submit",".modal-body form",function(e){
		e.preventDefault();
		var form = $(this);
		var url_ = form.attr('action');
		$.ajax({
			url:url_,
			type:'POST',
			data:form.serialize(),
			success:function(result){
				$("#clientsList").html(result);
				$(".close").trigger("click");
				$("#clientsList option:last").attr("selected", "selected");
			}
		});
		
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
	$(".paid").trigger("input");
}
</script>
@stop()


<div style="display: none;" class="row cloneDiv">
	<div class="row productList">
	  <div class="col-md-4">
	  	<div class="form-group">
			<label for="">{{trans('app.Products')}} </label>
			<input name="product_id[]" class="typeahead form-control" required=""  type="text">
		</div>
	  </div>
	  <div class="col-md-2">
	  	<div class="form-group">
			<label for="">{{trans('app.Sale Price')}}</label>
			<input name="price[]" class="form-control price" required=""  type="text">
		</div>
	  </div>
	  <div class="col-md-2">
	  	<div class="form-group">
			<label for="">{{trans('app.Qantity')}}</label>
			<input name="quantity[]" class="form-control qty" required=""  type="text">
		</div>
	  </div>
	  <div class="col-md-2">
	  	<div class="form-group">
			<label for="">{{trans('app.Total')}} </label>
			<input name="totalcost[]" class="form-control total" required=""  type="text">
		</div>
	  </div>
	  <div style="margin-top: 23px;" class="col-md-2">
			<a class="btn btn-danger" href="#" role="button">-</a>
	  </div>
	</div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('app.Create New Client')}}</h4>
      </div>
      <div class="modal-body">
        	{!! View::make('clients.create_partial')!!}
      </div>
    </div>

  </div>
</div>