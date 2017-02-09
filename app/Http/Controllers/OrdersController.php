<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Products;
use App\OrderDetails;
use App\Clients;
use DB;
class OrdersController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title = "Orders Index";
        $list = Orders::sortable()->Paginate();
        return view('orders.index',compact('title','list'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'orders | Create';
        return view('orders.create',compact('title'));
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
	        $invoice['client_id'] = $inputs['client_id'];
	        $invoice['payment_type'] = $inputs['payment_type'];
	        $invoice['is_paid'] = ($inputs['payment_type']==1)?1:0;
	        $invoice['paid'] = $inputs['paid'];
	        $invoice['due'] = $inputs['due'];
	        $invoice['total'] = $inputs['total'];
	        $invoice_id = Orders::create($invoice)->id;
	        foreach ($inputs['product_id'] as $key => $value) {
	        	$prod = explode('-', $value);
				$product = Products::findOrFail($prod[0]);
	        	$details['order_id'] = $invoice_id;
	        	$details['product_id'] = $prod[0];
	        	$details['qty'] = $inputs['quantity'][$key];
	        	$details['price'] = $inputs['price'][$key];
	        	$details['cost'] = $product->cost;
	        	$details['total'] = $inputs['totalcost'][$key];
	        	if(($product->quantity-$product->sale_count ) < $details['qty'])throw new \Exception('Quantity of this item '. $product->title .' Not Avilable');
				OrderDetails::create($details);
				$product->sale_count += $details['qty'];
				$product->save();

	        }
            //if($inputs['payment_type']==2){
                $client = Clients::find($inputs['client_id']);
                $client->total += $inputs['total'];
                $client->paid += $inputs['paid'];
                $client->due += $inputs['due'];
                $client->save();
            //}
            $request->session()->flash('alert-success', trans('app.Orders Invoice was successful added!'));
		    DB::commit();
		}catch(\Exception $e){
		     DB::rollback();
		     //var_dump($e->getMessage());die;
		    $request->session()->flash('alert-danger', trans('app.Some Error was ocuured during adding! ').$e->getMessage());
		}
        return redirect('orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Orders::with('details')->findOrFail($id);
        $title = 'orders | '.$invoice->id; 
        return view('orders.show',compact('invoice','title'));
    }
    public function autocomplete(Request $request)
    {
        $data = Products::selectRaw('CONCAT(id, "-", title) as name, id')->where("title","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }
    public function search(Request $request){
        $list =  Orders::search($request->get('from'),$request->get('to'));
        if($request->ajax()){
            return \View::make('orders._list',compact('list'));
        }else{ 
            $title = 'Orders | Create';
            return view('orders.index',compact('title','list'));
        }
    }
}
