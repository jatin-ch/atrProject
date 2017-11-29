<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function service()
    {
      return $this->belongsTo('App\Models\Admin\Service');
    }

    public function location()
    {
      return $this->belongsTo('App\Models\Admin\Location');
    }

    public function availability()
    {
      return $this->belongsTo('App\Models\Admin\Availability');
    }

    public function BookingDates()
    {
     	return $this->hasMany('App\Models\Page\BookingDate');
    }

    public function Documents()
    {
     	return $this->hasMany('App\Models\Page\Document');
    }

    public function BookingCancel()
    {
     	return $this->hasOne('App\Models\Page\BookingCancel');
    }

    public function reschedule()
    {
     	return $this->hasOne('App\Models\Page\Reschedule');
    }

    public function dispute()
    {
     	return $this->hasOne('App\Models\Client\Dispute');
    }

}
