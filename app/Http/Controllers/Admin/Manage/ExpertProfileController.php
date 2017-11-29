<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin\ExpertDetail;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Qualification;
use App\Models\Admin\Education;
use App\Models\Admin\WorkExperience;
use App\Models\Admin\Specialization;
use App\Models\Admin\Membership;
use App\Models\Admin\Award;
use Image;
use Session;

class ExpertProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|superadviser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
      $expertdetail->user_id = $request->user_id;
      $expertdetail->save();

      if($expertdetail->save()){

        if(count($request->degree) > 0){
          foreach($request->degree as $key => $v){
            $data = array(
              'degree' => $request->degree [$key],
              'college' => $request->college [$key],
              'year' => $request->year [$key],
              'user_id' => $request->user_id
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
              'user_id' => $request->user_id
            );
            WorkExperience::insert($data);
          }
        }

        if(count($request->name) > 0){
          foreach($request->name as $key => $v){
            $data = array(
              'name' => $request->name [$key],
              'user_id' => $request->user_id
            );
            Specialization::insert($data);
          }
        }

        if(count($request->institution_name) > 0){
          foreach($request->institution_name as $key => $v){
            $data = array(
              'institution_name' => $request->institution_name [$key],
              'institution_location' => $request->institution_location [$key],
              'user_id' => $request->user_id
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
              'user_id' => $request->user_id
            );
            Award::insert($data);
          }
        }

      }

      $expertdetail->qualifications()->sync($request->qualifications, false);

      Session::flash('success','Expert details added successfully!!');
      return redirect()->route('expertProfile.show', $request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $expertdetail = $user->expertDetail;
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $qualifications = Qualification::all();

          if($expertdetail) {
            return view('admin.manage.expertProfile.show')->withUser($user)->withExpertdetail($expertdetail)->withCategories($categories)->withSubcategories($subcategories)->withQualifications($qualifications);
          } else {
          return view('admin.manage.expertProfile.create')->withUser($user)->withCategories($categories)->withSubcategories($subcategories)->withQualifications($qualifications);
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
      //

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
        'type' => 'required|string',
        'experience' => 'required|integer',
        'major_cat' => 'required',
        'major_subcat' => 'required',
        'about' => 'required'
      ]);

      $expertdetail = ExpertDetail::find($id);
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


      Session::flash('success','Expert details saved');
      return redirect()->route('expertProfile.show', $expertdetail->user_id);
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
