<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class OrderDetails extends Model
{
    protected $table = 'order_detailes'; 
    protected $fillable = [
        'order_id','product_id','qty','cost','price','total'
    ];

    public function product(){
    	return $this->belongsTo('\App\Products','product_id','id');
    }
    public function invoice(){
    	return $this->belongsTo('\App\Orders','product_id','id');
    }
}
