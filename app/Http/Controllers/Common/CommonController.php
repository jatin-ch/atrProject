<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class CommonController extends Controller
{
    public function about()
    {
      return view('common.aboutus');
    }
    
    public function faq()
    {
      return view('common.faq');
    }
    
    public function terms()
    {
      return view('common.terms');
    }
    
    public function howitworks()
    {
      return view('common.howitworks');
    }


}
