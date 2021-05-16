<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $getusers = User::all();
        return view('admin.user',compact('getusers'));
    }

    public function status(Request $request)
    {
        $users = User::where('id', $request->id)->update( array('role_id'=>$request->status) );
        if ($users) {
            return 1;
        } else {
            return 0;
        }
    }
}
