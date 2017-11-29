<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dashboard()
    {
        $level = Auth::user()->level;
        
        if($level == 'superadministrator')
        {
            return redirect()->route('admin.dashboard');
        }
        else if( $level == 'administrator')
        {
            return redirect()->route('admin.dashboard');
        }
        else if($level == 'superadviser')
        {
            return redirect()->route('admin.dashboard');
        }
        else if($level == 'adviser')
        {
            return redirect()->route('adviser.dashboard');
        }
        else
        {
            return redirect()->route('user.dashboard');
        }
    }

}
