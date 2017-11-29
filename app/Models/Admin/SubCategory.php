<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function category()
    {
      return $this->belongsTo('App\Models\Admin\Category');
    }

    public function posts()
    {
      return $this->hasMany('App\Models\Admin\Post');
    }

    public function asks()
     {
       return $this->hasMany('App\Models\Page\Asks\Ask');
     }

}
