<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function firstShifts()
    {
      return $this->hasMany('App\Models\Admin\FirstShift');
    }

    public function Bookings()
    {
     	return $this->hasMany('App\Models\Page\Booking');
    }
}
