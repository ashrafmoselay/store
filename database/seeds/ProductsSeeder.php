<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        for ($i=0; $i < 100; $i++) { 
        	$n = $i+1;
        	$list [] =  [
            			'title'=>"Product title # $n",
            			'description'=>"Product description # $n",
		            	'cost'=>rand(1000,2500),
            			'price'=>rand(2600,3500),
            			'quantity'=>rand(1,100),
            			];
        }
    	DB::table('products')->insert($list);
    }
}
