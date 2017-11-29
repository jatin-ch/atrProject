<?php

namespace App\Models\Page\Asks;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function ask()
    {
      return $this->belongsTo('App\Models\Page\Asks\Ask');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function likes()
    {
      return $this->hasMany('App\Models\Page\Asks\AnswerLike');
    }

    public function comments()
    {
      return $this->hasMany('App\Models\Page\Asks\AnswerComment');
    }

}
