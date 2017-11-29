<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function SubCategories()
     {
     	 return $this->hasMany('App\Models\Admin\SubCategory');
     }

     public function posts()
     {
     	 return $this->hasMany('App\Models\Admin\Post');
     }

     public function qualifications()
     {
     	 return $this->hasMany('App\Models\Admin\Qualification');
     }

     public function asks()
     {
       return $this->hasMany('App\Models\Page\Asks\Ask');
     }

}
