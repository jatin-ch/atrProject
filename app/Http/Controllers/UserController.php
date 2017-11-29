<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use DB;
use Hash;
use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $mainuser = User::find(Auth::user()->id);

      if($mainuser->level == 'superadministrator'){
         $users = User::where('level', 'administrator')->orwhere('level', 'superadviser')->orWhere('level', 'adviser')->orderBy('id', 'desc')->paginate(10);
         return view('admin.users.index')->withUsers($users);
      } elseif ($mainuser->level == 'administrator') {
        $users = User::where('level', 'superadviser')->orWhere('level', 'adviser')->orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index')->withUsers($users);
      } elseif ($mainuser->level == 'superadviser') {
        $users = User::where('level', 'adviser')->orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index')->withUsers($users);
      } else {
        return redirect()->route('admin.dashboard');
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $mainuser = User::find(Auth::user()->id);

      if($mainuser->level == 'superadministrator'){
         $roles = Role::where('name', 'administrator')->orwhere('name', 'superadviser')->orWhere('name', 'adviser')->get();
      } elseif ($mainuser->level == 'administrator') {
        $roles = Role::where('name', 'superadviser')->orWhere('name', 'adviser')->get();
      } elseif ($mainuser->level == 'superadviser') {
        $roles = Role::where('name', 'adviser')->get();
      } else {
        return redirect()->route('admin.dashboard');
      }
        return view('admin.users.create')->withRoles($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|email|unique:users',
          'mobile' => 'required|min:10|max:10|unique:users'
        ]);

        if (!empty($request->password)) {
          $password = trim($request->password);
        } else {
          # set the manual password
          $length = 10;
          $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
          $str = '';
          $max = mb_strlen($keyspace, '8bit') - 1;
          for ($i = 0; $i < $length; ++$i) {
              $str .= $keyspace[random_int(0, $max)];
          }
          $password = $str;
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->level = $request->level;
        $user->approved = false;
        $user->password = Hash::make($password);
        $user->save();

        if ($request->roles) {
        $user->syncRoles($request->roles);
      }

      Session::flash('success','User has been added!');
      return redirect()->route('users.show', $user->id);

        // if($user->save()){
        //   return redirect()->route('users.show', $user->id);
        // } else {
        //   Session::flash('danger', 'Sorry a problem occurred while creating this user.');
        //   return redirect()->route('users.create');
        // }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //$user = User::findOrFail($id);
      $mainuser = User::find(Auth::user()->id);
      $user = User::where('id', $id)->with('roles')->first();

      if($mainuser->level == 'superadministrator'){
         return view("admin.users.show")->withUser($user);
      } elseif ($mainuser->level == 'administrator') {
        if($user->level == 'superadviser' || $user->level == 'adviser'){
          return view("admin.users.show")->withUser($user);
        } else {
          return redirect()->route('admin.dashboard');
        }

      } elseif ($mainuser->level == 'superadviser') {
        if($user->level == 'adviser'){
          return view("admin.users.show")->withUser($user);
        } else {
          return redirect()->route('admin.dashboard');
        }

      } else {
        return redirect()->route('admin.dashboard');
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //$user = User::findOrFail($id);
      $mainuser = User::find(Auth::user()->id);
      $user = User::where('id', $id)->with('roles')->first();

      if($mainuser->level == 'superadministrator'){
         $roles = Role::where('name', 'administrator')->orwhere('name', 'superadviser')->orWhere('name', 'adviser')->get();
         return view("admin.users.edit")->withUser($user)->withRoles($roles);
      } elseif ($mainuser->level == 'administrator') {
        if($user->level == 'superadviser' || $user->level == 'adviser'){
          $roles = Role::where('name', 'superadviser')->orWhere('name', 'adviser')->get();
          return view("admin.users.edit")->withUser($user)->withRoles($roles);
        } else {
          return redirect()->route('admin.dashboard');
        }

      } elseif ($mainuser->level == 'superadviser') {
        if($user->level == 'adviser'){
          $roles = Role::where('name', 'adviser')->get();
          return view("admin.users.edit")->withUser($user)->withRoles($roles);
        } else {
          return redirect()->route('admin.dashboard');
        }

      } else {
        return redirect()->route('admin.dashboard');
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
      ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->approved = $request->approved;
        if ($request->password_options == 'auto') {
          $length = 10;
          $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
          $str = '';
          $max = mb_strlen($keyspace, '8bit') - 1;
          for ($i = 0; $i < $length; ++$i) {
              $str .= $keyspace[random_int(0, $max)];
          }
          $user->password = Hash::make($str);
        } elseif ($request->password_options == 'manual') {
          $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->syncRoles($request->roles);

        Session::flash('success','User was updated successfully!');
        return redirect()->route('users.show', $id);

        // if($user->save()){
        //   return redirect()->route('users.show', $user->id);
        // } else {
        //   Session::flash('error', 'There was a problem saving the updated user info to the database. Try again later.');
        //   return redirect()->route('users.edit', $user->id);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
