<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
