<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';	
    protected $guarded = [];

    public function created_user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function assigned_user(){
        return $this->hasOne('App\User','id','user_id1');
    }
    public function relate_to_case(){
    	return $this->belongsTo('App\Models\CaseMast','case_id','case_id');
    }
    
}
