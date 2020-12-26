<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use App\User;
use Auth;
use Hash;
use App\Notification;

class NotificationController extends Controller
{
    //
    public function notifications(Request $request) {

    	try{
            $data = $request->all(); 

            $notifications = Notification::where('receiver_id',Auth::user()->id)
            							  ->with(['senderDetail'=>function($q){ $q->select('id','user_type_id','first_name','last_name','contact_name','profile_image'); },'requestForProposalDetail'=>function($q){ $q->select('id','user_id','user_type_id','request_title'); }])
            							  ->orderBy('id','desc')
            							  // ->get()->toArray();  
            							  ->paginate(10);
            // dd($notifications->total());
           	// if ($notifications->total()) {
           	// 	dd('if');
           	// }else{
           	// 	dd('else');
           	// }
            $page = 'notifications';
            return view('frontend.login.user.notifications.notifications',compact('page','notifications'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }
}
