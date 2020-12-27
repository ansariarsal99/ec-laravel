<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use App\Http\Controllers\Controller;
use App\Footer;

class FooterManagementController extends Controller
{
    public function footerDetail(Request $request){

        try{
            if($request->isMethod('post')){
                $input = $request->all();
                  // dd($input);
                $update = Footer::first();                   

                if(!empty($update)){
                    $update->contact_number   = $request->contact_number;
                    $update->email            = $request->email;
                    $update->address          = $request->address;
                    $update->isd_code         = '+'.$request['isd_code'];



                     if ($update->save()){             
                          return redirect()->back()->with('success','Footer Detail is updated sucessfully');
                     }else{
                        Session::flash('error','Something went wrong');
                        return redirect()->back();
                      }

                   }
                }   
                    // dd('here');
                $footerDetails = Footer::orderby('created_at', 'desc')->first();
                // dd($terms_condition);
                $page = 'footer'; 

            return view('admin.footerManagement.footer', compact('page','footerDetails'));
           } catch (Exception $e) {
                \Log::error($e->getMessage());
                Session::flash('error', 'Oops, Something went wrong');
                return redirect()->back();
        }
    }

}
