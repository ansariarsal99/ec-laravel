<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Session;
use App\Http\Controllers\Controller;
use DataTables;
use App\BuildMartFeesAndCondtionAmount;
use App\BuildMartFeesAndCondtion;
use Auth;
use App\UserType;
use App\User;
use App\Product;
use App\UserBuildMartFee;
use App\ProductBuildMartFee;


class BuildMartFeeController extends Controller
{
    Public function feesList(Request $request)
    {
        $page = 'build_mart_fees';
       return view('admin.buildMartFees.buildMartList',compact('page'));
    }

    public function feesListIndex(Request $request) {

        $BuildMartFeesAndCondtion = BuildMartFeesAndCondtion::select('*')->get();
      
        return DataTables::of($BuildMartFeesAndCondtion)
            ->addIndexColumn()    
            ->editColumn('percentage',function($BuildMartFeesAndCondtion) {
                return !empty($BuildMartFeesAndCondtion['percentage'])?$BuildMartFeesAndCondtion['percentage']:'-';
            })
            ->addColumn('action', function ($BuildMartFeesAndCondtion) {
               return 
             '<a href="' . url("provider/deliveryTerm/edit/".base64_encode($BuildMartFeesAndCondtion->id)) . '" class="edit-btn cp text-primary">Edit</a>
              <a href="' . url("provider/deliveryTerm/delete/".base64_encode($BuildMartFeesAndCondtion->id)) . '" class="delete-btn cp text-danger" del_id="'.$BuildMartFeesAndCondtion->id.'" > Delete</a>';
            })
            ->escapeColumns([])
            ->make(true);     
    }

    public function addBuildMartFees(Request $request){
        try{
            if($request->isMethod('post')) {
                $data = $request->all();
                // dd($data);
                $adminId = Auth::guard('admin')->user()->id;
                BuildMartFeesAndCondtion::where('admin_id',$adminId)->delete();               
                BuildMartFeesAndCondtionAmount::where('admin_id',$adminId)->delete();

                if($data['fees_type'] =='percentage'){

                      BuildMartFeesAndCondtion::create([
                                              'admin_id'         =>$adminId,
                                              'fees_type'        =>$data['fees_type'],
                                              'percentage'       =>$data['percentage']
                                          ]);
                
                }else if($data['fees_type'] =='lum_sum'){

                   $buildMartFeeId = BuildMartFeesAndCondtion::create([
                                                  'admin_id'         =>$adminId,
                                                  'fees_type'        =>$data['fees_type']
                                              ]);

                    foreach ($data['term_append_div'] as $key => $value) {
                    
                    BuildMartFeesAndCondtionAmount::create([
                                   'admin_id'                         =>$adminId,
                                   'build_mart_fees_and_condtions_id' =>$buildMartFeeId['id'],
                                   'from_price_range'                 =>$value['from_price_range'],
                                   'to_price_range'                   =>$value['to_price_range'],
                                   'fees'                             =>$value['fees']
                                ]);
                    }
                }    
                // Session::flash('success','BuildMart Fee is updated successfully');
                return redirect()->back()->with('success', 'BuildMart Fee is updated successfully');   
            }
            $adminId = Auth::guard('admin')->user()->id; 

            $BuildMartFeesAndCondtion =BuildMartFeesAndCondtion::where('admin_id',$adminId)->first();
            $BuildMartFeesAndCondtionAmounts =BuildMartFeesAndCondtionAmount::where('admin_id',$adminId)->get()->toArray();
            $BuildMartFeesAndCondtionAmountsCount =BuildMartFeesAndCondtionAmount::where('admin_id',$adminId)->count();
            // dd($BuildMartFeesAndCondtionAmountsCount);
            $page = 'build_mart_fees';
            return view('admin.buildMartFees.addBuildMartFees',compact('page','BuildMartFeesAndCondtion','BuildMartFeesAndCondtionAmounts','BuildMartFeesAndCondtionAmountsCount'));
        } catch(Exception $e){
             \Log::error($e->getMessage());
             Session::flash('error',trans('messages.frontend.common_error'));
        } 
    }

    public function designerList(Request $request) {
        $page =  'designers';
        return view('admin.buildMartFeesManagement.designer.designerList',compact('page'));
    }

