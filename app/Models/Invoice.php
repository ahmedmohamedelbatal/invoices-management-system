<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  use HasFactory;

  protected $fillable = [
    'invoice_number',
    'invoice_product',
    'section_id',
    'invoice_discount',
    'invoice_rate_vat',
    'invoice_value_vat',
    'invoice_total',
    'invoice_amount_commission',
    'invoice_amount_collection',
    'invoice_status',
    'payment_date',
    'invoice_note',
    'invoice_date',
    'invoice_due_date',
    'invoice_attachment',
    'created_by'
  ];

  public function section() {
    return $this->belongsTo(Section::class);
  }
}
