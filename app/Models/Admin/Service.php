<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function consultations()
     {
       return $this->belongsToMany('App\Models\Admin\Consultation');
     }

     public function benifits()
     {
       return $this->hasMany('App\Models\Admin\Benifit');
     }

     public function packages()
     {
       return $this->hasMany('App\Models\Admin\Package');
     }

     public function offers()
     {
       return $this->belongsToMany('App\Models\Admin\Offer');
     }

     public function Bookings()
     {
      	return $this->hasMany('App\Models\Page\Booking');
     }
}
