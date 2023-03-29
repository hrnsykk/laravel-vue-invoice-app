<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceItem;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ["name", "address", "date", "due_date", "terms", "tax", "total"];
    public function items(): object
    {
        return $this->hasMany(InvoiceItem::class, "invoice_number");
    }
}
