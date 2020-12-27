<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Session;
use App\Http\Controllers\Controller;
use DataTables;
use Auth;
use App\RewardPoint;
use App\ProductCategory;
use App\Product;
use App\RewardPointPrice;

class RewardPointManagementController extends Controller
{


	public  function rewardList(Request $request)
	{
         $page="reward";
		 return view('admin.rewardPointManagement.rewardPoint',compact('page'));
	}

	   public function rewardListIndex(Request $request) 
	   {
	       $rewardList = RewardPoint::where('reward_type','order')->select('*');
	       // $url = url('/');
	       return DataTables::of($rewardList)
	              ->addIndexColumn()

	              ->addColumn('status', function ($rewardList) {
	                  return '<div class="status_button_toggle" ral="' . $rewardList->id . '" rel="' . $rewardList->status . '" id="status_button_' . $rewardList->id . '"></div>';
	              })
	              ->addColumn('action', function ($rewardList) {
	                  return 
	                  '<a href="' . url("admin/rewardPointManagement/reward/editReward/point/".base64_encode($rewardList->id)) . '" class="edit-btn"> <i class="fa fa-pencil" title="Edit"></i></a>
	                  <a href="' . url("admin/rewardPointManagement/reward/point/delete/" . base64_encode($rewardList->id)) . '" class="del-btn"  onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
	              })

	              ->escapeColumns([])
		            ->make(true);                                
	   }

    
    publiC function addRewardPoint(Request $request){

	   if($request->isMethod('post')) {
	       $data = $request->all();
	       $data = $request->except('_token');
	       // dd($data);
         $data['reward_type'] = 'order';
	        if($data['reward_type']=='order'){
			      RewardPoint::create([
			       'reward_type'  =>$data['reward_type'],
			       'from_amount'  =>$data['from_amount'],
			       'to_amount'    =>$data['to_amount'],
			       'point'        =>$data['point'],

			      ]);
	        }
	       
	        // return redirect()->back()->with('success', 'Reward Point is updated successfully');   
          Session::flash('success','Reward Point added successfully');
          return redirect('admin/rewardPointManagement/reward/point/List');  
	    }

        $page="reward";
        return view('admin.rewardPointManagement.addRewardPoint',compact('page'));
    }

    
    public function validateFromAmountrewardPoint(){

	    $from_amount = $_GET['from_amount'];
	    // $reward_type = $_GET['reward_type'];

	    $conditions = RewardPoint::where('reward_type','order')->get()->toArray();
	     
	    $conditionCheck = RewardPoint::where('reward_type','order')
	                                              ->where('from_amount','<=',$from_amount)
	                                              ->where('to_amount','>=',$from_amount)
	    //                                           // ->where('id','!=',42)
	                                              ->get()
	                                              ->toArray();

	                         
	     if($conditionCheck !=null){
	          return 'false';  
	      }else{
	          return 'true';  

	      }

	}

	public function validateToAmountRewardPoint(){

	    $to_amount   = $_GET['to_amount'];
	
	    $conditionCheck = RewardPoint::where('reward_type','order')
                                                  ->where('from_amount','<=',$to_amount)
                                                  ->where('to_amount','>=',$to_amount)
        //                                           // ->where('id','!=',42)
                                                  ->get()
                                                  ->toArray();
             
         if($conditionCheck !=null){
              return 'false';  
          }else{

              return 'true';  
          }
	}

	    publiC function editRewardPoint(Request $request,$id){

		   if($request->isMethod('post')) {
		       $data = $request->all();
		       $data = $request->except('_token');

		       // dd($data);
            $data['reward_type'] = 'order';

		        if($data['reward_type']=='order'){
				      RewardPoint::where('id',$data['id'])->update([
				       'reward_type'  =>$data['reward_type'],
				       'from_amount'  =>$data['from_amount'],
				       'to_amount'    =>$data['to_amount'],
				       'point'        =>$data['point']
				    ]);
		        }
		        Session::flash('success','Reward Point updated successfully');
		        return redirect('admin/rewardPointManagement/reward/point/List');
		    }
		    $id = base64_decode($id);
		    $rewardPointRecord = RewardPoint::where('id',$id)->first();
		    // dd($rewardPointRecord);
	        $page="reward";
	        return view('admin.rewardPointManagement.editReward',compact('page','rewardPointRecord'));
	    }


