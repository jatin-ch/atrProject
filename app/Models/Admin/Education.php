<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
