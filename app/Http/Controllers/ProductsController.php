<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
class ProductsController extends Controller
{
    
     public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title = "Products Index";
        $list = Products::sortable()->Paginate();
        return view('products.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Products | Create';
        return view('products.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        Products::create($inputs);
        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Products::with('admin/Products')->findOrFail($id);
        $title = 'Products | '.$category->name; 
        return view('admin.Products.show',compact('Products','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $item = Products::findOrFail($id);
         $title = 'Products | '.$item->title; 
         return view('products.edit',compact('item','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Products = Products::find($id);
        $inputs = $request->all();
        $Products->update($inputs);
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Products::find($id)->delete();
       return redirect('products');
    }
    public function search(Request $request,$term=''){
        $list =  Products::search($term);
        if($request->ajax()){
        return \View::make('products._list',compact('list'));
        }else{
            $title = 'Products | Create';
            return view('products.index',compact('title','list'));
        }
    }
    public function qtyDetailes($id)
    {
        $list = \App\InvoiceDetailes::where('product_id',$id)->Paginate();
        $title = 'Products | Create';
        $totalqty = Products::find($id)->quantity;
        return view('products.qtyDetailes',compact('title','list','totalqty'));
    }
    public function salesDetailes($id)
    {
        $list = \App\OrderDetails::where('product_id',$id)->Paginate();
        $title = 'Products | Create';
        return view('products.salesDetailes',compact('title','list'));
    }
}
