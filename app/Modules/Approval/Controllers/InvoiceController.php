<?php

namespace App\Modules\Approval\Controllers;

use Illuminate\Http\Request;
use App\Modules\Approval\Models\Invoice;
use App\Modules\Approval\Models\InvoiceProductLine;
use Illuminate\Support\Facades\DB;
use App\Modules\Approval\Controllers\Controller;
    
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInvoices()
    {      
            
        try {
            
            $data = Invoice::with('company')->with('products')->get();            
            return $data;
            
        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Cant access invoices right now.'
            ], 403);
        }
          
       
    }

    public function getInvoiceHeaders()
    {
        // get headers for the table so it is automised
        $table = "invoices";
        return DB::getSchemaBuilder()->getColumnListing($table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInvoice(Request $request) 
    {      
            // get one invoice           
            $data = Invoice::with('company')->with('products')->find($request->id);            
            return $data;       
    }

    public function approveRejectInvoice(Request $request) 
    {      
            // approve reject invoice
            try {
            
                $data = Invoice::with('company')->with('products')->find($request->id);    
                $data->setStatus($request->status);
                $data->save();

                return $data;    
                
            } catch (\Exception $e) {
                
                return response()->json([
                    'message' => 'Cant approve or reject invoices right now.'
                ], 403);
            }
               
    }

}
