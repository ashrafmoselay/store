@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.Summary Report') }}</div>
                <?php 
                    $totalProduct = DB::table('products')->count();
                    $totalorders = DB::table('orders')->count();
                    $totalSales = DB::table('orders')->sum('total');
                    $purchase_Count = DB::table('purchase_invoice')->count();
                    $totalpurchase = DB::table('purchase_invoice')->sum('total');
                    $totalDebt = DB::table('clients')->sum('due');
                    $totalprofit = DB::table('order_detailes')->sum(DB::raw('(qty * price) - (qty * cost)'));
                    $totalRemainInStock = DB::table('products')->sum(DB::raw('(quantity - sale_count) * cost'));
                    $clientCountdue = DB::table('clients')->where('due','>',0)->count();
                    $clientCount = DB::table('clients')->count();
                    $supplierCount = DB::table('suppliers')->count();
                ?>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                <tr class="success">
                                    <td>{{ trans('app.Total Products') }}</td>
                                    <td>{{" $totalProduct "}} {{ trans('app.product') }}</td>
                                </tr>
                                <tr class="warning">
                                    <td>{{ trans('app.Today Sales') }}</td>
                                    <td>{{$totalSales. " ".trans('app.EGP')." ( $totalorders )"}} {{ trans('app.order') }}</td>
                                </tr>
                                <tr class="info">
                                    <td>{{ trans('app.Total Purchase') }}</td>
                                     <td>{{$totalpurchase." ".trans('app.EGP')." ( $purchase_Count ) "}}{{ trans('app.invoice') }}</td>
                                </tr>
                                <tr class="active">
                                    <td>{{ trans('app.Total debt') }} </td>
                                    <td>{{$totalDebt}} {{ trans('app.EGP') }} {{"( $clientCountdue )"}} {{trans('app.Client')}} </td>
                                </tr>
                                <tr class="{{($totalprofit<0)?"danger":"warning"}}">
                                    <td>{{ trans('app.Total Profit') }}</td>
                                    <td>{{$totalprofit. " ".trans('app.EGP')}}</td>
                                </tr>
                                <tr class="success">
                                    <td>{{ trans('app.Total Cost Remaining In Stock') }}</td>
                                     <td>{{$totalRemainInStock}} {{ trans('app.EGP') }} </td>
                                </tr>
                                <tr class="active">
                                    <td>{{ trans('app.Client Count') }}</td>
                                     <td>{{$clientCount}} </td>
                                </tr>
                                <tr class="warning">
                                    <td>{{ trans('app.Supplier Count') }}</td>
                                     <td>{{$supplierCount}} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer"><p> جميع الحقوق محفوظة 2017 &copy;<p></div>
            </div>
        </div>
    </div>
</div>
@endsection
