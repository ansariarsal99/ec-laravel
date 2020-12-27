<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use App\Http\Controllers\Controller;
use Exception;
use DataTables;
use App\AdminWireTransferDetail;
use Auth;

class WireTransferDetailController extends Controller
{
   public function updateWireTransferDetail(Request $request){
  
        if($request->isMethod('post')){
            $input = $request->all();
            $update = AdminWireTransferDetail::where('admin_id',Auth::guard('admin')->user()->id)->update([
    	                                'bank_name' =>$input['bank_name'],
    	                                'account_name' =>$input['account_name'],
    	                                'account_iban_number' =>$input['account_iban_number']
                                ]);   

             session::flash('success', 'Wire Transfer Detail Updated successfully');
            }
         
               
        $wireTrasferDetail = AdminWireTransferDetail::first();
        // dd($wireTrasferDetail);
        $page = 'wireTransfer'; 
        return view('admin.wireTrasferDetail.editWireTransferDetail', compact('page','wireTrasferDetail'));

   }
}	

