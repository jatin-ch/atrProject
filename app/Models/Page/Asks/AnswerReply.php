<?php

namespace App\Models\Page\Asks;

use Illuminate\Database\Eloquent\Model;

class AnswerReply extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function answer()
    {
      return $this->belongsTo('App\Models\Page\Asks\Answer');
    }
}
