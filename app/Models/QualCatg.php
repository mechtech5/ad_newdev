<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualCatg extends Model
{
    protected $table = 'qual_catg_mast';

    public $timestamps = false;
	protected $guarded = [] ;
	protected $primaryKey = 'qual_catg_code';

 	public $incrementing =false;
}
