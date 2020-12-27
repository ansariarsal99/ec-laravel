<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,Session;
use Exception;
use DB;
use Crypt;
use DataTables;
use App\ProductCategory;
use App\ProductSubCategory;
use App\productSellingMaterial;
use App\ProductSelectedSellingMaterialCategory;
use App\ProductSelectedSellingMaterialSubCategory;


class SellingMaterialController extends Controller
{
    public  function sellingMaterialList(Request $request)
   	 {
   	 	       
         $page="sell_Material";
   		 return view('admin.productManagement.sellingMaterial.list',compact('page'));

   	 }

    public function sellingMaterialListIndex(Request $request) 
     {
          $rewardList = productSellingMaterial::leftjoin('product_categories','product_selling_materials.product_category_id','product_categories.id')->leftjoin('product_sub_categories','product_selling_materials.product_sub_category_id','product_sub_categories.id')->select('product_selling_materials.*','product_categories.name as category_name','product_sub_categories.name as sub_category_name')->get(); 
     	 	        // dd($rewardList);
                         
         return DataTables::of($rewardList)
              ->addIndexColumn()
              
              ->editColumn('sub_category_name', function($rewardList){
                    if($rewardList['sub_category_name']!=null){
                      $reward = $rewardList['sub_category_name'];
                    }else{
                      $reward ="-";
                    }
                  return $reward;
              })

              ->addColumn('status', function ($rewardList) {
                  return '<div class="status_button_toggle" ral="' . $rewardList->id . '" rel="' . $rewardList->status . '" id="status_button_' . $rewardList->id . '"></div>';
              })
              ->addColumn('action', function ($rewardList) {
                  return 
                  '<a href="' . url("admin/sellingMaterial/edit/".base64_encode($rewardList->id)) . '" class="edit-btn"> <i class="fa fa-pencil" title="Edit"></i></a>
                  <a href="' . url("admin/sellingMaterial/delete/" . base64_encode($rewardList->id)) . '" class="del_btn" val="'.base64_encode($rewardList->id).'"  onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
              })
              ->escapeColumns([])
	            ->make(true);                                
     }

     public function addSellingUnitMaterial(Request $request){
        if ($request->isMethod('post')) {
     	     $data = $request->all();
           $data = $request->except('_token');
           productSellingMaterial::create($data);
           return redirect()->back()->with('success', 'product selling material is added successfully');   
      	}

    	  $productCategories = ProductCategory::get();
        $page="sell_Material";
     	return view('admin.productManagement.sellingMaterial.add',compact('page','productCategories'));
     }

     public function getSubCategoriesForMaterials(Request $request)
     { 
        $page = 'sell_Material';
        $subCategories = ProductSubCategory::where('category_id', $request->input('categoryId'))->get();
        return view('frontend.login.provider.element.productSubCategories', compact('page', 'subCategories'))->render();
     }

      public function editSellingUnitMaterial(Request $request,$id){
           if ($request->isMethod('post')) {
               $data = $request->all();
               $data = $request->except('_token');

               productSellingMaterial::where('id',$id)->update($data);
           return redirect()->back()->with('success', 'product selling material is updated successfully');   
          }

        $productSellingMaterial  = productSellingMaterial::with('selectedCategory','selectedSubCategory')->where('id',base64_decode($id))->first();
        $productCategories = ProductCategory::get();
         
        $page="sell_Material";
        return view('admin.productManagement.sellingMaterial.edit',compact('page','productCategories','$productSubCategories','productSellingMaterial'));
       }


      public function changeMaterialstatus(Request $request)
        {
            if($request->status && $request->id){
                $statusChanged = productSellingMaterial::where(['id' => $request->id])->update(['status' => $request->status]);
                return ['status' => 'success', 'message' => 'Status changed successfully'];
            }else{
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
        }
       
      public function deleteSellingMaterial($id, Request $request)
        {   
            $data = productSellingMaterial::where('id', base64_decode($id))->first();
            // dd($data);
            if(!empty($data)){
              $dataDeleted = productSellingMaterial::where('id', base64_decode($id))->delete();
             }
            return $response = array('status'=>'ok');
        }

       
      
}
