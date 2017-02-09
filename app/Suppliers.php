<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Suppliers extends Model
{
   
    use Sortable;
    protected $table = 'suppliers'; 
    protected $fillable = [
        'name','mobile'
    ];
    public $sortable = [
                        'id',
                        'name',
                        'created_at',
                        'mobile'];
}
