<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Razorpay extends Model
{
    protected $table = 'razorpay_payments';
    
    public function card()
    {
      return $this->belongsTo('App\Card');
    }
}
