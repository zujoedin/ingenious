<?php

namespace App\Modules\Approval\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Approval\Models\Company;
use App\Modules\Approval\Models\InvoiceProductLine;

class Invoice extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'number',
        'date',
        'due_date',
        'company_id',
        'status',
    ];



    public function company(){
        return $this->belongsTo(Company::class,"company_id");
    }

    public function invoiceProductLines(){
        return $this->hasMany(InvoiceProductLine::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'invoice_product_lines', 'invoice_id', 'product_id')->withPivot('quantity');  
    }

    public function setStatus($status)
    {
        if($status){
            $this->status = 'approved';
        }else{
            $this->status = 'rejected';
        }
    }

    
}
