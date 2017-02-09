<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class ClientPayments extends Model
{
    
    protected $table = 'client_payments'; 
    protected $fillable = [
        'client_id', 'total', 'paid','due'
    ];
}
