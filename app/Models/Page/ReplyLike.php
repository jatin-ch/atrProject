<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class ReplyLike extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function reply()
    {
      return $this->belongsTo('App\Models\Page\CommentReply');
    }
}
