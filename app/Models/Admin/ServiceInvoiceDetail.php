<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ServiceInvoiceDetail extends Model
{
    public function ServiceInvoice()
    {
      return $this->belongsTo('App\Models\Admin\ServiceInvoice');
    }
}
