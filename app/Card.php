<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    
    public function razorpay()
    {
      return $this->hasOne('App\Razorpay');
    }
}
