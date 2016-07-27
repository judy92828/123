<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ClearController extends Controller
{
    //
    public function clearread()
    {
        DB::table('articles')->update(array('views'=>0));
    }
}
