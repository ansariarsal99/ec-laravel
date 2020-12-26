<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get','post'],'/aboutUs','frontend\HomeController@aboutUs');
Route::match(['get','post'],'/faqs','frontend\HomeController@faqs');
Route::match(['get','post'],'/contactUs','frontend\HomeController@contactUs');

Route::match(['get','post'],'/registerToken','frontend\HomeController@registerToken');
Route::match(['get','post'],'/logout','frontend\HomeController@logout');

// ProviderController starts
Route::match(['get','post'],'/designer/list','frontend\ProviderController@designerList');
Route::match(['get','post'],'/designer/detail/{enc_designer_id}','frontend\ProviderController@designerDetail');
Route::match(['get','post'],'/contractor/list','frontend\ProviderController@contractorList');
Route::match(['get','post'],'/contractor/detail/{enc_contractor_id}','frontend\ProviderController@contractorDetail');
Route::match(['get','post'],'/consultant/list','frontend\ProviderController@consultantList');
Route::match(['get','post'],'/consultant/detail/{enc_consultant_id}','frontend\ProviderController@consultantDetail');
Route::match(['get','post'],'/seller/list','frontend\ProviderController@sellerList');
Route::match(['get','post'],'/seller/detail/{enc_seller_id}','frontend\ProviderController@sellerDetail');
Route::match(['get','post'],'termsCondtion','frontend\HomeController@getTermsAndCondtion');

Route::match(['get','post'],'/deliveryPolicy','frontend\HomeController@getDeliveryPolicy');
Route::match(['get','post'],'/career','frontend\HomeController@getCareer');
Route::match(['get','post'],'/returnAndExchangePolicy','frontend\HomeController@getReturnAndExchangePolicy');

// ProviderController ends

//
Route::match(['get','post'],'check-percentage','frontend\ProviderController@check_percentage');
//

Route::match(['get','post'],'/checkUserEmail','frontend\HomeController@checkUserEmail');
Route::match(['get','post'],'/checkUserMobile','frontend\HomeController@checkUserMobile');
Route::match(['get','post'],'/getStates','frontend\HomeController@getStates');
Route::match(['get','post'],'/getCities','frontend\HomeController@getCities');
Route::match(['get','post'],'/getCountryRelatedCities','frontend\HomeController@getCountryRelatedCities');


Route::group(['middleware'=>'GuestAuth'],function(){

   Route::match(['get','post'],'/','frontend\HomeController@index');
   Route::match(['get','post'], '/building/productList/{categoryId}','frontend\HomeController@productBuildingList');
   Route::match(['get','post'], '/wishlist/addProduct','frontend\HomeController@addProductAsWishlist');
   Route::match(['get','post'], 'cart/add-Product','frontend\HomeController@addProductAsCart');
   Route::match(['get','post'], '/compare/product','frontend\HomeController@compareProduct');
   Route::match(['get','post'], '/compare/product/Listing','frontend\HomeController@CompareProductList');
   Route::match(['get','post'], '/view/productDeatil/{productId}','frontend\HomeController@viewProductDeatil');
   Route::match(['get','post'], '/wishlist/Listing','frontend\HomeController@productWishlist');

   // Route::match(['get','post'],'/update/Cart','frontend\HomeController@updateMyCart');

   Route::match(['get','post'], 'mycart ','frontend\HomeController@myCart');



});

Route::group(['middleware'=>'guest'],function(){
    // HomeController start
    // Route::match(['get','post'],'/','frontend\HomeController@index');
    Route::match(['get','post'],'/login','frontend\HomeController@login');
    Route::match(['get','post'],'/signUp','frontend\HomeController@signUp');
    Route::match(['get','post'],'/enterOtp/{encUserId}','frontend\HomeController@enterOtp');
    Route::match(['get','post'],'/userRegistration','frontend\HomeController@userRegistration');
    Route::match(['get','post'],'/mobileOtpVerifyAjax','frontend\HomeController@mobileOtpVerifyAjax');
    Route::match(['get','post'],'/forgotPassword','frontend\HomeController@forgotPassword');
    Route::match(['get','post'],'/resetPassword/{encKey}/{encUserId}','frontend\HomeController@resetPassword');
    // Route::match(['get','post'],'termsCondtion','frontend\HomeController@getTermsAndCondtion');
    Route::match(['get','post'],'/provider/signUp','frontend\HomeController@providerSignUp');

     Route::match(['get', 'post'], '/provider/get/subcategoryAndMaterialList', 'frontend\HomeController@getSubCategoriesAndMaterialList');
    Route::match(['get', 'post'], '/provider/get/subcategory/depends/MaterialList', 'frontend\HomeController@getSubCategoriesBasedMaterialList');

    Route::match(['get','post'],'memberSignup/home','frontend\HomeController@becomeMember');
    Route::match(['get','post'],'provider/invoice-image','frontend\HomeController@invoiceImage');

    Route::match(['get', 'post'], 'add/image', 'frontend\HomeController@uploadProviderImage');
    Route::match(['get', 'post'], 'delete/image', 'frontend\HomeController@deleteImage');
    // Route::match(['get','post'],'/discountCode','frontend\HomeController@discountCode');
    Route::match(['get','post'],'/discountCode','frontend\HomeController@discountProductsCode');
    Route::match(['get','post'],'/discountCode/products','frontend\HomeController@discountCodeStore');
    // HomeController end

    //////////////////////add brand Trademark/////////////////////////////////
    Route::match(['get', 'post'], 'add/brand', 'frontend\HomeController@uploadProviderBrandImage');
    Route::match(['get', 'post'], 'delete/brand', 'frontend\HomeController@deleteBrandImage');


    // DeliverWithUsController starts
    Route::match(['get','post'],'/deliverWithUs','frontend\DeliverWithUsController@deliverWithUs');
    Route::match(['get','post'],'/deliverWithUsRegistration','frontend\DeliverWithUsController@deliverWithUsRegistration');
    Route::match(['get','post'],'/deliverWithUsRegistration/addVehicles','frontend\DeliverWithUsController@deliverWithUsRegistrationAddVehicles');
    // DeliverWithUsController ends

    Route::match(['get','post'],'/product/productDetail/{id}','frontend\HomeController@guestProductDetail');



});
// Route::match(['get','post'],'/provider/signUp','frontend\HomeController@providerSignUp');
// Route::match(['get','post'],'memberSignup/home','frontend\HomeController@becomeMember');

Route::match(['get','post'],'member-userType','frontend\HomeController@memberType');

Route::match(['get','post'],'subscription-pack-choosen','frontend\HomeController@subscriptionPackRegister');


Route::match(['get','post'],'expiry_subscription-pack-choosen','frontend\provider\SubscriptionController@expirySubscriptionPackRegister');

Route::match(['get','post'],'update_subscription-pack-choosen','frontend\provider\SubscriptionController@updateSubscriptionPackRegister');

Route::match(['get','post'],'registered-card-types','frontend\HomeController@registerCard');

Route::match(['get','post'],'getStateOfStore','frontend\HomeController@storeState');

Route::match(['get','post'],'registered-store_location','frontend\HomeController@storeLocationData');


