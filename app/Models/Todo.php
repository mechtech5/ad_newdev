<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';
    protected $guarded = [];
    
    public function user(){
    	return $this->belongsTo('App\User','team_id');
    }
}
