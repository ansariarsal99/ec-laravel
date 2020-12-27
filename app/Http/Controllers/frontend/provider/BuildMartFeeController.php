<?php

namespace App\Http\Controllers\frontend\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Exception;
use Auth;
use App\User;
use App\UserBuildMartFee;

class BuildMartFeeController extends Controller
{
    
    public function buildMartFees(Request $request) {
        try {

        	$user = User::where('id',Auth::user()->id)->first();
        	$user = !empty($user) ? $user->toArray() : [];
        	$page = 'buildMartFees';
        	// dd($user);
        	if ($user['assigned_build_mart_fees']=='yes' && $user['build_mart_fees_type']!=null) {
        		$feeRanges = UserBuildMartFee::where('user_id',$user['id']);
        		if ($user['build_mart_fees_type']=='any_order_amount') {
        			$feeRanges = $feeRanges->first();
                    $feeRanges = !empty($feeRanges) ? $feeRanges->toArray() : [];
        		}else{
        			$feeRanges = $feeRanges->get()->toArray();
        		}
        		// dd($feeRanges);
            	return view('frontend.login.provider.buildMartFees.buildMartFees',compact('page','feeRanges','user'));
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

    public function approveBuildMartFees(Request $request) {
        try {
        	// dd('here');
        	User::where('id',Auth::user()->id)->update(['is_build_mart_fees_approve_by_user'=>'yes']);
        	$page = 'buildMartFees';
        	Session::flash('success',trans('messages.frontend.build_mart_fees.approve_success'));
            return redirect()->back();
        } catch (Exception $e) {
            \Log::info($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }
}
