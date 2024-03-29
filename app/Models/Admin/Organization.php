<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function users()
    {
      return $this->belongsToMany('App\User');
    }

}
