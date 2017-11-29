<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ExpertDetail;
use App\Models\Admin\Education;
use App\Models\Admin\WorkExperience;
use App\Models\Admin\Specialization;
use App\Models\Admin\Membership;
use App\Models\Admin\Award;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Qualification;
use App\User;
use Auth;
use Image;
use Session;

class ExpertDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:adviser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $expertdetail = User::find(Auth::user()->id)->expertDetail;
      $categories = Category::all();
      $sub_categories = SubCategory::all();
      $qualifications = Qualification::all();

      $pw = 0;
      if(Auth::user()->basicDetail->image){
        $pw += 20;
      }
      if(Auth::user()->expertDetail){
        $pw += 20;
      }
      if(Auth::user()->verification){
        $pw += 10;
      }
      if(Auth::user()->availabilities->count() > 0){
        $pw += 20;
      }
      if(Auth::user()->locations->count() > 0){
        $pw += 10;
      }
      if(Auth::user()->galleries->count() > 0){
        $pw += 20;
      }

      if($expertdetail){
        return view('adviser.expertDetails.index')->withExpertdetail($expertdetail)->withCategories($categories)->withSub_categories($sub_categories)->withQualifications($qualifications)->withPw($pw);
      }
      else{
      return view('adviser.expertDetails.create')->withCategories($categories)->withSub_categories($sub_categories)->withQualifications($qualifications)->withPw($pw);
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
        'type' => 'required|string',
        'experience' => 'required|integer',
        'major_cat' => 'required',
        'major_subcat' => 'required',
        'other_cat' => 'required',
        'other_subcat' => 'required',
        'cp' => 'required',
        'coc' => 'required',
        'degree' => 'required',
        'college' => 'required',
        'year' => 'required',
        'about' => 'required'
      ]);

      $expertdetail = new ExpertDetail;
      $expertdetail->type = $request->type;
      $expertdetail->experience = $request->experience;
      $expertdetail->major_cat = $request->major_cat;
      $expertdetail->major_subcat = $request->major_subcat;
      $expertdetail->other_cat = $request->other_cat;
      $expertdetail->other_subcat = $request->other_subcat;
      $expertdetail->cp = $request->cp;
      $expertdetail->coc = $request->coc;
      $expertdetail->qualification = $request->qualification;
      $expertdetail->also_for = $request->also_for;
      $expertdetail->about = $request->about;
      $expertdetail->user_id = Auth::user()->id;
      $expertdetail->save();

      if($expertdetail->save()){

        if(count($request->degree) > 0){
          foreach($request->degree as $key => $v){
            $data = array(
              'degree' => $request->degree [$key],
              'college' => $request->college [$key],
              'year' => $request->year [$key],
              'user_id' => Auth::user()->id
            );
            Education::insert($data);
          }
        }

        if(count($request->profile) > 0){
          foreach($request->profile as $key => $v){
            $data = array(
              'profile' => $request->profile [$key],
              'office' => $request->office [$key],
              'from_year' => $request->from_year [$key],
              'to_year' => $request->to_year [$key],
              'user_id' => Auth::user()->id
            );
            WorkExperience::insert($data);
          }
        }

        if(count($request->name) > 0){
          foreach($request->name as $key => $v){
            $data = array(
              'name' => $request->name [$key],
              'user_id' => Auth::user()->id
            );
            Specialization::insert($data);
          }
        }

        if(count($request->institution_name) > 0){
          foreach($request->institution_name as $key => $v){
            $data = array(
              'institution_name' => $request->institution_name [$key],
              'institution_location' => $request->institution_location [$key],
              'user_id' => Auth::user()->id
            );
            Membership::insert($data);
          }
        }

        if(count($request->award_name) > 0){
          foreach($request->award_name as $key => $v){
            $data = array(
              'award_name' => $request->award_name [$key],
              'award_by' => $request->award_by [$key],
              'award_year' => $request->award_year [$key],
              'user_id' => Auth::user()->id
            );
            Award::insert($data);
          }
        }

      }

      $expertdetail->qualifications()->sync($request->qualifications, false);

      Session::flash('success','Expert details added successfully!!');
      return redirect()->route('adviser.expertDetails.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      $expertdetail = User::find(Auth::user()->id)->expertDetail;
      $categories = Category::all();
      $subcategories = SubCategory::all();


      if($expertdetail){
        return view('admin.expertDetails.edit')->withExpertdetail($expertdetail)->withCategories($categories)->withSubcategories($subcategories);
      }
      else{
        return redirect()->route('adviser.expertDetails.index');
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
      $expertdetail = ExpertDetail::find($id);

      $this->validate($request, [
        'type' => 'required|string',
        'experience' => 'required|integer',
        'major_cat' => 'required',
        'major_subcat' => 'required',
        'about' => 'required'
      ]);

      $expertdetail->type = $request->type;
      $expertdetail->experience = $request->experience;
      $expertdetail->major_cat = $request->major_cat;
      $expertdetail->major_subcat = $request->major_subcat;
      $expertdetail->other_cat = $request->other_cat;
      $expertdetail->other_subcat = $request->other_subcat;
      $expertdetail->cp = $request->cp;
      $expertdetail->coc = $request->coc;
      $expertdetail->qualification = $request->qualification;
      $expertdetail->also_for = $request->also_for;
      $expertdetail->about = $request->about;
      $expertdetail->save();

      if(isset($request->qualifications)){
        $expertdetail->qualifications()->sync($request->qualifications);
      }  else{
        $expertdetail->qualifications()->sync(array());
      }


      Session::flash('success','Expert details updated successfully!!');
      return redirect()->route('adviser.expertDetails.index');
    }
}
