<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Benifit extends Model
{
   protected $table = 'service_benifits';

    public function service()
    {
      return $this->belongsTo('App\Models\Admin\Service');
    }
}
