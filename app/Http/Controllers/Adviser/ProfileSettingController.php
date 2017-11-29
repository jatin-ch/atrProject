<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Session;
use Image;

class ProfileSettingController extends Controller
{
  public function __construct()
  {
      $this->middleware('role:adviser');
  }

  public function getSettings()
  {
    $setting = User::find(Auth::user()->id);
    return view('adviser.profile.setting')->withSetting($setting);
  }

  public function updateSettings(Request $request)
  {
   $setting = User::find(Auth::user()->id);

      $this->validate($request, [
       'name' => 'required|string|max:255'
       ]);

        if(isset($request->password)){
          $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
          ]);
        }

        if(isset($request->password)){
          $setting->name = $request->name;
          $setting->password = bcrypt($request->password);
        } else {
          $setting->name = $request->name;
        }
       $setting->save();

       if($request->password){
         Session::flash('success','Your password has been changed!');
       } else {
         Session::flash('success','Your profile has been saved.');
       }
        return redirect()->route('profile.settings.get');

      }

      public function uploadPhoto(Request $request)
      {
        $this->validate($request, ['image' => 'required|mimes:jpeg,png']);

        $profile = User::find(Auth::user()->id)->basicDetail;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(150,150)->save($location);
            $profile->image = $filename;
          }
        $profile->save();
      //  return redirect()->route('adviser.dashboard');
         Session::flash('success','Your profile picture was updated.');
          return redirect()->back();
      }
}
