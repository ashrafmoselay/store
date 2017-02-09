<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseInvoice;
use App\Products;
use App\InvoiceDetailes;
use DB;
class PurchaseInvoiceController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title = "PurchaseInvoice Index";
        $list = PurchaseInvoice::sortable()->Paginate();
        return view('purchaseInvoice.index',compact('title','list'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'purchaseInvoice | Create';
        return view('purchaseInvoice.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	try{
    		DB::beginTransaction();
	        $inputs = $request->all();
	        $invoice['supplier_id'] = $inputs['supplier_id'];
	        $invoice['total'] = $inputs['total'];
	        $invoice_id = PurchaseInvoice::create($invoice)->id;
	        foreach ($inputs['product_id'] as $key => $value) {
	        	$prod = explode('-', $value);
	        	$details['invoice_id'] = $invoice_id;
	        	$details['product_id'] = $prod[0];
	        	$details['qty'] = $inputs['quantity'][$key];
	        	$details['cost'] = $inputs['cost'][$key];
	        	$details['total'] = $inputs['totalcost'][$key];
				InvoiceDetailes::create($details);
				$product = Products::findOrFail($prod[0]);
				$avgCost = (($product->quantity * $product->cost) + ($details['qty'] * $details['cost']))/($details['qty'] + $product->quantity);
				$product->cost = $avgCost;
				$product->quantity += $details['qty'];
				$product->save();
				$request->session()->flash('alert-success', trans('app.Orders Invoice was successful added!'));

	        }
		    DB::commit();
		}catch(\Exception $e){
		    DB::rollback();
		     $request->session()->flash('alert-danger', trans('app.Some Error was ocuured during adding! ').$e->getMessage());
		}
        return redirect('purchaseInvoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = PurchaseInvoice::with('details')->findOrFail($id);
        $title = 'purchaseInvoice | '.$invoice->id; 
        return view('purchaseInvoice.show',compact('invoice','title'));
    }
    public function autocomplete(Request $request)
    {
        $data = Products::selectRaw('CONCAT(id, "-", title) as name, id')->where("title","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }
}
