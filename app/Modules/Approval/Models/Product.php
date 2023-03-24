<?php

namespace App\Modules\Approval\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Approval\Models\Invoice;

class Product extends Model
{
    use HasFactory;
    public $incrementing = false;
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_product_lines', 'product_id', 'invoice_id'); 
    }
}


