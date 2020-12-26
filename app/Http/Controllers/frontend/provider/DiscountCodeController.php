<?php

namespace App\Http\Controllers\frontend\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Exception;
use App\ProductCategory;
use App\ProductSubCategory;
use App\Admin;
use App\User;
use App\Product;
use DataTables;
use Crypt;
use Auth;
use App\SellerDiscountCode;
use App\DiscountedProduct;

class DiscountCodeController extends Controller
{
   public function discountCodeList(Request $request)
      {
          try {
              return view('frontend.login.provider.discountCode.discountCodesList');
          } catch (Exception $e) {
              \Log::info($e->getMessage());
              Session::flash('error', trans('messages.admin.common_error'));
              return redirect()->back();
          }
      }

      public function discountCodeListIndex(Request $request)
      {
        $url = url('/');

                $discountCodeList = SellerDiscountCode::with('discountedProducts.product')
                                                     ->select('seller_discount_codes.*')
                                                     ->where('seller_discount_codes.user_id',Auth::user()->id)
                                                     ->get();


                return DataTables::of($discountCodeList)
                                    ->addIndexColumn()

                                    ->addColumn('new_product', function($discountCodeList){
                                          $allProductName = "";
                                          foreach ($discountCodeList['discountedProducts'] as $key => $value) {
                                              if ($key==0) {
                                                  $separator = "";
                                              }else{
                                                  $separator = ", ";
                                              }
                                                  $allProductName = $allProductName.$separator.$value['product']['item_name'];
                                        
                                          }
                                          return $allProductName; 
                                         
                                     })

                                    ->addColumn('sellercode', function($discountCodeList){
                                        $ProductSellerName = ""; 
                                        foreach ($discountCodeList['discountedProducts'] as $key => $value) {
                                            if ($key==0) {
                                                $separator = "";
                                            }else{
                                                $separator = ", ";
                                            }
                                            
                                            $ProductSellerName = $ProductSellerName.$separator.$value['product']['seller_item_code']; 
                                         }
                                         return $ProductSellerName; 
                                        // $ProductSellerName = $value['product']['item_name'];
                                        // return $ProductSellerName;                                   
                                     })

                                    ->addColumn('barCode', function($discountCodeList){          
                                        $ProductBarCode = ""; 
                                        foreach ($discountCodeList['discountedProducts'] as $key => $value) {
                                            if ($key==0) {
                                                $separator = "";
                                            }else{
                                                $separator = ", ";
                                            }

                                            $ProductBarCode = $ProductBarCode.$separator.$value['product']['item_bar_code']; 
                                         }
                                         return $ProductBarCode;                               
                                     })

                                    


                                    ->addColumn('status', function($discountCodeList){
                                        if($discountCodeList->status == 'active') {
                                            return '<td class="stats_item">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success btn-sm btn-class">Active</button>
                                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                                            <div class="dropdown-menu dropdown-menu-right act_inact_btn">
                                                                <a class="dropdown-item drop-class inactive-class" discountCodeId="'.$discountCodeList->id.'" href="javascript:;">Make Inactive</a>
                                                            </div>
                                                        </div> 
                                                    </td>';
                                          }

                                          return '<td class="stats_item">
                                                      <div class="btn-group">
                                                          <button type="button" class="btn btn-danger btn-sm btn-class">Inactive</button>
                                                          <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                                          <div class="dropdown-menu dropdown-menu-right">
                                                              <a class="dropdown-item drop-class active-class" discountCodeId="'.$discountCodeList->id.'" href="javascript:;">Make Active</a>
                                                          </div>
                                                      </div> 
                                                  </td>';
                                      })

                                    ->addColumn('action', function($row) use($url){
                                        return '<a href="' . url("provider/discountCode/edit/".base64_encode($row->id)) . '" class="edit-btn cp text-primary"><i class="fa fa-pencil" title="Edit"></i></a> 
                                               <a href="javascript:;" class="delete-btn cp text-danger" del_id="'.$row->id.'" ><i class="fa fa-trash" title="Delete"></i></a>'; })
                                    
                                    ->escapeColumns([])
                                    ->make(true); 
      }


     public function addDiscountCode(Request $request)
        {

            if($request->isMethod('post')) {
                  
                  $payload = $request->all();
                  $data = $request->all();
                  $data['user_id'] = Auth::user()->id;

                  $payload['user_id'] = Auth::user()->id;
                  
                  
                  if(isset($payload['product_id'])){
                    $payload['product_id'] = 'yes';
                  }else{
                    $payload['product_id'] = 'no';
                  }

                  $payload['products']=$payload['product_id'];
                  // $payload = $request->except('product_id','seller_item_code','item_bar_code');
                  $payload['offer_start_date'] = date("Y-m-d", strtotime($payload['offer_start_date']));
                  $payload['offer_end_date']   = date("Y-m-d", strtotime($payload['offer_end_date']));
              
                  if($payload['discount_type']=='V'){
                     $payload['discount_type']='value';
                  }

                  if($payload['discount_type']=='P'){
                     $payload['discount_type']='percent';
                  }

                  $SellerDiscountCodeId = SellerDiscountCode::create($payload)->id;  
       
                  foreach ($data['product_id'] as $key => $value) {

                        DiscountedProduct::create([
                                                  'seller_discount_code_id' => $SellerDiscountCodeId,
                                                  'user_id'                 => $data['user_id'],
                                                  'product_id'              => $value
                                      ]);
                  }

                  Session::flash('success', 'Discount Code added successfully');
                  return redirect('provider/discountCode/list');
            }
   // discountedProducts
           $allSavedEnteries = DiscountedProduct::where('user_id',Auth::user()->id)->pluck('product_id')->toArray();
           $products = Product::where('user_id',Auth::user()->id)->whereNotIn('id',$allSavedEnteries)->orderBy('id','asc')->get()->toArray();
           // $products = Product::where('user_id',Auth::user()->id)->orderBy('id','asc')->get()->toArray();


           return view('frontend.login.provider.discountCode.addDiscountCode',compact('products'));
        }

       

       public function editDiscountCode(Request $request,$id)
        {
          $id = base64_decode($id);
           $sellerDiscountCodeRecord = SellerDiscountCode::with('discountedProducts.product')->where('id',$id)->first();
       

            if($request->isMethod('post')) {
                  $payload = $request->all();
                  $payload['user_id'] = Auth::user()->id;
                  $data = $request->all();
                  $data['user_id'] = Auth::user()->id;

                   if(isset($payload['product_id'])){
                      $payload['product_id'] = 'yes';
                    }else{
                      $payload['product_id'] = 'no';
                    }

                  // dd($payload);
                  $payload['products']         = $payload['product_id'];
                  $payload['offer_start_date'] = date("Y-m-d", strtotime($payload['offer_start_date']));
                  $payload['offer_end_date']   = date("Y-m-d", strtotime($payload['offer_end_date']));

                  if($payload['discount_type']=='V'){
                     $value='value';
                  }else{
                     $value='percent';
                  }
                  
                  SellerDiscountCode::where('id',base64_decode($payload['discount_code_id']))
                                         ->update([
                                                    'user_id'          =>$payload['user_id'],
                                                    'products'         =>$payload['product_id'],
                                                    'discount_code'    =>$payload['discount_code'],
                                                    'discount_value'   =>$payload['discount_value'],
                                                    'discount_type'    =>$value,
                                                    'offer_start_date' =>$payload['offer_start_date'],
                                                    'offer_end_date'   =>$payload['offer_end_date']
                                                ]);
                               
                  if($payload['minimum_purchase_amount']!=''){
                       SellerDiscountCode::where('id',base64_decode($payload['discount_code_id']))
                                               ->update(['minimum_purchase_amount'=>$payload['minimum_purchase_amount']]);
                  }
                   // dd(DiscountedProduct::where('seller_discount_code_id',base64_decode($payload['discount_code_id']))->delete());
                  DiscountedProduct::where('seller_discount_code_id',base64_decode($payload['discount_code_id']))->delete();  

                   foreach ($data['product_id'] as $key => $value1) {
                         DiscountedProduct::create([
                                                   'seller_discount_code_id' => base64_decode($payload['discount_code_id']),
                                                   'user_id'                 => $data['user_id'],
                                                   'product_id'              => $value1
                                       ]);
                   }


                  Session::flash('success', 'Discount Code updated successfully');
                  return redirect('provider/discountCode/list');
            }

           // $allSavedEnteries = DiscountedProduct::where('user_id',Auth::user()->id)->where('seller_discount_code_id',$id)->pluck('product_id')->toArray();


           $allSavedEnteries = DiscountedProduct::with('product','discountedProducts')->where('seller_discount_code_id',$id)->get()->pluck('product_id')->toArray();

           $otherSelectedEnteries = DiscountedProduct::with('product','discountedProducts')->whereNotIn('product_id',$allSavedEnteries)->get()->pluck('product_id')->toArray();  

           $products = Product::where('user_id',Auth::user()->id)->whereNotIn('id',$otherSelectedEnteries)->orderBy('id','desc')->get()->pluck('id')->toArray();
           

           $product = Product::where('user_id',Auth::user()->id)->whereIn('id',$products)->orderBy('id','asc')->get()->toArray();

           return view('frontend.login.provider.discountCode.editDiscountCode',compact('product','sellerDiscountCodeRecord','allSavedEnteries'));
        }

       
       public function changeStatusdiscountCode(Request $request)
       {
         try{
               if($request->status && $request->id){
                   $statusChanged = SellerDiscountCode::where('id', $request->id)->update(['status' => $request->status]);
                   $SellerDiscountCode = SellerDiscountCode::where('id', $request->id)->first();
                   return ['status' => 'success', 'message' => 'Status changed successfully', 'product_status' => $SellerDiscountCode->status];
               }else{
                   return ['status' => 'error', 'message' => 'Some required details is missing'];
               }
           } catch (Exception $e){
               \Log::error($e->getMessage());
               Session::flash('error', trans('messages.admin.common_error'));
               return redirect()->back();
           }
       }  


       public function deleteDiscountCode(Request $request,$id)
       {
           $id   = $request->id;
           // dd($id);
           DiscountedProduct::where('seller_discount_code_id',$id)->delete();
           $data = SellerDiscountCode::where('id',$id)->delete();
           Session::flash('success','Discount Code deleted successfully');

           return ['status'=>'success'];
       }


}
