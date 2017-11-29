<?php

namespace App\Models\Page\Asks;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    public function answer()
    {
      return $this->belongsTo('App\Models\Page\Asks\Answer');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function replies()
    {
      return $this->hasMany('App\Models\Page\Asks\AnswerReply');
    }
}
