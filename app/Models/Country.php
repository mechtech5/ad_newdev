<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country_mast';
	protected $primaryKey = 'country_code';
	protected $guarded = [];

	public function nationality(){
		return $this->belongsTo('App\Models\Nationality','nationality_id');
	}
	public function currency(){
		return $this->belongsTo('App\Models\Currency', 'currency_code');
	}
}
