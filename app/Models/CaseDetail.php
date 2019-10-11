<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class CaseDetail extends Model
{
   	use SoftDeletes;
    protected $table='case_detl';
    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['deleted_at'];
}
