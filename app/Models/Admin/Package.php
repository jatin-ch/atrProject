<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
   protected $table = 'service_includes';

    public function service()
    {
      return $this->belongsTo('App\Models\Admin\Service');
    }
}
