<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UnAvailability extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function consultations()
     {
       return $this->belongsToMany('App\Models\Admin\Consultation');
     }
}
