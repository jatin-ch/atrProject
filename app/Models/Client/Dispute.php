<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    public function Booking()
    {
      return $this->belongsTo('App\Models\Page\Booking');
    }
}
