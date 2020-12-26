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

class ProductsController extends Controller
{
    protected $subCategory;
    protected $productWeight;
    protected $productSpecification;
    protected $admin;
    protected $user;
    protected $product;
    protected $productImage;

    public function __construct(ProductSubCategory $subCategory, 
                                ProductWeight $productWeight,
                                ProductSpecification $productSpecification,
                                Admin $admin,
                                User $user,
                                Product $product,
                                ProductImage $productImage)
    {
        $this->subCategory = $subCategory;
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
                          return 
                          '<a href="' . url("provider/products/edit/".Crypt::encrypt($productList->id)) . '" class="edit-btn cp text-primary">Edit</a>
                          <a href="javascript:;" class="delete-btn cp text-danger" del_id="'.$productList->id.'" > Delete</a>
                          <a href="' . url("provider/products/view/".Crypt::encrypt($productList->id)) . '" class="cp text-dark" del_id="'.$productList->id.'" > View</a>';
                        })
                        ->escapeColumns([])
                        ->make(true);
    }

    /**
     * Add Product
     * @param Request $request 
     * @return view
     */
    public function addProduct(Request $request)
    {
        
            $page = 'product';
            // create product
            if($request->isMethod('post')) {
               $payload = $request->all();
               $payload['user_id'] = Auth::user()->id;

                // dd($payload);
               $productId = Product::create([
                // 'seller_item_code'                  =>$payload['seller_item_code'],
                'item_bar_code'                     =>$payload['item_bar_code'],
                'mawad_mart_code'                   =>$payload['mawad_mart_code'],
                'item_name'                         =>$payload['item_name'],
                'item_detail'                       =>$payload['item_detail'],
                'brand_id'                          =>$payload['brand_id'],
                'diameter_number'                   =>$payload['diameter_number'],
                'diameter_unit'                     =>$payload['diameter_unit'],
                'length_number'                     =>$payload['length_number'],
                'length_unit'                       =>$payload['length_unit'],
                'width_number'                      =>$payload['width_number'],
                'width_unit'                        =>$payload['width_unit'],
                'depth_number'                      =>$payload['depth_number'],
                'depth_unit'                        =>$payload['depth_unit'],
                'thickness_number'                  =>$payload['thickness_number'],
                'thickness_unit'                    =>$payload['thickness_unit'],
                'particle_number'                   =>$payload['particle_number'],
                'particle_unit'                     =>$payload['particle_unit'],
                'item_color'                        =>$payload['item_color'],
                'item_origin'                       =>$payload['item_origin'],
                'selling_unit'                      =>$payload['selling_unit'],
                'each_content_unit'                 =>$payload['each_content_unit'],
                'content_number'                    =>$payload['content_number'],
                'content_unit'                      =>$payload['content_unit'],
                'minimum_buying_quality_number'     =>$payload['minimum_buying_quality_number'],
                'minimum_buying_quality_unit'       =>$payload['minimum_buying_quality_unit'],
                'available_quantity_number'         =>$payload['available_quantity_number'],
                'available_quantity_unit'           =>$payload['available_quantity_unit'],
                'available_quantity_content_number' =>$payload['available_quantity_content_number'],
                'available_quantity_content_unit'   =>$payload['available_quantity_content_unit'],
                'user_id'                           =>$payload['user_id']

                        ])->id;

       
                if($payload['default_plan']=='normal'){
                    // if(!empty($payload['selected_plan_id'])){
                        foreach($payload['selected_plan_id'] as $key => $val) {
                                                                                              
                          ProductTermOfPayment::where('product_id',$productId)->create([
                                            'selected_plan_id'  => $val,
                                            'default_plan'      => $payload['default_plan'],
                                            'user_id'           =>$payload['user_id'],
                                            'product_id'        =>$productId
                                        ]);
                                
                            // }
                        }
                        $plan_id =  ProductTermOfPayment::where('product_id',$productId)->pluck('selected_plan_id')->toArray();
                                     
                    foreach($payload['reward'] as $key => $value) {
                        if($value['from_price'] != null && $value['to_price'] != null){

                            $pree = ProductTermOfPayment::where('product_id',$productId)->whereIn('selected_plan_id',$plan_id)->update([

                                           'from_price'  => $value['from_price'],
                                            'to_price'    => $value['to_price']
                                        ]);
                        }
                    }
                        // dd($pree);
                     // dd($payload['reward']);     
                                // dd($value);

  
                     // }
                
                    
                  

                }else{
                        ProductTermOfPayment::Create([
                                            'default_plan'     => $payload['default_plan'],
                                            'user_id'          => $payload['user_id'],
                                            'product_id'       => $productId
                                        ]);
           
                }
 
                       
               foreach ($request->category_id as $categoryId) {
                    ProductSelectedCategory::Create([
                                        'user_id'        => $payload['user_id'],
                                        'product_id'     => $productId,
                                        'category_id'    => $categoryId
                                    ]);
                }      

               foreach ($request->sub_category_id as $subCategoryId) {
                    ProductSelectedSubcategory::Create([
                                        'user_id'        => $payload['user_id'],
                                        'product_id'     => $productId,
                                        'subcategory_id' => $subCategoryId
                                    ]);
                }  

               foreach ($request->from_number as $from_number) {
                    ProductPriceRange::Create([
                                        'user_id'        => $payload['user_id'],
                                        'product_id'     => $productId,
                                        'from_number'    => $from_number
                                    ]);
                }    

               foreach ($request->from_unit as $from_unit) {
                    ProductPriceRange::where('product_id',$productId)->update([
                                        'from_unit'    => $from_unit
                                    ]);
                }


               foreach ($request->to_number as $to_number) {
                    ProductPriceRange::where('product_id',$productId)->update([
                                        'to_number'    => $to_number
                                    ]);
                }


               foreach ($request->to_unit as $to_unit) {
                    ProductPriceRange::where('product_id',$productId)->update([
                                        'to_unit'    => $to_unit
                                    ]);
                }

               foreach ($request->selling_unit_price as $selling_unit_price) {
                    ProductPriceRange::where('product_id',$productId)->update([
                                        'selling_unit_price'    => $selling_unit_price
                                    ]);
                }

               foreach ($request->unit_price as $unit_price) {
                    ProductPriceRange::where('product_id',$productId)->update([
                                        'unit_price'    => $unit_price
                                    ]);
                }


                $mediaIds = explode(",",$payload['media_ids']);
                foreach ($mediaIds as $mediaId) {
                    $this->productImage->where('id', $mediaId)
                                        ->where('user_id', \Auth::user()->id)
                                        ->update(['product_id' => $productId,
                                                    'status' => 'complete']);
                }


                  /////////////////////
                $mawadCode = Product::orderBy('id', 'DESC')->pluck('mawad_mart_code')->first();

                if($mawadCode==null){
                    $Mw= 'BM-';
                    $mawadCodeNumberManuallyGenerated = '0000001';
                    $mawadCodeNew = strtoupper($Mw.$mawadCodeNumberManuallyGenerated);

                    $updateMawadCode  =  Product::where('id',$productId)->update(['mawad_mart_code'=>$mawadCodeNew]);
                }else{

                    $oldCount = $this->product->count();
                    $Newcount = $oldCount + 1;

                    // $hhh = $mawadCodeNumber + $Newcount;

                    
                        $Mw= 'BM-';
                        // $num = 67868781;
                        $num = preg_replace('/\D/', '', $mawadCode);
                        $str_length = 7;

                        //  if number < $str_length
                        $str              = substr("000000{$num}", -$str_length);
                        $converted7digits = sprintf($str);
                        $concatecode      = strtoupper($Mw.$converted7digits);
                        $concatecode++;
                        // dd($concatecode);

                    // dd($concatecode);
                     $updateMawadCode  =  Product::where('id',$productId)->update(['mawad_mart_code'=>$concatecode]);

                }

                 // $sellerCode = Product::orderBy('id', 'DESC')->pluck('seller_item_code')->first();

                // if($payload['seller_item_code']==null){
                     $sellerCodeNew ="KFG0000".$productId;             
                    $updateMawadCode  =  Product::where('id',$productId)->update(['seller_item_code'=>$sellerCodeNew]);
                // }
               
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
                                                

           
                Session::flash('success', 'Product added successfully');
                return redirect()->back();
            }
////////////////////////////end add///////////request//////////

            $productCategories = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();

            $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();
            
            $mawadCode = Product::orderBy('id', 'DESC')->pluck('mawad_mart_code')->first();

            if($mawadCode==null){
                $Mw= 'BM-';
                $mawadCodeNumberqManuallyGenerated = '0000001';
                $mawadCode = strtoupper($Mw.$mawadCodeNumberqManuallyGenerated);
            }

            $sellerItemCode = Product::orderBy('id', 'DESC')->pluck('seller_item_code')->first();

            if($sellerItemCode==null){
                $Sw= 'KGF-';
                $sellerItemNumberManuallyGenerated = '0000001';
                $sellerItemCode = strtoupper($Sw.$sellerItemNumberManuallyGenerated);
            }  
            

            // dd($newMawadMartCode);

            // $supplierCode = $this->user->where('id', \Auth::user()->id)->pluck('supplier_code')->first();
            // delete product weights
            $this->productWeight->where('user_id', \Auth::user()->id)
                                ->whereNull('product_id')
                                ->where('status', 'pending')
                                ->delete();

            // delete product specifications
            $this->productSpecification->where('user_id', \Auth::user()->id)
                                        ->whereNull('product_id')
                                        ->where('status', 'pending')
                                        ->delete();

            // delete product images
            $this->productImage->where('user_id', \Auth::user()->id)
                                ->whereNull('product_id')
                                ->where('status', 'pending')
                                ->delete();

            $brandProducts = ProductBrand::get();   
            $brandColors   = ProductColor::get();   
            $SellingUnits  = ProductSellingUnit::get();   
            // dd($SellingUnits);
            $Origins       = Country::get();  

            $term_of_payment = UserTermOfPayment::where('user_id',Auth::User()->id)->get()->toArray();


            // $barCode = rand(1111111111,9999999999);

            return view('frontend.login.provider.products.add', compact('page', 'productCategories', 'mawadCode','termsOfPayments','brandProducts','brandColors','SellingUnits','Origins','term_of_payment','sellerItemCode'));
        
    }

   
    /**
     * Get Sub Categories
     * @param  Request $request 
     * @return view           
     */
    public function getSubCategories(Request $request)
    {
        $page = 'product';
        // dd($request->input('categoryId'));

       $subCategories = $this->subCategory->whereIn('category_id', $request->input('categoryId'))->get();

        return view('frontend.login.provider.element.productSubCategories', compact('page', 'subCategories'))->render(); 

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
        $payload = $request->all();
        $payload['user_id'] = \Auth::user()->id;
        $this->productSpecification->create($payload);

        $specifications = $this->productSpecification->whereNull('product_id')
                                                        ->where('status', 'pending')
                                                        ->get();

        return view('frontend.login.provider.element.productSpecification', compact('page', 'specifications'))->render();
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
            // $add_image = PostImage::insertGetId([
            //                                 'user_id' => Auth::user()->id,
            //                                 'name' => $uploadFile,
            //                                 'file_type' => $file_type
            //                             ]);  
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

                          // dd($slcted_subtags); 

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
    public function viewProduct(Request $request, $id)
    {
        try{
           
            $page = 'product';
            
            $product =$this->product->with(['productselectedcategory','productselectedsubcategory','productpricerange','productSpecification','producttermofpayment','productImage'])->where('id', Crypt::decrypt($id))->first();



            $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();

            $subCategories = $this->subCategory->where('status', 'active')
                                                        ->orderBy('name', 'asc')
                                                        ->get();


            $mawadCode = $this->admin->where('type', 'admin')->pluck('mawad_mart_code')->first();
            $supplierCode = $this->user->where('id', \Auth::user()->id)->pluck('supplier_code')->first();
             


            $productCategories   = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();

            $productSubCategories = ProductSubCategory::where('status', 'active')
                                               ->orderBy('name', 'asc')
                                               ->get();


            $mawadCode = Product::orderBy('id', 'DESC')->pluck('mawad_mart_code')->first();

            $brandProducts = ProductBrand::get();   
            $brandColors   = ProductColor::get();   
            $SellingUnits  = ProductSellingUnit::get();   
            $Origins       = Country::get();  




            return view('frontend.login.provider.products.view',compact('page', 'product','productCategories','productSubCategories','termsOfPayments','mawadCode','supplierCode','subCategories','brandProducts','brandColors','SellingUnits','Origins','term_of_payment'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.frontend.common_error'));
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
            $product = $this->product->with(['productselectedcategory','productselectedsubcategory','productpricerange','productSpecification','producttermofpayment.planName','notselectedplanName.planName'])->where('id', Crypt::decrypt($id))->first();

                      

            if($request->isMethod('post')){
                $payload = $request->all();
                $payload['user_id'] = Auth::user()->id;
                // dd();
                ProductSelectedCategory::where('product_id',$payload['productid'])->delete();
                ProductSelectedSubcategory::where('product_id',$payload['productid'])->delete();
                ProductPriceRange::where('product_id',$payload['productid'])->delete();
               

               foreach ($request->category_id as $categoryId) {
                    ProductSelectedCategory::Create([
                                        'user_id'        => $payload['user_id'],
                                        'product_id'     => $payload['productid'],
                                        'category_id'    => $categoryId
                                    ]);
                }      

               foreach ($request->sub_category_id as $subCategoryId) {
                    ProductSelectedSubcategory::Create([
                                        'user_id'        => $payload['user_id'],
                                        'product_id'     => $payload['productid'],
                                        'subcategory_id' => $subCategoryId
                                    ]);
                }  


               foreach ($request->from_number as $from_number) {
                    ProductPriceRange::Create([
                                        'user_id'        => $payload['user_id'],
                                        'product_id'     => $payload['productid'],
                                        'from_number'    => $from_number
                                    ]);
                }    

               foreach ($request->from_unit as $from_unit) {
                    ProductPriceRange::where('product_id',$payload['productid'])->update([
                                        'from_unit'    => $from_unit
                                    ]);
                }


               foreach ($request->to_number as $to_number) {
                    ProductPriceRange::where('product_id',$payload['productid'])->update([
                                        'to_number'    => $to_number
                                    ]);
                }

               foreach ($request->to_unit as $to_unit) {
                    ProductPriceRange::where('product_id',$payload['productid'])->update([
                                        'to_unit'    => $to_unit
                                    ]);
                }

               foreach ($request->selling_unit_price as $selling_unit_price) {
                    ProductPriceRange::where('product_id',$payload['productid'])->update([
                                        'selling_unit_price'    => $selling_unit_price
                                    ]);
                }

               foreach ($request->unit_price as $unit_price) {
                    ProductPriceRange::where('product_id',$payload['productid'])->update([
                                        'unit_price'    => $unit_price
                                    ]);
                }

                if($payload['media_ids']!=null){

                    $mediaIds = explode(",",$payload['media_ids']);
                    foreach ($mediaIds as $mediaId) {
                        $this->productImage->where('id', $mediaId)
                                            ->where('user_id', \Auth::user()->id)
                                            ->update(['product_id' => $payload['productid'],
                                                        'status' => 'complete']);
                    }
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

            //////////////////product term of payment table data//////save//////////////
              
                  // echo'<pre>'; print_r($payload); die;
              ProductTermOfPayment::where('product_id',$payload['productid'])->delete();


               if($payload['default_plan']=='normal'){
                    // if(!empty($payload['selected_plan_id'])){
                        foreach($payload['selected_plan_id'] as $key => $val) {
                                                                                              
                          ProductTermOfPayment::where('product_id',$payload['productid'])->create([
                                            'selected_plan_id'  => $val,
                                            'default_plan'      => $payload['default_plan'],
                                            'user_id'           =>$payload['user_id'],
                                            'from_price'       => $payload['reward'][$key]['from_price'],
                                            'to_price'         => $payload['reward'][$key]['to_price'],
                                            'product_id'        =>$payload['productid']
                                        ]);
                                
                            // }
                        }
                     

                }else{
                        ProductTermOfPayment::Create([
                                            'default_plan'     => $payload['default_plan'],
                                            'user_id'          => $payload['user_id'],
                                            'product_id'       => $payload['productid']
                                        ]);
           
                }
                 
               

                // dd($payload);

             $productId = Product::where('id',$payload['productid'])->update([
                'seller_item_code'                  =>$payload['seller_item_code'],
                'item_bar_code'                     =>$payload['item_bar_code'],
                'mawad_mart_code'                   =>$payload['mawad_mart_code'],
                'item_name'                         =>$payload['item_name'],
                'item_detail'                       =>$payload['item_detail'],
                'brand_id'                          =>$payload['brand_id'],
                'diameter_number'                   =>$payload['diameter_number'],
                'diameter_unit'                     =>$payload['diameter_unit'],
                'length_number'                     =>$payload['length_number'],
                'length_unit'                       =>$payload['length_unit'],
                'width_number'                      =>$payload['width_number'],
                'width_unit'                        =>$payload['width_unit'],
                'depth_number'                      =>$payload['depth_number'],
                'depth_unit'                        =>$payload['depth_unit'],
                'thickness_number'                  =>$payload['thickness_number'],
                'thickness_unit'                    =>$payload['thickness_unit'],
                'particle_number'                   =>$payload['particle_number'],
                'particle_unit'                     =>$payload['particle_unit'],
                'item_color'                        =>$payload['item_color'],
                'item_origin'                       =>$payload['item_origin'],
                'selling_unit'                      =>$payload['selling_unit'],
                'each_content_unit'                 =>$payload['each_content_unit'],
                'content_number'                    =>$payload['content_number'],
                'content_unit'                      =>$payload['content_unit'],
                'minimum_buying_quality_number'     =>$payload['minimum_buying_quality_number'],
                'minimum_buying_quality_unit'       =>$payload['minimum_buying_quality_unit'],
                'available_quantity_number'         =>$payload['available_quantity_number'],
                'available_quantity_unit'           =>$payload['available_quantity_unit'],
                'available_quantity_content_number' =>$payload['available_quantity_content_number'],
                'available_quantity_content_unit'   =>$payload['available_quantity_content_unit'],
                // 'user_id'                           =>$payload['user_id']

                        ]);
           
                // $productpricerange = ProductPriceRange::where('product_id',$id)->delete();
                return redirect('provider/products/list');
            }


          

            $subCategories = $this->subCategory->where('status', 'active')
                                                        ->orderBy('name', 'asc')
                                                        ->get();


            $mawadCode = $this->admin->where('type', 'admin')->pluck('mawad_mart_code')->first();
            // $supplierCode = $this->user->where('id', \Auth::user()->id)->pluck('supplier_code')->first();
             


             ////////////////////////////

             $productCategories   = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();

            $productSubCategories = ProductSubCategory::where('status', 'active')
                                               ->orderBy('name', 'asc')
                                               ->get();



            $mawadCode = Product::orderBy('id', 'DESC')->pluck('mawad_mart_code')->first();


           

            $brandProducts = ProductBrand::get();   
            $brandColors   = ProductColor::get();   
            $SellingUnits  = ProductSellingUnit::get();   
            $Origins       = Country::get();  

          

            $term = ProductTermOfPayment::where('user_id',Auth::User()->id)->where('product_id', Crypt::decrypt($id))->where('selected_plan_id' ,'!=',null)->pluck('selected_plan_id')->toArray();
            // dd($term == null);
            if($term!=null){

            $term_of_payment = UserTermOfPayment::where('user_id',Auth::User()->id)->whereNotIn('id',$term)->get()->toArray();
            }else{
                 $term_of_payment = UserTermOfPayment::where('user_id',Auth::User()->id)->get()->toArray();
            }

            // dd($term_of_payment);


            $defaultplan = ProductTermOfPayment::where('user_id',Auth::User()->id)->where('product_id', Crypt::decrypt($id))->value('default_plan');     
            // dd($defaultplan);        
            // dd($product['producttermofpayment'][0]['default_plan']);

            $slcted_plan_id = [];
               if(!empty($product)){
                   $product = $product->toArray();
                   $slcted_plan_id = array_map(function($v){ return $v['selected_plan_id']; }, $product['producttermofpayment']);
                  // echo '<pre>'; print_r($slcted_subtags);die;
               }

             $slcted_category_id = [];
                if(!empty($product)){
                    // $product = $product->toArray();
                    $slcted_category_id = array_map(function($v){ return $v['category_id']; }, $product['productselectedcategory']);
                   // echo '<pre>'; print_r($slcted_category_id);die;
                }

             $slcted_Subcategory_id = [];
                if(!empty($product)){
                    // $product = $product->toArray();
                    $slcted_Subcategory_id = array_map(function($v){ return $v['subcategory_id']; }, $product['productselectedsubcategory']);
                   // echo '<pre>'; print_r($slcted_Subcategory_id);die;
                }     

          return view('frontend.login.provider.products.edit', compact('page', 'product','productCategories','productSubCategories','termsOfPayments','mawadCode','supplierCode','subCategories','brandProducts','brandColors','SellingUnits','Origins','term_of_payment','slcted_plan_id','defaultplan','slcted_Subcategory_id','slcted_category_id'));
       
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

    public function checkProductImages(Request $request)
    {
        $images = $this->productImage->where('product_id', $request->input('productId'))->get();

        return ['response' => 'success', 'images' => $images];
    }
}
