<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
       'cat_id', 'name', 'price'
    ];
	protected $table='products';
	 public function getCategory() {
      return $this->belongsTo('App\Category','cat_id'); // this matches the Eloquent model
    }

	
}
