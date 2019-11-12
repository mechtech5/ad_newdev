<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table='currency';
    protected $guarded = [];
  	protected $primaryKey = "currency_code";
  	public $incrementing = false;
}
