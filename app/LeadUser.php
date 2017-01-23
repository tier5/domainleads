<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadUser extends Model
{
    protected $table = 'leadusers';

     public function domains(){
        return $this->hasMany('\App\Domain', 'id','domain_id');
    }

    public function user(){
    	return $this->hasMany('\App\User' , 'id' , 'user_id');
    }
}
