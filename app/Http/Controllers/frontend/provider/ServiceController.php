<?php

namespace App\Http\Controllers\frontend\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Exception;
use App\ProductCategory;
use App\ProductSubCategory;
use App\Product;
use App\UserTermOfPayment;
use App\ProductWeight;
use App\ProductSpecification;
use App\Admin;
use App\User;
use App\ProductImage;
use DataTables;
use Crypt;
use Auth;

class ServiceController extends Controller
{

 public function listServices(Request $request)
    {
     try{             
     // dd(Auth::user()->id);                             
            $page = 'service_list';
            return view('frontend.login.provider.services.list', compact('page'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();

        }
    }

    public function servicesListIndex(Request $request)
    {
      
        $serviceList = Product::with('category')
                                        ->select('*')
                                        ->where('user_id',\Auth::user()->id)
                                        ->where('type','service')
                                        ->orderBy('id', 'desc')->get();
       // dd($serviceList);                                 

        return DataTables::of($serviceList)
                        ->addIndexColumn()
                        ->addColumn('status', function($serviceList){
                            if($serviceList->status == 'active') {
                                return '<td class="stats_item">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm btn-class">Active</button>
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item drop-class inactive-class" product-id="'.$serviceList->id.'" href="javascript:;">Make Inactive</a>
                                                </div>
                                            </div> 
                                        </td>';
                            }

                            return '<td class="stats_item">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger btn-sm btn-class">Inactive</button>
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item drop-class active-class" product-id="'.$serviceList->id.'" href="javascript:;">Make Active</a>
                                            </div>
                                        </div> 
                                    </td>';
                        })
                        ->addColumn('action', function ($serviceList) {
                          return 
                          '<a href="' . url("provider/services/edit/".Crypt::encrypt($serviceList->id)) . '" class="edit-btn cp text-primary">Edit</a>
                          <a href="javascript:;" class="delete-btn cp text-danger" del_id="'.$serviceList->id.'" > Delete</a>
                          <a href="' . url("provider/services/view/".Crypt::encrypt($serviceList->id)) . '" class="cp text-dark" del_id="'.$serviceList->id.'" > View</a>';
                        })
                        ->escapeColumns([])
                        ->make(true);
    }

    

     public function addService(Request $request)
    {
        try {
            $page = 'service_list';
            // create product
            if($request->isMethod('post')) {
                $payload = $request->all();
               $this->createProduct($payload);
               return redirect('provider/services/list');
             
            }
            $productCategories  = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();

            $termsOfPayments    = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();
                                   
           // delete product Specification
            ProductSpecification::where('user_id', \Auth::user()->id)
                                        ->whereNull('product_id')
                                        ->where('status', 'pending')
                                        ->delete();

            // delete product images
            ProductImage::where('user_id', \Auth::user()->id)
                                ->whereNull('product_id')
                                ->where('status', 'pending')
                                ->delete();


            return view('frontend.login.provider.services.add', compact('page', 'productCategories'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function createProduct($payload)
    {
       
        $payload['user_id'] = \Auth::user()->id;
        $productId = Product::create($payload)->id;
          
        
        $typeServiceUpdate= product::where('user_id', \Auth::user()->id)->where('id', $productId)->update(['type'=>'service']);
     
        $specifications = ProductSpecification::where('user_id', \Auth::user()->id)
                                                        ->whereNull('product_id')
                                                        ->where('status', 'pending')
                                                        ->get();

        foreach ($specifications as $specification) {
            $specification->update([
                                    'product_id'=>$productId,
                                    'status'    => 'complete'
                                    ]);
        }

        // update product images
        $mediaIds = explode(",",$payload['media_ids']);

        foreach ($mediaIds as $mediaId) {
           ProductImage::where('id', $mediaId)
                                ->where('user_id', \Auth::user()->id)
                                ->update(['product_id' => $productId,
                                            'status' => 'complete']);
        }
                                        
        Session::flash('success', 'Service added successfully');

        return redirect()->back();
    }

    public function editService(Request $request, $id)
    {
        try {
            $page = 'product';
            $product = Product::with(['productSpecification'])
                                        ->where('id', Crypt::decrypt($id))
                                        ->first();

            if($request->isMethod('post')){
                $payload = $request->except('media_ids','_token');                 
                $product->update($payload);
                return redirect('provider/services/list');
            }


            $productCategories = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();


            $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();

            $subCategories = ProductSubCategory::where('status', 'active')
                                                        ->orderBy('name', 'asc')
                                                        ->get();
             // dd($termsOfPayments);                            

            return view('frontend.login.provider.services.edit', compact('page', 'product', 'productCategories','termsOfPayments','subCategories'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }


   public function deleteService(Request $request,$id)
    {
        $id   = $request->id;
        $data = product::where('id',$id)->delete();
        Session::flash('success','Service deleted successfully');

        return ['status'=>'success'];
    }

    public function changeServiceStatus(Request $request)
    {
      try{
            if($request->status && $request->id){
                $statusChanged = product::where('id', $request->id)->update(['status' => $request->status]);
                $product = product::where('id', $request->id)->first();
                return ['status' => 'success', 'message' => 'Status changed successfully', 'product_status' => $product->status];
            }else{
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
        } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    public function editServiceSpecification(Request $request)
    {
        $payload = $request->all();
        // dd($payload);
        $specification = ProductSpecification::where('id', $payload['specificationId'])->first();
        $specification->update($payload);

        return ['response' => 'success', 'specification' => $specification];
    }

    public function deleteServiceSpecification(Request $request, $id)
    {
        $id    = $request->id;
        $data  = ProductSpecification::where('id',$id)->delete();
        $count = ProductSpecification::where('product_id', $request->input('productId'))
                                            ->where('user_id', \Auth::user()->id)
                                            ->count();

        return ['status'=>'success', 'count' => $count];
    }

    public function getServiceSpecification(Request $request)
    {
        $data = ProductSpecification::where('id', $request->input('specificationId'))->first();
        return ['response' => 'success', 'specification' => $data];
    }

    public function viewService(Request $request, $id)
    {
        try{
            $page = 'service_list';
            $product = product::with(['productSpecification', 'productWeight', 
                                            'productImage','category', 'subCategory'])
                                            ->where('id', Crypt::decrypt($id))
                                            ->first();

            $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();

            return view('frontend.login.provider.services.view', compact('page', 'product', 'termsOfPayments'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }







}
