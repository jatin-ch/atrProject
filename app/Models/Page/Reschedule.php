<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function Booking()
    {
     	return $this->belongsTo('App\Models\Page\Booking');
    }
}
