<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdviserBasic extends Model
{
    public function basicDetail()
    {
      return $this->belongsTo('App\Models\Admin\BasicDetail');
    }
}
