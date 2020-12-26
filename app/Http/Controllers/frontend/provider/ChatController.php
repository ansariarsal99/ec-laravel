<?php

namespace App\Http\Controllers\frontend\provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use App\User;
use App\ChatRoom;
use Auth;
use App\Admin;

class ChatController extends Controller
{
    //
    public function messages(Request $request) {
        try{
            $data = $request->all();
            // dd($data);
            // dd(Auth::user()->id);
            $toUser = "";
            if (isset($data['to_user']) && !empty($data['to_user'])) {
                $receiverId = base64_decode($data['to_user']);
                $chatRoom = ChatRoom::where([
                                        'sender_id' => Auth::guard('web')->user()['id'],
                                        'receiver_id' => (int)$receiverId,
                                        'type' => 'user'
                                    ])
                                    ->orWhere(function($q) use ($receiverId){
                                        $q->where([
                                            'sender_id' => (int)$receiverId,
                                            'receiver_id' => Auth::guard('web')->user()['id'],
                                            'type' => 'user',
                                        ]);
                                    })
                                    ->first();
                // dd($receiverId);
                if (empty($chatRoom)) {
                    $roomId = time().rand(10000,90000).'-'.Auth::guard('web')->user()['id'];
                    $createRoom = ChatRoom::create(['room_id'=>$roomId,
                                                    'sender_id'=>Auth::user()->id,
                                                    'receiver_id'=>(int)$receiverId,
                                                    'type' => 'user',
                                                ]);
                }
                $toUser = $receiverId;
            }
            $adminId = Admin::where('type','admin')->where('status','active')->value('id');
            // dd($toUser);
            $adminRoom = ChatRoom::where([
                                    'user_id' => Auth::guard('web')->user()['id'],
                                    'admin_id' => $adminId,
                                    'type' => 'admin'
                                ])
                                ->first();
            if (empty($adminRoom)) {
                $roomId = time().rand(10000,90000).'-'.Auth::guard('web')->user()['id'];
                $createAdminRoom = ChatRoom::create(['room_id'=>$roomId,
                                                'user_id'=>Auth::user()->id,
                                                'admin_id'=>(int)$adminId,
                                                'type' => 'admin'
                                            ]);
            }

            $adminChatRoom = ChatRoom::with(['userDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','contact_name','contact_last_name','profile_image','is_login'); },'adminDetail'=>function($q){ $q->select('id','first_name','last_name','image','is_login'); }])
                                ->where('user_id',Auth::user()->id)
                                ->where('admin_id',$adminId)
                                ->first();
            $adminChatRoom = !empty($adminChatRoom) ? $adminChatRoom->toArray() : [];

            $chatRooms = ChatRoom::with(['senderDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','contact_name','contact_last_name','profile_image','is_login'); },'receiverDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','contact_name','contact_last_name','profile_image','is_login'); }])
                                ->where('sender_id',Auth::user()->id)
                                ->orWhere('receiver_id',Auth::user()->id)
                                ->orderBy('id','desc')
                                ->get()
                                ->toArray();
            // dd($adminChatRoom);
            $page = 'messages';
            return view('frontend.login.provider.messages.messages',compact('page','chatRooms','adminChatRoom','toUser'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function userChatGetView(Request $request) {

        $data = $request->all();
        // dd($data);
        if ($data['chatRoomType']=='admin') {
            $chatRoom = ChatRoom::with(['userDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','contact_name','contact_last_name','profile_image','is_login'); },'adminDetail'=>function($q){ $q->select('id','first_name','last_name','image','is_login'); }])->where('id',base64_decode($data['chatRoomId']))->first();
            $chatRoom = !empty($chatRoom) ? $chatRoom->toArray() : [];
        }else{
            $chatRoom = ChatRoom::with(['senderDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','contact_name','profile_image','is_login'); },'receiverDetail'=>function($q){ $q->select('id','user_type_id','institution_name','first_name','last_name','contact_name','profile_image','is_login'); }])->where('id',base64_decode($data['chatRoomId']))->first();
            $chatRoom = !empty($chatRoom) ? $chatRoom->toArray() : [];            
        }
        // dd($chatRoom);
        $roomId = $chatRoom['room_id'];
        $senderId = Auth::user()->id;
        $userId = null;
        $adminId = null;
        $receiverId = null;
        if ($chatRoom['type']=='admin') {
            $senderId = null;
            $userId = Auth::user()->id;
            $adminId = $chatRoom['admin_id'];
        }elseif ($chatRoom['sender_id']==Auth::user()->id) {
            $receiverId = $chatRoom['receiver_id'];
        }else{
            $receiverId = $chatRoom['sender_id'];            
        }
        if (!empty($chatRoom)) {
            $view = view('frontend.login.provider.messages.chatViewCommon',compact('chatRoom','senderId'))->render();
            // return $view;
            return array('status'=>'success','chatView'=>$view,'senderId'=>$senderId,'receiverId'=>$receiverId,'userId'=>$userId,'adminId'=>$adminId,'roomId'=>$roomId);
        }else{
            return array('status'=>'empty');
        }
    }
}
