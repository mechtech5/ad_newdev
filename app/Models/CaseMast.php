<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class CaseMast extends Model
{
    use SoftDeletes;
    protected $table = 'case_mast';
    
    protected $dates = ['deleted_at'];
	protected $guarded = [];
	
    public function casetype(){
    	return $this->belongsTo('App\Models\CaseType','case_type_id');
    }
    public function client(){
        return $this->belongsTo('App\Models\Customer','cust_id');
    }
}
