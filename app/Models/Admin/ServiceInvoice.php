<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ServiceInvoice extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function ServiceInvoiceDetails()
    {
     	return $this->hasMany('App\Models\Admin\ServiceInvoiceDetail');
    }
}
