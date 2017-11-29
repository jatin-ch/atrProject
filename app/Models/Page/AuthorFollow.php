<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class AuthorFollow extends Model
{
  protected $table = 'author_follows';

    public function user()
    {
      return $this->belongsTo('App\User');
    }

}
