<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConsultationInvoice extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function ConsultationInvoiceDetails()
    {
     	return $this->hasMany('App\Models\Admin\ConsultationInvoiceDetail');
    }
}
