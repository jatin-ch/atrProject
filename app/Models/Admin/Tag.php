<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // public function posts()
    // {
    //   return $this->belongsToMany('App\Models\Admin\Post');
    // }
    public function post()
    {
      return $this->belongsTo('App\Models\Admin\Post');
    }
}
