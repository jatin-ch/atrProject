<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ConsultationInvoiceDetail extends Model
{
    public function ConsultationInvoice()
    {
      return $this->belongsTo('App\Models\Admin\ConsultationInvoice');
    }
}
