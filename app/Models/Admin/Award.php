<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
