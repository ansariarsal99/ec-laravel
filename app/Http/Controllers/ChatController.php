<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use Auth;
use App\Admin;
use App\ChatRoom;

class ChatController extends Controller
{
    //
    public function messages(Request $request) {

    	$data = $request->all();

    	$adminChatRooms = ChatRoom::with(['userDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','contact_name','contact_last_name','profile_image','is_login'); }])
                                ->where('admin_id',Auth::guard('admin')->user()->id)
                                ->get();
        $adminChatRooms = !empty($adminChatRooms) ? $adminChatRooms->toArray() : [];
        // dd($adminChatRooms);
        if (sizeof($adminChatRooms)>0) {
            // dd('if');
        	$page = "messages";
        	return view('admin.chatManagement.messages.messages',compact('page','adminChatRooms'));
        }else{
            // dd('else');
            Session::flash('error',trans('messages.frontend.chat_document_center.not_found'));
            return redirect()->back();
        }
    }

    public function userChatGetView(Request $request) {

        $data = $request->all();
        // dd($data['chatRoomId']);
        if ($data['chatRoomType']=='admin') {
            $chatRoom = ChatRoom::with(['userDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','contact_name','contact_last_name','profile_image','is_login'); },'adminDetail'=>function($q){ $q->select('id','first_name','last_name','image','is_login'); }])->where('id',base64_decode($data['chatRoomId']))->first();
            $chatRoom = !empty($chatRoom) ? $chatRoom->toArray() : [];

            $roomId = $chatRoom['room_id'];
            $adminId = Auth::guard('admin')->user()->id;
            $senderId = null;
            $receiverId = null;
            $userId = $chatRoom['user_id'];

            $view = view('admin.chatManagement.messages.chatViewCommon',compact('chatRoom','adminId'))->render();
            // return $view;
            return array('status'=>'success','chatView'=>$view,'senderId'=>$senderId,'receiverId'=>$receiverId,'userId'=>$userId,'adminId'=>$adminId,'roomId'=>$roomId);
        }else{
            return array('status'=>'empty');
        }
    }


    
}
