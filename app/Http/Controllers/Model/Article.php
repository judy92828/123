<?php

namespace App\Http\Controllers\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //

    public function category()
    {
    	return $this->belongsTo('App\Http\Controllers\Model\Category');
    }
}
