<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    public function user()
     {
     	 return $this->belongsTo('App\User');
     }

}
