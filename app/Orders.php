<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Orders extends Model
{
    use Sortable;
    protected $table = 'orders'; 
    protected $fillable = [
        'client_id','payment_type','is_paid','total','paid','due'
    ];
    public $sortable = [
                        'id',
                        'client_id',
                        'payment_type',
                        'total',
                        'paid',
                        'due',
                        'created_at',
                        'updated_at'];

    public function details(){
        return $this->hasMany('\App\OrderDetails','order_id','id');
    }
    public function client(){
    	return $this->belongsTo('\App\Clients','client_id','id');
    }
    public function ScopeSearch($query,$from,$to){
        if(!empty($from) && !empty($to)){
            return $query->whereBetween('created_at', array($from, $to))->orderBy('created_at')->Paginate();
        }elseif(!empty($from)){
             return $query->where('created_at','>=',$from)->orderBy('created_at')->Paginate();
        }elseif(!empty($to)){
             return $query->where('created_at','<=',$to)->orderBy('created_at')->Paginate();
        }else{
            return $query->Paginate();
        }
    }
    //Defining An Accessor
    public function getPaymentTypeAttribute($value)
    {
        return ($value==1)?trans('app.Cash Payment'):trans('app.Payment in installments');
    }
}
