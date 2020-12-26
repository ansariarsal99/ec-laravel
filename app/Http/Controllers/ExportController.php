<?php

namespace App\Http\Controllers;

use App\Http\Requests, DB, Session, Response;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\CountryExport;
use App\Exports\subscriptionExport;
use App\Exports\userListIndividualExport;
use App\Exports\userListInstitutionExport;
use App\Exports\userCashTransferExport;
use App\Exports\providerDesignerListExport;
use App\Exports\providerContractorListExport;
use App\Exports\providerSellerListExport;
use App\Exports\providerConsultantListExport;
use App\Exports\ProductCategoryExport;
use App\Exports\ProductSubCategoryExport;
use App\Exports\trackRFPRequestListExport;
use App\Exports\ServiceExport;
use App\Exports\ProductSellingUnitExport;
use App\Exports\ProductColorExport;
use App\Exports\ProductBrandExport;
use App\Exports\ProductGradeExport;
use App\Exports\Product_Unit_Export;
use App\Exports\UserInqueryExport;
use App\Exports\SellingUnitGroupExport;
use App\Exports\ProductRewardExport;
use App\Exports\OrderRewardExport;
use App\Exports\CategoryRewardExport;
use App\Exports\SellingUnitExport;

class ExportController extends Controller
{
   public function countryExcelReport()
    {
        return Excel::download(new CountryExport, 'countryList_'.time().'.xlsx');
    }

    public function subscriptionExcelReport()
    {   
        return Excel::download(new subscriptionExport, 'subscriptionList_'.time().'.xlsx');
    }

    public function userTypeIndividualExcelReport()
    {  
        return Excel::download(new userListIndividualExport, 'userTypeIndividualList_'.time().'.xlsx');
    }

    public function userTypeInstitutionExcelReport()
    {  
        return Excel::download(new userListInstitutionExport, 'userTypeInstitutionList_'.time().'.xlsx');
    }

    public function userCashTransferExportExcelReport()
    {  
        return Excel::download(new userCashTransferExport, 'userCashTransferList_'.time().'.xlsx');
    }

    public function providerDesignerExportExcelReport()
    {  
        return Excel::download(new providerDesignerListExport, 'providerDesignerList_'.time().'.xlsx');
    }

    public function providerContractorListExportExcelReport()
    {  
      return Excel::download(new providerContractorListExport, 'providerContractorList_'.time().'.xlsx');
    }

    public function providerConsultListExcelReport()
    { 
      return Excel::download(new providerConsultantListExport, 'ConsultanList_'.time().'.xlsx');
    }

    public function providerSellerListExportExcelReport()
    {  
        return Excel::download(new providerSellerListExport, 'providerSellerList_'.time().'.xlsx');
    }

    public function exportProductCategories()
    {
        return Excel::download(new ProductCategoryExport, 'product_categories_list_'.time().'.xlsx');
    }

    public function exportProductSubCategories()
    {
        return Excel::download(new ProductSubCategoryExport, 'product_sub_categories_list_'.time().'.xlsx');
    }

    public function trackRFPRequestListExport()
    {
        return Excel::download(new trackRFPRequestListExport, 'RFP_request_list_'.time().'.xlsx');
    }

    public function serviceExportListExport()
    {
        return Excel::download(new ServiceExport, 'service_export_list_'.time().'.xlsx');
    }
     public function exportProductSellingUnit()
    {
        return Excel::download(new ProductSellingUnitExport, 'product_selling_unit_export_list_'.time().'.xlsx');
    }

    public function exportProductColor()
    {
        return Excel::download(new ProductColorExport, 'product_color_export_list_'.time().'.xlsx');
    }

    public function exportProductBrand()
    {
        return Excel::download(new ProductBrandExport, 'product_brand_export_list_'.time().'.xlsx');
    }

    public function exportProductUnit()
    {
        // dd('here');
        return Excel::download(new Product_Unit_Export, 'product_uts_export_list_'.time().'.xlsx');
    }

    public function exportProductGrade()
    {
        return Excel::download(new ProductGradeExport, 'product_grade_export_list_'.time().'.xlsx');
    }

   public function exportUserInquery()
   {
       // dd('here');
       return Excel::download(new UserInqueryExport, ' user_inquery_export_list_'.time().'.xlsx');
   }

   public function exportSellingUnitGroup() {
        // dd('here');
        return Excel::download(new SellingUnitGroupExport, 'selling_unit_group_export_list_'.time().'.xlsx');
    }

   public function ProductRewardExport()
    {
        return Excel::download(new ProductRewardExport, 'ProductRewardExportlist_'.time().'.xlsx');
    }

   public function OrderRewardExport()
    {
        return Excel::download(new OrderRewardExport,  'OrderRewardExportlist_'.time().'.xlsx');
    }
    
   public function CategoryRewardExport()
    {
        return Excel::download(new CategoryRewardExport, 'CategoryRewardExport_list_'.time().'.xlsx');
    }

    public function exportSellingUnit() {
        // dd('here');
        return Excel::download(new SellingUnitExport, 'selling_unit_export_list_'.time().'.xlsx');
    }

    
  
}
