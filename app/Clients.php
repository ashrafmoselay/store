<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Clients extends Model
{
   
    use Sortable;
    protected $table = 'clients'; 
    protected $fillable = [
        'name','mobile', 'total', 'paid','due'
    ];
    public $sortable = [
                        'id',
                        'name',
                        'total',
                        'paid',
                        'due',
                        'created_at',
                        'updated_at'];
    public function ScopeSearch($query,$search){
		return $query->where('name','like',"%$search%")->orwhere('mobile','like',"%$search%")->Paginate();
    }
    public function installment(){
        return $this->hasMany('\App\ClientPayments','client_id','id');
    }
}