        public function validateEditFromAmountRewardPoint(){

    	    // $reward_type = $_GET['reward_type'];
              // dd($_GET);
    	     // dd($_GET);
    	    $from_amount = $_GET['from_amount'];
    	     // $id =$data['id'];  
    	  
    	    $conditionCheck = RewardPoint::where('reward_type','order')
    	                                            ->where('from_amount','<=',$from_amount)
    	                                            ->where('to_amount','>=',$from_amount)
    	                                            ->where('id','!=',$_GET['id'])
    	                                            ->get()
    	                                            ->toArray();
    	       
    	   if($conditionCheck !=null){
    	        return 'false';  
    	    }else{

    	        return 'true';  
    	    }           
    	}

    	public function validateEditToAmountRewardPoint(){

    	    $to_amount   = $_GET['to_amount'];
    	    // $reward_type = $_GET['reward_type'];
             // dd($_GET);
    	    $conditionCheck = RewardPoint::where('reward_type','order')
   	    	                                            ->where('from_amount','<=',$to_amount)
   	    	                                            ->where('to_amount','>=',$to_amount)
   	    	                                            ->where('id','!=',$_GET['id'])
   	    	                                            ->get()
   	    	                                            ->toArray();
   	    	       
	    	   if($conditionCheck !=null){
	    	        return 'false';  
	    	    }else{

	    	        return 'true';  
	    	    }           
    	}

    	public function deleteRewardPoint($id, Request $request)
    	 {
    	    $id               = base64_decode($id);
    	    $subscription     = RewardPoint::where('id',$id)->first(); 
    	    $subscriptionId   = $subscription->id;
    	    // dd($subscriptionId);
    	    if(!empty($id)) {
    	      // $data->delete();
    	    $data = RewardPoint::where('id',$subscriptionId)->delete(); 
    	       Session::flash('success', 'Reward Point deleted successfully');
    	       return redirect()->back();
    	      }else {
    	        Session::flash('error', 'Something went wrong');
    	         return redirect()->back();
    	      } 
    	  }



    	public function changeStatus(Request $request)
    	{
    	  try{
    	    if($request->status && $request->id){
    	        $statusChanged = RewardPoint::where(['id' => $request->id])->update(['status' => $request->status]);
    	        return ['status' => 'success', 'message' => 'Status changed successfully'];
    	    }else{
    	        return ['status' => 'error', 'message' => 'Some required details is missing'];
    	    }
    	  }catch (Exception $e){
    	        \Log::error($e->getMessage());
    	        Session::flash('error', trans('messages.admin.common_error'));
    	        return redirect()->back();
    	    }
    	}

		public  function rewardCategoryList(Request $request)
		{
	     // dd($rewards);
       $page="categoryReward";
			 return view('admin.rewardPointManagement.categoryReward.categoryRewardPointList',compact('page'));
		}

		public function rewardCategoryListIndex(Request $request) 
		{
	       $rewardList = RewardPoint::where('reward_type','category')
                                     ->leftjoin('product_categories','reward_points.category_id','product_categories.id')
                                     ->select('reward_points.*','product_categories.name as category_name');
	       // $url = url('/');
	       return DataTables::of($rewardList)
	              ->addIndexColumn()

	              ->addColumn('status', function ($rewardList) {
	                  return '<div class="status_button_toggle" ral="' . $rewardList->id . '" rel="' . $rewardList->status . '" id="status_button_' . $rewardList->id . '"></div>';
	              })

	               ->addColumn('action', function ($rewardList) {
	                  return 
	                  '<a href="' . url("admin/rewardPointManagement/categoryReward/editReward/point/".base64_encode($rewardList->id)) . '" class="edit-btn"> <i class="fa fa-pencil" title="Edit"></i></a>
	                  <a href="' . url("admin/rewardPointManagement/categoryReward/point/delete/" . base64_encode($rewardList->id)) . '" class="del-btn"  onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
	                })

	              ->escapeColumns([])
		            ->make(true);                                
	   }

    
        publiC function addRewardCategoryPoint(Request $request){

           if($request->isMethod('post')) {
               $data = $request->all();
               $data = $request->except('_token');
                $data['reward_type'] = 'category';
               // dd($data);
                if($data['reward_type']=='category'){
                        RewardPoint::create([
                           'reward_type'  =>$data['reward_type'],
                           'category_id'  =>$data['category_id'],
                           'point'        =>$data['point']
                        ]);
                }
               
                // return redirect()->back()->with('success', 'Category Reward Point is updated successfully');   
                Session::flash('success','Category Reward Point added successfully');
                return redirect('admin/rewardPointManagement/categoryReward/point/List'); 
            }

            $categoryIds = RewardPoint::where('reward_type','category')->pluck('category_id')->toArray();
                       
            $productCategories = ProductCategory::whereNotIn('id',$categoryIds)->orderBy('id','asc')->get()->toArray();

            $page="categoryReward";
            return view('admin.rewardPointManagement.categoryReward.addCategoryRewardPoint',compact('page','productCategories'));
        }

