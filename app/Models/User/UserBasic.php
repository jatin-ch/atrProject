<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserBasic extends Model
{
    public function basicDetail()
    {
      return $this->belongsTo('App\Models\Admin\BasicDetail');
    }
}
