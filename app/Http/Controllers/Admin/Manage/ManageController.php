<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }

    public function index()
    {
      $users = User::where('level', 'adviser')->orderBy('id', 'desc')->paginate(10);
      return view('admin.manage.index')->withUsers($users);
    }

    public function search()
    {
      $users = User::where('level', 'adviser')->orderBy('id', 'desc')->paginate(10);
      $q = Input::get ('q');
    	if($q != ""){
    	$user = User::where('name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->paginate (5)->setPath ( '' );
    	$pagination = $user->appends ( array (
    				'q' => Input::get ( 'q' )
    		) );
    	if (count ( $user ) > 0)
    		return view('admin.manage.index')->withDetails($user)->withQuery($q)->withUsers($user);
    	}
    		return view('admin.manage.index')->withMessage('No Details found. Try to search again !')->withUsers($user);
   }

}
