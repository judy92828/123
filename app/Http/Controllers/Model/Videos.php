<?php

namespace App\Http\Controllers\Model;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{

    protected $table = 'videos';
    protected $guarded = array();

    public function issue()
    {
    	return $this->hasMany('App\Http\Controllers\Issue');
    }

}
