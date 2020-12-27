<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    // protected $fillable = ['type','display_order','user_id','category_id','sub_category_id','item_name','price_per_unit','image','mawad_mart_code','bar_code','item_bar_code','seller_item_code','supplier_code','terms_payment_id','item_detail','brand_id','item_color','item_origin','selling_unit','diameter_number','diameter_unit','length_number','length_unit','width_number','width_unit','depth_number','depth_unit','thickness_number','thickness_unit','particle_number','particle_unit','each_content_unit','content_number','content_unit','minimum_buying_quality_number','minimum_buying_quality_unit','from_number','from_unit','to_number','to_unit','selling_unit_price','discount','discount_type','final_price','unit_price','available_quantity_number','available_quantity_unit','available_quantity_content_number','available_quantity_content_unit','height_number','height_unit','item_name_arabic','item_Arabic_detail','Keywords','related_links','grade','criteria_name','criteria_unit','quantity_order','defualt_selling_unit_price','defualt_unit_price','default_plan','packing_unit_checkbox','user_store_location_id','provider_delivery_option_id'];

    protected $fillable = ['type','display_order','user_id','category_id','sub_category_id','item_name','price_per_unit','image','mawad_mart_code','bar_code','item_bar_code','seller_item_code','supplier_code','terms_payment_id','description_en','product_brand_id','product_color_id','country_id','selling_unit','selling_unit_id','is_packing_unit_checked','diameter_number','diameter_unit_id','length_number','length_unit_id','width_number','width_unit_id','depth_number','depth_unit_id','thickness_number','thickness_unit_id','particle_number','particle_unit_id','each_content_unit','content_number','content_unit','minimum_buying_quantity_number','minimum_buying_quantity_unit_id','from_number','from_unit','to_number','to_unit','selling_unit_price','unit_price','available_quantity_number','available_quantity_unit_id','available_quantity_content_number','available_quantity_content_unit_id','height_number','height_unit_id','item_name_arabic','description_ar','Keywords','related_links','product_grade_id','criteria_name','criteria_unit','quantity_order','defualt_selling_unit_price','defualt_unit_price','default_plan','packing_unit_checkbox','user_store_location_id','provider_delivery_option_id','ribbon','price_type','term_of_payment_type','has_special_delivery_condition','special_delivery_condition_type','has_special_build_mart_fees','special_build_mart_fees_type','default_amount','default_amount_build_mart_special_product','default_amount_type'];


    public function category()
    {
        return $this->hasOne('App\ProductCategory', 'id', 'category_id');
    }

    public function subCategory()
    {
        return $this->hasOne('App\ProductSubCategory', 'id', 'sub_category_id');
    }

    public function productSpecification()
    {
        return $this->hasMany('App\ProductSpecification', 'product_id', 'id');
    }

    public function productWeight()
    {
        return $this->hasMany('App\ProductWeight', 'product_id', 'id');
    }

    public function productImage()
    {
           return $this->hasOne('App\ProductImage', 'product_id', 'id');
    }

    public function productselectedcategory()
    {
        return $this->hasMany('App\ProductSelectedCategory', 'product_id', 'id');
    }
    
    public function productselectedsubcategory()
    {
        return $this->hasMany('App\ProductSelectedSubcategory', 'product_id', 'id');
    }
    
    public function productpricerange()
    {
        return $this->hasMany('App\ProductPriceRange', 'product_id', 'id');
    }
        public function producttermofpayment()
    {
        return $this->hasMany('App\ProductTermOfPayment', 'product_id', 'id');
    }
    public function notselectedplanName()
    {
        return $this->hasMany('App\ProductTermOfPayment', 'product_id', 'id')->where('selected_plan_id' ,'!=',null);
    }
     
    public function productkeyword()
    {
        return $this->hasMany('App\ProductKeyword', 'product_id', 'id');
    }
    public function productpacking()
    {
        return $this->hasMany('App\ProductPacking', 'product_id', 'id');
    }

    public function productdocument()
    {
        return $this->hasMany('App\ProductDocument', 'product_id', 'id');
    }
    
    public function productDiscountCode()
     {
         return $this->hasOne('App\DiscountedProduct', 'product_id', 'id');
     }
      //////////////07nov////change upper Product/////////////////
     // public function productDiscountCode()
     // {
     //     return $this->hasOne('App\SellerDiscountCode', 'product_id', 'id');
     // }

   public function sellerProduct() {
       return $this->hasOne('App\Product','user_store_location_id','id');
   }

   public function storeUnderProduct() {
       return $this->hasOne('App\UserStoreLocation','id','user_store_location_id');
   }

   public function product_selected_category() {
       return $this->hasMany('App\ProductSelectedCategory','product_id','id');
   }

   public function sellerName(){
       return $this->hasOne('App\User','id','user_id');
   }

   // public function productImage()
   // {
       // return $this->hasMany('App\ProductImage', 'product_id', 'id');
   // }

   public function product_Image_for_cart()
   {
       return $this->hasOne('App\ProductImage', 'product_id', 'id');
   }

   public function productPriceCartProject()
   {
       return $this->hasOne('App\ProductPriceRange', 'product_id', 'id');
   }

   public function product_Image_for_order_Item()
   {
       return $this->hasOne('App\ProductImage', 'product_id', 'id');
   }




    public function userDetail() {
        return $this->hasOne('App\User','id','user_id');
    }

    public function productSelectedCategories() {
       return $this->hasMany('App\ProductSelectedCategory','product_id','id');
    }

    public function productSpecifications() {
        return $this->hasMany('App\ProductSpecification', 'product_id', 'id');
    }

    public function productSelectedSubCategories() {
        return $this->hasMany('App\ProductSelectedSubcategory', 'product_id', 'id');
    }

    public function productSelectedSellingMaterials() {
        return $this->hasMany('App\ProductSelectedSellingMaterial', 'product_id', 'id');
    }

    public function productImages() {
        return $this->hasMany('App\ProductImage', 'product_id', 'id');
    }

    public function productRelatedLinks() {
        return $this->hasMany('App\ProductRelatedLink', 'product_id', 'id');
    }

    public function productSelectedKeywords() {
        return $this->hasMany('App\ProductSelectedKeyword', 'product_id', 'id');
    }

    public function userStoreLocationDetail() {
        return $this->hasOne('App\UserStoreLocation','id','user_store_location_id');
    }

    public function productBrandDetail() {
        return $this->hasOne('App\ProductBrand','id','product_brand_id');
    }

    public function productColorDetail() {
        return $this->hasOne('App\ProductColor','id','product_color_id');
    }

    public function countryDetail() {
        return $this->hasOne('App\Country','id','country_id');
    }

    public function productGradeDetail() {
        return $this->hasOne('App\ProductGrade','id','product_grade_id');
    }

    public function diameterUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','diameter_unit_id');
    }

    public function lengthUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','length_unit_id');
    }

    public function widthUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','width_unit_id');
    }

    public function depthUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','depth_unit_id');
    }

    public function heightUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','height_unit_id');
    }

    public function thicknessUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','thickness_unit_id');
    }

    public function particleUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','particle_unit_id');
    }

    public function productNewOptions() {
        return $this->hasMany('App\ProductNewOption', 'product_id', 'id');
    }

    public function sellingUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','selling_unit_id');
    }

    public function availableQuantityUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','available_quantity_unit_id');
    }

    public function availableQuantityContentUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','available_quantity_content_unit_id');
    }

    public function minimumBuyingQuantityUnitDetail() {
        return $this->hasOne('App\ProductSellingUnit','id','minimum_buying_quantity_unit_id');
    }

    public function productPackings() {
        return $this->hasMany('App\ProductPacking', 'product_id', 'id');
    }

    public function productPriceRanges() {
        return $this->hasMany('App\ProductPriceRange', 'product_id', 'id');
    }

    public function productTermOfPayments() {
        return $this->hasMany('App\ProductTermOfPayment', 'product_id', 'id');
    }

    public function productSpecialDeliveryFees() {
        return $this->hasMany('App\ProductSpecialDeliveryFee', 'product_id', 'id');
    }

    public function productBuildMartFees() {
        return $this->hasMany('App\ProductBuildMartFee', 'product_id', 'id');
    }

    ////////////////upload on 18 nov evening by deepak kamboj ////////////////////////////////////////

     public function product_price_range_single_unit_price()
     {
         return $this->hasOne('App\ProductPriceRange', 'product_id', 'id');
     }

     public function sellingUnitProduct()
     {
         return $this->hasOne('App\ProductSellingUnit', 'id', 'minimum_buying_quantity_unit_id');
     }

    
}
