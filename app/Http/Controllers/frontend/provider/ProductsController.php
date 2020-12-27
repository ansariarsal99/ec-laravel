<?php

namespace App\Http\Controllers\frontend\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Exception;
use App\ProductCategory;
use App\ProductSubCategory;
use App\UserTermOfPayment;
use App\ProductWeight;
use App\ProductSpecification;
use App\Admin;
use App\User;
use App\Product;
use App\ProductImage;
use App\ProductBrand;
use App\ProductColor;
use App\Country;
use App\ProductSellingUnit;
use App\ProductSelectedCategory;
use App\ProductSelectedSubcategory;
use App\ProductPriceRange;
use App\ProductTermOfPayment;
use Illuminate\Support\Arr;
use DataTables;
use Crypt;
use Auth;
use App\ProductKeyword;
use App\ProductGrade;
use App\ProductUnit;
use App\ProductPacking;
use Intervention\Image\ImageManagerStatic as Image;
use App\UserStoreLocation;
use App\SellingUnitGroup;
use App\ProviderDeliveryOption;
use App\ProductRelatedLink;
use App\ProductSelectedKeyword;
use App\ProductNewOption;
use App\ProductSpecialDeliveryFee;
use App\productSellingMaterial;
use App\ProductSelectedSellingMaterial;
use App\ProductTax;
use App\ProductBuildMartFee;


class ProductsController extends Controller
{
    protected $subCategory;
    protected $productWeight;
    protected $productSpecification;
    protected $admin;
    protected $user;
    protected $product;
    protected $productImage;
    protected $productSellingMaterial;

    public function __construct(ProductSubCategory $subCategory, 
                                ProductWeight $productWeight,
                                ProductSpecification $productSpecification,
                                Admin $admin,
                                User $user,
                                Product $product,
                                productSellingMaterial $productSellingMaterial,
                                ProductImage $productImage)
    {
        $this->subCategory = $subCategory;
        $this->productSellingMaterial = $productSellingMaterial;
        $this->productWeight = $productWeight;
        $this->productSpecification = $productSpecification;
        $this->admin = $admin;
        $this->user = $user;
        $this->product = $product;
        $this->productImage = $productImage;
    }
    /**
     * List Products
     * @param  Request $request 
     * @return view     
     */


    public function addPackingUnit(Request $request) {

        $data = $request->all();
        $page = 'product';
        // $sellingUnit = ProductSellingUnit::where('id',$data['sellingId'])->first()->toArray();
        // $SelectedSellingUnits = ProductSellingUnit::where('id','<',$data['sellingId'])->where('selling_unit_group_id',$sellingUnit['selling_unit_group_id'])->get()->toArray();
        // $sellingUnitCount = count($SelectedSellingUnits);
        // dd($sellingUnitCount);
        $SelectedSellingUnits = ProductSellingUnit::where('id', '!=', $data['sellingId'])->get()->toArray();    
        $view = view('frontend.login.provider.element.sellingUnit', compact('page','SelectedSellingUnits'))->render(); 
        return array('view'=>$view);
    }
    
    public function addNewPackingUnit(Request $request)
    {
       $data = $request->all();
       $page = 'product';

       // dd($data);
       $SelectedSellingUnits = ProductSellingUnit::where('id', '!=', $data['sellingId'])->where('id', '!=', $data['packing_unit_Id'])->get()->toArray();
       // dd($SelectedSellingUnits);

       $view = view('frontend.login.provider.element.pakingUnit', compact('page','SelectedSellingUnits'))->render(); 
       return $view;
    }

    public function getPackingUnit(Request $request)
    {
       $data = $request->all();
       $page = 'product';

        // dd($data['selected']);
        $SelectedSellingUnits = ProductSellingUnit::where('id', '!=', $data['sellingId'])->whereNotIn('id', $data['selected'])->get()->toArray();
        // $sellingUnit = ProductSellingUnit::where('id',$data['sellingId'])->first()->toArray();
        // $SelectedSellingUnits = ProductSellingUnit::where('id','<',$data['sellingId'])->where('selling_unit_group_id',$sellingUnit['selling_unit_group_id'])->whereNotIn('id', $data['selected'])->get()->toArray();
        // $sellingUnitCount = count($SelectedSellingUnits);
        // dd($sellingUnitCount);

        $view = view('frontend.login.provider.element.pakingUnit', compact('page','SelectedSellingUnits'))->render(); 
        // return $view;
        return array('view'=>$view);
    }


    
    
