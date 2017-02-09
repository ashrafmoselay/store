<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suppliers;
class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title = "Suppliers Index";
        $list = Suppliers::sortable()->Paginate();
        return view('suppliers.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Suppliers | Create';
        return view('suppliers.create',compact('title'));
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
        Suppliers::create($inputs);
        return redirect('suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Suppliers::with('admin/Suppliers')->findOrFail($id);
        $title = 'Suppliers | '.$category->name; 
        return view('admin.Suppliers.show',compact('Suppliers','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $item = Suppliers::findOrFail($id);
         $title = 'Suppliers | '.$item->title; 
         return view('suppliers.edit',compact('item','title'));
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
        $Suppliers = Suppliers::find($id);
        $inputs = $request->all();
        $Suppliers->update($inputs);
        return redirect('suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Suppliers::find($id)->delete();
       return redirect('Suppliers');
    }
    public function search($term){
        return Suppliers::search($term);
    }
}
