<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class ProductCart extends Model
{
    protected $table = 'product_carts';
    protected $fillable  = ['user_id','product_id','product_quantity','product_single_unit_price','product_unit','product_store_id','product_name','cart_total_price','cart_discount_applied','cart_discount_price','cart_estimated_tax','cart_grand_total','product_price_after_discount','product_discount_code','product_discount_type','product_quantity_price','seller_id'];

      public function product_name(){
        return $this->hasOne('App\Product','id','product_id');
      }

      public static function check_coupon($data){
        
          $discountCodeRecord =  ProductCart::where('user_id',$data['userId'])
                                             ->where('product_discount_code',$data['discountCode'])
                                             ->first();
           if($discountCodeRecord!=null){
                if($discountCodeRecord['product_discount_type']=='value'){
                    // dd('value');
                 
                   $afterDiscountPrice = ProductCart::where('product_id',$discountCodeRecord['product_id'])->pluck('product_quantity_price')->sum();
                   $sellerDiscountCodeId = DiscountedProduct::with('sellerDiscountCode')
                                ->where('product_id',$discountCodeRecord['product_id'])
                                ->distinct('seller_discount_code_id')
                                ->pluck('seller_discount_code_id')
                                ->toArray();

                   $checkDiscountOfProduct = SellerDiscountCode::where('id',$sellerDiscountCodeId)->first();
                   $balanceAmount = $afterDiscountPrice - $checkDiscountOfProduct['discount_value'];

                   $response['DiscountValue']  = $checkDiscountOfProduct['discount_value'];

                }elseif ($discountCodeRecord['product_discount_type']=='percent') {

                   $afterDiscountPrice =  ProductCart::where('user_id',Auth::user()->id)
                                                     ->where('product_id',$discountCodeRecord['product_id'])
                                                     ->pluck('product_quantity_price')
                                                     ->sum();               
                    // dd($afterDiscountPrice);
                   
                    $sellerDiscountCodeId = DiscountedProduct::with('sellerDiscountCode')
                                ->where('product_id',$discountCodeRecord['product_id'])
                                ->distinct('seller_discount_code_id')
                                ->pluck('seller_discount_code_id')
                                ->toArray();


                   $checkDiscountOfProduct = SellerDiscountCode::where('id',$sellerDiscountCodeId)->first();
                   // $discountcalculatedPrice = $checkDiscountOfProduct['discount_value']*$afterDiscountPrice /100;
                   $discountcalculatedPrice = $checkDiscountOfProduct['discount_value']/100*$afterDiscountPrice;
                        // dd($discountcalculatedPrice);

                   $balanceAmount = $afterDiscountPrice - $discountcalculatedPrice;

                   $response['DiscountValue'] = $discountcalculatedPrice;
                }else{
                    $balanceAmount = 0;                  
                }

            
               $allProductsUnderStoresIds = ProductCart::where('user_id',$data['userId'])->pluck('product_id');
               
               $ProductsSum = ProductCart::where('user_id',$data['userId'])
                                            ->where('product_id','!=',$discountCodeRecord['product_id'])
                                            ->whereIn('product_id',$allProductsUnderStoresIds)
                                            ->sum('product_quantity_price');

                $withoutAnyDiscountProductsSum = ProductCart::where('user_id',$data['userId'])
                                                             ->whereIn('product_id',$allProductsUnderStoresIds)
                                                             ->sum('product_quantity_price');                             
               // dd($ProductsSum);
               
               // $allProductsExceptDiscountCodeApplyProduct = ProductCart::where('user_id',$data['userId'])
                                                            // ->where('product_id','!=',$discountCodeRecord['product_id'])
                                                            // ->pluck('product_id');

               // $allProductSum = ProductCart::whereIn('product_id',$allProductsExceptDiscountCodeApplyProduct)->get()->sum('product_quantity_price');
              
               $allProductSum1 = $ProductsSum + $balanceAmount;
               $allProductSum1 = number_format($allProductSum1, 2);
               
             
               $taxOnProductPercentage = ProductTax::first();
               $taxAmount = $taxOnProductPercentage['tax_percent']*$allProductSum1/100;
               // $taxAmount = $taxOnProductPercentage['tax_percent']/100*$allProductSum1;
               $taxAmount = number_format($taxAmount, 2);


               $balanceAfterDiscount = $allProductSum1 + $taxAmount;
            
               $balanceAfterDiscount = number_format($balanceAfterDiscount, 2);

               $response['Sum_Product_Price']      = @$withoutAnyDiscountProductsSum;
               $response['discountedAmount']       = @$allProductSum1;
               $response['taxAmount']              = @$taxAmount;
               $response['grandTotal']             = @$balanceAfterDiscount;
               $response['status']                 = 'true';
           }else{
               $allProductsUnderStoresIds = ProductCart::where('user_id',$data['userId'])->pluck('product_id');
               $allProductSum = ProductCart::where('user_id',$data['userId'])->whereIn('product_id',$allProductsUnderStoresIds)->get()->sum('product_quantity_price');
               $taxOnProductPercentage = ProductTax::first();
               $taxAmount = $taxOnProductPercentage['tax_percent']*$allProductSum/100;
               $taxAmount = number_format($taxAmount, 2);
               
               $grandTotal = $allProductSum + $taxAmount;
               $response['Sum_Product_Price']  = $allProductSum;
               $response['taxAmount']          = $taxAmount;
               $response['grandTotal']         = $grandTotal;
               $response['status']             = 'false';
            }
            return $response;
      }
}
