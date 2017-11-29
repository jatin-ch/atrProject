<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Auth;
use App\Permission;
use Session;

class RoleController extends Controller
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
      $roles = Role::all();

      $mainuser = User::find(Auth::user()->id);

      if($mainuser->level == 'superadministrator'){
        return view('admin.roles.index')->withRoles($roles);
      } else{
        return redirect()->back();
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $permissions = Permission::all();

      $mainuser = User::find(Auth::user()->id);

      if($mainuser->level == 'superadministrator'){
        return view('admin.roles.create')->withPermissions($permissions);
      } else{
        return redirect()->route('admin.dashboard');
      }

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
        'display_name' => 'required|max:255',
        'name' => 'required|max:100|alpha_dash|unique:roles,name',
        'description' => 'sometimes|max:255'
      ]);

      $role = new Role();
      $role->display_name = $request->display_name;
      $role->name = $request->name;
      $role->description = $request->description;
      $role->save();

      if ($request->permissions) {
        $role->syncPermissions($request->permissions);
      }
      return redirect()->route('roles.show', $role->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $role = Role::where('id', $id)->with('permissions')->first();

      $mainuser = User::find(Auth::user()->id);

      if($mainuser->level == 'superadministrator'){
        return view('admin.roles.show')->withRole($role);
      } else{
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
      $role = Role::where('id', $id)->with('permissions')->first();
      $permissions = Permission::all();
      $perms = array();
        foreach($role->permissions as $permission)
        {
          $perms[$permission->id] = $permission->id;   
        }

      $mainuser = User::find(Auth::user()->id);

      if($mainuser->level == 'superadministrator'){
        return view('admin.roles.edit')->withRole($role)->withPermissions($permissions)->withPerms($perms);
      } else{
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
        'display_name' => 'required|max:255',
        'description' => 'sometimes|max:255'
      ]);

      $role = Role::findOrFail($id);
      $role->display_name = $request->display_name;
      $role->description = $request->description;
      $role->save();

      if ($request->permissions) {
        $role->syncPermissions($request->permissions);
      }

      return redirect()->route('roles.show', $id);
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
