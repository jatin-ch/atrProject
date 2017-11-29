<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    public function category()
    {
      return $this->belongsTo('App\Models\Admin\Category');
    }

    public function expertDetails()
    {
      return $this->belongsToMany('App\Models\Admin\ExpertDetail');
    }
}
