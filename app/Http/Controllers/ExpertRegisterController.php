<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ExpertRegisterController extends Controller
{

    protected $redirectTo = '/adviser/basicDetails';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('expert_create.blade.php');
    }


    public function store()
    {
      $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'mobile' => 'required|max:10|unique:users',
        'password' => 'required|string|min:6|confirmed'
      ]);

      $user = User::find(Auth::user());

      if($user){
        $user->level = 'adviser';
        $user->approved = false;
        $user->save();
      } else {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->level = 'adviser';
        $user->approved = false;
        $user->password =  bcrypt($request->password);
        $user->save();
      }
    }
}
