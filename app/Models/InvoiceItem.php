<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = ["quantity", "item", "unit_price", "amount"];

    // public function invoice(): object
    // {
    //     return $this->belongsTo(Invoice::class, 'id');
    // }
}
