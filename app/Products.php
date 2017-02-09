<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Products extends Model
{
    
    use Sortable;
    protected $table = 'products'; 
    protected $fillable = [
        'title','description', 'quantity', 'cost','price'
    ];
    public $sortable = [
                        'id',
                        'title',
                        'quantity',
                        'total',
                        'cost',
                        'price',
                        'created_at',
                        'sale_count'];
    public function ScopeSearch($query,$search){
		return $query->where('title','like',"%$search%")->Paginate();
    }
    //Defining An Accessor
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }
    //Defining A Mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }
}
