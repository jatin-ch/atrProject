<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    
    public function services()
    {
      return $this->belongsToMany('App\Models\Admin\Service');
    }

    public function consultations()
    {
      return $this->belongsToMany('App\Models\Admin\Consultation');
    }
}
