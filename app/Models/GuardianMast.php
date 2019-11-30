<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuardianMast extends Model
{
    protected $table = 'guardian_mast';
    protected $guarded = [];

    public function relation(){
    	return $this->belongsTo('App\Models\Relation','relation_id');
    }
    public function designation(){
    	return $this->belongsTo('App\Models\DesignationMast','designation_id');
    }
    public function profession(){
    	return $this->belongsTo('App\Models\ProfessionMast','profession_id');
    }
    
}
