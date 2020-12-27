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
use DataTables;
use Crypt;

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
        $productList = $this->product->with('category')
                                        ->select('*')
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
        try {
            $page = 'product';
            // create product
            if($request->isMethod('post')) {
                $payload = $request->all();
                $this->createProduct($payload);
            }
            $productCategories = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();

            $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();

            $mawadCode = $this->admin->where('type', 'admin')->pluck('mawad_mart_code')->first();
            $supplierCode = $this->user->where('id', \Auth::user()->id)->pluck('supplier_code')->first();
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

            $barCode = rand(1111111111,9999999999);

            return view('frontend.login.provider.products.add', compact('page', 'productCategories', 'mawadCode', 'supplierCode', 'termsOfPayments','barCode'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    /**
     * Create new product
     * @param Array $payload 
     * @return view         
     */
    public function createProduct($payload)
    {
        $displayOrder = 1;
        $product = $this->product->orderBy('id', 'desc')->first();
        if($product) {
            $productOrder = $product->display_order;
            $displayOrder = $productOrder + 1;
        }
        $payload['display_order'] = $displayOrder;
        $mediaIds = explode(",",$payload['media_ids']);
        $payload['user_id'] = \Auth::user()->id;
        $productId = $this->product->create($payload)->id;

        // update product weights
        $weights = $this->productWeight->where('user_id', \Auth::user()->id)
                                ->whereNull('product_id')
                                ->where('status', 'pending')
                                ->get();

        foreach ($weights as $weight) {
            $weight->update([
                            'product_id'=>$productId,
                            'status'    => 'complete'
                            ]);
        }
                                

        // update product specifications
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

        // update product images
        foreach ($mediaIds as $mediaId) {
            $this->productImage->where('id', $mediaId)
                                ->where('user_id', \Auth::user()->id)
                                ->update(['product_id' => $productId,
                                            'status' => 'complete']);
        }
                                        
        Session::flash('success', 'Product added successfully');

        return redirect()->back();
    }

    /**
     * Get Sub Categories
     * @param  Request $request 
     * @return view           
     */
    public function getSubCategories(Request $request)
    {
        $page = 'product';
        $subCategories = $this->subCategory->where('category_id', $request->input('categoryId'))->get();

        return view('frontend.login.provider.element.productSubCategories', compact('page', 'subCategories'))->render(); 

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
            $product = $this->product->with(['productSpecification', 'productWeight', 
                                            'productImage','category', 'subCategory'])
                                            ->where('id', Crypt::decrypt($id))
                                            ->first();

            $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();

            return view('frontend.login.provider.products.view', compact('page', 'product', 'termsOfPayments'));
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
        try {
            $page = 'product';
            $product = $this->product->with(['productSpecification', 'productWeight'])
                                        ->where('id', Crypt::decrypt($id))
                                        ->first();

            if($request->isMethod('post')){
                $payload = $request->all();
                $product->update($payload);

                return redirect('provider/products/list');
            }
            $productCategories = ProductCategory::where('status', 'active')
                                                ->orderBy('name', 'asc')
                                                ->get();


            $termsOfPayments = UserTermOfPayment::with('userTermOfPaymentQuotas')
                                                    ->where('user_id', \Auth::user()->id)
                                                    ->where('use_term_of_payment_as_default', 'yes')
                                                    ->first();

            $subCategories = $this->subCategory->where('status', 'active')
                                                        ->orderBy('name', 'asc')
                                                        ->get();


            $mawadCode = $this->admin->where('type', 'admin')->pluck('mawad_mart_code')->first();
            $supplierCode = $this->user->where('id', \Auth::user()->id)->pluck('supplier_code')->first();

            return view('frontend.login.provider.products.edit', compact('page', 'product', 'productCategories', 'termsOfPayments', 'mawadCode', 'supplierCode', 'subCategories'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
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
        $specification = $this->productSpecification->where('id', $payload['specificationId'])->first();
        $specification->update($payload);

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
