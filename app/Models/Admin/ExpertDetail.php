<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ExpertDetail extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function qualifications()
    {
      return $this->belongsToMany('App\Models\Admin\Qualification');
    }

}
