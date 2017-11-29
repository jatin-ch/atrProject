<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    public function services()
    {
      return $this->belongsToMany('App\Models\Admin\Service');
    }

     public function offers()
     {
       return $this->belongsToMany('App\Models\Admin\Offer');
     }

      public function unavailabilities()
      {
        return $this->belongsToMany('App\Models\Admin\UnAvailability');
      }
}
