<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Approval\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get-invoices', [InvoiceController::class, 'getInvoices']);

Route::get('/get-invoice-headers', [InvoiceController::class, 'getInvoiceHeaders']);

Route::post('/get-invoice', [InvoiceController::class, 'getInvoice']);

Route::post('/approve-reject', [InvoiceController::class, 'approveRejectInvoice']);