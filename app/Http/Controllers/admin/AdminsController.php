<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index() {
        $admins = User::where('id' , '!='  , 1)->get();
        return view('admins.index' , [
            'admins' => $admins
        ]);
    }


}