    public function listProducts(Request $request)
    {
        try{
            $page = 'list_product';

            return view('frontend.login.provider.products.list', compact('page'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();

        }
    }

    public function productsListIndex(Request $request)
    {
        $productList = $this->product->select('*')
                                        ->where('user_id',\Auth::user()->id)
                                        ->orderBy('id', 'desc')->get();

        return DataTables::of($productList)
                        ->addIndexColumn()
                        ->addColumn('product_name_arabic', function($productList){
                            if (!empty($productList->item_name_arabic)) {
                                return $productList->item_name_arabic;
                            }else{
                                return '-';
                            }
                        })
                        ->addColumn('product_name_english', function($productList){
                            if (!empty($productList->item_name)) {
                                return $productList->item_name;
                            }else{
                                return '-';
                            }
                        })
                        ->addColumn('special_build_mart_fees', function($productList){
                                return ucfirst($productList->has_special_build_mart_fees);
                            })
                        ->addColumn('status', function($productList){
                            if($productList->status == 'active') {
                                return '<td class="stats_item">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm btn-class">Active</button>
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item drop-class inactive-class" product-id="'.$productList->id.'" href="javascript:;">Make Inactive</a>
                                                </div>
                                            </div> 
                                        </td>';
                            }

                            return '<td class="stats_item">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger btn-sm btn-class">Inactive</button>
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item drop-class active-class" product-id="'.$productList->id.'" href="javascript:;">Make Active</a>
                                            </div>
                                        </div> 
                                    </td>';
                        })
                        ->addColumn('action', function ($productList) {
                            if ($productList->has_special_build_mart_fees=='yes') {
                                $specialFees = '<a href="'.url("provider/products/specialBuildMartFees/".base64_encode($productList->id)).'" class="cp text-dark"> <i class="fa fa-money" title="Special Build Mart Fees"></i></a>';
                            }else{
                                $specialFees = '';
                            }
                          return 
                          // '<a href="' . url("provider/products/edit/".Crypt::encrypt($productList->id)) . '" class="edit-btn cp text-primary">Edit</a>
                          // <a href="javascript:;" class="delete-btn cp text-danger" del_id="'.$productList->id.'" > Delete</a>
                          // <a href="' . url("provider/products/view/".Crypt::encrypt($productList->id)) . '" class="cp text-dark" del_id="'.$productList->id.'" > View</a>';
                          '<a href="javascript:;" class="edit-btn cp text-primary">Edit</a>
                          <a href="javascript:;" class="delete-btn cp text-danger" del_id="'.$productList->id.'" > Delete</a>
                          <a href="'.url("provider/products/view/".base64_encode($productList->id)).'" class="cp text-dark" del_id="'.$productList->id.'" > View</a>'.$specialFees.'';
                        })
                        ->escapeColumns([])
                        ->make(true);
    }

    /**
     * Add Product
     * @param Request $request 
     * @return view
     */
    // public function addProduct(Request $request)
    // {
    //     try{
    //         $page = 'product';
    //         // create product
    //         if($request->isMethod('post')) {
    //            $payload = $request->all();
    //            $payload['user_id'] = Auth::user()->id;                
    //            // dd($payload);
    //            $productId = Product::create([
    //             'seller_item_code'                  =>$payload['seller_item_code'],
    //             'item_bar_code'                     =>$payload['item_bar_code'],
    //             'item_name'                         =>$payload['item_name'],
    //             'item_detail'                       =>$payload['item_detail'],
    //             'user_store_location_id'            =>$payload['user_store_location_id'],
    //             'provider_delivery_option_id'       =>$payload['provider_delivery_option_id'],
    //             'brand_id'                          =>$payload['brand_id'],
    //             'item_color'                        =>$payload['item_color'],
    //             'item_origin'                       =>$payload['item_origin'],
    //             'selling_unit'                      =>$payload['selling_unit'],
    //             'minimum_buying_quality_number'     =>$payload['minimum_buying_quality_number'],
    //             'minimum_buying_quality_unit'       =>$payload['minimum_buying_quality_unit'],
    //             'available_quantity_number'         =>$payload['available_quantity_number'],
    //             'available_quantity_unit'           =>$payload['available_quantity_unit'],
    //             'available_quantity_content_number' =>$payload['available_quantity_content_number'],
    //             'available_quantity_content_unit'   =>$payload['available_quantity_content_unit'],
    //             'related_links'                     =>$payload['related_links'],
    //             'user_id'                           =>$payload['user_id']

    //                     ])->id;
               
    //             if(isset($payload['packing_unit_checkbox'])){

    //                foreach ($payload['packing_append_div'] as $value) {
    //                     // dd($value);
    //                     $ProductPacking=  ProductPacking::Create([
    //                          'user_id'            => $payload['user_id'],
    //                          'product_id'         => $productId,
    //                          'each_content_unit'  => @$value['each_content_unit'],
    //                          'content_number'     => @$value['content_number'],
    //                          'content_unit'       => @$value['content_unit']
    //                          // 'to_unit'            => $value['to_unit']
    //                      ]);
    //                }  

    //                Product::where('id',$productId)->update([
    //                         'packing_unit_checkbox'    => $payload['packing_unit_checkbox']
    //                             ]); 
    //             }
    //            //  else{
    //            //     // has no records
    //            //      foreach ($payload['packing_append_div'] as $value) {

    //            //          $ProductPacking=  ProductPacking::Create([
    //            //               'user_id'            => $payload['user_id'],
    //            //               'product_id'         => $productId,
    //            //               'each_content_unit'  => $value['each_content_unit'],
    //            //               'content_number'     => $value['content_number'],
    //            //               'content_unit'       => $value['content_unit']
    //            //               // 'to_unit'            => $value['to_unit']
    //            //           ]);
    //            //      }
                
    //            // }

    //             // if(isset($payload['packing_unit_checkbox'])){
    //             //     Product::where('id',$productId)->update([
    //             //             'packing_unit_checkbox'    => $payload['packing_unit_checkbox']
    //             //                 ]);
    //             // }

    //            // foreach ($payload['packing_append_div'] as $value) {
    //            //   $ProductPacking=  ProductPacking::Create([
    //            //           'user_id'            => $payload['user_id'],
    //            //           'product_id'         => $productId,
    //            //           'each_content_unit'  => $value['each_content_unit'],
    //            //           'content_number'     => $value['content_number'],
    //            //           'content_unit'       => $value['content_unit']
    //            //       ]);
               
    //            // }    
    //                      // 'to_unit'            => $value['to_unit']

    //             $keywordArray = explode(',', $payload['Keywords']);
             
    //             if ($keywordArray!='') { 
    //                 foreach ($keywordArray as $value) {
    //                  ProductKeyword::Create([
    //                           'user_id'            => $payload['user_id'],
    //                           'product_id'         => $productId,
    //                           'keyword_name'        => $value
                              
    //                       ]);
    //                   }
    //             }

    //             if ($request['grade']!='') {
    //                 Product::where('id',$productId)->update([
    //                                     'grade'    => $payload['grade']
    //                                 ]);
    //              }


    //             if ($request['item_Arabic_detail']!='') {
    //                 Product::where('id',$productId)->update([
    //                                     'item_Arabic_detail'    => $payload['item_Arabic_detail']
    //                                 ]);
    //              }
                
    //             if ($request['item_name_arabic']!='') {
    //                 Product::where('id',$productId)->update([
    //                                     'item_name_arabic'    => $payload['item_name_arabic']
    //                                 ]);
    //              }

    //             if ($request['defualt_selling_unit_price']!='') {
    //                 Product::where('id',$productId)->update([
    //                                     'defualt_selling_unit_price'    => $payload['defualt_selling_unit_price']
    //                                 ]);
    //              }

    //             if ($request['quantity_order']!='') {
    //                 Product::where('id',$productId)->update([
    //                                     'quantity_order'    => $payload['quantity_order']
    //                                 ]);
    //              }

    //             if ($request['diameter_number']!='') {
    //                 Product::where('id',$productId)->update([
    //                                     'diameter_number'    => $payload['diameter_number']
    //                                 ]);
    //              }
    //             if ($request['diameter_unit']!='') {
    //                 Product::where('id',$productId)->update([
    //                                         'diameter_unit'    => $payload['diameter_unit']
    //                                     ]);
    //              }
    //            if ($request['length_number']!='') {
    //                 Product::where('id',$productId)->update([
    //                                         'length_number'    => $payload['length_number']
    //                                     ]);
    //              }    
    //             if ($request['length_unit']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'length_unit'   =>$payload['length_unit']
    //                                     ]);
    //              }    
    //              if($request['grade']!=''){
    //                product::where('id',$productId)->update([
    //                                         'grade' =>$payload['grade']
    //                                     ]);
    //              }

    //             if ($request['width_number']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'width_number'    =>$payload['width_number']
    //                                     ]);
    //              }
    //             if ($request['width_unit']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'width_unit'    =>$payload['width_unit']
    //                                     ]);
    //              }
    //             if ($request['depth_number']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'depth_number'    =>$payload['depth_number']
    //                                     ]);
    //              }
    //             if ($request['depth_unit']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'depth_unit'     =>$payload['depth_unit']
    //                                     ]);
    //              }
    //             if ($request['thickness_number']!='') {     
    //                 Product::where('id',$productId)->update([
    //                                         'thickness_number'     =>$payload['thickness_number']
    //                                     ]);
    //              }
    //             if ($request['thickness_unit']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'thickness_unit'    =>$payload['thickness_unit']
    //                                     ]);
    //              }
    //             if ($request['particle_number']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'particle_number'  =>$payload['particle_number']
    //                                     ]);
    //              }
    //             if ($request['particle_unit']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'particle_unit'     =>$payload['particle_unit']
    //                                          ]);
    //              }

    //             if ($request['height_number']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'height_number'     =>$payload['height_number']
    //                                          ]);
    //              }

    //             if ($request['height_unit']!='') {    
    //                 Product::where('id',$productId)->update([
    //                                         'height_unit'     =>$payload['height_unit']
    //                                          ]);
    //              }

    //              if ($request['criteria_name']!='') {    
    //                  Product::where('id',$productId)->update([
    //                                          'criteria_name'     =>$payload['criteria_name']
    //                                           ]);
    //               }

    //              if ($request['criteria_unit']!='') {    
    //                  Product::where('id',$productId)->update([
    //                                          'criteria_unit'     =>$payload['criteria_unit']
    //                                           ]);
    //               } 

    //               if ($request['default_plan']!='') {    
    //                   Product::where('id',$productId)->update([
    //                                           'default_plan'     =>$payload['default_plan']
    //                                            ]);
    //                } 


    //               $quantiyPrc= 'quantity_price';

    //              // dd("2");
    //             if($payload['quantity_order']==$quantiyPrc){
                 
    //                 foreach ($payload['price_firsrt_append_div'] as $key => $value) {
    //                     // $value = json_decode($value['from_number'], true);
    //                     // dd($value);
    //                     $productpricerange=  ProductPriceRange::Create([
    //                           'user_id'            => $payload['user_id'],
    //                           'product_id'         => $productId,
    //                           'from_number'        => $value['from_number'],
    //                           'from_unit'          => $value['from_unit'],
    //                           'to_number'          => $value['to_number'],
    //                           'to_unit'            => $value['to_unit'],
    //                           'selling_unit_price' => $value['selling_unit_price'],
    //                           'discount'           => $value['discount'],
    //                           'discount_type'      => $value['discount_type'],
    //                           'final_price'        => $value['final_price'],
    //                           'unit_price'         => $value['unit_price'] 
    //                     ]);

    //                     // if ($request['discount_type']!='') {
    //                     //     ProductPriceRange::where('id',$productpricerange['id'])->update([
    //                     //                         'discount_type'    => $payload['discount_type']
    //                     //                     ]);
    //                     //  }

    //                     // if ($request['discount_price']!='') {
    //                     //     ProductPriceRange::where('id',$productpricerange['id'])->update([
    //                     //                         'discount_price'    => $payload['discount_price']
    //                     //                     ]);
    //                     //  } 
                    
    //                 }    

    //             }else{

    //                 $updateProductPriceRange=  Product::where('id',$productId)
    //                                                    ->update([
    //                                                           'selling_unit_price' => $value['selling_unit_price'],
    //                                                           'discount'           => $value['discount'],
    //                                                           'discount_type'      => $value['discount_type'],
    //                                                           'final_price'        => $value['final_price'],
    //                                                           'unit_price'         => $value['unit_price'] 
    //                                                     ]);

                   
    //                 // if ($request['defualt_selling_unit_price']!='') {    
    //                 //    Product::where('id',$productId)->update([
    //                 //                            'defualt_selling_unit_price'    =>$payload['defualt_selling_unit_price']
    //                 //                        ]);
    //                 // }
    //                 // if ($request['defualt_unit_price']!='') {    
    //                 //     Product::where('id',$productId)->update([
    //                 //                             'defualt_unit_price'    =>$payload['defualt_unit_price']
    //                 //                         ]);
    //                 // }
                  

    //             }

               


    //             if($payload['default_plan']=='normal'){
    //                 // if(!empty($payload['selected_plan_id'])){
    //                 if ($request['default_plan']!='') {    
    //                     Product::where('id',$productId)->update([
    //                                              'default_plan'    =>'normal'
    //                                          ]);
    //                 }
                          
    //                 foreach($payload['plan_append_div'] as $key => $val) {
                                                                                          
    //                   ProductTermOfPayment::where('product_id',$productId)->create([
    //                                     'selected_plan_id'  => $val['selected_plan_id'],
    //                                     'default_plan'      => $payload['default_plan'],
    //                                     'user_id'           => $payload['user_id'],
    //                                     'from_price'        => $val['from_price'],
    //                                     'to_price'          => $val['to_price'],
    //                                     'range_type'        => $val['range_type'],
    //                                     'product_id'        => $productId
    //                                 ]);
    //                 }




    //             }else{

    //                  if ($request['default_plan']!='') {    
    //                      Product::where('id',$productId)->update([
    //                                              'default_plan'    =>'default'
    //                                          ]);
    //                   }
                          

    //                     ProductTermOfPayment::Create([
    //                                         'default_plan'     => $payload['default_plan'],
    //                                         'user_id'          => $payload['user_id'],
    //                                         'product_id'       => $productId
    //                                         // 'fixed_plan_id'    => $payload['fixed_plan_id']
    //                                     ]);
           
    //             }

 
                       
    //            foreach ($request['category_id'] as $categoryId) {
    //                 ProductSelectedCategory::Create([
    //                                     'user_id'        => $payload['user_id'],
    //                                     'product_id'     => $productId,
    //                                     'category_id'    => $categoryId
    //                                 ]);
    //             }      

    //            foreach ($request['sub_category_id'] as $subCategoryId) {
    //                 ProductSelectedSubcategory::Create([
    //                                     'user_id'        => $payload['user_id'],
    //                                     'product_id'     => $productId,
    //                                     'subcategory_id' => $subCategoryId
    //                                 ]);
    //             }  

            


    //             $mediaIds = explode(",",$payload['media_ids']);
    //             foreach ($mediaIds as $mediaId) {
    //                 $this->productImage->where('id', $mediaId)
    //                                     ->where('user_id', \Auth::user()->id)
    //                                     ->update(['product_id' => $productId,
    //                                                 'status' => 'complete']);
    //             }


    //             $specifications =   $this->productSpecification->where('user_id', \Auth::user()->id)
    //                                                                 ->whereNull('product_id')
    //                                                                 ->where('status', 'pending')
    //                                                                 ->get();

    //             foreach ($specifications as $specification) {
    //                 $specification->update([
    //                                         'product_id'=>$productId,
    //                                         'status'    => 'complete'
    //                                         ]);
    //             }

            
               
              
           
    //             Session::flash('success', 'Product added successfully');
    //             return redirect()->back();
    //         }

    //         $productCategories = ProductCategory::where('status', 'active')
    //                                             ->orderBy('name', 'asc')
    //                                             ->get();

    //         $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
    //                                                 ->where('user_id', \Auth::user()->id)
    //                                                 ->where('use_term_of_payment_as_default', 'yes')
    //                                                 ->first();
            

    //         $mawadCodeCount = Product::where('user_id', \Auth::user()->id)->count();
    //         $ItemNumber = $mawadCodeCount +1;
    //         $usreId = Auth::user()->id;
    //         $mawadCode ='BM-'.$usreId.'-'.$ItemNumber;  
            
    //         $sellerItemCode = User::where('id', \Auth::user()->id)->value('supplier_code');

    //         // $this->productWeight->where('user_id', \Auth::user()->id)
    //         //                     ->whereNull('product_id')
    //         //                     ->where('status', 'pending')
    //         //                     ->delete();

    //         // delete product specifications

    //         $productSpecifications = $this->productSpecification->where('user_id', \Auth::user()->id)
    //                                                             ->whereNull('product_id')
    //                                                             ->where('status', 'pending')
    //                                                             ->get()
    //                                                             ->toArray();

    //         if (isset($productSpecifications) && sizeof($productSpecifications)>0) {
    //             foreach ($productSpecifications as $key => $productSpecification) {
    //                 if($productSpecification['image'] != null && file_exists(productSpecificationImgsBasePath.'/'.$productSpecification['image']) ) {
    //                     unlink(productSpecificationImgsBasePath.'/'.$productSpecification['image']);
    //                 }
    //             }
    //         }

    //         $this->productSpecification->where('user_id', \Auth::user()->id)
    //                                     ->whereNull('product_id')
    //                                     ->where('status', 'pending')
    //                                     ->delete();

    //         // delete product images

    //         $productImages = $this->productImage->where('user_id', \Auth::user()->id)
    //                                             ->whereNull('product_id')
    //                                             ->where('status', 'pending')
    //                                             ->get()
    //                                             ->toArray();

    //         if (isset($productImages) && sizeof($productImages)>0) {
    //             foreach ($productImages as $key => $productImage) {
    //                 if($productImage['name'] != null && file_exists(productImgsBasePath.'/'.$productImage['name']) ) {
    //                     // dd('here');
    //                     unlink(productImgsBasePath.'/'.$productImage['name']);
    //                 }
    //             }
    //         }

    //         $this->productImage->where('user_id', \Auth::user()->id)
    //                             ->whereNull('product_id')
    //                             ->where('status', 'pending')
    //                             ->delete();

    //         ProductTermOfPayment::where('user_id', \Auth::user()->id)
    //                             ->whereNull('product_id')
    //                             ->delete();

    //         ProductPriceRange::where('user_id', \Auth::user()->id)
    //                             ->whereNull('product_id')
    //                             ->delete();

    //         $brandProducts   = ProductBrand::where('status','active')->get();   
    //         $brandColors     = ProductColor::where('status','active')->get();   
    //         $SellingUnits    = ProductSellingUnit::where('status','active')->get();   
    //         $Origins         = Country::where('status','active')->get();  
    //         $productUnits    = ProductUnit::where('status','active')->get();  
    //         $productGrades   = ProductGrade::where('status','active')->get();
    //         $term_of_payment = UserTermOfPayment::where('user_id',Auth::User()->id)->get()->toArray();

    //         $storeLocations = UserStoreLocation::where('user_id',Auth::user()->id)
    //                                              ->orderBy('id','desc')
    //                                              ->get()
    //                                              ->toArray();

    //         $providerDeliveryOptions = ProviderDeliveryOption::get()->toArray();
    //         // dd(Auth::user()->delivery_option_id);

    //         $sellingUnitGroups = SellingUnitGroup::where('status','active')
    //                                              ->whereHas('productSellingUnits',function($q){ $q->where('status','active'); })
    //                                              ->with(['productSellingUnits'=>function($q){ $q->orderBy('id','desc'); }])
    //                                              // ->with('productSellingUnits')
    //                                              ->get()
    //                                              ->toArray();   
    //         // dd($sellingUnitGroups);
    //         // $barCode = rand(1111111111,9999999999);
    //         return view('frontend.login.provider.products.add', compact('page', 'productCategories','mawadCode','termsOfPayments','brandProducts','brandColors','SellingUnits','Origins','term_of_payment','sellerItemCode','productUnits','productGrades','storeLocations','sellingUnitGroups','providerDeliveryOptions'));
    //         } catch (Exception $e) {
    //             dd($e);
    //             \Log::error($e->getMessage());
    //             Session::flash('error',trans('messages.frontend.common_error'));
    //             return redirect()->back();

    //         }
        
    // }

    public function addProduct(Request $request) {

        try{
            $page = 'product';
            // create product
            if($request->isMethod('post')) {
                $data = $request->all();
                $data['user_id'] = Auth::user()->id;  
                // dd('1');
                // dd($data);

                // $productId = 22;  
                // $keywordArray = explode(',', $data['Keywords']);             
                // // dd($keywordArray);
                // if ($keywordArray!='') { 
                //     foreach ($keywordArray as $keyword) {
                //         if (!empty($keyword)) {
                //             $keywordId = ProductKeyword::where('keyword_name',$keyword)->value('id');
                //             // dd($keywordId);
                //             if (empty($keywordId) || $keywordId==null) {
                //                 $keywordId = ProductKeyword::Create([
                //                                                     'user_id'            => $data['user_id'],
                //                                                     'product_id'         => $productId,
                //                                                     'keyword_name'       => $keyword  
                //                                                     ])->id;
                //             }

                //             $selectedKeywordId = ProductSelectedKeyword::where('user_id',$data['user_id'])
                //                                                 ->where('product_id',$productId)
                //                                                 ->where('product_keyword_id',$keywordId)
                //                                                 ->value('id');

                //             if (empty($selectedKeywordId) || $selectedKeywordId==null) {
                //                 ProductSelectedKeyword::Create([
                //                                                 'user_id'            => $data['user_id'],
                //                                                 'product_id'         => $productId,
                //                                                 'product_keyword_id' => $keywordId  
                //                                                 ])->id;
                //             }
                //         }
                //     }
                // }          
                // dd('one');
                
                // dd($data);
                $productId = Product::create([
                                            'user_id'                           =>$data['user_id'],
                                            'item_bar_code'                     =>$data['item_bar_code'],
                                            'item_name'                         =>@$data['item_name'],
                                            'item_name_arabic'                  =>@$data['item_name_arabic'],
                                            'seller_item_code'                  =>$data['seller_item_code'],
                                            'item_detail'                       =>@$data['item_detail'],
                                            'description_en'                    =>@$data['description_en'],
                                            'description_ar'                    =>@$data['description_ar'],
                                            'user_store_location_id'            =>$data['user_store_location_id'],
                                            'ribbon'                            =>@$data['ribbon'],
                                            // 'provider_delivery_option_id'    =>$data['provider_delivery_option_id'],   // not in use
                                            'product_brand_id'                  =>@$data['product_brand_id'],
                                            'product_color_id'                  =>@$data['product_color_id'],
                                            'country_id'                        =>@$data['country_id'],
                                            'product_grade_id'                  =>@$data['product_grade_id'],
                                            'diameter_number'                   =>@$data['diameter_number'],
                                            'diameter_unit_id'                  =>@$data['diameter_unit_id'],
                                            'length_number'                     =>@$data['length_number'],
                                            'length_unit_id'                    =>@$data['length_unit_id'],
                                            'width_number'                      =>@$data['width_number'],
                                            'width_unit_id'                     =>@$data['width_unit_id'],
                                            'depth_number'                      =>@$data['depth_number'],
                                            'depth_unit_id'                     =>@$data['depth_unit_id'],
                                            'height_number'                     =>@$data['height_number'],
                                            'height_unit_id'                    =>@$data['height_unit_id'],
                                            'thickness_number'                  =>@$data['thickness_number'],
                                            'thickness_unit_id'                 =>@$data['thickness_unit_id'],
                                            'particle_number'                   =>@$data['particle_number'],
                                            'particle_unit_id'                  =>@$data['particle_unit_id'],
                                            'selling_unit_id'                   =>@$data['selling_unit_id'],
                                            'minimum_buying_quantity_number'    =>@$data['minimum_buying_quantity_number'],
                                            'minimum_buying_quantity_unit_id'   =>@$data['minimum_buying_quantity_unit_id'],
                                            'available_quantity_number'         =>@$data['available_quantity_number'],
                                            'available_quantity_unit_id'        =>@$data['available_quantity_unit_id'],
                                            'available_quantity_content_number' =>@$data['available_quantity_content_number'],
                                            'available_quantity_content_unit_id'=>@$data['available_quantity_content_unit_id'],
                                            'is_packing_unit_checked'           =>@$data['is_packing_unit_checked'],
                                            'price_type'                        =>@$data['price_type'],
                                            'term_of_payment_type'              =>@$data['term_of_payment_type'],
                                            'has_special_delivery_condition'    =>@$data['has_special_delivery_condition'],
                                            'special_delivery_condition_type'   =>@$data['special_delivery_condition_type'],
                                            // 'related_links'                     =>$data['related_links'],  // should be multiple
                                        ])->id;

                $keywordArray = explode(',', $data['Keywords']);             
                // dd($keywordArray);
                if ($keywordArray!='') { 
                    foreach ($keywordArray as $keyword) {
                        if (!empty($keyword)) {
                            $keywordId = ProductKeyword::where('keyword_name',$keyword)->value('id');
                            // dd($keywordId);
                            if (empty($keywordId) || $keywordId==null) {
                                $keywordId = ProductKeyword::Create([
                                                                    'user_id'            => $data['user_id'],
                                                                    'product_id'         => $productId,
                                                                    'keyword_name'       => $keyword  
                                                                    ])->id;
                            }

                            $selectedKeywordId = ProductSelectedKeyword::where('user_id',$data['user_id'])
                                                                ->where('product_id',$productId)
                                                                ->where('product_keyword_id',$keywordId)
                                                                ->value('id');

                            if (empty($selectedKeywordId) || $selectedKeywordId==null) {
                                ProductSelectedKeyword::Create([
                                                                'user_id'            => $data['user_id'],
                                                                'product_id'         => $productId,
                                                                'product_keyword_id' => $keywordId  
                                                                ])->id;
                            }
                        }
                    }
                } 

                if (isset($data['product_keyword_ids']) && sizeof($data['product_keyword_ids'])>0) {

                    $selectedKeywordIds = ProductSelectedKeyword::where('user_id',$data['user_id'])
                                                            ->where('product_id',$productId)
                                                            ->pluck('product_keyword_id')
                                                            ->toArray();

                    foreach ($data['product_keyword_ids'] as $key => $productKeywordId) {
                        if (!empty($productKeywordId) && !in_array($productKeywordId, $selectedKeywordIds)) {
                            ProductSelectedKeyword::Create([
                                                            'user_id'            => $data['user_id'],
                                                            'product_id'         => $productId,
                                                            'product_keyword_id' => $productKeywordId  
                                                            ])->id;
                        }
                    }
                }

                // dd('here2');

                $relatedLinkArray = explode(',', $data['related_links']);             
                if ($relatedLinkArray!='') { 
                    foreach ($relatedLinkArray as $link) {
                        if(!empty($link)){
                            ProductRelatedLink::Create([
                                                    'user_id'            => $data['user_id'],
                                                    'product_id'         => $productId,
                                                    'link'               => $link      
                                                ]);
                        }
                    }
                }

                foreach ($request['category_id'] as $categoryId) {
                    if (!empty($categoryId)) {
                        ProductSelectedCategory::Create([
                                            'user_id'        => $data['user_id'],
                                            'product_id'     => $productId,
                                            'category_id'    => $categoryId
                                        ]);
                    }
                }      

                foreach ($request['sub_category_id'] as $subCategoryId) {
                    if (!empty($subCategoryId)) {
                        ProductSelectedSubcategory::Create([
                                            'user_id'        => $data['user_id'],
                                            'product_id'     => $productId,
                                            'subcategory_id' => $subCategoryId
                                        ]);
                    }
                }

                if ($data['type_of_material_id'] && sizeof($data['type_of_material_id'])>0) {
                    foreach ($request['type_of_material_id'] as $typeOfMaterialId) {
                        if (!empty($typeOfMaterialId)) {
                            ProductSelectedSellingMaterial::Create([
                                                'user_id'        => $data['user_id'],
                                                'product_id'     => $productId,
                                                'product_selling_material_id' => $typeOfMaterialId
                                            ]);
                        }
                    }
                }

                $mediaIds = explode(",",$data['media_ids']);
                foreach ($mediaIds as $mediaId) {
                    $this->productImage->where('id', $mediaId)
                                        ->where('user_id', \Auth::user()->id)
                                        ->update([
                                                'product_id' => $productId,
                                                'status' => 'complete'
                                                ]);
                }

                $specifications =   $this->productSpecification->where('user_id', \Auth::user()->id)
                                                                    ->whereNull('product_id')
                                                                    ->where('status', 'pending')
                                                                    ->get();

                foreach ($specifications as $specification) {
                    $specification->update([
                                            'product_id'=>$productId,
                                            'status'    => 'complete'
                                            ]);
                }

                if(isset($data['new_option_div']) && sizeof($data['new_option_div'])>0){
                    foreach ($data['new_option_div'] as $newOption) {
                        if (!empty($newOption['title']) && !empty($newOption['value']) && !empty($newOption['option_type'])) {
                            $ProductPacking=  ProductNewOption::Create([
                                                                        'product_id'         => $productId,
                                                                        'title'  => @$newOption['title'],
                                                                        'value'     => @$newOption['value'],
                                                                        'option_type'       => @$newOption['option_type'],
                                                                        'product_selling_unit_id'       => @$newOption['product_selling_unit_id']
                                                                    ]);
                        }
                    }  
                }

                if(isset($data['is_packing_unit_checked']) && $data['is_packing_unit_checked']=='yes'){
                    foreach ($data['packing_append_div'] as $packing) {
                        if (!empty($packing['each_content_unit_id']) && !empty($packing['content_number']) && !empty($packing['content_unit_id'])) {
                            $ProductPacking = ProductPacking::Create([
                                 'user_id'             => $data['user_id'],
                                 'product_id'          => $productId,
                                 'each_content_unit_id'=> @$packing['each_content_unit_id'],
                                 'content_number'      => @$packing['content_number'],
                                 'content_unit_id'     => @$packing['content_unit_id']
                            ]);
                        }
                    } 
                }

                if($data['price_type']=='according_to_ordered_quantity') {                 
                    foreach ($data['price_firsrt_append_div'] as $key => $priceRange) {
                        if (is_int($key)) {
                            $productpricerange=  ProductPriceRange::Create([
                                                                            'user_id'            => $data['user_id'],
                                                                            'product_id'         => $productId,
                                                                            "from_number"        => $priceRange['from_number'],
                                                                            'from_unit_id'       => $priceRange['from_unit_id'],
                                                                            'to_number'          => $priceRange['to_number'],
                                                                            'to_unit_id'         => $priceRange['to_unit_id'],
                                                                            'selling_unit_price' => $priceRange['selling_unit_price'],
                                                                            'discount'           => $priceRange['discount'],
                                                                            'discount_type'      => $priceRange['discount_type'],
                                                                            'final_price'        => $priceRange['final_price'],
                                                                            'unit_price'         => $priceRange['unit_price'] 
                                                                        ]);
                        }
                    
                    }    
                }else{     
                    $productpricerange=  ProductPriceRange::Create([
                                                                    'user_id'            => $data['user_id'],
                                                                    'product_id'         => $productId,
                                                                    'selling_unit_price' => $data['price_firsrt_append_div']['selling_unit_price'],
                                                                    'discount'           => $data['price_firsrt_append_div']['discount'],
                                                                    'discount_type'      => $data['price_firsrt_append_div']['discount_type'],
                                                                    'final_price'        => $data['price_firsrt_append_div']['final_price'],
                                                                    'unit_price'         => $data['price_firsrt_append_div']['unit_price'] 
                                                                ]);        

                } 

                if(isset($data['term_of_payment_type']) && $data['term_of_payment_type']=='according_to_order_amount' && isset($data['plan_append_div']) && sizeof($data['plan_append_div'])>0){                          
                    foreach($data['plan_append_div'] as $key => $termOfPayment) {
                        if ($termOfPayment['from_price']!=null && $termOfPayment['to_price']!=null && $termOfPayment['selected_plan_id']!=null) {
                            ProductTermOfPayment::create([
                                                        'user_id'           => $data['user_id'],
                                                        'product_id'        => $productId,
                                                        'from_price'        => $termOfPayment['from_price'],
                                                        'to_price'          => $termOfPayment['to_price'],
                                                        'range_type'        => $termOfPayment['range_type'],
                                                        'selected_plan_id'  => $termOfPayment['selected_plan_id'],
                                                    ]);                            
                        }                                                                                          
                    }
                }

                if(isset($data['special_delivery_condition_type']) && $data['special_delivery_condition_type']=='according_to_order_amount' && isset($data['according_to_order_amount_div']) && sizeof($data['according_to_order_amount_div'])>0){
                    foreach ($data['according_to_order_amount_div'] as $splDelvFee) {
                        if (!empty($splDelvFee['from_price']) && !empty($splDelvFee['to_price'])) {
                            $splDelFee =  ProductSpecialDeliveryFee::Create([
                                                                        'user_id'       => $data['user_id'],
                                                                        'product_id'    => $productId,
                                                                        'from_price'    => @$splDelvFee['from_price'],
                                                                        'to_price'      => @$splDelvFee['to_price'],
                                                                        'delivery_type' => @$splDelvFee['delivery_type'],
                                                                        'amount'        => @$splDelvFee['amount']
                                                                    ]);
                        }
                    }  
                }
                // dd('here1');
                
                // if ($request['grade']!='') {
                //     Product::where('id',$productId)->update([
                //                         'grade'    => $data['grade']
                //                     ]);
                // }


                // if ($request['item_Arabic_detail']!='') {
                //     Product::where('id',$productId)->update([
                //                         'item_Arabic_detail'    => $data['item_Arabic_detail']
                //                     ]);
                // }
                
                // if ($request['item_name_arabic']!='') {
                //     Product::where('id',$productId)->update([
                //                         'item_name_arabic'    => $data['item_name_arabic']
                //                     ]);
                // }

                // if ($request['defualt_selling_unit_price']!='') {
                //     Product::where('id',$productId)->update([
                //                         'defualt_selling_unit_price'    => $data['defualt_selling_unit_price']
                //                     ]);
                //  }

                // if ($request['quantity_order']!='') {
                //     Product::where('id',$productId)->update([
                //                         'quantity_order'    => $data['quantity_order']
                //                     ]);
                //  }

               //  if ($request['diameter_number']!='') {
               //      Product::where('id',$productId)->update([
               //                          'diameter_number'    => $data['diameter_number']
               //                      ]);
               //   }
               //  if ($request['diameter_unit']!='') {
               //      Product::where('id',$productId)->update([
               //                              'diameter_unit'    => $data['diameter_unit']
               //                          ]);
               //   }
               // if ($request['length_number']!='') {
               //      Product::where('id',$productId)->update([
               //                              'length_number'    => $data['length_number']
               //                          ]);
               //   }    
               //  if ($request['length_unit']!='') {    
               //      Product::where('id',$productId)->update([
               //                              'length_unit'   =>$data['length_unit']
               //                          ]);
               //   }    
                 // if($request['grade']!=''){
                 //   product::where('id',$productId)->update([
                 //                            'grade' =>$data['grade']
                 //                        ]);
                 // }

                // if ($request['width_number']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'width_number'    =>$data['width_number']
                //                         ]);
                //  }
                // if ($request['width_unit']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'width_unit'    =>$data['width_unit']
                //                         ]);
                //  }
                // if ($request['depth_number']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'depth_number'    =>$data['depth_number']
                //                         ]);
                //  }
                // if ($request['depth_unit']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'depth_unit'     =>$data['depth_unit']
                //                         ]);
                //  }
                // if ($request['thickness_number']!='') {     
                //     Product::where('id',$productId)->update([
                //                             'thickness_number'     =>$data['thickness_number']
                //                         ]);
                //  }
                // if ($request['thickness_unit']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'thickness_unit'    =>$data['thickness_unit']
                //                         ]);
                //  }
                // if ($request['particle_number']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'particle_number'  =>$data['particle_number']
                //                         ]);
                //  }
                // if ($request['particle_unit']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'particle_unit'     =>$data['particle_unit']
                //                              ]);
                //  }

                // if ($request['height_number']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'height_number'     =>$data['height_number']
                //                              ]);
                //  }

                // if ($request['height_unit']!='') {    
                //     Product::where('id',$productId)->update([
                //                             'height_unit'     =>$data['height_unit']
                //                              ]);
                //  }

                //  if ($request['criteria_name']!='') {    
                //      Product::where('id',$productId)->update([
                //                              'criteria_name'     =>$data['criteria_name']
                //                               ]);
                //   }

                //  if ($request['criteria_unit']!='') {    
                //      Product::where('id',$productId)->update([
                //                              'criteria_unit'     =>$data['criteria_unit']
                //                               ]);
                //   } 

                  // if ($request['default_plan']!='') {    
                  //     Product::where('id',$productId)->update([
                  //                             'default_plan'     =>$data['default_plan']
                  //                              ]);
                  //  } 


                

               


                // if($data['default_plan']=='normal'){
                //     // if(!empty($data['selected_plan_id'])){
                //     if ($request['default_plan']!='') {    
                //         Product::where('id',$productId)->update([
                //                                  'default_plan'    =>'normal'
                //                              ]);
                //     }
                          
                //     foreach($data['plan_append_div'] as $key => $val) {
                                                                                          
                //       ProductTermOfPayment::where('product_id',$productId)->create([
                //                         'selected_plan_id'  => $val['selected_plan_id'],
                //                         'default_plan'      => $data['default_plan'],
                //                         'user_id'           => $data['user_id'],
                //                         'from_price'        => $val['from_price'],
                //                         'to_price'          => $val['to_price'],
                //                         'range_type'        => $val['range_type'],
                //                         'product_id'        => $productId
                //                     ]);
                //     }




                // }else{

                //      if ($request['default_plan']!='') {    
                //          Product::where('id',$productId)->update([
                //                                  'default_plan'    =>'default'
                //                              ]);
                //       }
                          

                //         ProductTermOfPayment::Create([
                //                             'default_plan'     => $data['default_plan'],
                //                             'user_id'          => $data['user_id'],
                //                             'product_id'       => $productId
                //                             // 'fixed_plan_id'    => $data['fixed_plan_id']
                //                         ]);
           
                // }               
              
           
                Session::flash('success', 'Product added successfully');
                // return redirect()->back();
                return redirect('/provider/products/list');
            }

            $productCategories = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();

            $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();
            

            $mawadCodeCount = Product::where('user_id', \Auth::user()->id)->count();
            $ItemNumber = $mawadCodeCount +1;
            $usreId = Auth::user()->id;
            $mawadCode ='BM-'.$usreId.'-'.$ItemNumber;  
            
            $sellerItemCode = User::where('id', \Auth::user()->id)->value('supplier_code');

            // $this->productWeight->where('user_id', \Auth::user()->id)
            //                     ->whereNull('product_id')
            //                     ->where('status', 'pending')
            //                     ->delete();

            // delete product specifications

            $productSpecifications = $this->productSpecification->where('user_id', \Auth::user()->id)
                                                                ->whereNull('product_id')
                                                                ->where('status', 'pending')
                                                                ->get()
                                                                ->toArray();

            if (isset($productSpecifications) && sizeof($productSpecifications)>0) {
                foreach ($productSpecifications as $key => $productSpecification) {
                    if($productSpecification['image'] != null && file_exists(productSpecificationImgsBasePath.'/'.$productSpecification['image']) ) {
                        unlink(productSpecificationImgsBasePath.'/'.$productSpecification['image']);
                    }
                }
            }

            $this->productSpecification->where('user_id', \Auth::user()->id)
                                        ->whereNull('product_id')
                                        ->where('status', 'pending')
                                        ->delete();

            // delete product images

            $productImages = $this->productImage->where('user_id', \Auth::user()->id)
                                                ->whereNull('product_id')
                                                ->where('status', 'pending')
                                                ->get()
                                                ->toArray();

            if (isset($productImages) && sizeof($productImages)>0) {
                foreach ($productImages as $key => $productImage) {
                    if($productImage['name'] != null && file_exists(productImgsBasePath.'/'.$productImage['name']) ) {
                        // dd('here');
                        unlink(productImgsBasePath.'/'.$productImage['name']);
                    }
                }
            }

            $this->productImage->where('user_id', \Auth::user()->id)
                                ->whereNull('product_id')
                                ->where('status', 'pending')
                                ->delete();

            ProductTermOfPayment::where('user_id', \Auth::user()->id)
                                ->whereNull('product_id')
                                ->delete();

            ProductPriceRange::where('user_id', \Auth::user()->id)
                                ->whereNull('product_id')
                                ->delete();

            ProductSpecialDeliveryFee::where('user_id', \Auth::user()->id)
                                        ->whereNull('product_id')
                                        ->delete();

            $SellingUnits    = ProductSellingUnit::where('status','active')->get();   
            $productUnits    = ProductUnit::where('status','active')->get();  
            $term_of_payment = UserTermOfPayment::where('user_id',Auth::User()->id)->get()->toArray();

            $storeLocations = UserStoreLocation::where('user_id',Auth::user()->id)
                                                 ->orderBy('id','desc')
                                                 ->get()
                                                 ->toArray();

            $providerDeliveryOptions = ProviderDeliveryOption::get()->toArray();
            // dd(Auth::user()->delivery_option_id);
            // dd('here');
            // $sellingUnitGroups = SellingUnitGroup::where('status','active')
            //                                      ->whereHas('productSellingUnits',function($q){ $q->where('status','active'); })
            //                                      ->with(['productSellingUnits'=>function($q){ $q->orderBy('id','desc'); }])
            //                                      // ->with('productSellingUnits')
            //                                      ->get()
            //                                      ->toArray();  
            // dd('there');
            $products = Product::where('type','product')
                                ->where('status','active')
                                ->orderBy('id','desc')
                                ->select('id','type','item_name','item_name_arabic','item_detail','item_Arabic_detail','status')
                                ->get()
                                ->toArray();

            $productKeywords = ProductKeyword::where('status', 'active')
                                              ->select('id','keyword_name','status')
                                              ->orderBy('keyword_name', 'asc')
                                              ->get()
                                              ->toArray();
                                              
            $brandProducts   = ProductBrand::where('status','active')->get();   
            $brandColors     = ProductColor::where('status','active')->get();   
            $Origins         = Country::where('status','active')->get();  
            $productGrades   = ProductGrade::where('status','active')->get();
            // dd($productKeywords); 
            return view('frontend.login.provider.products.add', compact('page', 'productCategories','mawadCode','termsOfPayments','brandProducts','brandColors','SellingUnits','Origins','term_of_payment','sellerItemCode','productUnits','productGrades','storeLocations','providerDeliveryOptions','products','productKeywords'));
        } catch (Exception $e) {
            // dd($e);
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
        
    }

   
    /**
     * Get Sub Categories
     * @param  Request $request 
     * @return view           
     */
    public function getSubCategories(Request $request) {

        $page = 'product';
        $subCategories = $this->subCategory->whereIn('category_id', $request->input('categoryId'))->get();
        $typeOfMaterials = $this->productSellingMaterial->whereIn('product_category_id', $request->input('categoryId'))->get();
        // dd($typeOfMaterials);
        $view1 = view('frontend.login.provider.element.productSubCategories', compact('page', 'subCategories'))->render();
        $view2 = view('frontend.login.provider.element.productSellingMaterials', compact('page', 'typeOfMaterials'))->render();
        // return view('frontend.login.provider.element.productSubCategories', compact('page', 'subCategories'))->render(); 
        return array('view1'=>$view1, 'view2'=>$view2);
    }

    /**
     * Get Type of Materials
     * @param  Request $request 
     * @return view           
     */
    public function getTypeOfMaterials(Request $request) {

        $page = 'product';
        // $subCategories = $this->subCategory->whereIn('category_id', $request->input('categoryId'))->get();
        $typeOfMaterials = $this->productSellingMaterial
                                ->whereIn('product_category_id', $request->input('categoryId'));
        if ($request->input('subCategoryId') && !empty($request->input('subCategoryId'))) {
            $typeOfMaterials = $typeOfMaterials->whereIn('product_sub_category_id', $request->input('subCategoryId'));
        }
        $typeOfMaterials = $typeOfMaterials->get();
        // dd($typeOfMaterials);
        // $view1 = view('frontend.login.provider.element.productSubCategories', compact('page', 'subCategories'))->render();
        $view2 = view('frontend.login.provider.element.productSellingMaterials', compact('page', 'typeOfMaterials'))->render();
        // return view('frontend.login.provider.element.productSubCategories', compact('page', 'subCategories'))->render(); 
        return array('view2'=>$view2);
    }

     public function deleteProductPriceRange(Request $request,$id){
        // $data =$request->all(); 
        // dd($id);

        $ProductPriceRange = ProductPriceRange::where('id',$id)->delete();
        // $response = [];
        $response['status'] = 'true';
        // $response['msg'] = ' deleted successfully';
        
        return $response;
    }

    /**
     * Add Weight
     * @param Request $request 
     * @return view
     */
    public function addWeight(Request $request)
    {
        $price = 0;
        $page = 'product';
        $payload = $request->all();
        $payload['user_id'] = \Auth::user()->id;
        if($payload['price']) {
            $price = $payload['price'];
        }
        $payload['per_unit_price'] = $price;
        $payload['price'] = $price * $payload['pcs'];
        $this->productWeight->create($payload);

        $productWeights = $this->productWeight->whereNull('product_id')
                                                ->where('status', 'pending')
                                                ->get();

        return view('frontend.login.provider.element.productWeight', compact('page', 'productWeights'))->render();
    }

    /**
     * Add Specification 
     * @param Request $request 
     * @return  view render 
     */
    public function addSpecification(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;
        // dd($data);
        if(isset($data['image']) && !empty($data['image'])){
            // dd($data);
            $image = $request->file('image');
            $ext = strtolower($image->getClientOriginalExtension());
            // dd($ext);
            $data['image'] = time().'_'.rand().'.'.$ext;
            $destination_path = productSpecificationImgsBasePath;
            // dd($destination_path);
            if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp' || $ext == 'doc' || $ext == 'docx' || $ext == 'pdf'){
                // $image = Image::make($request->file('image'));
                // $image = $image->resize(600,null,function($constraint){
                //         $constraint->aspectRatio();
                //         $constraint->upsize();
                //     });
                // $image->save($destination_path.$data['image']);
                $image->move(productSpecificationImgsBasePath, $data['image']);
            }else{
                return array('status'=>'error');
            }
            
        }else{
            $data['image'] = null;
        }
        // dd($data['image']);
        $this->productSpecification->create($data);

        $specifications = $this->productSpecification->whereNull('product_id')
                                                        ->where('status', 'pending')
                                                        ->get();
        // dd($specifications);        
        return view('frontend.login.provider.element.productSpecification', compact('page', 'specifications'))->render();
    }

    public function deleteSpecification(Request $request,$id) {

        $id   = $request->id;
        // dd($id);
        $delete_spec = $this->productSpecification->where(['id' => base64_decode($id)])->first();
        // dd($delete_spec);
        if($delete_spec->image != null){
            if(file_exists('public/frontend/images/products/specifications/'.$delete_spec->image)){
                unlink(productSpecificationImgsBasePath.$delete_spec->image);
            }
        } 
        $delete_spec->delete();
        return ['status'=>'success'];
    }

    public function uploadProductImage(Request $request)
    {
        if($request->isMethod('post')){
            $payload = [];
            if($productId = $request->input('product_id')){
                $payload['product_id'] = $productId;
            }
            $payload['user_id'] = \Auth::user()->id;
            if($request->hasfile('file')) { 
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename =time().'.'.$extension;
                // dd($file);
                $file->move(productImgsBasePath, $filename);
                $payload['name'] = $filename;
            }
            $imgId = $this->productImage->create($payload)->id;
            $file_type = 'image';
            // dd($add_image);
            return $response = array('status' => 'success', 'img_id' => $imgId, 'img_name' => $filename, 'file_type' => $file_type);            
        }
    }

   

    public function deleteProductImage(Request $request)
    {
        if($request->isMethod('post')){
            if($request->file_id) {
                $delete_image = $this->productImage->where(['id' => $request->file_id])->first();
            } else {
                $delete_image = $this->productImage->where(['name' => $request->removename])->first();
            }
            // dd($delete_image);
            if($delete_image != null){
                if(file_exists('public/frontend/images/products/'.$delete_image->name)){
                    unlink(productImgsBasePath.$delete_image->name);
                }
                $delete_image->delete();
            }  

            return $response = array('status' => 'success', 'result' => $delete_image);            
        }
    }

    public function uploadProductDocument(Request $request)
    {
        if($request->isMethod('post')){
            $payload = [];
            if($productId = $request->input('product_id')){
                $payload['product_id'] = $productId;
            }
            $payload['user_id'] = \Auth::user()->id;
            if($request->hasfile('file')) { 
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename =time().'.'.$extension;
                // dd($file);
                $file->move(productDocumentBasePath, $filename);
                $payload['name'] = $filename;
            }
            $imgId = $this->productImage->create($payload)->id;
            $file_type = 'image';
            // dd($add_image);
            return $response = array('status' => 'success', 'img_id' => $imgId, 'img_name' => $filename, 'file_type' => $file_type);            
        }
    }

    public function deleteProductDocument(Request $request)
    {
        if($request->isMethod('post')){
            if($request->file_id) {
                $delete_image = $this->productImage->where(['id' => $request->file_id])->first();
            } else {
                $delete_image = $this->productImage->where(['name' => $request->removename])->first();
            }
            // dd($delete_image);
            if($delete_image != null){
                if(file_exists('public/frontend/images/productDocument/'.$delete_image->name)){
                    unlink(productDocumentBasePath.$delete_image->name);
                }
                $delete_image->delete();
            }  

            return $response = array('status' => 'success', 'result' => $delete_image);            
        }
    }

    /**
     * Delete Product
     * @param  Request $request 
     * @param  string  $id      
     * @return array           
     */
    public function deleteProduct(Request $request,$id)
    {

        $id   = $request->id;
        $data = $this->product->where('id',$id)->delete();

        ProductSpecification::where('product_id',$id)->delete();

        ProductImage::where('product_id',$id)->delete();

        ProductSelectedCategory::where('product_id',$id)->delete();

        ProductSelectedSubcategory::where('product_id',$id)->delete();

        ProductPriceRange::where('product_id',$id)->delete();

        ProductTermOfPayment::where('product_id',$id)->delete();
                 
        Session::flash('success','Product deleted successfully');

        return ['status'=>'success'];
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
                $statusChanged = $this->product->where('id', $request->id)->update(['status' => $request->status]);
                $product = $this->product->where('id', $request->id)->first();
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

    /**
     * View Product
     * @param  Request $request
     * @param  string  $id     
     * @return view     
     */
    // public function viewProduct(Request $request, $id)
    // {
    //    try {          
           
    //         $page = 'product';

    //         return view('frontend.login.provider.products.view',compact('page'));
            
    //         $product = $this->product->with(['productselectedcategory','productselectedsubcategory','productpricerange','productSpecification','producttermofpayment.planName','notselectedplanName.planName','productkeyword','productpacking','productImage'])->where('id', Crypt::decrypt($id))->first();


    //         $subCategories = $this->subCategory->where('status', 'active')
    //                                                                 ->orderBy('name', 'asc')
    //                                                                 ->get();

    //         $supplierCode = $this->user->where('id', \Auth::user()->id)->pluck('supplier_code')->first();
            
    //         $productCategories   = ProductCategory::where('status', 'active')
    //                                             ->orderBy('name', 'asc')
    //                                             ->get();
            
    //         $productSubCategories = ProductSubCategory::where('status', 'active')
    //                                            ->orderBy('name', 'asc')
    //                                            ->get();

    //         $brandProducts = ProductBrand::get();   
    //         $brandColors   = ProductColor::get();   
    //         $SellingUnits  = ProductSellingUnit::get();   
    //         $Origins       = Country::get();  

    //         $brandProducts   = ProductBrand::where('status','active')->get();   
    //         $brandColors     = ProductColor::where('status','active')->get();   
    //         $SellingUnits    = ProductSellingUnit::where('status','active')->get();   
    //         $Origins         = Country::where('status','active')->get();  
    //         $productUnits    = ProductUnit::where('status','active')->get();  


    //         $term = ProductTermOfPayment::where('user_id',Auth::User()->id)->where('product_id', Crypt::decrypt($id))->where('selected_plan_id' ,'!=',null)->pluck('selected_plan_id')->toArray();
           
    //         $term_of_payment = UserTermOfPayment::where('user_id',Auth::User()->id)->get()->toArray();   


    //         $slcted_plan_id = [];
    //            if(!empty($product)){
    //                $product = $product->toArray();
    //                $slcted_plan_id = array_map(function($v){ return $v['selected_plan_id']; }, $product['producttermofpayment']);
    //            }

    //          $slcted_category_id = [];
    //             if(!empty($product)){
    //                 $slcted_category_id = array_map(function($v){ return $v['category_id']; }, $product['productselectedcategory']);
    //             }
    //          $prdctCategory =  ProductCategory::whereIn('id',$slcted_category_id)->pluck('name')->toArray();

    //          $productCategoryImplode = implode(", ",$prdctCategory);



    //          $slcted_Subcategory_id = [];
    //             if(!empty($product)){
    //                 $slcted_Subcategory_id = array_map(function($v){ return $v['subcategory_id']; }, $product['productselectedsubcategory']);
    //             }

    //         $prdctSubCategory =  ProductSubCategory::whereIn('id',$slcted_Subcategory_id)->pluck('name')->toArray();

    //         $productSubCategoryImplode = implode(", ",$prdctSubCategory);    



    //        $keywordData = ProductKeyword::where('product_id',Crypt::decrypt($id))->pluck('keyword_name')->toArray();
    //         $keyword = implode(", ",$keywordData);

    //        $diameter_unit  = ProductSellingUnit::where('id',$product['diameter_unit_id'])->value('name');
    //        $length_unit    = ProductSellingUnit::where('id',$product['length_unit_id'])->value('name');
    //        $width_unit     = ProductSellingUnit::where('id',$product['width_unit_id'])->value('name');
    //               // echo '<pre>'; print_r($width_unit);die;
    //        $depth_unit     = ProductSellingUnit::where('id',$product['depth_unit_id'])->value('name');
    //        $thickness_unit = ProductSellingUnit::where('id',$product['thickness_unit_id'])->value('name');
    //        $particle_unit  = ProductSellingUnit::where('id',$product['particle_unit_id'])->value('name');
    //        $height_unit    = ProductSellingUnit::where('id',$product['height_unit_id'])->value('name');
    //        // $criteria_unit  = ProductSellingUnit::where('id',$product['criteria_unit_id'])->value('name');

    //        $dbProductImages = ProductImage::where('user_id', \Auth::user()->id)
    //                ->where('product_id', Crypt::decrypt($id))
    //                ->get();
          
    //         $productGrades   = ProductGrade::where('status','active')->get();
    //        $term_of_payment = UserTermOfPayment::where('user_id',Auth::User()->id)->get()->toArray();
    //         // dd('here');
    //        return view('frontend.login.provider.products.view',compact('page', 'product','productCategories','productSubCategories','mawadCode','supplierCode','subCategories','brandColors','SellingUnits','Origins','term_of_payment','slcted_plan_id','defaultplan','slcted_Subcategory_id','slcted_category_id','brandProducts','keyword','productCategoryImplode','productSubCategoryImplode','diameter_unit','length_unit','width_unit','depth_unit','thickness_unit','particle_unit','height_unit','criteria_unit','dbProductImages','productUnits'));
    //     } catch (Exception $e) {
    //         dd($e);
    //         \Log::error($e->getMessage());
    //         Session::flash('error',trans('messages.frontend.common_error'));
    //         return redirect()->back();
    //     }      
    // }

    /**
     * View Product
     * @param  Request $request
     * @param  string  $id     
     * @return view     
     */
    public function viewProduct(Request $request, $id)
    {
       try {          
           
            $page = 'product';
            
            $product = Product::with(['userDetail'=>function($q){
                $q->select('id','supplier_code','contact_name','contact_last_name');
            },'productSpecifications','productSelectedCategories.productCategoryDetail'=>function($q){
                $q->select('id','name');
            },'productSelectedSubCategories.productSubCategoryDetail'=>function($q){
                $q->select('id','name');
            },'productSelectedSellingMaterials.productSellingMaterialDetail'=>function($q){
                $q->select('id','selling_material_name');
            },'productImages','productRelatedLinks','productSelectedKeywords.productKeywordDetail'=>function($q){
                $q->select('id','keyword_name');
            },'userStoreLocationDetail'=>function($q){
                $q->select('id','store_name');
            },'productBrandDetail'=>function($q){
                $q->select('id','brand_name');
            },'productColorDetail'=>function($q){
                $q->select('id','name');
            },'countryDetail'=>function($q){
                $q->select('id','name');
            },'productGradeDetail'=>function($q){
                $q->select('id','grade_name');
            },'diameterUnitDetail'=>function($q){
                $q->select('id','name');
            },'lengthUnitDetail'=>function($q){
                $q->select('id','name');
            },'widthUnitDetail'=>function($q){
                $q->select('id','name');
            },'depthUnitDetail'=>function($q){
                $q->select('id','name');
            },'heightUnitDetail'=>function($q){
                $q->select('id','name');
            },'thicknessUnitDetail'=>function($q){
                $q->select('id','name');
            },'particleUnitDetail'=>function($q){
                $q->select('id','name');
            },'productNewOptions.productSellingUnitDetail'=>function($q){
                $q->select('id','name');
            },'sellingUnitDetail'=>function($q){
                $q->select('id','name');
            },'availableQuantityUnitDetail'=>function($q){
                $q->select('id','name');
            },'availableQuantityContentUnitDetail'=>function($q){
                $q->select('id','name');
            },'minimumBuyingQuantityUnitDetail'=>function($q){
                $q->select('id','name');
            },'productPackings.eachContentUnitDetail','productPackings.contentUnitDetail','productPriceRanges.fromUnitDetail','productPriceRanges.toUnitDetail','productTermOfPayments.planDetail','productSpecialDeliveryFees'])->where('id', base64_decode($id))->first();
            $product = !empty($product) ? $product->toArray() : [];
            // dd($product);
            $productTax = ProductTax::first()->toArray();
            // dd($productTax);
            return view('frontend.login.provider.products.view',compact('page','product','productTax'));

        } catch (Exception $e) {
            // dd($e);
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }      
    }

    /**
     * Edit Product
     * @param  Request $request 
     * @return view        
     */
    public function editProduct(Request $request, $id)
      {
      
       
            $page = 'product';
            $product = $this->product->with(['productselectedcategory','productselectedsubcategory','productpricerange','productSpecification','producttermofpayment.planName','notselectedplanName.planName','productkeyword','productpacking'])->where('id', Crypt::decrypt($id))->first();

                      
            if($request->isMethod('post')){

                $payload = $request->all();
                $payload['user_id'] = Auth::user()->id;
                // dd($payload);

                ProductSelectedCategory::where('product_id',$payload['productid'])->delete();
                ProductSelectedSubcategory::where('product_id',$payload['productid'])->delete();
                ProductPriceRange::where('product_id',$payload['productid'])->delete();
                ProductPacking::where('product_id',$payload['productid'])->delete();
                ProductKeyword::where('product_id',$payload['productid'])->delete();
                ProductTermOfPayment::where('product_id',$payload['productid'])->delete();

                       foreach ($request['category_id'] as $categoryId) {
                            ProductSelectedCategory::Create([
                                                'user_id'        => $payload['user_id'],
                                                'product_id'     => $payload['productid'],
                                                'category_id'    => $categoryId
                                            ]);
                        }      

                       foreach ($request['sub_category_id'] as $subCategoryId) {
                            ProductSelectedSubcategory::Create([
                                                'user_id'        => $payload['user_id'],
                                                'product_id'     => $payload['productid'],
                                                'subcategory_id' => $subCategoryId
                                            ]);
                        }  
                   
                   ////////////////////////////////////////////////////////////////////////
                      if(isset($payload['packing_unit_checkbox'])){

                         foreach ($payload['packing_append_div'] as $value) {

                              $ProductPacking=  ProductPacking::Create([
                                   'user_id'            => $payload['user_id'],
                                   'product_id'         => $payload['productid'],
                                   'each_content_unit'  => $value['each_content_unit'],
                                   'content_number'     => $value['content_number'],
                                   'content_unit'       => $value['content_unit']
                                   // 'to_unit'            => $value['to_unit']
                               ]);
                         }    
                      }else{
                         // has no records
                          foreach ($payload['packing_append_div'] as $value) {

                              $ProductPacking=  ProductPacking::Create([
                                   'user_id'            => $payload['user_id'],
                                   'product_id'         => $payload['productid'],
                                   'each_content_unit'  => $value['each_content_unit'],
                                   'content_number'     => $value['content_number'],
                                   'content_unit'       => $value['content_unit']
                                   // 'to_unit'            => $value['to_unit']
                               ]);
                          }
                      
                     }

                      if(isset($payload['packing_unit_checkbox'])){
                          Product::where('id',$payload['productid'])->update([
                                  'packing_unit_checkbox'    => $payload['packing_unit_checkbox']
                                      ]);
                      }
                      ///////////////////////////////////////////////////////////

                        $keywordArray = explode(',', $payload['Keywords']);
                     
                        if ($keywordArray!='') { 
                            foreach ($keywordArray as $value) {
                             ProductKeyword::Create([
                                      'user_id'            => $payload['user_id'],
                                      'product_id'         => $payload['productid'],
                                      'keyword_name'        => $value
                                      
                                  ]);
                              }
                        }

                        if ($request['grade']!='') {
                            Product::where('id',$payload['productid'])->update([
                                                'grade'    => $payload['grade']
                                            ]);
                         }


                        if ($request['item_Arabic_detail']!='') {
                            Product::where('id',$payload['productid'])->update([
                                                'item_Arabic_detail'    => $payload['item_Arabic_detail']
                                            ]);
                         }
                        
                        if ($request['item_name_arabic']!='') {
                            Product::where('id',$payload['productid'])->update([
                                                'item_name_arabic'    => $payload['item_name_arabic']
                                            ]);
                         }

                        if ($request['defualt_selling_unit_price']!='') {
                            Product::where('id',$payload['productid'])->update([
                                                'defualt_selling_unit_price'    => $payload['defualt_selling_unit_price']
                                            ]);
                         }

                        if ($request['quantity_order']!='') {
                            Product::where('id',$payload['productid'])->update([
                                                'quantity_order'    => $payload['quantity_order']
                                            ]);
                         }

                        if ($request['diameter_number']!='') {
                            Product::where('id',$payload['productid'])->update([
                                                'diameter_number'    => $payload['diameter_number']
                                            ]);
                         }
                        if ($request['diameter_unit']!='') {
                            Product::where('id',$payload['productid'])->update([
                                                    'diameter_unit'    => $payload['diameter_unit']
                                                ]);
                         }
                       if ($request['length_number']!='') {
                            Product::where('id',$payload['productid'])->update([
                                                    'length_number'    => $payload['length_number']
                                                ]);
                         }    
                        if ($request['length_unit']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'length_unit'   =>$payload['length_unit']
                                                ]);
                         }    
                        if ($request['width_number']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'width_number'    =>$payload['width_number']
                                                ]);
                         }
                        if ($request['width_unit']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'width_unit'    =>$payload['width_unit']
                                                ]);
                         }
                        if ($request['depth_number']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'depth_number'    =>$payload['depth_number']
                                                ]);
                         }

                          if($request['grade']!=''){
                           Product::where('id',$payload['productid'])->update([
                                                    'grade' =>$payload['grade']
                                                ]);
                         }

                        if ($request['depth_unit']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'depth_unit'     =>$payload['depth_unit']
                                                ]);
                         }
                        if ($request['thickness_number']!='') {     
                            Product::where('id',$payload['productid'])->update([
                                                    'thickness_number'     =>$payload['thickness_number']
                                                ]);
                         }
                        if ($request['thickness_unit']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'thickness_unit'    =>$payload['thickness_unit']
                                                ]);
                         }
                        if ($request['particle_number']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'particle_number'  =>$payload['particle_number']
                                                ]);
                         }
                        if ($request['particle_unit']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'particle_unit'     =>$payload['particle_unit']
                                                     ]);
                         }

                        if ($request['height_number']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'height_number'     =>$payload['height_number']
                                                     ]);
                         }

                        if ($request['height_unit']!='') {    
                            Product::where('id',$payload['productid'])->update([
                                                    'height_unit'     =>$payload['height_unit']
                                                     ]);
                         }

                         if ($request['criteria_name']!='') {    
                             Product::where('id',$payload['productid'])->update([
                                                     'criteria_name'     =>$payload['criteria_name']
                                                      ]);
                          }

                         if ($request['criteria_unit']!='') {    
                             Product::where('id',$payload['productid'])->update([
                                                     'criteria_unit'     =>$payload['criteria_unit']
                                                      ]);
                          } 

                          if ($request['default_plan']!='') {    
                              Product::where('id',$payload['productid'])->update([
                                                      'default_plan'     =>$payload['default_plan']
                                                       ]);
                           } 


                          $quantiyPrc= 'quantity_price';

                         // dd($payload);
                        if($payload['quantity_order']==$quantiyPrc){
                         
                            foreach ($payload['price_firsrt_append_div'] as $value) {
                              $productpricerange=  ProductPriceRange::Create([
                                      'user_id'            => $payload['user_id'],
                                      'product_id'         => $payload['productid'],
                                      'from_number'        => $value['from_number'],
                                      'from_unit'          => $value['from_unit'],
                                      'to_number'          => $value['to_number'],
                                      'to_unit'            => $value['to_unit'],
                                      'selling_unit_price' => $value['selling_unit_price'],
                                      'discount_percent'   => $value['discount_percent'],
                                      'final_price'        => $value['final_price'],
                                      'unit_price'         => $value['unit_price'] 
                                  ]);

                                if ($request['discount_type']!='') {
                                    ProductPriceRange::where('id',$productpricerange['id'])->update([
                                                        'discount_type'    => $payload['discount_type']
                                                    ]);
                                 }

                                if ($request['discount_price']!='') {
                                    ProductPriceRange::where('id',$productpricerange['id'])->update([
                                                        'discount_price'    => $payload['discount_price']
                                                    ]);
                                 } 
                            
                            }    

                        }else{

                           
                           if ($request['defualt_selling_unit_price']!='') {    
                               Product::where('id',$payload['productid'])->update([
                                                       'defualt_selling_unit_price'    =>$payload['defualt_selling_unit_price']
                                                   ]);
                            }
                            if ($request['defualt_unit_price']!='') {    
                                Product::where('id',$payload['productid'])->update([
                                                        'defualt_unit_price'    =>$payload['defualt_unit_price']
                                                    ]);
                             }
                          

                        }

                       


                        if($payload['default_plan']=='normal'){
                            // if(!empty($payload['selected_plan_id'])){
                            //  if ($request['default_plan']!='') {    
                                 Product::where('id',$payload['productid'])->update([
                                                         'default_plan'    =>'normal'
                                                     ]);
                           
                                foreach($payload['plan_append_div'] as $key22 => $val) {
                                                                                                      
                                  ProductTermOfPayment::where('product_id',$payload['productid'])->create([
                                                    'selected_plan_id'  => $val['selected_plan_id'],
                                                    'default_plan'      => $payload['default_plan'],
                                                    'user_id'           => $payload['user_id'],
                                                    'from_price'        => $val['from_price'],
                                                    'to_price'          => $val['to_price'],
                                                    'product_id'        => $payload['productid']
                                                ]);
                                        
                                    // }
                                }



                        }else{

                             if ($request['default_plan']!='') {    
                                 Product::where('id',$payload['productid'])->update([
                                                         'default_plan'    =>'default'
                                                     ]);
                              }
                                  

                                ProductTermOfPayment::Create([
                                                    'default_plan'     => $payload['default_plan'],
                                                    'user_id'          => $payload['user_id'],
                                                    'product_id'       => $payload['productid']
                                                    // 'fixed_plan_id'    => $payload['fixed_plan_id']
                                                ]);
                   
                        }

                        
                        $specifications =   $this->productSpecification->where('user_id', \Auth::user()->id)
                                                                            ->whereNull('product_id')
                                                                            ->where('status', 'pending')
                                                                            ->get();

                        foreach ($specifications as $specification) {
                            $specification->update([
                                                    'product_id'=>$payload['productid'],
                                                    'status'    => 'complete'
                                                    ]);
                        }

                         $images =   $this->productImage->where('user_id', \Auth::user()->id)
                                   ->whereNull('product_id')
                                    ->where('status', 'pending')
                                    ->get();


                        foreach ($images as $img) {
                            $img->update([
                                        'product_id'=>$payload['productid'],
                                        'status'    => 'complete'
                                        ]);
                        }            

                  // echo'<pre>'; print_r($payload); die;

             $productId = Product::where('id',$payload['productid'])->update([
              'seller_item_code'                    =>$payload['seller_item_code'],
                'item_bar_code'                     =>$payload['item_bar_code'],
                'item_name'                         =>$payload['item_name'],
                'item_detail'                       =>$payload['item_detail'],
                'brand_id'                          =>$payload['brand_id'],
                'item_color'                        =>$payload['item_color'],
                'item_origin'                       =>$payload['item_origin'],
                'selling_unit'                      =>$payload['selling_unit'],
                'minimum_buying_quality_number'     =>$payload['minimum_buying_quality_number'],
                'minimum_buying_quality_unit'       =>$payload['minimum_buying_quality_unit'],
                'available_quantity_number'         =>$payload['available_quantity_number'],
                'available_quantity_unit'           =>$payload['available_quantity_unit'],
                'available_quantity_content_number' =>$payload['available_quantity_content_number'],
                'available_quantity_content_unit'   =>$payload['available_quantity_content_unit'],
                'related_links'                     =>$payload['related_links'],
                'user_id'                           =>$payload['user_id']

                        ]);
                // $productpricerange = ProductPriceRange::where('product_id',$id)->delete();
                 Session::flash('success', 'Product updated successfully');
                return redirect('provider/products/list');
            }


          

            $subCategories = $this->subCategory->where('status', 'active')
                                                        ->orderBy('name', 'asc')
                                                        ->get();

            $supplierCode = $this->user->where('id', \Auth::user()->id)->pluck('supplier_code')->first();
            
            $productCategories   = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();
            
            $productSubCategories = ProductSubCategory::where('status', 'active')
                                               ->orderBy('name', 'asc')
                                               ->get();

            
            $brandProducts   = ProductBrand::where('status','active')->get();   
            $brandColors     = ProductColor::where('status','active')->get();   
            $SellingUnits    = ProductSellingUnit::where('status','active')->get();   
            $Origins         = Country::where('status','active')->get();  
            $productUnits    = ProductUnit::where('status','active')->get();  
            $productGrades   = ProductGrade::where('status','active')->get();




            $term = ProductTermOfPayment::where('user_id',Auth::User()->id)->where('product_id', Crypt::decrypt($id))->where('selected_plan_id' ,'!=',null)->pluck('selected_plan_id')->toArray();
           
            $term_of_payment = UserTermOfPayment::where('user_id',Auth::User()->id)->get()->toArray();
            // dd($term_of_payment);

            $defaultplan = ProductTermOfPayment::where('user_id',Auth::User()->id)->where('product_id', Crypt::decrypt($id))->value('default_plan');     


            $slcted_plan_id = [];
               if(!empty($product)){
                   $product = $product->toArray();
                   $slcted_plan_id = array_map(function($v){ return $v['selected_plan_id']; }, $product['producttermofpayment']);
                  // echo '<pre>'; print_r($slcted_plan_id);die;
               }

             $slcted_category_id = [];
                if(!empty($product)){
                    $slcted_category_id = array_map(function($v){ return $v['category_id']; }, $product['productselectedcategory']);
                }

             $slcted_Subcategory_id = [];
                if(!empty($product)){
                    $slcted_Subcategory_id = array_map(function($v){ return $v['subcategory_id']; }, $product['productselectedsubcategory']);
                }

            $keywordData = ProductKeyword::where('product_id',Crypt::decrypt($id))->pluck('keyword_name')->toArray();
            $keyword = implode(", ",$keywordData);


            // $productUnits  = ProductUnit::get();  

            $this->productSpecification->where('user_id', \Auth::user()->id)
                                        ->whereNull('product_id')
                                        ->where('status', 'pending')
                                        ->delete();

            // delete product images
            $this->productImage->where('user_id', \Auth::user()->id)
                                ->whereNull('product_id')
                                ->where('status', 'pending')
                                ->delete();


          return view('frontend.login.provider.products.edit', compact('page', 'product','productCategories','productSubCategories','mawadCode','supplierCode','subCategories','brandColors','SellingUnits','Origins','term_of_payment','slcted_plan_id','defaultplan','slcted_Subcategory_id','slcted_category_id','brandProducts','keyword','productUnits','productGrades'));
         
       
    }

    /**
     * Get Product Weight
     * @param  Request $request 
     * @return Array         
     */
    public function getProductWeight(Request $request)
    {
        $data = $this->productWeight->where('id', $request->input('weightId'))->first();
        return ['response' => 'success', 'weight' => $data];
    }

    /**
     * [getProductWeight description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getProductSpecification(Request $request)
    {
        $data = $this->productSpecification->where('id', $request->input('specificationId'))->first();
        // dd($data);
        return ['response' => 'success', 'specification' => $data];
    }

    /**
     * Edit Product Weight
     * @param  Request $request 
     * @return Array        
     */
    

    //  public function updateProductSpecification(Request $request)
    // {
    //     $payload = $request->all();

    //     $payload['user_id'] = \Auth::user()->id;
    //     $payload = $request->all();
    //     $specification =$this->productSpecification->where('id',$payload['specificationId'])->update([
                                      
    //                                     'title'       =>$payload['title'],
    //                                     'description' =>$payload['description'] 
    //                                 ]);

    //     return ['response' => 'success', 'specification' => $specification];
    // }

    public function editProductWeight(Request $request)
    {
        $payload = $request->all();
        $weight = $this->productWeight->where('id', $payload['wightId'])->first();
        $price = $weight->price;
        if($payload['price']) {
            $price = $payload['price'];
        }
        $payload['per_unit_price'] = $price;
        $payload['price'] = $price * $payload['pcs'];
        $weight->update($payload);

        return ['response' => 'success', 'weight' => $weight];
    }

    /**
     * Edit Product Specification
     * @param  Request $request 
     * @return Array          
     */
    public function editProductSpecification(Request $request)
    {
        $payload = $request->all();
        // dd($specification);

        $payload['user_id'] = \Auth::user()->id;
        // dd($payload);
         $specification =$this->productSpecification->create([
                                        'user_id'     =>$payload['user_id'],
                                        'product_id'  =>$payload['productid'],
                                        'title'       =>$payload['title'],
                                        'description' =>$payload['description'] 
                                    ]);

        // $specification->update($payload);

        // $specification = $this->productSpecification->where('id', $payload['specificationId'])->first();

        return ['response' => 'success', 'specification' => $specification];
    }


        // dd($specification);
    // updateProductSpecification
     public function updateProductSpecification(Request $request)
    {
        $payload = $request->all();

        $payload['user_id'] = \Auth::user()->id;
        $payload = $request->all();
        // $payload = $request->except('productid');
        // dd($payload);

         $specification =$this->productSpecification->where('id',$payload['specificationId'])->update([
                                        // 'user_id'     =>$payload['user_id'],
                                        // 'product_id'  =>$payload['productid'],
                                        'title'       =>$payload['title'],
                                        'description' =>$payload['description'] 
                                    ]);

        // $specification->update($payload);

        // $specification = $this->productSpecification->where('id', $payload['specificationId'])->first();

        return ['response' => 'success', 'specification' => $specification];
    }

     /**
     * Delete Product Weight
     * @param  Request $request 
     * @param  string  $id      
     * @return array           
     */
    public function deleteProductWeight(Request $request, $id)
    {
        $id   = $request->id;
        $data = $this->productWeight->where('id',$id)->delete();
        $count = $this->productWeight->where('product_id', $request->input('productId'))
                                            ->where('user_id', \Auth::user()->id)
                                            ->count();

        return ['status'=>'success', 'count' => $count];
    }

    /**
     * delete product specification
     * @param  Request $request 
     * @param  string  $id      
     * @return array           
     */
    public function deleteProductSpecification(Request $request, $id)
    {
        $id   = $request->id;
        $data = $this->productSpecification->where('id',$id)->delete();
        $count = $this->productSpecification->where('product_id', $request->input('productId'))
                                            ->where('user_id', \Auth::user()->id)
                                            ->count();

        return ['status'=>'success', 'count' => $count];
    }

    /**
     * Get Product Images
     * @param  Request $request 
     * @return array           
     */
    public function getProductImages(Request $request, $id)
    {
        $dbProductImages = $this->productImage->where('user_id', \Auth::user()->id)
                            ->where('product_id', $id)
                            ->get();
        $productImages = [];

        foreach ($dbProductImages as $image) {
            $productImages[] = [

                'id'    => $image->id,
                'image' => $image->name,
                // 'size'  => File::size(public_path('frontend/images/products/' . $image->name))
            ];
        }

        return $response = array('status' => 'ok','images'=>$productImages);
    }

    public function checkProductImages(Request $request) {

        $images = $this->productImage->where('product_id', $request->input('productId'))->get();

        return ['response' => 'success', 'images' => $images];
    }

    public function addTermOfPayment(Request $request) {

        $data = $request->all();
        // dd($data);
        $term = ProductTermOfPayment::where('user_id',Auth::user()->id)
                                     ->where('part',$data['part'])
                                     ->first();
        if (!empty($term)) {
            $updateTermId = ProductTermOfPayment::where('user_id',Auth::user()->id)
                                                 ->where('part',$data['part'])
                                                 ->update([
                                                           $data['key']=>$data['value'] 
                                                        ]);
        }else{
            $createTermId = ProductTermOfPayment::create([
                                                      'user_id'=>Auth::user()->id,
                                                      'part'=>$data['part'],
                                                      $data['key']=>$data['value']
                                                    ])->id;
        }
    }

    public function checkTermOfPaymentRange(Request $request) {

        $data = $request->all();
        // dd($data);
        if (isset($data['range']) && !empty($data['range'])) {
            $conditionCheck = ProductTermOfPayment::where('user_id',Auth::user()->id)
                                                     ->whereNull('product_id')
                                                     ->where('from_price','<=',$data['range'])
                                                     ->where('to_price','>=',$data['range'])
                                                     ->where('part','!=',$data['part'])
                                                     ->get()
                                                     ->toArray();
            // dd($conditionCheck);
            if (!empty($conditionCheck)) {
                $resp = 'false';
            }else{
                $resp = 'true';
            }
            return $resp;
        }
    }

    public function removeTermOfPayment(Request $request) {

        $data = $request->all();
        // dd($data);
        $term = ProductTermOfPayment::where('user_id',Auth::user()->id)
                                     ->whereNull('product_id')
                                     ->delete();
    }

    public function addProductPriceRange(Request $request) {

        $data = $request->all();
        // dd($data);
        $term = ProductPriceRange::where('user_id',Auth::user()->id)
                                     ->where('part',$data['part'])
                                     ->first();
        if (!empty($term)) {
            $updateTermId = ProductPriceRange::where('user_id',Auth::user()->id)
                                                 ->where('part',$data['part'])
                                                 ->update([
                                                           $data['key']=>$data['value'] 
                                                        ]);
        }else{
            $createTermId = ProductPriceRange::create([
                                                      'user_id'=>Auth::user()->id,
                                                      'part'=>$data['part'],
                                                      $data['key']=>$data['value']
                                                    ])->id;
        }
    }

    public function checkRangeOfPriceRange(Request $request) {

        $data = $request->all();
        // dd($data);
        if (isset($data['range']) && !empty($data['range'])) {
            $conditionCheck = ProductPriceRange::where('user_id',Auth::user()->id)
                                                     ->whereNull('product_id')
                                                     ->where('from_number','<=',$data['range'])
                                                     ->where('to_number','>=',$data['range'])
                                                     ->where('part','!=',$data['part'])
                                                     ->get()
                                                     ->toArray();
            // dd($conditionCheck);
            if (!empty($conditionCheck)) {
                $resp = 'false';
            }else{
                $resp = 'true';
            }
            return $resp;
        }
    }

    /**
     * Add Product Brand 
     * @param Request $request 
     * @return  view render 
     */
    public function addProductBrand(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $createdId = ProductBrand::create($data)->id;                                               
        // dd($createdId);
        $html =  '<option value="'.$createdId.'">'.$data['brand_name'].'</option>';
        // dd($html);
        if (!empty($createdId)) {
            return $response = array('status'=>'success', 'html'=>$html);
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function addProductBrandValidate( Request $request)
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

    /**
     * Add Product Color 
     * @param Request $request 
     * @return  view render 
     */
    public function addProductColor(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $createdId = ProductColor::create($data)->id;                                               
        // dd($createdId);
        $html =  '<option value="'.$createdId.'">'.$data['name'].'</option>';
        // dd($html);
        if (!empty($createdId)) {
            return $response = array('status'=>'success', 'html'=>$html);
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function addProductColorValidate( Request $request)
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

    /**
     * Add Product Country 
     * @param Request $request 
     * @return  view render 
     */
    public function addProductCountry(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $createdId = Country::create($data)->id;                                               
        // dd($createdId);
        $html =  '<option value="'.$createdId.'">'.$data['name'].'</option>';
        // dd($html);
        if (!empty($createdId)) {
            return $response = array('status'=>'success', 'html'=>$html);
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function addProductCountryValidate( Request $request)
    {

        $name = $_GET['name'];
        $nameCount = Country::where('name',$name)->count();
        if ($nameCount >0) {
            $resp = 'false';
        }else{
            $resp = 'true';
        }
        return $resp;
    }

    /**
     * Add Product Grade 
     * @param Request $request 
     * @return  view render 
     */
    public function addProductGrade(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $createdId = ProductGrade::create($data)->id;                                               
        // dd($createdId);
        $html =  '<option value="'.$createdId.'">'.$data['grade_name'].'</option>';
        // dd($html);
        if (!empty($createdId)) {
            return $response = array('status'=>'success', 'html'=>$html);
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function addProductGradeValidate( Request $request)
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

    /**
     * Add Product Selling Unit 
     * @param Request $request 
     * @return  view render 
     */
    public function addProductSellingUnit(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $createdId = ProductSellingUnit::create($data)->id;                                               
        // dd($createdId);
        $html =  '<option value="'.$createdId.'">'.$data['name'].'</option>';
        // dd($html);
        if (!empty($createdId)) {
            return $response = array('status'=>'success', 'html'=>$html);
        }else{
            return $response = array('status'=>'error');
        }
    }

    public function addProductSellingUnitValidate( Request $request)
    {

        $name = $_GET['name'];
        $nameCount = ProductSellingUnit::where('name',$name)->count();
        if ($nameCount >0) {
            $resp = 'false';
        }else{
            $resp = 'true';
        }
        return $resp;
    }

    /**
     * Add Product New Option 
     * @param Request $request 
     * @return  view render 
     */
    public function addProductNewOption(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $SellingUnits    = ProductSellingUnit::where('status','active')->get();   
        $view = view('frontend.login.provider.element.addProductNewOption', compact('data','SellingUnits'))->render(); 
        return array('status'=>'success','view'=>$view);
    }

    public function addSpecialDeliveryFee(Request $request) {

        $data = $request->all();
        // dd($data);
        $fee = ProductSpecialDeliveryFee::where('user_id',Auth::user()->id)
                                     ->where('part',$data['part'])
                                     ->first();
        if (!empty($fee)) {
            $updateFeeId = ProductSpecialDeliveryFee::where('user_id',Auth::user()->id)
                                                 ->where('part',$data['part'])
                                                 ->update([
                                                           $data['key']=>$data['value'] 
                                                        ]);
        }else{
            $createFeeId = ProductSpecialDeliveryFee::create([
                                                      'user_id'=>Auth::user()->id,
                                                      'part'=>$data['part'],
                                                      $data['key']=>$data['value']
                                                    ])->id;
        }
    }

    public function checkSpecialDeliveryFee(Request $request) {

        $data = $request->all();
        // dd($data);
        if (isset($data['range']) && !empty($data['range'])) {
            $conditionCheck = ProductSpecialDeliveryFee::where('user_id',Auth::user()->id)
                                                     ->whereNull('product_id')
                                                     ->where('from_price','<=',$data['range'])
                                                     ->where('to_price','>=',$data['range'])
                                                     ->where('part','!=',$data['part'])
                                                     ->get()
                                                     ->toArray();
            // dd($conditionCheck);
            if (!empty($conditionCheck)) {
                $resp = 'false';
            }else{
                $resp = 'true';
            }
            return $resp;
        }
    }

    public function removeSpecialDeliveryFee(Request $request) {

        $data = $request->all();
        // dd($data['part']);
        if (isset($data['part']) && !empty($data['part'])) {
            $delete = ProductSpecialDeliveryFee::where('user_id',Auth::user()->id)
                                         ->whereNull('product_id')
                                         ->where('part',$data['part'])
                                         ->delete();
        }else{
            $delete = ProductSpecialDeliveryFee::where('user_id',Auth::user()->id)
                                         ->whereNull('product_id')
                                         ->delete();
        }
    }

    public function productSpecialBuildMartFees($encProductId, Request $request) {
        try {

            $decProductId = base64_decode($encProductId);
            // dd($decProductId);
            $product = Product::where('id',$decProductId)->first();
            $product = !empty($product) ? $product->toArray() : [];
            $page = 'product';
            // dd($product);
            if ($product['has_special_build_mart_fees']=='yes' && $product['special_build_mart_fees_type']!=null) {
                $feeRanges = ProductBuildMartFee::where('product_id',$product['id']);
                if ($product['special_build_mart_fees_type']=='any_order_amount') {
                    $feeRanges = $feeRanges->first();
                    $feeRanges = !empty($feeRanges) ? $feeRanges->toArray() : [];
                }else{
                    $feeRanges = $feeRanges->get()->toArray();
                }
                // dd($feeRanges);
                return view('frontend.login.provider.products.specialBuildMartFees',compact('page','feeRanges','product'));
            }else{
                Session::flash('error',trans('messages.frontend.build_mart_fees.not_assigned'));
                return redirect()->back();
            }
        } catch (Exception $e) {
            \Log::info($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    
}