    public function designerListIndex(Request $request) {
        $userTypeId = UserType::where('alias','designer')->value('id');
        // dd($userTypeId);
        $designerList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                            ->select('users.id','users.user_type_id','users.complete_profile','users.email','users.mobile_no','users.company_name','users.contact_name','users.contact_last_name','users.status','users.assigned_build_mart_fees','users.is_build_mart_fees_approve_by_user','user_types.name as user_type_name')
                            ->where('users.user_type_id',$userTypeId)
                            ->where('users.complete_profile','yes')
                            ->get();

        return DataTables::of($designerList)
                        ->addIndexColumn()
                        ->addColumn('contact_full_name', function($designerList){
                                return ucfirst($designerList->contact_name).' '.ucfirst($designerList->contact_last_name);
                            })
                        ->addColumn('assigned_fees', function($designerList){
                                return ucfirst($designerList->assigned_build_mart_fees);
                            })
                        ->addColumn('build_mart_fees_approval', function($sellerList){
                                return ucfirst($sellerList->is_build_mart_fees_approve_by_user);
                            })
                        // ->addColumn('action', function ($designerList) {
                        //     return 
                        //       '<a href="' . url("admin/designer/detail/".base64_encode($designerList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                        //        <a href="' . url("admin/provider/storeLocation/".base64_encode($designerList->id)) . '" class="User"> <i class="fa fa-user" title="Designer Store Location"></i></a>
                        //        <a href="' . url("admin/buildMartFees/designer/fees/".base64_encode($designerList->id)).'" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>';
                        // })
                        ->addColumn('action', function ($designerList) {
                            return 
                              '<a href="' . url("admin/buildMartFees/designer/fees/".base64_encode($designerList->id)).'" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>';
                        })
                        ->escapeColumns([])
                        ->make(true);                                          
    } 

    public function designerFees($encDesignerId, Request $request) {
        
        try{
            $decDesignerId = base64_decode($encDesignerId);
            if($request->isMethod('post')) {
                $data = $request->all();
                // dd($decDesignerId);  
                // dd($data); 
                if ($data['build_mart_fees_type']=='according_to_order_amount') {
                    // dd('if');
                    if (isset($data['add_range_div']) && sizeof($data['add_range_div'])>0) {
                        UserBuildMartFee::where('user_id',$decDesignerId)->delete();
                        foreach ($data['add_range_div'] as $key => $range) {
                            if(!empty($range) && !empty($range['from_price']) && !empty($range['to_price']) && !empty($range['value']) && !empty($range['type'])){
                                UserBuildMartFee::create([
                                                          'user_id'=>$decDesignerId,
                                                          'from_price'=>$range['from_price'],
                                                          'to_price'=>$range['to_price'],
                                                          'value'=>$range['value'],
                                                          'type'=>$range['type'],
                                                          'part'=>$key
                                                        ]);
                            }       
                        }   
                    }
                    // dd('done');
                }else{
                    // dd('else');
                    if (!empty($data['value']) && !empty($data['type'])) {
                        UserBuildMartFee::where('user_id',$decDesignerId)->delete();
                        UserBuildMartFee::create([
                                                  'user_id'=>$decDesignerId,
                                                  'value'=>$data['value'],
                                                  'type'=>$data['type'],
                                                ]);
                    }

                }
                User::where('id',$decDesignerId)->update([
                                                          'assigned_build_mart_fees'=>'yes',
                                                          'build_mart_fees_type'=>$data['build_mart_fees_type']
                                                        ]);
                // Session::flash('success','BuildMart Fee is updated successfully');
                // return redirect()->back()->with('success', 'BuildMart Fee updated successfully'); 
                return redirect('/admin/buildMartFees/designers')->with('success', 'BuildMart Fee updated successfully');   
            }
            $user = User::where('id',$decDesignerId)->first();
            $user = !empty($user) ? $user->toArray() : [];

            UserBuildMartFee::where('user_id',$decDesignerId)->where('value',null)->delete();
            // dd($user);
            if (!empty($user) && $user['assigned_build_mart_fees']=='yes') {
                $feeRanges = UserBuildMartFee::where('user_id',$decDesignerId);
                if ($user['build_mart_fees_type']=='according_to_order_amount') {
                    $feeRanges = $feeRanges->get()->toArray();
                }else{
                    $feeRanges = $feeRanges->first();
                    $feeRanges = !empty($feeRanges) ? $feeRanges->toArray() : [];
                }
            }else{
                $feeRanges = [];
            }
            // dd(sizeof($feeRanges));
            $page =  'designers';
            return view('admin.buildMartFeesManagement.designer.buildMartFees',compact('page','encDesignerId','feeRanges','user'));
        } catch(Exception $e){
             \Log::error($e->getMessage());
             Session::flash('error',trans('messages.frontend.common_error'));
             return redirect()->back();
        } 
    }

