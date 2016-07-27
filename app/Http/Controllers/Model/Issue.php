<?php

namespace App\Http\Controllers\Model;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    //
    protected $guarded = array();
     
	public function video()
	{
		return $this->belongsTo('App\Controllers\Model\Videos');
	}
}
