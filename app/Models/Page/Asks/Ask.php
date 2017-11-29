<?php

namespace App\Models\Page\Asks;

use Illuminate\Database\Eloquent\Model;

class Ask extends Model
{
    protected $table = 'asks';

     public function user()
     {
       return $this->belongsTo('App\User');
     }

     public function category()
     {
       return $this->belongsTo('App\Models\Admin\Category');
     }

     public function subcategory()
     {
       return $this->belongsTo('App\Models\Admin\SubCategory');
     }

     public function answers()
     {
       return $this->hasMany('App\Models\Page\Asks\Answer');
     }
}
