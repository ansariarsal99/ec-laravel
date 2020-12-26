<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Session;
use Exception;
use DB;
use App\ProductCategory;
use App\ProductSubCategory;
use App\ProductColor;
use App\ProductSellingUnit;
use App\ProductBrand;
use DataTables;
use Crypt;
use App\ProductGrade;
use App\ProductUnit;
use App\SellingUnitGroup;
use Intervention\Image\ImageManagerStatic as Image;


class ProductsController extends Controller
{
    private $productCategory;
    private $productSubCategory;

    public function __construct(ProductCategory $productCategory, ProductSubCategory $productSubCategory)
    {
        $this->productCategory = $productCategory;
        $this->productSubCategory = $productSubCategory;
    }
    /**
     * Category List Index
     * @param  Request $request 
     * @return Response Json           
     */
    public function categoryListIndex(Request $request) 
    {
        $categoryList = $this->productCategory->select('*');
        return DataTables::of($categoryList)
                ->addIndexColumn()
                ->addColumn('description', function($categoryList){
                    $strLength = strlen($categoryList->description);
                    if($strLength > 250) {
                        return substr($categoryList->description, 0, 250).'....';
                    }
                    return $categoryList->description;
                })
                ->addColumn('status', function ($categoryList) {
                    return '<div class="status_button_toggle" ral="' . $categoryList->id . '" rel="' . $categoryList->status . '" id="status_button_' . $categoryList->id . '"></div>';
                })

                ->addColumn('action', function ($categoryList) {
                    return 
                    '<a href="' . url("admin/productManagement/category/detail/".Crypt::encrypt($categoryList->id)) . '" class="view"> <i class="fa fa-eye" title="Detail"></i></a>
                    <a href="' . url("admin/productManagement/category/edit/".Crypt::encrypt($categoryList->id)) . '" class="edit-btn"> <i class="fa fa-pencil" title="Edit"></i></a>
                    <a href="' . url("admin/productManagement/category/delete/" . Crypt::encrypt($categoryList->id)) . '" class="del-btn" onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
                })

                ->escapeColumns([])
                ->make(true);                                
    }

    /**
     * Get Category Detail
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function getCategoryDetail(Request $request, $id)
    {
        try {
            $page = 'category';
            $category = $this->productCategory->where('id', Crypt::decrypt($id))->first();

            return view('admin.productManagement.category.detail', compact('page', 'category'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Category List
     * @param  Request $request 
     * @return view           
     */
    public function categoryList(Request $request)
    {
        try {
            $page = 'category';
            return view('admin.productManagement.category.list', compact('page'));

        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Add Category
     * @param Request $request
     * @return  view 
     */
  public function addCategory(Request $request)
  {
      try{
          $page = 'category';
          if($request->isMethod('post')) {
              $payload = $request->all();
              $data = $request->all();


              $profileImage = $payload['uploader'];

              if(isset($data['uploader']) && !empty($data['uploader'])){
              
                  $image = $request->file('uploader');
                  $ext = $image->getClientOriginalExtension();
                  $data['uploader'] = time().'_'.rand().'.'.$ext;

                  $destination_path = adminBaseProductCategoryImgsPath;

                  if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp'){
                      $image = Image::make($request->file('uploader'));
                      $image = $image->resize(600,null,function($constraint){
                              $constraint->aspectRatio();
                              $constraint->upsize();
                          });

                      $image->save($destination_path.'/'.$data['uploader']);

                  }else{
                      return redirect()->back()->with('error',trans('messages.frontend.user_profile.invalid_file_extension'));
                  }
                  
              }    
              ProductCategory::create([
                        'name'           => $payload['name'],
                        'description'    => $payload['description'],
                        'category_image' => $data['uploader']
                      ]);

              Session::flash('success', 'Product category added successfully');

              return redirect('admin/productManagement/category/list');
          }

          return view('admin.productManagement.category.add', compact('page'));
      } catch (Exception $e) {
          \Log::error($e->getMessage());
          Session::flash('error', trans('messages.admin.common_error'));
          return redirect()->back();
      }
  }

  /**
   * Edit Category
   * @param  Request $request 
   * @return view          
   */
  public function editCategory(Request $request, $id)
  {
    
          $page = 'category';
          $category = $this->productCategory->where('id', Crypt::decrypt($id))->first();
          if($request->isMethod('post')) {
              $payload = $request->all();
              $data = $request->all();
              // dd($data);

              if(isset($data['uploader']) && !empty($data['uploader'])){
              // $profileImage = $payload['uploader'];
              
                  $image = $request->file('uploader');
                  $ext = $image->getClientOriginalExtension();
                  $data['uploader'] = time().'_'.rand().'.'.$ext;

                  $destination_path = adminBaseProductCategoryImgsPath;

                  if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp'){
                      $image = Image::make($request->file('uploader'));
                      $image = $image->resize(600,null,function($constraint){
                              $constraint->aspectRatio();
                              $constraint->upsize();
                          });

                      $image->save($destination_path.'/'.$data['uploader']);
                      // dd($data['uploader']);

                      ProductCategory::where('id',$data['category_id'])->update(['category_image'=>$data['uploader']]);

                      if($profileImage != null && file_exists(adminBaseProductCategoryImgsPath.'/'.$profileImage) ) {
                          unlink(adminBaseProductCategoryImgsPath.'/'.$profileImage);
                      }

                  }else{
                      return redirect()->back()->with('error',trans('messages.frontend.user_profile.invalid_file_extension'));
                  }
                  
              } 

               // dd($payload['category_id']);

               ProductCategory::where('id',$payload['category_id'])->update([
                         'name'           => $payload['name'],
                         'description'    => $payload['description']
                         // 'category_image' => $data['uploader']
                       ]);

              // $category->update($payload);
              Session::flash('success', 'Product category updated successfully');

              return redirect('admin/productManagement/category/list');
          }

          return view('admin.productManagement.category.edit', compact('page', 'category'));
 
  }

