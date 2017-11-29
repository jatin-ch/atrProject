<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
  protected $table = 'post_likes';

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function post()
    {
      return $this->belongsTo('App\Models\Admin\Post');
    }
}
