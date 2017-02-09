<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class PurchaseInvoice extends Model
{
    
    use Sortable;
    protected $table = 'purchase_invoice'; 
    protected $fillable = [
        'supplier_id','total'
    ];
    public $sortable = [
                        'id',
                        'supplier_id',
                        'total',
                        'created_at',
                        'updated_at'];

    public function details(){
        return $this->hasMany('\App\InvoiceDetailes','invoice_id','id')->orderBy('id','DESC');
    }
    public function supplier(){
    	return $this->belongsTo('\App\Suppliers','supplier_id','id');
    }
}
