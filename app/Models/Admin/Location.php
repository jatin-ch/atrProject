<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function firstshifts()
     {
       return $this->hasMany('App\Models\Admin\FirstShift');
     }

     public function Bookings()
     {
      	return $this->hasMany('App\Models\Page\Booking');
     }

}
