<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class AuthorLike extends Model
{
  protected $table = 'author_likes';

    public function user()
    {
      return $this->belongsTo('App\User');
    }

}
