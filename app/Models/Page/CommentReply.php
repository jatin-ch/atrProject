<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function comment()
    {
      return $this->belongsTo('App\Models\Page\PostComment');
    }

    public function rlikes()
    {
      return $this->hasMany('App\Models\Page\ReplyLike');
    }
}
