<?php

namespace App\Http\Controllers\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    public function article()
    {
    	return $this->hasMany('App\Http\Controllers\Article');
    }

    public function video()
    {
    	return $this->hasMany('App\Http\Controllers\Video');
    }
}
