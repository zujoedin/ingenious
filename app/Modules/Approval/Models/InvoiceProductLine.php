<?php

namespace App\Modules\Approval\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Approval\Models\Invoice;
use App\Modules\Approval\Models\Product;

class InvoiceProductLine extends Model
{
    use HasFactory;
    public $incrementing = false;
    
    protected $fillable = [
        'quantity',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class,"id");
    }
    
    public function product(){
        return $this->belongsTo(Product::class,"id");
    }
}
