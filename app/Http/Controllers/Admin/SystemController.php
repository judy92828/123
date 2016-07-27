<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Model\System;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class SystemController extends CommonController
{
    //系统设置
    public function index()
    {
        if ($input = Input::except('_token', "file_upload")) {
            if ($input = Input::except('_token', 'file_upload')) {
                $sys = System::first();
                if ($sys['id'] != '') {
                    System::where('id', $sys['id'])->update($input);
                } else {
                    System::create($input);
                }
                return redirect('admin/system');
            } else {
                $sys = System::first();
                if (count($sys) == 0) {
                    return view('admin.system.create');
                } else {
                    return view('admin.system.index')->with('sys', $sys);
                }
            }

        }else{
            $sys = System::first();
            if (count($sys) == 0) {
                return view('admin.system.create');
            } else {
                return view('admin.system.index')->with('sys', $sys);
            }
        }
    }
}
