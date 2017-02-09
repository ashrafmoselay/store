<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class InvoiceDetailes extends Model
{
    use Sortable;
    protected $table = 'invoice_detailes'; 
    protected $fillable = [
        'invoice_id','product_id','qty','cost','total'
    ];

    public function product(){
    	return $this->belongsTo('\App\Products','product_id','id');
    }
    public function invoice(){
    	return $this->belongsTo('\App\PurchaseInvoice','invoice_id','id');
    }
}
