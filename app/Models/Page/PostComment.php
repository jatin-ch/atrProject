<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function post()
    {
      return $this->belongsTo('App\Models\Admin\Post');
    }

    public function replies()
    {
      return $this->hasMany('App\Models\Page\CommentReply');
    }

    public function clikes()
    {
      return $this->hasMany('App\Models\Page\CommentLike');
    }

}
