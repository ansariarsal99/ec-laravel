<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;
use App\DeliveryPolicy;
use App\Career;
use App\ReturnAndExchangePolicy;

class ContentManagementController extends Controller
{
       public function term(Request $request){

        try{
        if($request->isMethod('post')){
            $input = $request->all();
             // dd($input);
            $update = Term::first();   

            if(!empty($update)){
                $update->title         = $request->title;
                $update->description   = $request->description;

                 if ($update->save()){             
                      return redirect()->back()->with('success','Terms & Condtions updated sucessfully');
                 }else{
                    Session::flash('error','Something went wrong');
                    return redirect()->back();
                  }

               }
            }   

        // dd('here');
            $terms_condition = Term::orderby('created_at', 'desc')->first();
                // dd($terms_condition);
            $page = 'terms'; 

        return view('admin.contentManagement.TermsAndCondtions.term', compact('page','terms_condition'));
       } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', 'Oops, Something went wrong');
            return redirect()->back();
        }
   }

   
   public function deliveryPolicy(Request $request){
       try{
       if($request->isMethod('post')){
           $input = $request->all();
           // dd($input);
           $update = DeliveryPolicy::first();   
           if(!empty($update)){
               $update->title         = $request->title;
               $update->description   = $request->description;
                if ($update->save()){             
                     return redirect()->back()->with('success','Delivery & Policy updated sucessfully');
                }else{
                   Session::flash('error','Something went wrong');
                   return redirect()->back();
                 }

              }
           }   

           $deliveryPolicy = DeliveryPolicy::orderby('created_at', 'desc')->first();
           // dd($deliveryPolicy);
           $page = 'deliveryPolicy'; 

       return view('admin.contentManagement.deliveryPolicy.deliveryPolicy', compact('page','deliveryPolicy'));
      } catch (Exception $e) {
           \Log::error($e->getMessage());
           Session::flash('error', 'Oops, Something went wrong');
           return redirect()->back();
       }
   }

   public function Career(Request $request){
       try{
           if($request->isMethod('post')){
               $input = $request->all();
               $update = Career::first();   

               if(!empty($update)){
                   $update->title         = $request->title;
                   $update->description   = $request->description;

                   if ($update->save()){             
                       return redirect()->back()->with('success','Career updated sucessfully');
                   }else{
                       Session::flash('error','Something went wrong');
                       return redirect()->back();
                   }
               }
           }   

           $career = Career::orderby('created_at', 'desc')->first();
           $page = 'Career'; 
           return view('admin.contentManagement.career.career', compact('page','career'));
      } catch (Exception $e) {
           \Log::error($e->getMessage());
           Session::flash('error', 'Oops, Something went wrong');
           return redirect()->back();
       }
   }

   public function ReturnAndExchangePolicy(Request $request){
       try{
           if($request->isMethod('post')){
               $input = $request->all();
               $update = ReturnAndExchangePolicy::first();   
               if(!empty($update)){
                   $update->title         = $request->title;
                   $update->description   = $request->description;

                    if ($update->save()){             
                         return redirect()->back()->with('success','Return & Exchange Policy updated sucessfully');
                    }else{
                       Session::flash('error','Something went wrong');
                       return redirect()->back();
                     }
                  }
               }   

           $returnAndExchangePolicy = ReturnAndExchangePolicy::orderby('created_at','desc')->first();
           $page = 'ReturnAndExchangePolicy'; 
           return view('admin.contentManagement.returnAndExchangePolicy.returnAndExchangePolicy', compact('page','returnAndExchangePolicy'));
      } catch (Exception $e) {
           \Log::error($e->getMessage());
           Session::flash('error', 'Oops, Something went wrong');
           return redirect()->back();
       }
   }


}