    /**
     * Delete Category
     * @param  Request $request 
     * @param  [type]  $id      
     * @return Array          
     */
    public function deleteCategory(Request $request, $id)
    {
        try {
            $this->productCategory->where('id', Crypt::decrypt($id))->delete();

            Session::flash('success', 'Category deleted successfully');
            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Change Status
     * @param  Request $request 
     * @return Array          
     */
    public function changeStatus(Request $request)
    {
      try{
            if($request->status && $request->id){
                $statusChanged = $this->productCategory->where(['id' => $request->id])->update(['status' => $request->status]);
                return ['status' => 'success', 'message' => 'Status changed successfully'];
            }else{
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
        } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Sub Category List Index
     * @param  Request $request 
     * @return Response Json           
     */
    public function subCategoryListIndex(Request $request) 
    {
        $categoryList = $this->productSubCategory->with('category')->select('*');
        return DataTables::of($categoryList)
                ->addIndexColumn()

                ->addColumn('status', function ($categoryList) {
                    return '<div class="status_button_toggle" ral="' . $categoryList->id . '" rel="' . $categoryList->status . '" id="status_button_' . $categoryList->id . '"></div>';
                })

                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" class="edit_sub_category" ral_country_id="'.$row->id.'" ral_country_name="'.$row->name.'" ral_category_id="'.$row->category_id.'" data-toggle="modal" data-target="#editCountryModal"><i class="fa fa-edit" title="Edit"></i></a>

                    <a href="' . url("admin/productManagement/subcategory/delete/" . Crypt::encrypt($row->id)) . '" class="del-btn" onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
                })

                ->escapeColumns([])
                ->make(true);                                
    }


    /**
     * Category List
     * @param  Request $request 
     * @return view           
     */
    public function subCategoryList(Request $request)
    {
        try {
            $page = 'sub_category';
            $categories = $this->productCategory->get();

            return view('admin.productManagement.subCategory.list', compact('page', 'categories'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Add Sub Category
     * @param Request $request 
     * @return  view 
     */
    public function addSubCategory(Request $request)
    {
        try {
            $payload = $request->all();
            $this->productSubCategory->create($payload);
            Session::flash('success', 'Sub category added successfully');

            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Edit Sub Category
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function editSubCategory(Request $request)
    {
        try {
            $payload = $request->all();
            $subCategory = $this->productSubCategory->where('id', $request->input('id'))->first();
            $subCategory->update($payload);
            Session::flash('success', 'Sub category updated successfully');

            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Change Sub Category Status
     * @param  Request $request 
     * @return Array          
     */
    public function changeSubCategoryStatus(Request $request)
    {
      try{
            if($request->status && $request->id){
                $statusChanged = $this->productSubCategory->where(['id' => $request->id])->update(['status' => $request->status]);
                return ['status' => 'success', 'message' => 'Status changed successfully'];
            }else{
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
        } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

     /**
     * Delete Sub Category
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function deleteSubCategory(Request $request, $id)
    {
        try {
            $this->productSubCategory->where('id', Crypt::decrypt($id))->delete();

            Session::flash('success', 'SubCategory deleted successfully');
            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }



       public function colorList(Request $request)
    {
        try {
            $page = 'color';
            $categories = ProductColor::get();

            return view('admin.productManagement.color.list', compact('page', 'categories'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }


    public function colorListIndex(Request $request) 
    {
        $colorList = ProductColor::select('*');

        return DataTables::of($colorList)
                ->addIndexColumn()

                ->addColumn('status', function ($colorList) {
                    return '<div class="status_button_toggle" ral="' . $colorList->id . '" rel="' . $colorList->status . '" id="status_button_' . $colorList->id . '"></div>';
                })

                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" class="edit_sub_category" ral_color_id="'.$row->id.'" ral_color_name="'.$row->name.'" ral_color="'.$row->id.'" data-toggle="modal" data-target="#editCountryModal"><i class="fa fa-edit" title="Edit"></i></a>

                        <a href="' . url("admin/productManagement/color/delete/" . base64_encode($row->id)) . '" class="del-btn" onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
                })

                ->escapeColumns([])
                ->make(true);                                
    }

   public function addColor(Request $request)
    {
        try {
            $payload = $request->all();
            ProductColor::create($payload);
            Session::flash('success', 'Product Color added successfully');

            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Edit Sub Category
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function editColor(Request $request)
    {
        try {
            $payload = $request->all();
            // dd($payload);
            $subCategory = ProductColor::where('id', $request->input('id'))->first();
            $subCategory->update($payload);
            Session::flash('success', 'Product Color updated successfully');

            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Change Sub Category Status
     * @param  Request $request 
     * @return Array          
     */
    public function changeColorStatus(Request $request)
    {
      try{
            if($request->status && $request->id){
                $statusChanged = ProductColor::where(['id' => $request->id])->update(['status' => $request->status]);
                return ['status' => 'success', 'message' => 'Status changed successfully'];
            }else{
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
        } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

     /**
     * Delete Sub Category
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function deleteColor(Request $request, $id)
    {
        try {
            ProductColor::where('id', base64_decode($id))->delete();

            Session::flash('success', 'Product Color deleted successfully');
            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    public function validateAddColorName()
    {

        $name = $_GET['name'];
        $nameCount = ProductColor::where('name',$name)->count();

        if ($nameCount >0) {
            $resp = 'false';
        }else{
            $resp = 'true';
        }
        return $resp;
    }

    public function validateEditColorName( Request $request){

        $data = $request->all();
        // dd($data);         
        $name = @$data['name'];
        
        if ($data['id'] == null) {
            
            $count = ProductColor::where('name',$name)->count();;
            // dd($count);        
            
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else{

            $id    = $data['id'];
            $count = ProductColor::where('name',$name)->where('id','!=',$id)->count();
            // dd($count);  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
   }

    // public function sellingUnitList(Request $request)
    // {
    //     // try {
    //         $page = 'selling_unit';
    //         $categories = ProductSellingUnit::leftJoin('selling_unit_groups','selling_unit_groups.id','product_selling_Units.selling_unit_group_id')->select('product_selling_Units.*','selling_unit_groups.name as sellingGroup')->orderBy('id','asc')->get();
    //         // dd($categories);

    //         return view('admin.productManagement.sellingUnit.list', compact('page', 'categories'));
    //     // } catch (Exception $e) {
    //     //     \Log::error($e->getMessage());
    //     //     Session::flash('error', trans('messages.admin.common_error'));
    //     //     return redirect()->back();
    //     // }
    // }


    // public function sellingUnitListIndex(Request $request) 
    // {
    //    $sellingUnitList = ProductSellingUnit::leftJoin('selling_unit_groups','selling_unit_groups.id','product_selling_Units.selling_unit_group_id')->select('product_selling_Units.*','selling_unit_groups.name as sellingGroup')->orderBy('id','asc')->get();

    //     return DataTables::of($sellingUnitList)
    //             ->addIndexColumn()

    //             ->addColumn('status', function ($sellingUnitList) {
    //                 return '<div class="status_button_toggle" ral="' . $sellingUnitList->id . '" rel="' . $sellingUnitList->status . '" id="status_button_' . $sellingUnitList->id . '"></div>';
    //             })

    //         ->addColumn('action', function($row){
    //                            return '<a href="javascript:void(0)" class="edit_selling_unit" ral_unit_selling_id="'.$row->id.'" ral_unit_selling_name="'.$row->name.'" ral_unit_selling_type="'.$row->type.'" ral_selling_unit_id="'.$row->selling_unit_id.'" ral_selling_group_id="'.$row['sellingUnitGroup']['name'].'" ral_group_id="'.$row->selling_unit_group_id.'" data-toggle="modal" data-target="#editCountryModal"><i class="fa fa-edit" title="Edit"></i></a>

    //                     <a href="' . url("admin/productManagement/sellingUnit/delete/" . base64_encode($row->id)) . '" class="del-btn" onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
    //             })

    //             ->escapeColumns([])
    //             ->make(true);                                
    // }

    // public function addSellingUnit(Request $request)
    //  {
    //      try {
    //          $payload = $request->all();
    //          $sellingUnitRecord =ProductSellingUnit::first();
    //          if($sellingUnitRecord!=''){
    //              $payload = $request->except('_token','id');
             
    //              $sellingGroupRecord = ProductSellingUnit::where('selling_unit_group_id',$payload['selling_unit_group_id'])->first();
    //              if($sellingGroupRecord!=null){

    //                  if($payload['type'] =='greaterThan'){

    //                      ProductSellingUnit::create($payload);  

    //                  }else if($payload['type'] =='lessThan'){
    //                      ProductSellingUnit::where('status','active')->update(['status'=>'inactive']);
    //                        $sellingUnitRecordGet =ProductSellingUnit::get()->toArray();
                        
    //                      foreach ($sellingUnitRecordGet as $key => $value) {

    //                          if($payload['type'] =='lessThan'){
    //                              if($value['id']==$payload['selling_unit_id']){
    //                                  $newIdGenerated =    ProductSellingUnit::create([
    //                                                          'name' =>$payload['name'],
    //                                                          'type' =>$payload['type'],
    //                                                          'selling_unit_id' =>$payload['selling_unit_id'],
    //                                                          'selling_unit_group_id' =>$payload['selling_unit_group_id']
    //                                                             ]);
    //                              } 

    //                                  // dd($payload);
    //                              $sellUnit =ProductSellingUnit::create([
    //                                                     'name' =>$value['name'],
    //                                                     'type' =>$value['type'],
    //                                                     'selling_unit_id' =>$value['selling_unit_id'],
    //                                                     'selling_unit_group_id' =>$value['selling_unit_group_id']
    //                                                     ]); 
                  
    //                          }  
    //                      }
    //                      ProductSellingUnit::where('status','inactive')->delete();                        
    //                  }

    //              }else {
    //                  $payload = $request->except('_token','id');
    //                  ProductSellingUnit::create($payload);  
    //                  Session::flash('success', 'Product Selling Unit is added successfully');
    //                  return redirect()->back();
    //              } 

    //          } else {
    //              $payload = $request->except('_token','id');
    //              dd($payload);
    //              ProductSellingUnit::create($payload);  
    //          }

         
    //          Session::flash('success', 'Product Selling Unit is added successfully');
    //          return redirect()->back();
    //      } catch (Exception $e) {
    //          \Log::error($e->getMessage());
    //          Session::flash('error', trans('messages.admin.common_error'));
    //          return redirect()->back();
    //      }
    //  }

    //  public function sellingUnitGroup(Request $request){
    //          $input   = $request->all();
    //          $sellingGroup  = ProductSellingUnit::where('selling_unit_group_id',$input['sellingGroupUnitId'])->get()->toArray();
    //          if (!empty($sellingGroup)) {
    //                $groupData = true;
    //          }else{
    //                $groupData = false;
    //          }
    //          // dd($groupData);
    //            // dd($sellingGroup);
    //          $view    = view('admin.element.sellingUnitGroup',['sellingGroup' => $sellingGroup])->render();
    //          return array('groupData'=>$groupData,'view'=>$view);
    //     }

     

    // public function sellingUnitChange(Request $request){
    //        $input      = $request->all();
    //        $selingid   =  ProductSellingUnit::where('id',$input['edit_id'])->first();
       
    //        $id =$selingid['selling_unit_id'];
    //         // dd($id);
    //        $allsellingUnitlist  = ProductSellingUnit::where('selling_unit_group_id',$input['groupId'])->get();
    //         // dd($allsellingUnitlist);
    //        $view    = view('admin.element.sellingUnit',compact('allsellingUnitlist','id'))->render();
    //        return $view;
    //    }


    // /**
    //  * Edit Sub Category
    //  * @param  Request $request 
    //  * @param  string  $id      
    //  * @return view           
    //  */
    // public function editSellingUnit(Request $request)
    // {
    //     try {
    //         $payload = $request->all();
    //         // dd($payload);
    //         $payload = $request->except('_token');
    //         ProductSellingUnit::where('id',$payload['id'])->update([
    //                                       'name' =>$payload['name']
    //                                     ]);        
    //         Session::flash('success', 'Product Selling Unit is updated successfully');

    //         return redirect()->back();
    //     } catch (Exception $e) {
    //         \Log::error($e->getMessage());
    //         Session::flash('error', trans('messages.admin.common_error'));
    //         return redirect()->back();
    //     }
    // }

    // /**
    //  * Change Sub Category Status
    //  * @param  Request $request 
    //  * @return Array          
    //  */
    // public function changeSellingUnitStatus(Request $request)
    // {
    //   try{
    //         if($request->status && $request->id){
    //             $statusChanged = ProductSellingUnit::where(['id' => $request->id])->update(['status' => $request->status]);
    //             return ['status' => 'success', 'message' => 'Status changed successfully'];
    //         }else{
    //             return ['status' => 'error', 'message' => 'Some required details is missing'];
    //         }
    //     } catch (Exception $e){
    //         \Log::error($e->getMessage());
    //         Session::flash('error', trans('messages.admin.common_error'));
    //         return redirect()->back();
    //     }
    // }

    //  /**
    //  * Delete Sub Category
    //  * @param  Request $request 
    //  * @param  string  $id      
    //  * @return view           
    //  */
    // public function deleteSellingUnit(Request $request, $id)
    // {
    //     try {
    //         ProductSellingUnit::where('id', base64_decode($id))->delete();

    //         Session::flash('success', 'Product Selling Unit deleted successfully');
    //         return redirect()->back();
    //     } catch (Exception $e) {
    //         \Log::error($e->getMessage());
    //         Session::flash('error', trans('messages.admin.common_error'));
    //         return redirect()->back();
    //     }
    // }

    // public function validateAddSellingUnitName()
    // {

    //     $name = $_GET['name'];
    //     $nameCount = ProductSellingUnit::where('name',$name)->count();

    //     if ($nameCount >0) {
    //         $resp = 'false';
    //     }else{
    //         $resp = 'true';
    //     }
    //     return $resp;
    // }

    // public function validateEditSellingUnitName( Request $request){

    //     $data = $request->all();
    //     // dd($data);         
    //     $name = @$data['name'];
        
    //     if ($data['id'] == null) {
            
    //         $count = ProductSellingUnit::where('name',$name)->count();;
    //         // dd($count);        
            
    //         if ($count > 0) {
    //             return 'false';
    //         } else {
    //             return 'true';
    //         }
    //     } else{

    //         $id    = $data['id'];
    //         $count = ProductSellingUnit::where('name',$name)->where('id','!=',$id)->count();
    //         // dd($count);  
    //         if ($count > 0) {
    //             return 'false';
    //         } else {
    //             return 'true';
    //         }
    //     }
    // }



    public function brandList(Request $request)
    {
        try {
            // dd('here');
            $page = 'brand';
            return view('admin.productManagement.brand.list', compact('page'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }


    public function brandListIndex(Request $request) 
    {
        $brandList = ProductBrand::select('*');
        // dd($brandList);
        return DataTables::of($brandList)
                ->addIndexColumn()

                ->addColumn('status', function ($brandList) {
                    return '<div class="status_button_toggle" ral="' . $brandList->id . '" rel="' . $brandList->status . '" id="status_button_' . $brandList->id . '"></div>';
                })

                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" class="edit_brand" ral_brand_id="'.$row->id.'" ral_brand_name="'.$row->brand_name.'" ral_brand="'.$row->id.'" data-toggle="modal" data-target="#editCountryModal"><i class="fa fa-edit" title="Edit"></i></a>

                        <a href="' . url("admin/productManagement/brand/delete/" . base64_encode($row->id)) . '" class="del-btn" onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
                })

                ->escapeColumns([])
                ->make(true);                                
    }

   public function addBrand(Request $request)
    {
        try {
            $payload = $request->all();
            // dd($payload);
            ProductBrand::create($payload);
            Session::flash('success', 'Product Brand is added successfully');

            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Edit Sub Category
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function editbrand(Request $request)
    {
        try {
            $payload = $request->all();
            // dd($payload);
            $productBrand = ProductBrand::where('id', $request->input('id'))->first();
            $productBrand->update($payload);
            Session::flash('success', 'Product Brand is updated successfully');

            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Change Sub Category Status
     * @param  Request $request 
     * @return Array          
     */
    public function changebrandStatus(Request $request)
    {
      try{
            if($request->status && $request->id){
                $statusChanged = ProductBrand::where(['id' => $request->id])->update(['status' => $request->status]);
                return ['status' => 'success', 'message' => 'Status changed successfully'];
            }else{
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
        } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

     /**
     * Delete Sub Category
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function deletebrand(Request $request, $id)
    {
        try {
            ProductBrand::where('id', base64_decode($id))->delete();

            Session::flash('success', 'Product Brand deleted successfully');
            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    public function validateAddBrandName( Request $request)
    {

        $name = $_GET['brand_name'];
        $nameCount = ProductBrand::where('brand_name',$name)->count();

        if ($nameCount >0) {
            $resp = 'false';
        }else{
            $resp = 'true';
        }
        return $resp;
    }

    public function validateEditbrandName( Request $request){

        $data = $request->all();
        // dd($data);         
        $name = @$data['brand_name'];
        
        if ($data['id'] == null) {
            
            $count = ProductBrand::where('brand_name',$name)->count();;
            // dd($count);        
            
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else{

            $id    = $data['id'];
            $count = ProductBrand::where('brand_name',$name)->where('id','!=',$id)->count();
            // dd($count);  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
   }

    public function gradeList(Request $request)
    {
        try {
            // dd('here');
            $page = 'grade';
            return view('admin.productManagement.grade.list', compact('page'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }


    public function gradeListIndex(Request $request) 
    {
        $ProductGrade = ProductGrade::select('*');
        // dd($ProductGrade);
        return DataTables::of($ProductGrade)
                ->addIndexColumn()
                ->addColumn('status', function ($ProductGrade) {
                    return '<div class="status_button_toggle" ral="' . $ProductGrade->id . '" rel="' . $ProductGrade->status . '" id="status_button_' . $ProductGrade->id . '"></div>';
                })

                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" class="edit_brand" ral_brand_id="'.$row->id.'" ral_brand_name="'.$row->grade_name.'" ral_brand="'.$row->id.'" data-toggle="modal" data-target="#editCountryModal"><i class="fa fa-edit" title="Edit"></i></a>

                        <a href="' . url("admin/productManagement/grade/delete/" . base64_encode($row->id)) . '" class="del-btn" onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
                })

                ->escapeColumns([])
                ->make(true);                                
    }

   public function addGrade(Request $request)
    {
        try {
            $payload = $request->all();
            // dd($payload);
            ProductGrade::create($payload);
            Session::flash('success', 'Product Grade is added successfully');

            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Edit Sub Category
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function editGrade(Request $request)
    {
        try {
            $payload = $request->all();
            // dd($payload);
            $ProductGrade = ProductGrade::where('id', $request->input('id'))->first();
            $ProductGrade->update($payload);
            Session::flash('success', 'Product grade is updated successfully');

            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Change Sub Category Status
     * @param  Request $request 
     * @return Array          
     */
    public function changeGradeStatus(Request $request)
    {
      try{
            if($request->status && $request->id){
                $statusChanged = ProductGrade::where(['id' => $request->id])->update(['status' => $request->status]);
                return ['status' => 'success', 'message' => 'Status changed successfully'];
            }else{
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
        } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

     /**
     * Delete Sub Category
     * @param  Request $request 
     * @param  string  $id      
     * @return view           
     */
    public function deleteGrade(Request $request, $id)
    {
        try {
            ProductGrade::where('id', base64_decode($id))->delete();
            Session::flash('success', 'Product Grade deleted successfully');
            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    public function validateAddGradeName( Request $request)
    {

        $name = $_GET['grade_name'];
        $nameCount = ProductGrade::where('grade_name',$name)->count();

        if ($nameCount >0) {
            $resp = 'false';
        }else{
            $resp = 'true';
        }
        return $resp;
    }

    public function validateEditGradeName( Request $request){

        $data = $request->all();
        // dd($data);         
        $name = @$data['grade_name'];
        
        if ($data['id'] == null) {
            
            $count = ProductGrade::where('grade_name',$name)->count();;
            // dd($count);        
            
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else{

            $id    = $data['id'];
            $count = ProductGrade::where('grade_name',$name)->where('id','!=',$id)->count();
            // dd($count);  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
   }


       public function productUnitList(Request $request)
        {
          $page =  'product-unit';
          return view('admin.productManagement.productUnit.productUnit',compact('page'));
        }

       public function productUnitListIndex(Request $request) 
       {
        $url = url('/');
           $ProductList = ProductUnit::get();
           // $url = url('/');
           return DataTables::of($ProductList)
                  ->addIndexColumn()
           
                  ->addColumn('status', function ($ProductList) {
                      return '<div class="status_button_toggle" ral="'.$ProductList->id.'" rel="'.$ProductList->status.'" id="status_button_'.$ProductList->id.'"></div>';
                    })

                  ->addColumn('action', function($ProductList) use($url){
                      return '<a href="javascript:void(0)" class="edit_course" ral_country_id="'.$ProductList->id.'" ral_country_name="'.$ProductList->unit.'" data-toggle="modal" data-target="#editCountryModal"><i class="fa fa-edit" title="Edit"></i></a>
                          
                          <a href="javascript:void(0)" class="del_btn" val="'.base64_encode($ProductList->id).'"><i class="fa fa-trash" title="Delete"></i><a>';
                     })   

                    ->escapeColumns([])
                    ->make(true);            
       }   

        public function changeStatusProductUnit(Request $request)
        {
            if($request->status && $request->id){
                $statusChanged = ProductUnit::where(['id' => $request->id])->update(['status' => $request->status]);
                return ['status' => 'success', 'message' => 'Status changed successfully'];
            }else{  
                return ['status' => 'error', 'message' => 'Some required details is missing'];
            }
        }

        public function addProductUnit(Request $request){
            $payload = $request->except('_token');
            // dd($payload);
            ProductUnit::create($payload);
            Session::flash('success', 'Product Unit is added successfully');   

            return redirect()->back();
        }

        public function updateProductUnit(Request $request){
            $payload = $request->except('_token','name');
             // dd($payload);
            $courseData = ProductUnit::where('id',$request->input('id'))->first();
            $courseData->update($payload);
            Session::flash('success', 'Product Unit is updated successfully');   
            return redirect()->back();   
        }

        public function deleteProductUnit($id, Request $request)
        {   
            $data= ProductUnit::where('id', base64_decode($id))->first();
            if(!empty($data)){
              $dataDeleted = ProductUnit::where('id', base64_decode($id))->first()->delete();
              // Session::flash('success','Product Unit is deleted successfully');
              return $response = array('status'=>'ok');
            }
        }

        public function validateProductUnitName(){

         $name = $_GET['unit'];
         $nameCount = ProductUnit::where('unit',$name)->count();

         if ($nameCount >0) {
             $resp = 'false';
         }else{
             $resp = 'true';
         }
            return $resp;
        }


        public function validateEditProductUnitName( Request $request){

            $data = $request->all();
            $name = @$data['unit'];
            
            if ($data['id'] == null) {
                
                $count = ProductUnit::where('unit',$name)->count();;
                // dd($count);        
                
                if ($count > 0) {
                    return 'false';
                } else {
                    return 'true';
                }
            } else{

                $id    = $data['id'];
                $count = ProductUnit::where('unit',$name)->where('id','!=',$id)->count();
                // dd($count);  
                if ($count > 0) {
                    return 'false';
                } else {
                    return 'true';
                }
            }
       }

    public function sellingUnitGroupList(Request $request) {
        $page =  'sellingUnitGroup';
        return view('admin.productManagement.sellingUnitGroup.list',compact('page'));
    }

    public function sellingUnitGroupListIndex(Request $request) {
        $url = url('/');
        $SellingUnitGroupList = SellingUnitGroup::get();
        // $url = url('/');
        return DataTables::of($SellingUnitGroupList)
                          ->addIndexColumn()       
                          ->addColumn('status', function ($SellingUnitGroupList) {
                              return '<div class="status_button_toggle" ral="'.$SellingUnitGroupList->id.'" rel="'.$SellingUnitGroupList->status.'" id="status_button_'.$SellingUnitGroupList->id.'"></div>';
                            })
                          ->addColumn('action', function($SellingUnitGroupList) use($url){
                              return '<a href="javascript:void(0)" class="editSellUnitGp" ral_group_id="'.$SellingUnitGroupList->id.'" ral_group_name="'.$SellingUnitGroupList->name.'" data-toggle="modal" data-target="#editSellingUnitGroupModal"><i class="fa fa-edit" title="Edit"></i></a>                             
                                  <a href="javascript:void(0)" class="del_btn" val="'.base64_encode($SellingUnitGroupList->id).'"><i class="fa fa-trash" title="Delete"></i><a>';
                             })  
                          ->escapeColumns([])
                          ->make(true);            
    } 

    public function addSellingUnitGroup(Request $request){
        $data = $request->except('_token');
        // dd($data);
        SellingUnitGroup::create($data);
        Session::flash('success', 'Selling Unit Group is added successfully');   

        return redirect()->back();
    }

    public function updateSellingUnitGroup(Request $request){
        $data = $request->except('_token','name');
         // dd($data);
        $sellingUnitGroupData = SellingUnitGroup::where('id',$request->input('id'))->first();
        $sellingUnitGroupData->update(['name'=>$data['gp_name']]);
        Session::flash('success', 'Selling Unit Group is updated successfully');   
        return redirect()->back();   
    }

    public function deleteSellingUnitGroup($id, Request $request) {   
        $data= SellingUnitGroup::where('id', base64_decode($id))->first();
        if(!empty($data)){

            ProductSellingUnit::where('selling_unit_group_id',base64_decode($id))->delete();

          $dataDeleted = SellingUnitGroup::where('id', base64_decode($id))->first()->delete();
          Session::flash('success','selling group Unit is deleted successfully');
          return $response = array('status'=>'ok');
        }
    }

    public function sellingUnitGroupChangeStatus(Request $request) {
        // dd('here');
        if($request->status && $request->id){
            $statusChanged = SellingUnitGroup::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{  
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

    public function validateSellingUnitGroupName(){

        $name = $_GET['name'];
        $nameCount = SellingUnitGroup::where('name',$name)->count();
        if ($nameCount >0) {
             $resp = 'false';
        }else{
             $resp = 'true';
        }
        return $resp;
    }

    public function validateEditSellingUnitGroupName( Request $request){

        $data = $request->all();
        $name = @$data['name'];
        
        if ($data['id'] == null) {            
            $count = SellingUnitGroup::where('name',$name)->count();;
            // dd($count);                  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else{
            $id    = $data['id'];
            $count = SellingUnitGroup::where('name',$name)->where('id','!=',$id)->count();
            // dd($count);  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
    }

    public function sellingUnitList(Request $request) {
        $page =  'sellingUnit';
        return view('admin.productManagement.sellingUnit.list',compact('page'));
    }

    public function sellingUnitListIndex(Request $request) {
        $url = url('/');
        $sellingUnitList = ProductSellingUnit::get();
        // $url = url('/');
        return DataTables::of($sellingUnitList)
                          ->addIndexColumn()       
                          ->addColumn('status', function ($sellingUnitList) {
                              return '<div class="status_button_toggle" ral="'.$sellingUnitList->id.'" rel="'.$sellingUnitList->status.'" id="status_button_'.$sellingUnitList->id.'"></div>';
                            })
                          ->addColumn('action', function($sellingUnitList) use($url){
                              return '<a href="javascript:void(0)" class="editSellUnitGp" ral_group_id="'.$sellingUnitList->id.'" ral_group_name="'.$sellingUnitList->name.'" data-toggle="modal" data-target="#editSellingUnitModal"><i class="fa fa-edit" title="Edit"></i></a>                             
                                  <a href="javascript:void(0)" class="del_btn" val="'.base64_encode($sellingUnitList->id).'"><i class="fa fa-trash" title="Delete"></i><a>';
                             })  
                          ->escapeColumns([])
                          ->make(true);            
    } 

    public function addSellingUnit(Request $request){
        $data = $request->except('_token');
        // dd($data);
        ProductSellingUnit::create($data);
        Session::flash('success', 'Selling Unit is added successfully');   

        return redirect()->back();
    }

    public function updateSellingUnit(Request $request){
        $data = $request->except('_token');
         // dd($data);
        $sellingUnitGroupData = ProductSellingUnit::where('id',$request->input('id'))->first();
        $sellingUnitGroupData->update(['name'=>$data['name']]);
        Session::flash('success', 'Selling Unit is updated successfully');   
        return redirect()->back();   
    }

    public function deleteSellingUnit($id, Request $request) {   
        $data= ProductSellingUnit::where('id', base64_decode($id))->first();

        $dataDeleted = ProductSellingUnit::where('id', base64_decode($id))->delete();
        Session::flash('success','Selling Unit is deleted successfully');
        return $response = array('status'=>'ok');
    }

    public function sellingUnitChangeStatus(Request $request) {
        // dd('here');
        if($request->status && $request->id){
            $statusChanged = ProductSellingUnit::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{  
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

    public function validateSellingUnitName(){

        $name = $_GET['name'];
        $nameCount = ProductSellingUnit::where('name',$name)->count();
        if ($nameCount >0) {
             $resp = 'false';
        }else{
             $resp = 'true';
        }
        return $resp;
    }

    public function validateEditSellingUnitName( Request $request){

        $data = $request->all();
        $name = @$data['name'];
        
        if ($data['id'] == null) {            
            $count = ProductSellingUnit::where('name',$name)->count();;
            // dd($count);                  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else{
            $id    = $data['id'];
            $count = ProductSellingUnit::where('name',$name)->where('id','!=',$id)->count();
            // dd($count);  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
    }
    

}