Route::group(['middleware'=>'CheckUserAuth'],function(){
    Route::group(['prefix'=>'user'],function(){
    	Route::match(['get','post'],'/buildingMaterialServices','frontend\HomeController@buildingMaterialServices');
        // ProfileController starts
    	Route::match(['get','post'],'/profile','frontend\ProfileController@userProfile');
    	Route::match(['get','post'],'/editProfile','frontend\ProfileController@userEditProfile');
    	Route::match(['get','post'],'/changePassword','frontend\ProfileController@userChangePassword');

        Route::match(['get','post'],'/locations','frontend\ProfileController@userLocations');
        Route::match(['get','post'],'/paymentMethods','frontend\ProfileController@userPaymentMethods');
        Route::match(['get','post'],'/address/add','frontend\ProfileController@userAddAddress');
        Route::match(['get','post'],'/card/add','frontend\ProfileController@userAddCard');
        Route::match(['get','post'],'/address/editModal/{enc_address_id}','frontend\ProfileController@userEditAddressModal');
        Route::match(['get','post'],'/address/update','frontend\ProfileController@userUpdateAddress');
        Route::match(['get','post'],'/address/delete/{enc_address_id}','frontend\ProfileController@userDeleteAddress');
        Route::match(['get','post'],'/card/editModal/{enc_card_id}','frontend\ProfileController@userEditCardModal');
        Route::match(['get','post'],'/card/update','frontend\ProfileController@userUpdateCard');
        Route::match(['get','post'],'/card/delete/{enc_address_id}','frontend\ProfileController@userDeleteCard');
        Route::match(['get','post'],'/card/default/update','frontend\ProfileController@userUpdateDefaultCard');
        Route::match(['get','post'],'/address/default/update','frontend\ProfileController@userUpdateDefaultAddress');
        // ProfileController ends

        // RequestForProposalController starts
        Route::match(['get','post'],'/requestForProposal','frontend\RequestForProposalController@requestForProposal');
        Route::match(['get','post'],'/requestForProposal/updateStep','frontend\RequestForProposalController@requestForProposalUpdateStep');
        Route::match(['get','post'],'/requestForProposal/updateServiceCategories/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalUpdateServiceCategories');
        Route::match(['get','post'],'/requestForProposal/updateProjectDetail/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalUpdateProjectDetail');
        Route::match(['get','post'],'/requestForProposal/updateRequestDetail/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalUpdateRequestDetail');
        Route::match(['get','post'],'/requestForProposal/updateProjectSite/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalUpdateProjectSite');
        Route::match(['get','post'],'/requestForProposal/updateRepresentative/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalUpdateRepresentative');
        Route::match(['get','post'],'/requestForProposal/updateAttachFile/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalUpdateAttachFile');
        Route::match(['get','post'],'/reviewProposalRequest/{enc_req_for_proposal_id}','frontend\RequestForProposalController@reviewProposalRequest');
        Route::match(['get','post'],'/requestForProposal/inviteeDelete','frontend\RequestForProposalController@requestForProposalInviteeDelete');
        Route::match(['get','post'],'/requestForProposal/searchProviders','frontend\RequestForProposalController@requestForProposalSearchProviders');
        Route::match(['get','post'],'/requestForProposal/inviteeAdd/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalInviteeAdd');
        Route::match(['get','post'],'/requestForProposal/selectServiceCategories','frontend\RequestForProposalController@requestForProposalSelectServiceCategories');
        Route::match(['get','post'],'/requestForProposal/selectedProviders','frontend\RequestForProposalController@requestForProposalSelectedProviders');
        Route::match(['get','post'],'/requestForProposal/submit/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalSubmit');
        Route::match(['get','post'],'/requestForProposal/saveForLater/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalSaveForLater');

        Route::match(['get','post'],'/requestForProposal/uploadAttachFile/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalUploadAttachFile');
        Route::match(['get','post'],'/requestForProposal/deleteAttachFile/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalDeleteAttachFile');
        Route::match(['get','post'],'/requestForProposal/attachFiles/{enc_req_for_proposal_id}','frontend\RequestForProposalController@requestForProposalAttachFiles');

        Route::match(['get','post'],'/requestForProposal/providerCheck','frontend\RequestForProposalController@requestForProposalProviderCheck');
        Route::match(['get','post'],'/requestForProposal/providerAllCheck','frontend\RequestForProposalController@requestForProposalProviderAllCheck');

        Route::match(['get','post'],'/quotations','frontend\RequestForProposalController@quotations');
        Route::match(['get','post'],'/reviewProposalRequestDetail/{enc_req_id}','frontend\RequestForProposalController@reviewProposalRequestDetail');
        Route::match(['get','post'],'/proposalHistory/{enc_req_id}','frontend\RequestForProposalController@proposalHistory');

        Route::match(['get','post'],'/submittedOffers','frontend\RequestForProposalController@submittedOffers');
        Route::match(['get','post'],'/requestForProposalDelete/{enc_req_id}','frontend\RequestForProposalController@requestForProposalDelete');
        Route::match(['get','post'],'/requestForProposalAccept/{enc_req_id}','frontend\RequestForProposalController@requestForProposalAccept');
        Route::match(['get','post'],'/requestForProposalReject/{enc_req_id}','frontend\RequestForProposalController@requestForProposalReject');
        Route::match(['get','post'],'/trackRFPRequest','frontend\RequestForProposalController@trackRFPRequest');
        Route::match(['get','post'],'/trackAllRFP','frontend\RequestForProposalController@trackAllRFP');

        Route::match(['get','post'],'/myRequests','frontend\RequestForProposalController@myRequests');
        Route::match(['get','post'],'/myRequests/index','frontend\RequestForProposalController@myRequestsIndex');
        Route::match(['get','post'],'/requestForProposal/cancel','frontend\RequestForProposalController@cancelRequestForProposal');
        Route::match(['get','post'],'/requestForProposal/delete','frontend\RequestForProposalController@deleteRequestForProposal');
        Route::match(['get','post'],'/requestForProposal/changeSubmissionDeadline','frontend\RequestForProposalController@changeSubmissionDeadlineRequestForProposal');
        Route::match(['get','post'],'/manageRequest/{enc_req_id}','frontend\RequestForProposalController@manageRequest');
        Route::match(['get','post'],'/requestDocumentCenter/{enc_req_assign_to_user_id}','frontend\RequestForProposalController@requestDocumentCenter');
        Route::match(['get','post'],'/requestChatDocumentCenter/{enc_other_user_id}','frontend\provider\RequestForProposalController@requestChatDocumentCenter');

        Route::match(['get','post'],'/requestForProposalAssignToUser/cancel','frontend\RequestForProposalController@cancelRequestForProposalAssignToUser');
        Route::match(['get','post'],'/requestForProposalAssignToUser/reject','frontend\RequestForProposalController@rejectRequestForProposalAssignToUser');
        Route::match(['get','post'],'/requestForProposalAssignToUser/accept','frontend\RequestForProposalController@acceptRequestForProposalAssignToUser');
        Route::match(['get','post'],'/requestForProposalAssignToUser/delete','frontend\RequestForProposalController@deleteRequestForProposalAssignToUser');

        // RequestForProposalController ends
        Route::match(['get','post'],'/advertisemnt/list','frontend\ProfileController@userAdvertisement');
        Route::match(['get','post'],'/advertisemnt/index','frontend\ProfileController@userAdvertisementListIndex');
        Route::match(['get','post'],'/advertisemnt/user/add','frontend\ProfileController@AddAdvertisement');
        Route::match(['get','post'],'/advertisemnt/user/edit/{id}','frontend\ProfileController@EditAdvertisement');
        Route::match(['get','post'],'/advertisemnt/user/delete/{id}','frontend\ProfileController@deleteAdvertisement');
        Route::match(['get','post'],'/myMembership','frontend\ProfileController@myMembership');

       Route::match(['get','post'],'/productseller/detail/{id}','frontend\HomeController@viewSellerDeatil');




         ////////choose delivery options//////////////////////
        // chooseDeliveryOption
         Route::match(['get','post'],'/chooseDeliveryOption','frontend\ProfileController@chooseDeliveryOption');

         ///////////cart//////////////

         Route::match(['get','post'],'/update/Cart','frontend\HomeController@updateMyCart');
         Route::match(['get','post'],'/check/CouponInCart','frontend\HomeController@checkCouponInCart');

          //////////////////Address cart/////////////////////////////

         Route::match(['get','post'],'deliverey/address/add','frontend\HomeController@cartAddDeliveryAddress');
         Route::match(['get','post'],'/deliverey/address/editModal/{enc_address_id}','frontend\HomeController@cartEditAddressModal');
         Route::match(['get','post'],'/deliverey/address/update','frontend\HomeController@cartUpdateAddress');
         Route::match(['get','post'],'/deliverey/address/delete/{enc_address_id}','frontend\HomeController@cartDeleteAddress');

       ///////////////////////////////////////////////////////////////////
         Route::match(['get','post'],'deliverey/card/add','frontend\HomeController@cardAddedToCart');
         Route::match(['get','post'],'deliverey/card/editModal/{enc_card_id}','frontend\HomeController@cartEditCardModal');
         Route::match(['get','post'],'/deliverey/card/update','frontend\HomeController@cartUpdateCard');
         Route::match(['get','post'],'/deliverey/card/delete/{enc_address_id}','frontend\HomeController@userDeleteCard');
         Route::match(['get','post'],'deliverey/payment','frontend\HomeController@cartPayment');

         Route::match(['get','post'],'/product/orderDetails/printInvoice','frontend\ProfileController@getWithoutPdf');
         Route::match(['get','post'],'/myOrder/cancelOrder','frontend\ProfileController@cancelOrder');

       // Route::match(['get','post'],'/product/myOrders','frontend\ProfileController@myOrders');
       // Route::match(['get','post'],'/product/orderDetails/{id}','frontend\ProfileController@orderDetails');

        // NotificationController starts
        Route::match(['get','post'],'/notifications','frontend\NotificationController@notifications');
        // NotificationController ends

        // Route::match(['get','post'], 'mycart ','frontend\HomeController@myCart');
        Route::match(['get','post'],'/product/myOrders','frontend\ProfileController@myOrders');
        Route::match(['get','post'],'/product/orderDetails/{id}','frontend\ProfileController@orderDetails');
        ///////////CANCELLED ORDER DETAIL/////////////////////////////
        Route::match(['get','post'],'/product/CancelledOrderDetails/{id}','frontend\ProfileController@cancelledOrderDetails');

        Route::match(['get','post'],'/product/rating/review','frontend\ProfileController@myRatingReview');

        // ChatController starts
        Route::match(['get','post'],'/messages','frontend\ChatController@messages');
        Route::match(['get','post'],'/chat/getView','frontend\ChatController@userChatGetView');
        Route::match(['get','post'],'/chat/updateSidebarLastMessage','frontend\ChatController@userChatUpdateSidebarLastMessage');
        Route::match(['get','post'],'/chat/onlineStatus','frontend\ChatController@userChatOnlineStatus');
        // ChatController ends

    });

    Route::group(['prefix'=>'provider'],function(){
        Route::match(['get','post'],'/profile','frontend\provider\ProfileController@providerProfile');
        Route::match(['get','post'],'/editProfile','frontend\provider\ProfileController@providerEditProfile');

        Route::match(['get', 'post'], '/profile/get/subcategoryAndMaterialList', 'frontend\provider\ProfileController@getSubCategoriesAndMaterialListForSeller');

        Route::match(['get', 'post'], '/get/subcategory/depends/MaterialList', 'frontend\provider\ProfileController@getSubCategoriesBasedMaterialListForSeller');

        Route::match(['get','post'],'/changePassword','frontend\provider\ProfileController@providerChangePassword');
        Route::match(['get','post'],'/paymentMethods','frontend\provider\ProfileController@providerPaymentMethods');
        Route::match(['get','post'],'/card/add','frontend\provider\ProfileController@providerAddCard');
        Route::match(['get','post'],'/card/editModal/{enc_card_id}','frontend\provider\ProfileController@providerEditCardModal');
        Route::match(['get','post'],'/card/update','frontend\provider\ProfileController@providerUpdateCard');
        Route::match(['get','post'],'/card/delete/{enc_address_id}','frontend\provider\ProfileController@providerDeleteCard');
        Route::match(['get','post'],'/card/default/update','frontend\provider\ProfileController@providerUpdateDefaultCard');
        Route::match(['get','post'],'/storeLocations','frontend\provider\ProfileController@providerStoreLocations');
        Route::match(['get','post'],'/storeLocation/add','frontend\provider\ProfileController@providerAddStoreLocation');
        Route::match(['get','post'],'/storeLocation/default/update','frontend\provider\ProfileController@providerUpdateDefaultStoreLocation');
        Route::match(['get','post'],'/storeLocation/delete/{enc_address_id}','frontend\provider\ProfileController@providerDeleteStoreLocation');
        Route::match(['get','post'],'/storeLocation/editModal/{enc_address_id}','frontend\provider\ProfileController@providerEditStoreLocationModal');
        Route::match(['get','post'],'/storeLocation/update','frontend\provider\ProfileController@providerUpdateStoreLocation');

        Route::match(['get','post'],'/subscription-pack','frontend\provider\ProfileController@providerSubscription');

        Route::match(['get','post'],'/TermsOfPayment','frontend\provider\ProfileController@providerTermsPayment');

        Route::match(['get','post'],'/termsPaymentAddNewMethod','frontend\provider\ProfileController@providerTermsPaymentAddNewMethod');

        Route::match(['get','post'],'/edit/paymentmethod/{id}','frontend\provider\ProfileController@providerTermsPaymentEditMethod');
        Route::match(['get','post'],'/delete/paymentmethod/{id}','frontend\provider\ProfileController@providerTermsPaymentdeleteMethod');

        Route::match(['get','post'],'/paymentmethod/default/update','frontend\provider\ProfileController@providerUpdateDefaulTermsPayment');
        Route::match(['get','post'],'products/add','frontend\provider\ProductsController@addProduct');
        Route::match(['get','post'],'products/list','frontend\provider\ProductsController@listProducts');
        Route::match(['get', 'post'], 'get/subcategory', 'frontend\provider\ProductsController@getSubCategories');
        Route::match(['get', 'post'], 'get/typeOfMaterial', 'frontend\provider\ProductsController@getTypeOfMaterials');
        Route::match(['get', 'post'], 'product/add/weight', 'frontend\provider\ProductsController@addWeight');
        Route::match(['get', 'post'], 'product/add/specification', 'frontend\provider\ProductsController@addSpecification');
        Route::match(['get', 'post'], 'product/delete/specification/{id}', 'frontend\provider\ProductsController@deleteSpecification');

        Route::match(['get', 'post'], 'product/add/productBrand', 'frontend\provider\ProductsController@addProductBrand');
        Route::match(['get', 'post'], 'product/add/productColor', 'frontend\provider\ProductsController@addProductColor');
        Route::match(['get', 'post'], 'product/add/productCountry', 'frontend\provider\ProductsController@addProductCountry');
        Route::match(['get', 'post'], 'product/add/productGrade', 'frontend\provider\ProductsController@addProductGrade');
        Route::match(['get', 'post'], 'product/add/productSellingUnit', 'frontend\provider\ProductsController@addProductSellingUnit');
        Route::match(['get', 'post'], 'product/add/productNewOption', 'frontend\provider\ProductsController@addProductNewOption');

        Route::match(['get', 'post'], 'product/add/productBrand/validate', 'frontend\provider\ProductsController@addProductBrandValidate');
        Route::match(['get', 'post'], 'product/add/productColor/validate', 'frontend\provider\ProductsController@addProductColorValidate');
        Route::match(['get', 'post'], 'product/add/productCountry/validate', 'frontend\provider\ProductsController@addProductCountryValidate');
        Route::match(['get', 'post'], 'product/add/productGrade/validate', 'frontend\provider\ProductsController@addProductGradeValidate');
        Route::match(['get', 'post'], 'product/add/productSellingUnit/validate', 'frontend\provider\ProductsController@addProductSellingUnitValidate');

        Route::match(['get', 'post'], 'product/add/image', 'frontend\provider\ProductsController@uploadProductImage');
        Route::match(['get', 'post'], 'product/delete/image', 'frontend\provider\ProductsController@deleteProductImage');

          Route::match(['get', 'post'], 'product/add/productDocument', 'frontend\provider\ProductsController@uploadProductDocument');

        Route::match(['get', 'post'], 'product/delete/productDocument', 'frontend\provider\ProductsController@deleteProductDocument');

        Route::match(['get','post'],'/productseller/detail/{id}','frontend\HomeController@viewSellerDeatil');

         Route::match(['get','post'],'/deliveryTerm/add','frontend\provider\ProfileController@addDeliveryTermsPayment');

         Route::match(['get','post'],'/deliveryTerm/edit/{id}','frontend\provider\ProfileController@editDeliveryTermsPayment');

         Route::match(['get','post'],'/deliveryTerm/delete/{id}','frontend\provider\ProfileController@deleteDeliveryTermsPayment');

         Route::match(['get','post'],'/delveryterms/list','frontend\provider\ProfileController@providerDeliveryPaymentList');

         Route::match(['get','post'],'/delveryterms/list/Index','frontend\provider\ProfileController@providerDeliveryPaymentListIndex');

         Route::match(['get','post'],'/delivery-check-name
          ','frontend\provider\ProfileController@validateFromOrderAmount');

         Route::match(['get','post'],'/delivery/check/toOrderedAmount/name
          ','frontend\provider\ProfileController@validateToOrderAmount');

         Route::match(['get','post'],'/delivery/update/fromOrderedAmount/name
          ','frontend\provider\ProfileController@validateEditFromOrderAmount');

         Route::match(['get','post'],'/delivery/update/toOrderedAmount/name
          ','frontend\provider\ProfileController@validateEditToOrderAmount');

         //////////////////////////////Add Trademark Image /////////////////////////////////////////
         Route::match(['get', 'post'], 'add/dropzone/Brand/image', 'frontend\provider\ProfileController@addDropzoneBrandImage');

         Route::match(['get', 'post'], '/dropzone/Brand/image/edit/{id}', 'frontend\provider\ProfileController@getProviderTrademarkImage');

         Route::match(['get', 'post'], '/dropzone/Brand/image/remove', 'frontend\provider\ProfileController@deleteProviderTrademarkImage');


         ////////////////////////////// End Add Trademark Image/////////////////////////////////////////



        Route::match(['get','post'],'products/list/index','frontend\provider\ProductsController@productsListIndex');
        Route::match(['get','post'],'products/delete/{id}','frontend\provider\ProductsController@deleteProduct');
        Route::match(['get','post'],'products/change/status','frontend\provider\ProductsController@changeStatus');
        Route::match(['get','post'],'products/view/{id}','frontend\provider\ProductsController@viewProduct');
        Route::match(['get','post'],'products/images/{id}','frontend\provider\ProductsController@getProductImages');

        Route::match(['get','post'],'products/specialBuildMartFees/{enc_product_id}','frontend\provider\ProductsController@productSpecialBuildMartFees');

        Route::match(['get','post'],'products/edit/specification','frontend\provider\ProductsController@editProductSpecification');
        Route::match(['get','post'],'products/edit/weight','frontend\provider\ProductsController@editProductWeight');
        Route::match(['get','post'],'products/edit/{id}','frontend\provider\ProductsController@editProduct');
        Route::match(['get','post'],'products/weight','frontend\provider\ProductsController@getProductWeight');
        Route::match(['get','post'],'products/specification','frontend\provider\ProductsController@getProductSpecification');
        Route::match(['get','post'],'products/delete/weight/{id}','frontend\provider\ProductsController@deleteProductWeight');
        Route::match(['get','post'],'products/delete/specification/{id}','frontend\provider\ProductsController@deleteProductSpecification');
        Route::match(['get','post'],'check/product/images','frontend\provider\ProductsController@checkProductImages');

      Route::match(['get','post'],'products/update/specification','frontend\provider\ProductsController@updateProductSpecification');

         Route::match(['get','post'],'/advertisemnt/list','frontend\provider\ProfileController@providerAdvertisement');
        Route::match(['get','post'],'/advertisemnt/index','frontend\provider\ProfileController@providerAdvertisementListIndex');

        Route::match(['get','post'],'/advertisemnt/add','frontend\provider\ProfileController@providerAddAdvertisement');
        Route::match(['get','post'],'/advertisemnt/edit/{id}','frontend\provider\ProfileController@providerEditAdvertisement');
        Route::match(['get','post'],'/advertisemnt/delete/{id}','frontend\provider\ProfileController@providerDeleteAdvertisement');

        Route::match(['get','post'],'/myMembership','frontend\provider\ProfileController@providerMyMembership');
        // Route::match(['get', 'post'], '/image/edit/{id}', 'frontend\provider\ProfileController@getProductImage');
        Route::match(['get', 'post'], 'image/edit/{id}', 'frontend\provider\ProfileController@getProviderMultipleImage');
        Route::match(['get', 'post'], '/image/remove', 'frontend\provider\ProfileController@deleteProviderImages');
        Route::match(['get', 'post'], 'add/dropzone/image', 'frontend\provider\ProfileController@addDropzoneImage');

        // Route::match(['get','post'], '/building/productList/{categoryId}','frontend\HomeController@productBuildingList');
        // Route::match(['get','post'], '/wishlist/addProduct','frontend\HomeController@addProductAsWishlist');
        // Route::match(['get','post'], '/wishlist/Listing','frontend\HomeController@productWishlist');
        // Route::match(['get','post'], '/view/productDeatil/{productId}','frontend\HomeController@viewProductDeatil');

        Route::match(['get','post'], '/ask/question/seller','frontend\HomeController@askQuestionToSeller');

        Route::match(['get','post'], '/wishlist/addCartProduct','frontend\HomeController@addCartProductAsWishlist');


        Route::match(['get','post'],'/trackAllRFPs','frontend\provider\RequestForProposalController@trackAllRFPs');
        Route::match(['get','post'],'/trackAllRFPs/index','frontend\provider\RequestForProposalController@trackAllRFPsIndex');

        Route::match(['get','post'],'/trackRFPRequest','frontend\provider\RequestForProposalController@trackRFPRequest');
        Route::match(['get','post'],'/trackAllRFP','frontend\provider\RequestForProposalController@trackAllRFP');
        Route::match(['get','post'],'/quotations','frontend\provider\RequestForProposalController@quotations');
        Route::match(['get','post'],'/reviewProposalRequestDetail/{enc_req_id}','frontend\provider\RequestForProposalController@reviewProposalRequestDetail');
        Route::match(['get','post'],'/requestForProposalDelete/{enc_req_id}','frontend\provider\RequestForProposalController@requestForProposalDelete');
        Route::match(['get','post'],'/quotation/accept','frontend\provider\RequestForProposalController@quotationAccept');
        Route::match(['get','post'],'/requestForProposalReject/{enc_req_id}','frontend\provider\RequestForProposalController@requestForProposalReject');
        Route::match(['get','post'],'/quotation/respond','frontend\provider\RequestForProposalController@quotationRespond');
        Route::match(['get','post'],'/quotation/respond/delete/{enc_rsp_id}','frontend\provider\RequestForProposalController@deleteQuotationRespond');
        Route::match(['get','post'],'/requestDocumentCenter/{enc_req_assign_to_user_id}','frontend\provider\RequestForProposalController@requestDocumentCenter');
        Route::match(['get','post'],'/requestChatDocumentCenter/{enc_other_user_id}','frontend\provider\RequestForProposalController@requestChatDocumentCenter');

        Route::match(['get','post'],'export/trackRFPRequestListExport','ExportController@trackRFPRequestListExport');
        // Route::match(['get','post'], '/compare/product','frontend\HomeController@compareProduct');
        // Route::match(['get','post'], '/compare/product/Listing','frontend\HomeController@CompareProductList');

        // ChatController starts
        Route::match(['get','post'],'/messages','frontend\ChatController@messages');
        // ChatController ends

        Route::match(['get','post'],'product/selling_unit/add','frontend\provider\ProductsController@addPackingUnit');
        Route::match(['get','post'],'product/packng_unit/add','frontend\provider\ProductsController@addNewPackingUnit');
       Route::match(['get','post'],'product/new_packng_unit/add','frontend\provider\ProductsController@getPackingUnit');

        Route::match(['get','post'],'product/termOfPayment/add','frontend\provider\ProductsController@addtermOfPayment');
        Route::match(['get','post'],'product/termOfPayment/remove','frontend\provider\ProductsController@removeTermOfPayment');
        Route::match(['get','post'],'product/checkTermOfPayment/range','frontend\provider\ProductsController@checkTermOfPaymentRange');

        Route::match(['get','post'],'product/specialDeliveryFee/add','frontend\provider\ProductsController@addSpecialDeliveryFee');
        Route::match(['get','post'],'product/specialDeliveryFee/remove','frontend\provider\ProductsController@removeSpecialDeliveryFee');
        Route::match(['get','post'],'product/checkSpecialDeliveryFee/range','frontend\provider\ProductsController@checkSpecialDeliveryFee');

        Route::match(['get','post'],'product/priceRange/add','frontend\provider\ProductsController@addProductPriceRange');
        Route::match(['get','post'],'product/checkPriceRange/range','frontend\provider\ProductsController@checkRangeOfPriceRange');


        Route::match(['get','post'], '/trackInqueries','frontend\ProviderController@inqueriesList');

        Route::match(['get','post'], '/Inqueries/index','frontend\ProviderController@inquery_ListIndex');

        Route::match(['get','post'], '/trackInqueries/response/send','frontend\ProviderController@sendReply');


        Route::match(['get','post'],'services/add','frontend\provider\ServiceController@addService');
        Route::match(['get','post'],'services/list','frontend\provider\ServiceController@listServices');
        Route::match(['get','post'],'services/list/index','frontend\provider\ServiceController@servicesListIndex');

        Route::match(['get','post'],'services/delete/{id}','frontend\provider\ServiceController@deleteService');
        Route::match(['get','post'],'services/edit/{id}','frontend\provider\ServiceController@editService');
        Route::match(['get','post'],'services/change/status','frontend\provider\ServiceController@changeServiceStatus');

        Route::match(['get','post'],'services-edit/specification','frontend\provider\ServiceController@editServiceSpecification');

        Route::match(['get','post'],'services/delete/specification/{id}','frontend\provider\ServiceController@deleteServiceSpecification');

        Route::match(['get','post'],'service/specification','frontend\provider\ServiceController@getServiceSpecification');

        Route::match(['get','post'],'services/view/{id}','frontend\provider\ServiceController@viewService');

        // NotificationController starts
        Route::match(['get','post'],'/notifications','frontend\provider\NotificationController@notifications');
        // NotificationController ends

        // Route::match(['get','post'], 'cart/add-Product','frontend\HomeController@addProductAsCart');

        // Route::match(['get','post'], 'mycart ','frontend\HomeController@myCart');

        Route::match(['get','post'], 'cartItem/delete/{id}','frontend\HomeController@deleteMyCartItem');

        Route::match(['get','post'], 'cart/address/add','frontend\HomeController@addressToCart');

         //subscription
        Route::match(['get','post'],'payment_subscription_pack_choosen','frontend\provider\SubscriptionController@paymentSubscriptionPackRegister');
        Route::match(['get','post'],'subscription/payment','frontend\provider\SubscriptionController@subscriptionPayment');


         ////////Discount Codes////////////
          Route::match(['get','post'], '/discountCode/list','frontend\provider\DiscountCodeController@discountCodeList');
          Route::match(['get','post'], '/discountCode/List/Index','frontend\provider\DiscountCodeController@discountCodeListIndex');
          Route::match(['get','post'], '/discountCode/add','frontend\provider\DiscountCodeController@addDiscountCode');
          Route::match(['get','post'], '/discountCode/edit/{id}','frontend\provider\DiscountCodeController@editDiscountCode');
          Route::match(['get','post'], '/discountCode/change/status','frontend\provider\DiscountCodeController@changeStatusdiscountCode');

          Route::match(['get','post'], '/discountCode/delete/{id}','frontend\provider\DiscountCodeController@deleteDiscountCode');

         Route::match(['get','post'],'/chooseDeliveryOption','frontend\provider\ProfileController@chooseDeliveryOption');


         Route::match(['get','post'],'/productCancellationRequest/list','frontend\provider\OrderManagementController@productCancellationRequestList');
         Route::match(['get','post'],'/productCancellationRequest/list/Index','frontend\provider\OrderManagementController@productCancellationRequestListIndex');

         Route::match(['get','post'],'/view/productCancellationRequest/{id}','frontend\provider\OrderManagementController@viewProductCancellationRequest');

           Route::match(['get','post'],'/productCancellationRequest/Accepted/BySeller','frontend\provider\OrderManagementController@acceptedProductCancellationRequest');

         Route::match(['get','post'],'/productCancellationRequest/Rejected/BySeller','frontend\provider\OrderManagementController@rejectedProductCancellationRequest');



         Route::match(['get','post'],'/cancelled/Order/list','frontend\provider\OrderManagementController@cancelledOrderList');

         Route::match(['get','post'],'/cancelled/Order/list/Index','frontend\provider\OrderManagementController@cancelledOrderListIndex');

         Route::match(['get','post'],'view/cancelled/order/{id}','frontend\provider\OrderManagementController@viewCancelledOrderDetail');



         Route::match(['get','post'],'/orderProduct/list','frontend\provider\OrderManagementController@orderProductList');

         Route::match(['get','post'],'/orderProduct/list/Index','frontend\provider\OrderManagementController@orderProductListIndex');

         Route::match(['get','post'],'/view/orderProduct/detail/{id}','frontend\provider\OrderManagementController@viewOrderDetail');

         Route::match(['get','post'],'/updated/orderProduct/status/ofSeller','frontend\provider\OrderManagementController@updatedOrderStatusBySeller');

         Route::match(['get','post'],'/change/orderProduct/status/bySeller','frontend\provider\OrderManagementController@changeOrderStatusBySeller');


         ///////////refund orders//////////////////////
           Route::match(['get','post'],'/refund/Order/list','frontend\provider\OrderManagementController@refundOrderList');

           Route::match(['get','post'],'/refund/Order/list/Index','frontend\provider\OrderManagementController@refundOrderListIndex');

           Route::match(['get','post'],'/updated/RefundProduct/status/ofSeller','frontend\provider\OrderManagementController@updatedRefundStatusBySeller');

           Route::match(['get','post'],'/change/RefundProduct/status/bySeller','frontend\provider\OrderManagementController@changeRefundStatusBySeller');

           Route::match(['get','post'],'/get/filtered/product/seller','frontend\provider\OrderManagementController@filterProductsSeller');

           Route::match(['get','post'],'/refund/Order/list/detail/{encod_id}','frontend\provider\OrderManagementController@refundOrderSellerDetail');

           Route::match(['get','post'],'/product/refundOrder/invoice','frontend\provider\OrderManagementController@getOrderPdf');


           /////////////////////////////Closed Order////////////////////

           Route::match(['get','post'],'/closed/Order/list','frontend\provider\OrderManagementController@closedOrderList');

           Route::match(['get','post'],'/complete/refund/Order/list','frontend\provider\OrderManagementController@RefundCompletedOrderList');

           //////////////Earning Management///////////////////////////////
           Route::match(['get','post'],'/earning/list','frontend\provider\ReportManagementController@earningList');
           Route::match(['get','post'],'/earning/commission/BuildMartCommision','frontend\provider\ReportManagementController@sendBuildMartCommision');



        // Frontend export started
        Route::match(['get','post'],'export/serviceList','ExportController@serviceExportListExport');
        Route::match(['get','post'],'export/user_InqueryList','ExportController@exportUserInquery');

        // ChatController starts
        Route::match(['get','post'],'/messages','frontend\provider\ChatController@messages');
        Route::match(['get','post'],'/chat/getView','frontend\provider\ChatController@userChatGetView');
        // ChatController ends

        // DeliverWithUsController starts
        Route::match(['get','post'],'/deliverWithUs','frontend\provider\DeliverWithUsController@deliverWithUs');
        Route::match(['get','post'],'/deliverWithUsRegistration','frontend\provider\DeliverWithUsController@deliverWithUsRegistration');
        Route::match(['get','post'],'/deliverWithUsRegistration/addVehicles','frontend\provider\DeliverWithUsController@deliverWithUsRegistrationAddVehicles');
        Route::match(['get','post'],'/deliveryPerson/list','frontend\provider\DeliverWithUsController@deliveryPersonList');
        Route::match(['get','post'],'/deliveryPerson/detail/{id}','frontend\provider\DeliverWithUsController@deliveryPersonDetail');
        // DeliverWithUsController ends

        // BuildMartFeeController starts
        Route::match(['get','post'],'/buildMartFees','frontend\provider\BuildMartFeeController@buildMartFees');
        Route::match(['get','post'],'/buildMartFees/approve','frontend\provider\BuildMartFeeController@approveBuildMartFees');

        // BuildMartFeeController ends
    });



});


// AdminController

Route::match(['get','post'],'admin/insert','AdminController@insert');
Route::match(['get','post'],'admin','AdminController@login');
Route::match(['get','post'],'admin/forgetpassword','AdminController@forgotPassword');
Route::match(['get','post'],'admin/passwordReset','AdminController@getResetPassword');

Route::group(['middleware'=>'admin','prefix'=>'admin'],function(){

    Route::match(['get','post'],'dashboard','AdminController@dashboard');
    Route::match(['get','post'],'logout','AdminController@logout');
    Route::match(['get','post'],'profile','AdminController@profile');
    Route::match(['get','post'],'profile/changePassword','AdminController@changePassword');
    Route::match(['get','post'],'profile-image','AdminController@profileImage');
    Route::match(['get','post'],'generalManagement/countries/list','CountryController@countryList');
    Route::match(['get','post'],'generalManagement/countries/index','CountryController@countryListIndex');
    Route::match(['get','post'],'generalManagement/countries/status','CountryController@changeStatus');
    Route::match(['get','post'],'generalManagement/countries/add','CountryController@addCountry');
    Route::match(['get','post'],'generalManagement/countries/edit/','CountryController@updateCountry');
    Route::match(['get','post'],'generalManagement/countries/delete/{id}','CountryController@deleteCountry');

    Route::match(['get','post'],'generalManagement/check/name','CountryController@validateCountryName');
    Route::match(['get','post'],'generalManagement/edit/name','CountryController@validateEditCountryName');

    Route::match(['get','post'],'generalManagement/states/list','StateController@stateList');
    Route::match(['get','post'],'generalManagement/states/index','StateController@stateListIndex');
    Route::match(['get','post'],'generalManagement/states/status','StateController@changeStatus');
    Route::match(['get','post'],'generalManagement/states/add','StateController@addState');
    Route::match(['get','post'],'generalManagement/states/edit/','StateController@updateState');
    Route::match(['get','post'],'generalManagement/states/delete/{id}','StateController@deleteState');


    Route::match(['get','post'],'generalManagement/checkState/name','StateController@validateStateName');
    Route::match(['get','post'],'generalManagement/editState/name','StateController@validateEditStateName');


    Route::match(['get','post'],'generalManagement/cities/list','CityController@cityList');
    Route::match(['get','post'],'generalManagement/cities/index','CityController@cityListIndex');
    Route::match(['get','post'],'generalManagement/cities/status','CityController@changeStatus');
    Route::match(['get','post'],'generalManagement/cities/add','CityController@addCity');
    Route::match(['get','post'],'generalManagement/cities/edit/','CityController@updateCity');
    Route::match(['get','post'],'generalManagement/cities/delete/{id}','CityController@deleteCity');
    Route::match(['get','post'],'generalManagement/changeCountry','CityController@changeCountry');
    Route::match(['get','post'],'generalManagement/changeState','CityController@changeState');

    Route::match(['get','post'],'generalManagement/checkCity/name','CityController@validateCityName');
    Route::match(['get','post'],'generalManagement/editCity/name','CityController@validateEditCityName');

    Route::match(['get','post'],'contentManagement/termAndCondtion','ContentManagementController@term');

     Route::match(['get','post'],'contentManagement/deliveryPolicy','ContentManagementController@deliveryPolicy');

    Route::match(['get','post'],'contentManagement/Career','ContentManagementController@Career');
    Route::match(['get','post'],'contentManagement/ReturnAndExchangePolicy','ContentManagementController@ReturnAndExchangePolicy');


    Route::match(['get','post'],'subscriptionManagement/subscribeList','SubscriptionController@subscriptionList');
    Route::match(['get','post'],'subscriptionManagement/subscriptionListIndex','SubscriptionController@subscriptionListIndex');

    Route::match(['get','post'],'subscriptionManagement/addSubscription','SubscriptionController@addSubscription');
    Route::match(['get','post'],'subscriptionManagement/editSubscription/{id}','SubscriptionController@updateSubscription');

    Route::match(['get','post'],'subscriptionManagement/deleteSubscription/{id}','SubscriptionController@deleteSubscription');

    Route::match(['get','post'],'subscriptionManagement/subscription/status','SubscriptionController@changeStatus');

    Route::match(['get','post'],'user/userList','UserController@userdataList');
    Route::match(['get','post'],'userManagement/listIndex','UserController@userListIndex');

    Route::match(['get','post'],'userManagement/detail/{id}','UserController@detail');

    Route::match(['get','post'],'userManagement/individual/status','UserController@changeUserIndividualStatus');


   Route::match(['get','post'],'user/Institution/userList','UserController@userInstitutionList');
 Route::match(['get','post'],'user/InstitutionuserListIndex','UserController@userInstitutionListIndex');

    Route::match(['get','post'],'userManagement/Institutiondetail/{id}','UserController@userInstitutiondetail');
    Route::match(['get','post'],'userManagement/institution/status','UserController@changeUserInstitutionStatus');
    Route::match(['get','post'],'user/userDeliveryAddressIndividual/{id}','UserController@userDeliveryAdressIndividual');
    Route::match(['get','post'],'user/userDeliveryAddress/{id}','UserController@userDeliveryAdressInstitution');

   Route::match(['get','post'],'user/designer/designerList','UserController@userDesignerList');
   Route::match(['get','post'],'user/designerListIndex','UserController@userDesignerListIndex');
   Route::match(['get','post'],'designer/detail/{id}','UserController@Designerdetail');
   Route::match(['get','post'],'userManagement/Designer-status','UserController@changeDesigner_Status');
   Route::match(['get','post'],'provider/storeLocation/{id}','UserController@providerDesignerStoreLocation');
   Route::match(['get','post'],'userManagement/Designer/transaction_status','UserController@changeDesignerTransactionStatus');

   Route::match(['get','post'],'userManagement/certified_provider-status','UserController@changeCertifiedProviderTransactionStatus');

   Route::match(['get','post'],'provider/contractorList','UserController@userContractorList');
   Route::match(['get','post'],'provider/contractorListIndex','UserController@userContractorListIndex');
   Route::match(['get','post'],'provider/contractor/detail/{id}','UserController@Contractordetail');
   Route::match(['get','post'],'provider/contractor/status','UserController@changeContractorStatus');
   Route::match(['get','post'],'provider/contractor/storeLocation/{id}','UserController@providerContractorStoreLocation');
    Route::match(['get','post'],'provider/contractor/transactionStatus','UserController@changeContractorTransactionStatus');

   Route::match(['get','post'],'provider/consultantList','UserController@providerConsultantList');
   Route::match(['get','post'],'provider/consultantListIndex','UserController@providerConsultantListIndex');
   Route::match(['get','post'],'provider/consultant/detail/{id}','UserController@consultantdetail');
   Route::match(['get','post'],'provider/consultant/status','UserController@changeConsultantStatus');
   Route::match(['get','post'],'provider/consultant/storeLocation/{id}','UserController@providerConsultantStoreLocation');
    Route::match(['get','post'],'provider/consultant/transactionStatus','UserController@changeConsultantTransactionStatus');
    // Route::match(['get','post'],'userManagement/Designer/transaction_status','UserController@changeDesignerTransactionStatus');

   Route::match(['get','post'],'provider/sellerList','UserController@providerSellerList');
   Route::match(['get','post'],'provider/sellerListIndex','UserController@providerSellerListIndex');
   Route::match(['get','post'],'provider/seller/detail/{id}','UserController@sellerdetail');
   Route::match(['get','post'],'provider/seller/status','UserController@changeSellerStatus');
   Route::match(['get','post'],'provider/seller/storeLocation/{id}','UserController@providerSellerStoreLocation');
   Route::match(['get','post'],'provider/seller/transactionStatus','UserController@changesellerTransactionStatus');





    Route::match(['get','post'],'user/cashTransfer/userList','UserCashTransferController@cashList');
    Route::match(['get','post'],'user/cashTransfer/userListIndex','UserCashTransferController@cashListIndex');
    Route::match(['get','post'],'user/cashTransfer/detail/{id}','UserCashTransferController@cashdetail');
    Route::match(['get','post'],'user/cashTransfer/status','UserCashTransferController@changecashStatus');
    Route::match(['get','post'],'user/userStoreAddress/{id}','UserCashTransferController@userStoreAddress');

    Route::match(['get','post'],'membership/membershipContent','MembershipController@membershipContent');
    Route::match(['get','post'],'membership/list','MembershipController@membershipList');
    Route::match(['get','post'],'membership/listIndex','MembershipController@membershipListIndex');
    Route::match(['get','post'],'membership/add','MembershipController@addMembership');
    Route::match(['get','post'],'membership/edit/{id}','MembershipController@editMembership');
    Route::match(['get','post'],'membership/delete/{id}','MembershipController@deleteMembership');
    Route::match(['get','post'],'membership/status','MembershipController@changeStatusMembershipLevel');

    Route::match(['get','post'],'update/WireTransferDetail','WireTransferDetailController@updateWireTransferDetail');




//////////////////oriduct Management////////////////
    Route::match(['get','post'],'productManagement/color/list/index','ProductsController@colorListIndex');
    Route::match(['get','post'],'productManagement/color/list','ProductsController@colorList');

    Route::match(['get','post'],'productManagement/color/add','ProductsController@addColor');

    Route::match(['get','post'],'productManagement/color/edit','ProductsController@editColor');
    Route::match(['get','post'],'productManagement/color/validateColorName','ProductsController@validateEditColorName');

    Route::match(['get','post'],'productManagement/color/changeStatus','ProductsController@changeColorStatus');
    Route::match(['get','post'],'productManagement/color/delete/{id}','ProductsController@deleteColor');
    Route::match(['get','post'],'productManagement/color/validateAddColorName','ProductsController@validateAddColorName');


    Route::match(['get','post'],'productManagement/sellingUnit/list/index','ProductsController@sellingUnitListIndex');
    Route::match(['get','post'],'productManagement/sellingUnit/list','ProductsController@sellingUnitList');
    Route::match(['get','post'],'productManagement/sellingUnit/add','ProductsController@addsellingUnit');
    Route::match(['get','post'],'productManagement/sellingUnit/edit','ProductsController@editsellingUnit');
    Route::match(['get','post'],'productManagement/sellingUnit/validateSellingUnitName','ProductsController@validateEditsellingUnitName');

    Route::match(['get','post'],'productManagement/sellingUnit/changeStatus','ProductsController@changeSellingUnitStatus');
    Route::match(['get','post'],'productManagement/sellingUnit/delete/{id}','ProductsController@deleteSellingUnit');
    Route::match(['get','post'],'productManagement/sellingUnit/validateAddSellingUnitName','ProductsController@validateAddsellingUnitName');

    Route::match(['get','post'],'productManagement/brand/list/index','ProductsController@brandListIndex');
    Route::match(['get','post'],'productManagement/brand/list','ProductsController@brandList');
    Route::match(['get','post'],'productManagement/brand-add','ProductsController@addBrand');
    Route::match(['get','post'],'productManagement/brand/edit','ProductsController@editbrand');
    Route::match(['get','post'],'productManagement/brand/validatebrandName','ProductsController@validateEditbrandName');
    Route::match(['get','post'],'productManagement/brand/changeStatus','ProductsController@changeBrandStatus');
    Route::match(['get','post'],'productManagement/brand/delete/{id}','ProductsController@deleteBrand');
    Route::match(['get','post'],'productManagement/brand/validateAddBrandName','ProductsController@validateAddBrandName');

    Route::match(['get','post'],'productManagement/changeSellingUnitGroup','ProductsController@sellingUnitGroup');
    Route::match(['get','post'],'productManagement/changeSelliningunit','ProductsController@sellingUnitChange');



  /////////////////Order Management Admin//////////////////////////////////
    Route::match(['get','post'],'refundApproval/List','OrderManagementController@refundOrderApprovalList');
    Route::match(['get','post'],'refundApproval/ListIndex','OrderManagementController@refundOrderApprovalListIndex');
    Route::match(['get','post'],'refundApproval/updated/RefundProduct/status/ByAdmin','OrderManagementController@updatedRefundStatusBySeller');
    Route::match(['get','post'],'refundApproval/refund/status','OrderManagementController@changeRefundStatusByAdmin');


    Route::match(['get','post'],'all/userList','UserController@allUserList');
    Route::match(['get','post'],'all/userList/index','UserController@allUserListIndex');
    Route::match(['get','post'],'all/user/detail/{id}','UserController@allUserdetail');
    Route::match(['get','post'],'all/user/storeLocation/{id}','UserController@allUserStoreLocation');
    Route::match(['get','post'],'footer/detail','FooterManagementController@footerDetail');


    Route::match(['get','post'],'productUnitList','ProductsController@productUnitList');
    Route::match(['get','post'],'productUnitList/index','ProductsController@productUnitListIndex');
    Route::match(['get','post'],'productUnitList/add','ProductsController@addProductUnit');
    Route::match(['get','post'],'productUnitList/status','ProductsController@changeStatusProductUnit');
    Route::match(['get','post'],'productUnitList/edit/','ProductsController@updateProductUnit');
    Route::match(['get','post'],'productUnitList/delete/{id}','ProductsController@deleteProductUnit');
    Route::match(['get','post'],'productUnitList/check/name','ProductsController@validateProductUnitName');
    Route::match(['get','post'],'productUnitList/edit/name','ProductsController@validateEditProductUnitName');

    // Route::match(['get','post'],'productManagement/sellingUnitGroupList','ProductsController@sellingUnitGroupList');
    // Route::match(['get','post'],'productManagement/sellingUnitGroupList/index','ProductsController@sellingUnitGroupListIndex');
    // Route::match(['get','post'],'productManagement/sellingUnitGroup/add','ProductsController@addSellingUnitGroup');
    // Route::match(['get','post'],'productManagement/sellingUnitGroup/status','ProductsController@sellingUnitGroupChangeStatus');
    // Route::match(['get','post'],'productManagement/sellingUnitGroup/edit/','ProductsController@updateSellingUnitGroup');
    // Route::match(['get','post'],'productManagement/sellingUnitGroup/delete/{id}','ProductsController@deleteSellingUnitGroup');
    // Route::match(['get','post'],'productManagement/sellingUnitGroup/check/name','ProductsController@validateSellingUnitGroupName');
    // Route::match(['get','post'],'productManagement/sellingUnitGroup/edit/name','ProductsController@validateEditSellingUnitGroupName');

    Route::match(['get','post'],'productManagement/sellingUnitList','ProductsController@sellingUnitList');
    Route::match(['get','post'],'productManagement/sellingUnitList/index','ProductsController@sellingUnitListIndex');
    Route::match(['get','post'],'productManagement/sellingUnit/add','ProductsController@addSellingUnit');
    Route::match(['get','post'],'productManagement/sellingUnit/status','ProductsController@sellingUnitChangeStatus');
    Route::match(['get','post'],'productManagement/sellingUnit/edit/','ProductsController@updateSellingUnit');
    Route::match(['get','post'],'productManagement/sellingUnit/delete/{id}','ProductsController@deleteSellingUnit');
    Route::match(['get','post'],'productManagement/sellingUnit/check/name','ProductsController@validateSellingUnitName');
    Route::match(['get','post'],'productManagement/sellingUnit/edit/name','ProductsController@validateEditSellingUnitName');

   Route::match(['get','post'],'productManagement/grade/list','ProductsController@gradeList');
   Route::match(['get','post'],'productManagement/grade/list/index','ProductsController@gradeListIndex');
   Route::match(['get','post'],'productManagement/grade-add','ProductsController@addGrade');
   Route::match(['get','post'],'productManagement/grade/edit','ProductsController@editGrade');
   Route::match(['get','post'],'productManagement/grade/validatebrandName','ProductsController@validateEditGradeName');
   Route::match(['get','post'],'productManagement/grade/changeStatus','ProductsController@changeGradeStatus');
   Route::match(['get','post'],'productManagement/grade/delete/{id}','ProductsController@deleteGrade');
   Route::match(['get','post'],'productManagement/grade/validateAddGradeName','ProductsController@validateAddGradeName');


   /////////RewardPointManagemnt//////////
   Route::match(['get','post'],'rewardPointManagement/reward/point/List','RewardPointManagementController@rewardList');

   Route::match(['get','post'],'rewardPointManagement/reward/point/Index','RewardPointManagementController@rewardListIndex');

   Route::match(['get','post'],'rewardPointManagement/reward/addReward/point','RewardPointManagementController@addRewardPoint');

   Route::match(['get','post'],'rewardPointManagement/check/FromAmount','RewardPointManagementController@validateFromAmountrewardPoint');

   Route::match(['get','post'],'rewardPointManagement/check/ToAmount','RewardPointManagementController@validateToAmountRewardPoint');

   Route::match(['get','post'],'rewardPointManagement/reward/editReward/point/{id}','RewardPointManagementController@editRewardPoint');

   Route::match(['get','post'],'rewardPointManagement/check/edit/FromAmount','RewardPointManagementController@validateEditFromAmountRewardPoint');

   Route::match(['get','post'],'rewardPointManagement/check/edit/ToAmount','RewardPointManagementController@validateEditToAmountRewardPoint');

   Route::match(['get','post'],'rewardPointManagement/reward/point/delete/{id}','RewardPointManagementController@deleteRewardPoint');

   Route::match(['get','post'],'rewardPointManagement/status','RewardPointManagementController@changeStatus');

  ////////////category Reward/////////////////
   Route::match(['get','post'],'rewardPointManagement/categoryReward/point/List','RewardPointManagementController@rewardCategoryList');

   Route::match(['get','post'],'rewardPointManagement/categoryReward/point/Index','RewardPointManagementController@rewardCategoryListIndex');

   Route::match(['get','post'],'rewardPointManagement/categoryReward/addReward/point','RewardPointManagementController@addRewardCategoryPoint');

   Route::match(['get','post'],'rewardPointManagement/categoryReward/editReward/point/{id}','RewardPointManagementController@editRewardCategoryPoint');

   Route::match(['get','post'],'rewardPointManagement/categoryReward/point/delete/{id}','RewardPointManagementController@deleteRewardCategoryPoint');

   Route::match(['get','post'],'rewardPointManagement/categoryReward/status','RewardPointManagementController@changeRewardCategoryStatus');

   ///////////product Category///////////////////

   Route::match(['get','post'],'rewardPointManagement/productReward/point/List','RewardPointManagementController@rewardproductList');

   Route::match(['get','post'],'rewardPointManagement/productReward/point/Index','RewardPointManagementController@rewardProductListIndex');

   Route::match(['get','post'],'rewardPointManagement/productReward/addReward/point','RewardPointManagementController@addRewardProductPoint');

   Route::match(['get','post'],'rewardPointManagement/productReward/editReward/point/{id}','RewardPointManagementController@editRewardProductPoint');

   Route::match(['get','post'],'rewardPointManagement/productReward/point/delete/{id}','RewardPointManagementController@deleteRewardProductPoint');

   Route::match(['get','post'],'rewardPointManagement/productReward/status','RewardPointManagementController@changeRewardProductStatus');


   /////////////Reward point Price///////
   Route::match(['get','post'],'rewardPointManagement/priceReward/point','RewardPointManagementController@rewardPointPrice');

  /////////////EndReward//////////////////////////////////////


   //////////////Tax Management/////////////////////////////////
    Route::match(['get','post'],'taxManagement/ProductTax/add','AdminController@addProductTax');

   //////////////Tax Management/////////////////////////////////


   Route::match(['get','post'],'rewardPointManagement/reward/export','ExportController@OrderRewardExport');
   Route::match(['get','post'],'rewardPointManagement/productReward/export','ExportController@ProductRewardExport');

   Route::match(['get','post'],'rewardPointManagement/categoryReward/export','ExportController@CategoryRewardExport');




   ////////////////////SellingMaterialController/////////////////////////////

    Route::match(['get','post'],'sellingMaterial/list','SellingMaterialController@sellingMaterialList');

    Route::match(['get','post'],'sellingMaterial/list/index','SellingMaterialController@sellingMaterialListIndex');

    Route::match(['get','post'],'sellingMaterial/add','SellingMaterialController@addSellingUnitMaterial');

    Route::match(['get', 'post'], 'get/all/subcategory', 'SellingMaterialController@getSubCategoriesForMaterials');

    Route::match(['get','post'],'sellingMaterial/edit/{id}','SellingMaterialController@editSellingUnitMaterial');

    Route::match(['get', 'post'], 'sellingMaterial/status', 'SellingMaterialController@changeMaterialstatus');

    Route::match(['get','post'],'sellingMaterial/delete/{id}','SellingMaterialController@deleteSellingMaterial');






    Route::match(['get','post'],'export/product-unit-list','ExportController@exportProductUnit');
    Route::match(['get','post'],'export/gradeList','ExportController@exportProductGrade');
    Route::match(['get','post'],'productManagement/sellingUnitGroupList/export','ExportController@exportSellingUnitGroup');
    Route::match(['get','post'],'productManagement/sellingUnitList/export','ExportController@exportSellingUnit');



    Route::match(['get','post'],'export/provider-designerList','ExportController@providerDesignerExportExcelReport');

    Route::match(['get','post'],'export/provider-consultantList','ExportController@providerConsultListExcelReport');

    Route::match(['get','post'],'export/provider/contractorList','ExportController@providerContractorListExportExcelReport');

    Route::match(['get','post'],'export/provider/sellerList','ExportController@providerSellerListExportExcelReport');

    Route::match(['get','post'],'export/countryList','ExportController@countryExcelReport');
    Route::match(['get','post'],'exportManagement/subscriptionList','ExportController@subscriptionExcelReport');
    Route::match(['get','post'],'export/usertypeIndividual','ExportController@userTypeIndividualExcelReport');
    Route::match(['get','post'],'export/usertypeInstitution','ExportController@userTypeInstitutionExcelReport');
    Route::match(['get','post'],'export/userCashTransfer','ExportController@userCashTransferExportExcelReport');

    Route::match(['get','post'],'productManagement/category/list/index','ProductsController@categoryListIndex');
    Route::match(['get','post'],'productManagement/category/list','ProductsController@categoryList');
    Route::match(['get','post'],'productManagement/category/add','ProductsController@addCategory');
    Route::match(['get','post'],'productManagement/category/edit/{id}','ProductsController@editCategory');
    Route::match(['get','post'],'productManagement/category/delete/{id}','ProductsController@deleteCategory');
    Route::match(['get','post'],'productManagement/category/changeStatus','ProductsController@changeStatus');

    ///////////////////////build mart condtion/////////////////////////////////

    // BuildMartFeeController starts
    Route::match(['get','post'],'buildaMart/feesList','BuildMartFeeController@feesList');
    Route::match(['get','post'],'buildaMart/feesListIndex','BuildMartFeeController@feesListIndex');
    Route::match(['get','post'],'buildaMart/addBuildMartFees','BuildMartFeeController@addBuildMartFees');

    Route::match(['get','post'],'buildMartFees/designers','BuildMartFeeController@designerList');
    Route::match(['get','post'],'buildMartFees/designerListIndex','BuildMartFeeController@designerListIndex');
    Route::match(['get','post'],'buildMartFees/designer/fees/{enc_designer_id}','BuildMartFeeController@designerFees');
    // Route::match(['get','post'],'buildMartFees/designer/updateFee/{enc_designer_id}','BuildMartFeeController@designerUpdateFee');
    Route::match(['get','post'],'buildMartFees/contractors','BuildMartFeeController@contractorList');
    Route::match(['get','post'],'buildMartFees/contractorListIndex','BuildMartFeeController@contractorListIndex');
    Route::match(['get','post'],'buildMartFees/contractor/fees/{enc_designer_id}','BuildMartFeeController@contractorFees');
    Route::match(['get','post'],'buildMartFees/consultants','BuildMartFeeController@consultantList');
    Route::match(['get','post'],'buildMartFees/consultantListIndex','BuildMartFeeController@consultantListIndex');
    Route::match(['get','post'],'buildMartFees/consultant/fees/{enc_designer_id}','BuildMartFeeController@consultantFees');
    Route::match(['get','post'],'buildMartFees/sellers','BuildMartFeeController@sellerList');
    Route::match(['get','post'],'buildMartFees/sellerListIndex','BuildMartFeeController@sellerListIndex');
    Route::match(['get','post'],'buildMartFees/seller/fees/{enc_designer_id}','BuildMartFeeController@sellerFees');
    Route::match(['get','post'],'buildMartFees/seller/products/{enc_seller_id}','BuildMartFeeController@sellerProductList');
    Route::match(['get','post'],'buildMartFees/seller/productListIndex/{enc_seller_id}','BuildMartFeeController@sellerProductListIndex');
    Route::match(['get','post'],'buildMartFees/seller/product/fees/{enc_product_id}','BuildMartFeeController@sellerProductFees');

    Route::match(['get','post'],'buildMartFees/range/add','BuildMartFeeController@addBuildMartFeeRange');
    Route::match(['get','post'],'buildMartFees/range/check','BuildMartFeeController@checkBuildMartFeeRange');

    Route::match(['get','post'],'specialBuildMartFees/range/add','BuildMartFeeController@addSpecialBuildMartFeeRange');
    Route::match(['get','post'],'specialBuildMartFees/range/check','BuildMartFeeController@checkSpecialBuildMartFeeRange');

    // BuildMartFeeController ends

    //////////////EARNING MANAGEMENT/////////////////////
    Route::match(['get','post'],'adminearning/list','EarningManagementController@adminEarningList');
    Route::match(['get','post'],'adminearning/list/index','EarningManagementController@adminEarningListIndex');


    Route::match(['get','post'],'productManagement/category/export','ExportController@exportProductCategories');
    Route::match(['get','post'],'productManagement/category/detail/{id}','ProductsController@getCategoryDetail');

    Route::match(['get','post'],'productManagement/subcategory/list/index','ProductsController@subCategoryListIndex');
    Route::match(['get','post'],'productManagement/subcategory/list','ProductsController@subCategoryList');
    Route::match(['get','post'],'productManagement/subcategory/add','ProductsController@addSubCategory');
    Route::match(['get','post'],'productManagement/subcategory/edit','ProductsController@editSubCategory');
    Route::match(['get','post'],'productManagement/subcategory/changeStatus','ProductsController@changeSubCategoryStatus');
    Route::match(['get','post'],'productManagement/subcategory/delete/{id}','ProductsController@deleteSubCategory');
    Route::match(['get','post'],'productManagement/subcategory/export','ExportController@exportProductSubCategories');

    Route::match(['get','post'],'productManagement/selling-unit/export','ExportController@exportProductSellingUnit');
    Route::match(['get','post'],'productManagement/color/export','ExportController@exportProductColor');
    Route::match(['get','post'],'productManagement/brand/export','ExportController@exportProductBrand');

    // ChatController starts
    Route::match(['get','post'],'chatManagement/messages','ChatController@messages');
    Route::match(['get','post'],'/chat/getView','ChatController@userChatGetView');
    // ChatController ends

    // Permissions Controller starts
    Route::match(['get','post'],'permissions/roles','PermissionController@roles');
    Route::match(['get','post'],'permissions/roles/add','PermissionController@addRoles');
    Route::match(['get','post'],'permissions/roles/delete/{id}','PermissionController@deleteRoles')->name('admin.roles.delete');
    Route::match(['get','post'],'permissions/permissions','PermissionController@permissions');
    Route::match(['get','post'],'permissions/permissions/add','PermissionController@addPermission');
    Route::match(['get','post'],'permissions/permissions/delete/{id}','PermissionController@deletePermission')->name('admin.permissions.delete');
    // Permissions Controller ends








 });



/*all constants start*/
// define('PROJECT_NAME','Mawad Mart');
define('PROJECT_NAME','Build Mart');
define('notificationServerKey','AAAAZGGD0dE:APA91bHDNXuIcECTOGHutzgw5dCIDoP5qfRWJeDWGRqnH_sr9r8aerNc_vN1lkPHhC7UBjJju3qvN_w9mdT7cT7r3Jf80GB1x-Ta60kHYCClYbLByz5uvLCo-6_EIj_hT8D1TarNyrYJ');

/////////PRODUCT CATEGORY IMAGE/////////
define('adminBaseProductCategoryImgsPath','public/admin/images/productCategory/');
define('adminProductCategoryImgsPath', asset('public/admin/images/productCategory/'));

//////////END CATEGORY IMAGE///////////////

define('providerBaseImgsPath','public/frontend/images/provider/');
define('providerImgsPath', asset('public/frontend/images/provider/'));

////////////bRAND iMAGE//////////////
define('providerBrandImgsBasePath','public/frontend/images/providerBrandImages/');
define('providerBrandImgsPath', asset('public/frontend/images/providerBrandImages/'));
// providerBrandImages

define('providerDocBasePath', 'public/frontend/images/providerdocument/');

define('frontendAdvertImageBasePath','public/frontend/imgs/advert_image');
define('frontendAdvertImagePath', asset('public/frontend/imgs/advert_image'));

define('defaultImagePath',asset('public/frontend/img'));
define('defaultImageBasePath','public/frontend/img');
define('userProfileImagePath',asset('public/frontend/imgs/userProfile'));
define('userProfileImageBasePath','public/frontend/imgs/userProfile');
define('requestForProposalImagePath',asset('public/frontend/imgs/requestForProposal'));
define('requestForProposalImageBasePath','public/frontend/imgs/requestForProposal');

define('requestForProposalAttachFileImagePath',asset('public/frontend/imgs/requestForProposal/attachFile'));
define('requestForProposalAttachFileImageBasePath','public/frontend/imgs/requestForProposal/attachFile');

define('requestForProposalRespondAttachmentImagePath',asset('public/frontend/imgs/requestForProposal/respondAttachment'));
define('requestForProposalRespondAttachmentImageBasePath','public/frontend/imgs/requestForProposal/respondAttachment');

define('invoiceImageBasePath','public/frontend/imgs/invoice/');
define('invoiceImagePath', asset('public/frontend/imgs/invoice/'));

define('adminProfileImageBasePath', 'public/admin/images/profile/');
define('adminProfileImagePath', asset('public/admin/images/profile/'));

define('defaultAdminImagePath',asset('public/admin/images/'));

define('productImgsBasePath', 'public/frontend/images/products/');
define('productImgsPath', asset('public/frontend/images/products/'));

define('productSpecificationImgsBasePath', 'public/frontend/images/products/specifications/');
define('productSpecificationImgsPath', asset('public/frontend/images/products/specifications/'));

define('productDocumentBasePath', 'public/frontend/images/productDocument/');
define('productDocumentPath', asset('public/frontend/images/productDocument/'));

define('userVehicleImgsBasePath', 'public/frontend/imgs/userVehicles/');
define('userVehicleImgsPath', asset('public/frontend/imgs/userVehicles/'));
/*all constants end*/
