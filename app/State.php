<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	protected $table = 'state_mast';
	 
 	protected $primaryKey = 'state_code';

 	public $incrementing =false;
}
