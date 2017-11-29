<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class BookingDate extends Model
{
    public function Booking()
    {
     	return $this->belongsTo('App\Models\Page\Booking');
    }
}