        publiC function editRewardCategoryPoint(Request $request,$id){

           if($request->isMethod('post')) {
                  $data = $request->all();
                  $data = $request->except('_token');
                  $data['reward_type'] = 'category';

                   if($data['reward_type']=='category'){
                     RewardPoint::where('id',$data['id'])->update([
                          'reward_type'  =>$data['reward_type'],
                          'point'        =>$data['point']
                       ]);
                   }
                Session::flash('success','Category Reward Point updated successfully');
                return redirect('admin/rewardPointManagement/categoryReward/point/List');
            }
           $id = base64_decode($id);
           $rewardPointRecord = RewardPoint::where('id',$id)->first();
           $productCategories = ProductCategory::where('id',$rewardPointRecord['category_id'])->orderBy('id','asc')->get()->toArray();

           $page="categoryReward";
           return view('admin.rewardPointManagement.categoryReward.editCategoryRewardPoint',compact('page','rewardPointRecord','productCategories'));
        }

        public function deleteRewardCategoryPoint($id, Request $request)
         {
            $id               = base64_decode($id);
            $subscription     = RewardPoint::where('id',$id)->first(); 
            $subscriptionId   = $subscription->id;
            // dd($subscriptionId);
            if(!empty($id)) {
              // $data->delete();
            $data = RewardPoint::where('id',$subscriptionId)->delete(); 
               Session::flash('success', 'Category Reward Point deleted successfully');
               return redirect()->back();
              }else {
                Session::flash('error', 'Something went wrong');
                 return redirect()->back();
              } 
          }



