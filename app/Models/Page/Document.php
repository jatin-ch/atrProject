<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
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
