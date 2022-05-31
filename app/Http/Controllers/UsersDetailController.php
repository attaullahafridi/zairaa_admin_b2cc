<?php

namespace App\Http\Controllers;

use App\Exports\UserDetailExports;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Excel;

class UsersDetailController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$users_detail = User::with('users_detail')->where('type','!=',1)->get();
    	// $users_detail = User::where('type','!=',1)->where('status',1)->get()->toJSON();
    	// dd($users_detail);
    	return View::make('pages.users.users',compact('users_detail'));
    }

    public function export(Request $request) 
    {
        return Excel::download(new UserDetailExports($request->export_result), 'users_detail.xlsx');
    }
}