        public function changeRewardCategoryStatus(Request $request)
        {
          try{
            if($request->status && $request->id){
                $statusChanged = RewardPoint::where(['id' => $request->id])->update(['status' => $request->status]);
                return ['status' => 'success', 'message' => 'Status changed successfully'];
            }else{
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
          }catch (Exception $e){
                \Log::error($e->getMessage());
                Session::flash('error', trans('messages.admin.common_error'));
                return redirect()->back();
            }
        }

       /////product Reward///////////

        public  function rewardproductList(Request $request)
          {
            
              // dd($rewardList);                        
             $page="productReward";
             return view('admin.rewardPointManagement.productReward.ProductRewardPointList',compact('page'));
          }

          public function rewardProductListIndex(Request $request) 
          {
             $rewardList = RewardPoint::with('productName')->where('reward_type','product')
                                                   ->leftjoin('products','reward_points.product_name','products.id')
                                                  ->select('reward_points.*','products.item_name as productOrignalName')->get();
               // $url = url('/');
               return DataTables::of($rewardList)
                      ->addIndexColumn()

                      ->addColumn('barCode', function($rewardList){          
                          $ProductBarCode = $rewardList['productName']['item_bar_code'];
                           return $ProductBarCode;                               
                       })

                      ->addColumn('seller_item_code', function($rewardList){          
                          $ProductBarCode1 = $rewardList['productName']['seller_item_code'];
                           return $ProductBarCode1;                               
                       })

                      ->addColumn('status', function ($rewardList) {
                          return '<div class="status_button_toggle" ral="' . $rewardList->id . '" rel="' . $rewardList->status . '" id="status_button_' . $rewardList->id . '"></div>';
                      })

                       ->addColumn('action', function ($rewardList) {
                          return 
                          '<a href="' . url("admin/rewardPointManagement/productReward/editReward/point/".base64_encode($rewardList->id)) . '" class="edit-btn"> <i class="fa fa-pencil" title="Edit"></i></a>
                          <a href="' . url("admin/rewardPointManagement/productReward/point/delete/" . base64_encode($rewardList->id)) . '" class="del-btn"  onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
                        })

                      ->escapeColumns([])
                      ->make(true);                                
           }

          
            publiC function addRewardProductPoint(Request $request){

                 if($request->isMethod('post')) {
                     $data = $request->all();
                     $data = $request->except('_token');
                     $data['reward_type'] = 'product';
                  // dd($data);

                      if($data['reward_type']=='product'){
                              RewardPoint::create([
                                 'reward_type'  =>$data['reward_type'],
                                 'product_name' =>$data['product_name'],
                                 'point'        =>$data['point']
                              ]);
                      }
                     
                      // return redirect()->back()->with('success', 'Product Reward Point is updated successfully');   
                      Session::flash('success','Product Reward Point added successfully');
                      return redirect('admin/rewardPointManagement/productReward/point/List'); 
                  }

                  $categoryIds = RewardPoint::where('reward_type','product')->pluck('product_name')->toArray();
                             
                  $productProduct = Product::whereNotIn('item_name',$categoryIds)->distinct('item_name')->get()->toArray();


                  $page="productReward";
                  return view('admin.rewardPointManagement.productReward.addProductRewardPoint',compact('page','productProduct'));
              }

              publiC function editRewardProductPoint(Request $request,$id){

                 if($request->isMethod('post')) {
                        $data = $request->all();
                        $data = $request->except('_token');
                        $data['reward_type'] = 'product';
                        if($data['reward_type']=='product'){

                           RewardPoint::where('id',$data['id'])->update([
                                'reward_type'    =>$data['reward_type'],
                                'product_name'   =>$data['product_name'],
                                'point'          =>$data['point']
                             ]);
                         }

                      Session::flash('success','Product Reward Point updated successfully');
                      return redirect('admin/rewardPointManagement/productReward/point/List');
                  }

                 $id = base64_decode($id);
                 $rewardPointRecord = RewardPoint::where('id',$id)->first();

                 $allSavedEnteries  = RewardPoint::where('product_name',$rewardPointRecord['product_name'])->get()->pluck('product_name');

                 $otherSelectedEnteries = RewardPoint::whereNotIn('product_name',$allSavedEnteries)->get()->pluck('product_name')->toArray();  

                 $products = Product::whereNotIn('id',$otherSelectedEnteries)->orderBy('id','desc')->get()->toArray();
                 
                 // $products = Product::where('id',$rewardPointRecord['product_id'])->orderBy('id','asc')->get()->toArray();

                 $page="productReward";
                 return view('admin.rewardPointManagement.productReward.editProductRewardPoint',compact('page','rewardPointRecord','products','allSavedEnteries'));
              }

              public function deleteRewardProductPoint($id, Request $request)
               {
                  $id               = base64_decode($id);
                  $subscription     = RewardPoint::where('id',$id)->first(); 
                  $subscriptionId   = $subscription->id;
                  // dd($subscriptionId);
                  if(!empty($id)) {
                    // $data->delete();
                  $data = RewardPoint::where('id',$subscriptionId)->delete(); 
                     Session::flash('success', 'Product Reward Point deleted successfully');
                     return redirect()->back();
                    }else {
                      Session::flash('error', 'Something went wrong');
                       return redirect()->back();
                    } 
                }



              public function changeRewardProductStatus(Request $request)
              {
                try{
                  if($request->status && $request->id){
                      $statusChanged = RewardPoint::where(['id' => $request->id])->update(['status' => $request->status]);
                      return ['status' => 'success', 'message' => 'Status changed successfully'];
                  }else{
                      return ['status' => 'error', 'message' => 'Some required details is missing'];
                  }
                }catch (Exception $e){
                      \Log::error($e->getMessage());
                      Session::flash('error', trans('messages.admin.common_error'));
                      return redirect()->back();
                  }
              } 

              publiC function rewardPointPrice(Request $request){

                 if($request->isMethod('post')) {
                        $data = $request->all();
                        $data = $request->except('_token');
                       // dd($data);
                       
                           RewardPointPrice::where('id',$data['id'])->update([
                                'point_price'  =>$data['point_price'],
                                'point'        =>$data['point']
                             ]);
                         

                      Session::flash('success','Reward Point Price is updated successfully');
                      return redirect('admin/rewardPointManagement/priceReward/point');
                  }

                 $rewardPointRecord = RewardPointPrice::where('id','1')->first();
                 // dd($rewardPointRecord);
                 $page="pointPrice";
                 return view('admin.rewardPointManagement.rewardPointPrice.pointPrice',compact('page','rewardPointRecord'));
              } 
 




}
