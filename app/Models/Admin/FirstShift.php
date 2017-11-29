<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class FirstShift extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function location()
     {
       return $this->belongsTo('App\Models\Admin\Location');
     }

     public function availability()
     {
       return $this->belongsTo('App\Models\Admin\Availability');
     }

}
