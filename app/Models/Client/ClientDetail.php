<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    public function client()
    {
      return $this->belongsTo('App\Client');
    }
}