    // public function designerUpdateFee($encDesignerId, Request $request) {

    //     try{
    //         if($request->isMethod('post')) {
    //             $data = $request->all();
    //             $decDesignerId = base64_decode($encDesignerId);
    //             // dd($decDesignerId);  
    //             // dd($data); 
    //             if ($data['build_mart_fees_type']=='according_to_order_amount') {
    //                 // dd('if');
    //                 UserBuildMartFee::where('user_id',$decDesignerId)->delete();
    //                 if (isset($data['add_range_div']) && sizeof($data['add_range_div'])>0) {
    //                     foreach ($data['add_range_div'] as $key => $range) {
    //                         if(!empty($range) && !empty($range['from_price']) && !empty($range['to_price']) && !empty($range['value']) && !empty($range['type'])){
    //                             UserBuildMartFee::create([
    //                                                       'user_id'=>$decDesignerId,
    //                                                       'from_price'=>$range['from_price'],
    //                                                       'to_price'=>$range['to_price'],
    //                                                       'value'=>$range['value'],
    //                                                       'type'=>$range['type'],
    //                                                     ]);
    //                         }       
    //                     }   
    //                 }
    //                 // dd('done');
    //             }else{
    //                 // dd('else');
    //                 UserBuildMartFee::where('user_id',$decDesignerId)->delete();
    //                 if (!empty($data['value']) && !empty($data['type'])) {
    //                     UserBuildMartFee::create([
    //                                               'user_id'=>$decDesignerId,
    //                                               'value'=>$data['value'],
    //                                               'type'=>$data['type'],
    //                                             ]);
    //                 }

    //             }
    //             User::where('id',$decDesignerId)->update([
    //                                                       'assigned_build_mart_fees'=>'yes',
    //                                                       'build_mart_fees_type'=>$data['build_mart_fees_type']
    //                                                     ]);
    //             // Session::flash('success','BuildMart Fee is updated successfully');
    //             return redirect()->back()->with('success', 'BuildMart Fee updated successfully');   
    //         }else{
    //             Session::flash('error',trans('messages.frontend.common_error'));
    //             return redirect()->back();
    //         }
    //     } catch(Exception $e){
    //          \Log::error($e->getMessage());
    //          Session::flash('error',trans('messages.frontend.common_error'));
    //          return redirect()->back();
    //     } 
    // }

    public function addBuildMartFeeRange(Request $request) {

        $data = $request->all();
        // dd($data);
        $term = UserBuildMartFee::where('user_id',$data['userId'])
                                     ->where('part',$data['part'])
                                     ->first();
        if (!empty($term)) {
            $updateTermId = UserBuildMartFee::where('user_id',$data['userId'])
                                                 ->where('part',$data['part'])
                                                 ->update([
                                                           $data['key']=>$data['value'] 
                                                        ]);
        }else{
            $createTermId = UserBuildMartFee::create([
                                                      'user_id'=>$data['userId'],
                                                      'part'=>$data['part'],
                                                      $data['key']=>$data['value']
                                                    ])->id;
        }
    }

