<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function tags()
    {
    	// return $this->belongsToMany('App\Models\Admin\Tag');
      return $this->hasMany('App\Models\Admin\Tag');
    }

    public function category()
    {
      return $this->belongsTo('App\Models\Admin\Category');
    }

    public function SubCategory()
    {
      return $this->belongsTo('App\Models\Admin\SubCategory');
    }

    public function likes()
    {
      return $this->hasMany('App\Models\Page\PostLike');
    }

    public function comments()
    {
    	return $this->hasMany('App\Models\Page\PostComment');
    }

}
