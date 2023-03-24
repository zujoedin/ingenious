<?php

namespace App\Modules\Approval\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Approval\Models\Invoice;

class Company extends Model
{
    use HasFactory;
    public $incrementing = false;
    
    protected $fillable = [
        'name',
        'street',
        'city',
        'zip',
        'phone',
        'email',
    ];


    public function invoices() {
        return $this->hasOne(Invoice::class);
    }
}