    public function checkBuildMartFeeRange(Request $request) {

        $data = $request->all();
        // dd($data);
        if (isset($data['range']) && !empty($data['range'])) {
            $conditionCheck = UserBuildMartFee::where('user_id',$data['userId'])
                                                     // ->whereNull('value')
                                                     ->where('from_price','<=',$data['range'])
                                                     ->where('to_price','>=',$data['range'])
                                                     // ->where('part','!=',$data['part'])
                                                     ->where(function ($query)use($data) {
                                                            $query->where('part','!=',$data['part'])
                                                                  ->orWhere('part', null);
                                                        })
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

    public function contractorList(Request $request) {
        $page =  'contractors';
        return view('admin.buildMartFeesManagement.contractor.contractorList',compact('page'));
    }

    public function contractorListIndex(Request $request) {
        $userTypeId = UserType::where('alias','contractor')->value('id');
        $contractorList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                               ->select('users.id','users.user_type_id','users.complete_profile','users.email','users.mobile_no','users.company_name','users.contact_name','users.contact_last_name','users.status','users.assigned_build_mart_fees','users.is_build_mart_fees_approve_by_user','user_types.name as user_type_name')
                               ->where('users.user_type_id',$userTypeId)
                               ->where('users.complete_profile','yes')
                               ->get();

        return DataTables::of($contractorList)
                        ->addIndexColumn()
                        ->addColumn('contact_full_name', function($contractorList){
                                return ucfirst($contractorList->contact_name).' '.ucfirst($contractorList->contact_last_name);
                            })
                        ->addColumn('assigned_fees', function($contractorList){
                                return ucfirst($contractorList->assigned_build_mart_fees);
                            })
                        ->addColumn('build_mart_fees_approval', function($sellerList){
                                return ucfirst($sellerList->is_build_mart_fees_approve_by_user);
                            })
                        // ->addColumn('action', function ($contractorList) {
                        //         return 
                        //           '<a href="' . url("admin/provider/contractor/detail/".base64_encode($contractorList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                        //           <a href="' . url("admin/provider/contractor/storeLocation/".base64_encode($contractorList->id)) . '" class="User"> <i class="fa fa-user" title="Contractor Store Location"></i></a>';
                        // })
                        ->addColumn('action', function ($contractorList) {
                            return 
                              // '<a href="javascript:;" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>';
                              '<a href="' . url("admin/buildMartFees/contractor/fees/".base64_encode($contractorList->id)).'" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>';
                        })
                        ->escapeColumns([])
                        ->make(true);                                          
    }

    public function contractorFees($encContractorId, Request $request) {
        
        try{
            $decContractorId = base64_decode($encContractorId);
            if($request->isMethod('post')) {
                $data = $request->all();
                // dd($decContractorId);  
                // dd($data); 
                if ($data['build_mart_fees_type']=='according_to_order_amount') {
                    // dd('if');
                    if (isset($data['add_range_div']) && sizeof($data['add_range_div'])>0) {
                        UserBuildMartFee::where('user_id',$decContractorId)->delete();
                        foreach ($data['add_range_div'] as $key => $range) {
                            if(!empty($range) && !empty($range['from_price']) && !empty($range['to_price']) && !empty($range['value']) && !empty($range['type'])){
                                UserBuildMartFee::create([
                                                          'user_id'=>$decContractorId,
                                                          'from_price'=>$range['from_price'],
                                                          'to_price'=>$range['to_price'],
                                                          'value'=>$range['value'],
                                                          'type'=>$range['type'],
                                                          'part'=>$key
                                                        ]);
                            }       
                        }   
                    }
                    // dd('done');
                }else{
                    // dd('else');
                    if (!empty($data['value']) && !empty($data['type'])) {
                        UserBuildMartFee::where('user_id',$decContractorId)->delete();
                        UserBuildMartFee::create([
                                                  'user_id'=>$decContractorId,
                                                  'value'=>$data['value'],
                                                  'type'=>$data['type'],
                                                ]);
                    }

                }
                User::where('id',$decContractorId)->update([
                                                          'assigned_build_mart_fees'=>'yes',
                                                          'build_mart_fees_type'=>$data['build_mart_fees_type']
                                                        ]);
                // Session::flash('success','BuildMart Fee is updated successfully');
                // return redirect()->back()->with('success', 'BuildMart Fee updated successfully');   
                return redirect('/admin/buildMartFees/contractors')->with('success', 'BuildMart Fee updated successfully');   
            }
            $user = User::where('id',$decContractorId)->first();
            $user = !empty($user) ? $user->toArray() : [];

            UserBuildMartFee::where('user_id',$decContractorId)->where('value',null)->delete();
            // dd($user);
            if (!empty($user) && $user['assigned_build_mart_fees']=='yes') {
                $feeRanges = UserBuildMartFee::where('user_id',$decContractorId);
                if ($user['build_mart_fees_type']=='according_to_order_amount') {
                    $feeRanges = $feeRanges->get()->toArray();
                }else{
                    $feeRanges = $feeRanges->first();
                    $feeRanges = !empty($feeRanges) ? $feeRanges->toArray() : [];
                }
            }else{
                $feeRanges = [];
            }
            // dd(sizeof($feeRanges));
            $page =  'contractors';
            return view('admin.buildMartFeesManagement.contractor.buildMartFees',compact('page','encContractorId','feeRanges','user'));
        } catch(Exception $e){
             \Log::error($e->getMessage());
             Session::flash('error',trans('messages.frontend.common_error'));
             return redirect()->back();
        } 
    }

    public function consultantList(Request $request) {
        $page =  'consultants';
        return view('admin.buildMartFeesManagement.consultant.consultantList',compact('page'));
    }

    public function consultantListIndex(Request $request) {
        $userTypeId = UserType::where('alias','consultant')->value('id');
        $consultantList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                               ->select('users.id','users.user_type_id','users.complete_profile','users.email','users.mobile_no','users.company_name','users.contact_name','users.contact_last_name','users.status','users.assigned_build_mart_fees','users.is_build_mart_fees_approve_by_user','user_types.name as user_type_name')
                               ->where('users.user_type_id',$userTypeId)
                               ->where('users.complete_profile','yes')
                               ->get();

        return DataTables::of($consultantList)
                        ->addIndexColumn()
                        ->addColumn('contact_full_name', function($consultantList){
                                return ucfirst($consultantList->contact_name).' '.ucfirst($consultantList->contact_last_name);
                            })
                        ->addColumn('assigned_fees', function($consultantList){
                                return ucfirst($consultantList->assigned_build_mart_fees);
                            })
                        ->addColumn('build_mart_fees_approval', function($sellerList){
                                return ucfirst($sellerList->is_build_mart_fees_approve_by_user);
                            })
                        // ->addColumn('action', function ($consultantList) {
                        //     return 
                        //         '<a href="' . url("admin/provider/consultant/detail/".base64_encode($consultantList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                        //         <a href="' . url("admin/provider/consultant/storeLocation/".base64_encode($consultantList->id)) . '" class="User"> <i class="fa fa-user" title="Consultant Store Location"></i></a>';
                        // })
                        ->addColumn('action', function ($consultantList) {
                            return 
                              // '<a href="javascript:;" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>';
                            '<a href="' . url("admin/buildMartFees/consultant/fees/".base64_encode($consultantList->id)).'" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>';
                        })
                        ->escapeColumns([])
                        ->make(true);                                          
    }

    public function consultantFees($encSellerId, Request $request) {
        
        try{
            $decConsultantId = base64_decode($encConsultantId);
            if($request->isMethod('post')) {
                $data = $request->all();
                // dd($decConsultantId);  
                // dd($data); 
                if ($data['build_mart_fees_type']=='according_to_order_amount') {
                    // dd('if');
                    if (isset($data['add_range_div']) && sizeof($data['add_range_div'])>0) {
                        UserBuildMartFee::where('user_id',$decConsultantId)->delete();
                        foreach ($data['add_range_div'] as $key => $range) {
                            if(!empty($range) && !empty($range['from_price']) && !empty($range['to_price']) && !empty($range['value']) && !empty($range['type'])){
                                UserBuildMartFee::create([
                                                          'user_id'=>$decConsultantId,
                                                          'from_price'=>$range['from_price'],
                                                          'to_price'=>$range['to_price'],
                                                          'value'=>$range['value'],
                                                          'type'=>$range['type'],
                                                          'part'=>$key
                                                        ]);
                            }       
                        }   
                    }
                    // dd('done');
                }else{
                    // dd('else');
                    if (!empty($data['value']) && !empty($data['type'])) {
                        UserBuildMartFee::where('user_id',$decConsultantId)->delete();
                        UserBuildMartFee::create([
                                                  'user_id'=>$decConsultantId,
                                                  'value'=>$data['value'],
                                                  'type'=>$data['type'],
                                                ]);
                    }

                }
                User::where('id',$decConsultantId)->update([
                                                          'assigned_build_mart_fees'=>'yes',
                                                          'build_mart_fees_type'=>$data['build_mart_fees_type']
                                                        ]);
                // Session::flash('success','BuildMart Fee is updated successfully');
                // return redirect()->back()->with('success', 'BuildMart Fee updated successfully');   
                return redirect('/admin/buildMartFees/consultants')->with('success', 'BuildMart Fee updated successfully');   
            }
            $user = User::where('id',$decConsultantId)->first();
            $user = !empty($user) ? $user->toArray() : [];

            UserBuildMartFee::where('user_id',$decConsultantId)->where('value',null)->delete();
            // dd($user);
            if (!empty($user) && $user['assigned_build_mart_fees']=='yes') {
                $feeRanges = UserBuildMartFee::where('user_id',$decConsultantId);
                if ($user['build_mart_fees_type']=='according_to_order_amount') {
                    $feeRanges = $feeRanges->get()->toArray();
                }else{
                    $feeRanges = $feeRanges->first();
                    $feeRanges = !empty($feeRanges) ? $feeRanges->toArray() : [];
                }
            }else{
                $feeRanges = [];
            }
            // dd(sizeof($feeRanges));
            $page =  'consultants';
            return view('admin.buildMartFeesManagement.consultant.buildMartFees',compact('page','encConsultantId','feeRanges','user'));
        } catch(Exception $e){
             \Log::error($e->getMessage());
             Session::flash('error',trans('messages.frontend.common_error'));
             return redirect()->back();
        } 
    }

    public function sellerList(Request $request) {
        $page =  'sellers';
        return view('admin.buildMartFeesManagement.seller.sellerList',compact('page'));
    }

    public function sellerListIndex(Request $request) {
        $userTypeId = UserType::where('alias','seller')->value('id');
        $sellerList = User::leftjoin('user_types','users.user_type_id','user_types.id')
                           ->select('users.id','users.user_type_id','users.complete_profile','users.email','users.mobile_no','users.company_name','users.contact_name','users.contact_last_name','users.status','users.assigned_build_mart_fees','users.is_build_mart_fees_approve_by_user','user_types.name as user_type_name')
                           ->where('users.user_type_id',$userTypeId)
                           ->where('users.complete_profile','yes')
                           ->get();

        return DataTables::of($sellerList)
                          ->addIndexColumn()
                          ->addColumn('contact_full_name', function($sellerList){
                                return ucfirst($sellerList->contact_name).' '.ucfirst($sellerList->contact_last_name);
                            })
                          ->addColumn('assigned_fees', function($sellerList){
                                return ucfirst($sellerList->assigned_build_mart_fees);
                            })
                          ->addColumn('build_mart_fees_approval', function($sellerList){
                                return ucfirst($sellerList->is_build_mart_fees_approve_by_user);
                            })
                          // ->addColumn('action', function ($sellerList) {
                          //     return 
                          //     '<a href="' . url("admin/provider/seller/detail/".base64_encode($sellerList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                          //     <a href="' . url("admin/provider/seller/storeLocation/".base64_encode($sellerList->id)) . '" class="User"> <i class="fa fa-user" title="Seller Store Location"></i></a>
                          //     <a href="' . url("admin/buildMartFees/seller/products/".base64_encode($sellerList->id)) . '" class="User"> <i class="fa fa-bars" title="View Products"></i></a>';
                          //   })
                          ->addColumn('action', function ($sellerList) {
                                return 
                                  // '<a href="javascript:;" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>';
                                '<a href="' . url("admin/buildMartFees/seller/fees/".base64_encode($sellerList->id)).'" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>
                                <a href="' . url("admin/buildMartFees/seller/products/".base64_encode($sellerList->id)) . '" class="User"> <i class="fa fa-bars" title="View Products"></i></a>';
                            })
                          ->escapeColumns([])
                          ->make(true);                                          
    } 

   public function sellerFees($encSellerId, Request $request) {
         
         try{
             $decSellerId = base64_decode($encSellerId);
             if($request->isMethod('post')) {
                 $data = $request->all();
                 // dd($decSellerId);  
                 // default_amount
                 // dd($data); 
                 if ($data['build_mart_fees_type']=='according_to_order_amount') {
                     // dd('if');
                     if (isset($data['add_range_div']) && sizeof($data['add_range_div'])>0) {
                         UserBuildMartFee::where('user_id',$decSellerId)->delete();
                         foreach ($data['add_range_div'] as $key => $range) {
                             if(!empty($range) && !empty($range['from_price']) && !empty($range['to_price']) && !empty($range['value']) && !empty($range['type'])){
                                 UserBuildMartFee::create([
                                                           'user_id'=>$decSellerId,
                                                           'from_price'=>$range['from_price'],
                                                           'to_price'=>$range['to_price'],
                                                           'value'=>$range['value'],
                                                           'type'=>$range['type'],
                                                           'part'=>$key
                                                         ]);
                             }       
                         }   
                     }

                     User::where('id',$decSellerId)->update([
                                   'default_amount'=>'yes',
                                   'default_amount_type'=>$data['default_amount_type'],
                                   'default_amount_build_mart'=>@$data['default_amount_build_mart']
                                 ]);
                     // dd('done');
                 }else{
                     // dd('else');
                     if (!empty($data['value']) && !empty($data['type'])) {
                         UserBuildMartFee::where('user_id',$decSellerId)->delete();
                         UserBuildMartFee::create([
                                                   'user_id'=>$decSellerId,
                                                   'value'=>$data['value'],
                                                   'type'=>$data['type'],
                                                 ]);
                     }

                     User::where('id',$decSellerId)->update([
                                   'default_amount'=>'no',
                                   'default_amount_type'=>null,
                                   'default_amount_build_mart'=>null
                                 ]);

                 }
                 User::where('id',$decSellerId)->update([
                                                           'assigned_build_mart_fees'=>'yes',
                                                           'build_mart_fees_type'=>$data['build_mart_fees_type']
                                                         ]);
                 // Session::flash('success','BuildMart Fee is updated successfully');
                 // return redirect()->back()->with('success', 'BuildMart Fee updated successfully');   
                 return redirect('/admin/buildMartFees/sellers')->with('success', 'BuildMart Fee updated successfully');   
             }
             $user = User::where('id',$decSellerId)->first();
             $user = !empty($user) ? $user->toArray() : [];

             UserBuildMartFee::where('user_id',$decSellerId)->where('value',null)->delete();
             // dd($user);
             if (!empty($user) && $user['assigned_build_mart_fees']=='yes') {
                 $feeRanges = UserBuildMartFee::where('user_id',$decSellerId);
                 if ($user['build_mart_fees_type']=='according_to_order_amount') {
                     $feeRanges = $feeRanges->get()->toArray();
                 }else{
                     $feeRanges = $feeRanges->first();
                     $feeRanges = !empty($feeRanges) ? $feeRanges->toArray() : [];
                 }
             }else{
                 $feeRanges = [];
             }
             // dd(sizeof($feeRanges));
             $page =  'sellers';
             return view('admin.buildMartFeesManagement.seller.buildMartFees',compact('page','encSellerId','feeRanges','user'));
         } catch(Exception $e){
              \Log::error($e->getMessage());
              Session::flash('error',trans('messages.frontend.common_error'));
              return redirect()->back();
         } 
     }

    public function sellerProductList($encSellerId, Request $request) {
        $page =  'sellers';
        return view('admin.buildMartFeesManagement.seller.products.productList',compact('page','encSellerId'));
    }

    public function sellerProductListIndex($encSellerId, Request $request) {
        $decSellerId = base64_decode($encSellerId);

        $productList = Product::leftjoin('users','products.user_id','users.id')
                                ->select('products.id','products.item_name','products.item_name_arabic','products.seller_item_code','products.item_bar_code','products.status','products.has_special_build_mart_fees','users.company_name','users.contact_name','users.contact_last_name')
                                ->where('products.user_id',$decSellerId)
                                ->orderBy('products.id', 'desc')
                                ->get();
                                // ->get()
                                // ->toArray();
        // dd($productList);

        return DataTables::of($productList)
                          ->addIndexColumn()
                          ->addColumn('product_seller_name', function($productList){
                                return ucfirst($productList->contact_name).' '.ucfirst($productList->contact_last_name);
                            })
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
                          // ->addColumn('action', function ($productList) {
                          //     return 
                          //     '<a href="' . url("admin/provider/seller/detail/".base64_encode($productList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                          //     <a href="' . url("admin/provider/seller/storeLocation/".base64_encode($productList->id)) . '" class="User"> <i class="fa fa-user" title="Seller Store Location"></i></a>
                          //     <a href="' . url("admin/seller/products/".base64_encode($productList->id)) . '" class="User"> <i class="fa fa-bars" title="View Products"></i></a>';
                          //   })
                          ->addColumn('action', function ($productList) {
                                return 
                                  // '<a href="javascript:;" class="User"> <i class="fa fa-money" title="Build Mart Fees"></i></a>';
                                  '<a href="' . url("admin/buildMartFees/seller/product/fees/".base64_encode($productList->id)) . '" class="User"> <i class="fa fa-money" title="Special Build Mart Fees"></i></a>';
                            })
                          ->escapeColumns([])
                          ->make(true);                                          
    } 

   public function sellerProductFees($encProductId, Request $request) {
          
          try{
              $decProductId = base64_decode($encProductId);

              $product = Product::where('id',$decProductId)->first();
              $product = !empty($product) ? $product->toArray() : [];
              $encSellerId = base64_encode($product['user_id']);
              // dd($encSellerId);
              if($request->isMethod('post')) {
                  $data = $request->all();
                  // dd($decProductId);  
                  // dd($data); 
                  if ($data['build_mart_fees_type']=='according_to_order_amount') {
                      // dd('if');
                      if (isset($data['add_range_div']) && sizeof($data['add_range_div'])>0) {
                          ProductBuildMartFee::where('product_id',$decProductId)->delete();
                          foreach ($data['add_range_div'] as $key => $range) {
                              if(!empty($range) && !empty($range['from_price']) && !empty($range['to_price']) && !empty($range['value']) && !empty($range['type'])){
                                  ProductBuildMartFee::create([
                                                            'product_id'=>$decProductId,
                                                            'from_price'=>$range['from_price'],
                                                            'to_price'=>$range['to_price'],
                                                            'value'=>$range['value'],
                                                            'type'=>$range['type'],
                                                            'part'=>$key
                                                          ]);
                              }       
                          }   
                      }

                      ////////add default amount.to product table.//////
                       Product::where('id',$decProductId)->update([                              
                                'default_amount_build_mart_special_product'=>@$data['default_amount_build_mart_special_product'],
                                'default_amount_type'=>@$data['default_amount_type'],
                                'default_amount'=>'yes'

                                                          ]);
                      // dd('done');
                  }else{
                      // dd('else');
                      if (!empty($data['value']) && !empty($data['type'])) {
                          ProductBuildMartFee::where('product_id',$decProductId)->delete();
                          ProductBuildMartFee::create([
                                                    'product_id'=>$decProductId,
                                                    'value'=>$data['value'],
                                                    'type'=>$data['type'],
                                                  ]);

                          Product::where('id',$decProductId)->update([              
                                 'default_amount_build_mart_special_product'=>null,
                                 'default_amount_type'=>null,
                                 'default_amount'=>'no'
                                       ]);
                      }

                  }
                  Product::where('id',$decProductId)->update([
                                                            'has_special_build_mart_fees'=>'yes',
                                                            'special_build_mart_fees_type'=>$data['build_mart_fees_type']
                                                          ]);
                  // Session::flash('success','BuildMart Fee is updated successfully');
                  // return redirect()->back()->with('success', 'BuildMart Fee updated successfully');   
                  return redirect('/admin/buildMartFees/seller/products/'.$encSellerId)->with('success', 'Special BuildMart Fee updated successfully');   
              }
              // dd('here');
              ProductBuildMartFee::where('product_id',$decProductId)->where('value',null)->delete();
              // dd($product);
              if (!empty($product) && $product['has_special_build_mart_fees']=='yes') {
                  $feeRanges = ProductBuildMartFee::where('product_id',$decProductId);
                  if ($product['special_build_mart_fees_type']=='according_to_order_amount') {
                      $feeRanges = $feeRanges->get()->toArray();
                  }else{
                      $feeRanges = $feeRanges->first();
                      $feeRanges = !empty($feeRanges) ? $feeRanges->toArray() : [];
                  }
              }else{
                  $feeRanges = [];
              }
              // dd(sizeof($feeRanges));
              $page =  'sellers';
              return view('admin.buildMartFeesManagement.seller.products.specialBuildMartFees',compact('page','encProductId','feeRanges','product'));
          } catch(Exception $e){
               \Log::error($e->getMessage());
               Session::flash('error',trans('messages.frontend.common_error'));
               return redirect()->back();
          } 
      }

    public function addSpecialBuildMartFeeRange(Request $request) {

        $data = $request->all();
        // dd($data);
        $term = ProductBuildMartFee::where('product_id',$data['productId'])
                                     ->where('part',$data['part'])
                                     ->first();
        if (!empty($term)) {
            $updateTermId = ProductBuildMartFee::where('product_id',$data['productId'])
                                                 ->where('part',$data['part'])
                                                 ->update([
                                                           $data['key']=>$data['value'] 
                                                        ]);
        }else{
            $createTermId = ProductBuildMartFee::create([
                                                      'product_id'=>$data['productId'],
                                                      'part'=>$data['part'],
                                                      $data['key']=>$data['value']
                                                    ])->id;
        }
    }

    public function checkSpecialBuildMartFeeRange(Request $request) {

        $data = $request->all();
        // dd($data);
        // $data['range'] = 43;
        if (isset($data['range']) && !empty($data['range'])) {
            $conditionCheck = ProductBuildMartFee::where('product_id',$data['productId'])
                                                     // ->whereNull('value')
                                                     ->where('from_price','<=',$data['range'])
                                                     ->where('to_price','>=',$data['range'])
                                                     // ->where('part','!=',$data['part'])
                                                     ->where(function ($query)use($data) {
                                                            $query->where('part','!=',$data['part'])
                                                                  ->orWhere('part', null);
                                                        })
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

    



}
