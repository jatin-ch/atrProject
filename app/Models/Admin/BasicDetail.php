<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BasicDetail extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function adviserBasic()
    {
      return $this->hasOne('App\Models\Admin\AdviserBasic');
    }

    public function userBasic()
    {
      return $this->hasOne('App\Models\User\UserBasic');
    }
}
