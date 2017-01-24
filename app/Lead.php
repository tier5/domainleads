<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

     public function domains(){
        return $this->hasMany('\App\Domain', 'id','domain_id');
    }

    public function user(){
    	return $this->hasMany('\App\User' , 'id' , 'user_id');
    }
}
