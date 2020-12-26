<?php 
    if ($chatRoom['type']=='admin') {
        
        $name = ucfirst($chatRoom['admin_detail']['first_name']).' '.ucfirst($chatRoom['admin_detail']['last_name']);
        $isLogin = $chatRoom['admin_detail']['is_login'];
        $userId = $chatRoom['admin_detail']['id'];
        $chatCls = "admn_chat_stts".$userId;
        
        if (!empty($chatRoom['admin_detail']['image']) && file_exists(adminProfileImageBasePath.'/'.$chatRoom['admin_detail']['image']) ) {
            $imgPath = adminProfileImagePath.'/'.$chatRoom['admin_detail']['image'];
        }else{
            $imgPath = defaultImagePath.'/no_image.png';      
        }
    }elseif ($chatRoom['sender_detail']['id']==Auth::user()->id) {
        $isLogin = $chatRoom['receiver_detail']['is_login'];
        $userId = $chatRoom['receiver_detail']['id'];
        $chatCls = "usr_chat_stts".$userId;
        if ($chatRoom['receiver_detail']['user_type_id']==1 || $chatRoom['receiver_detail']['user_type_id']==2) {
            $name = ucfirst($chatRoom['receiver_detail']['first_name']).' '.ucfirst($chatRoom['receiver_detail']['last_name']);
        }else{
            $name = ucfirst($chatRoom['receiver_detail']['contact_name']);
        }
        if (!empty($chatRoom['receiver_detail']['profile_image']) && file_exists(userProfileImageBasePath.'/'.$chatRoom['receiver_detail']['profile_image']) ) {
            $imgPath = userProfileImagePath.'/'.$chatRoom['receiver_detail']['profile_image'];
        }else{
            $imgPath = defaultImagePath.'/no_image.png';      
        }
    }else{
        $isLogin = $chatRoom['sender_detail']['is_login'];
        $userId = $chatRoom['sender_detail']['id'];
        $chatCls = "usr_chat_stts".$userId;
        if ($chatRoom['sender_detail']['user_type_id']==1 || $chatRoom['sender_detail']['user_type_id']==2) {
            $name = ucfirst($chatRoom['sender_detail']['first_name']).' '.ucfirst($chatRoom['sender_detail']['last_name']);
        }else{
            $name = ucfirst($chatRoom['sender_detail']['contact_name']);
        }
        if (!empty($chatRoom['sender_detail']['profile_image']) && file_exists(userProfileImageBasePath.'/'.$chatRoom['sender_detail']['profile_image']) ) {
            $imgPath = userProfileImagePath.'/'.$chatRoom['sender_detail']['profile_image'];
        }else{
            $imgPath = defaultImagePath.'/no_image.png';      
        }
    }
?>
<div class="top-head_in d-flex align-items-center">
    <img class="img-fluid" src="{{$imgPath}}" />
    <span class="right_inf">
        <h5 class="nam_ch"> {{$name}} <span class="pull-right"></span> </h5>
        <span class="act_stts {{$chatCls}} text-success" @if($isLogin=='yes') style="display: block" @else style="display: none" @endif><i class="fa fa-circle"></i> Active Now</span>
    </span>
</div>
<ul class="my-chat-convo my-chat-convo-cls{{$chatRoom['room_id']}} clearfix">
    <!-- <li class="msg-box pull-left">
        <div class="col-sm-12">
            <p>Hello</p>
            <span class="msg-time">07:45 PM</span>
        </div>
    </li> -->
    <!-- <li class="msg-box pull-right">
        <div class="col-sm-12">
            <p>consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <span class="msg-time">07:50 PM</span>
        </div>
    </li>
    <li class="msg-box pull-right">
        <div class="col-sm-12">
            <p>
                <a class="img_left" href="https://s.ftcdn.net/v2013/pics/all/curated/RKyaEDwp8J7JKeZWQPuOVWvkUjGQfpCx_cover_580.jpg?r=1a0fc22192d0c808b8bb2b9bcfbf4a45b1793687" target="_blank">
                    <img src="https://s.ftcdn.net/v2013/pics/all/curated/RKyaEDwp8J7JKeZWQPuOVWvkUjGQfpCx_cover_580.jpg?r=1a0fc22192d0c808b8bb2b9bcfbf4a45b1793687" class="img_chat">
                </a>
            </p>
            <span class="msg-time">07:45 PM</span>
        </div>
    </li>
    <li class="msg-box pull-left">
        <div class="col-sm-12">
            <p>Hello</p>
            <span class="msg-time">07:45 PM</span>
        </div>
    </li>
    <li class="msg-box pull-right">
        <div class="col-sm-12">
            <p>consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <span class="msg-time">07:50 PM</span>
        </div>
    </li>
    <li class="msg-box pull-right">
        <div class="col-sm-12">
            <p>consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <span class="msg-time">07:50 PM</span>
        </div>
    </li>
    <li class="msg-box pull-right">
        <div class="col-sm-12">
            <p>consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <span class="msg-time">07:51 PM</span>
        </div>
    </li>
    <li class="msg-box pull-left">
        <div class="col-sm-12">
            <p>
                <a class="img_left" href="https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg" target="_blank">
                    <img src="https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg" class="img_chat">
                </a>
            </p>
            <span class="msg-time">07:45 PM</span>
        </div>
    </li>
    <li class="msg-box pull-left">
        <div class="col-sm-12">
            <p>Typing . . .</p>
        </div>
    </li> -->
</ul>  
<script type="text/javascript">
    var className;
    var senderId = "{{@$senderId}}";
     var senderImgHtml = '';
    // alert("{{$chatRoom['room_id']}}");
    // loadMessages();
    // Loads chat messages history and listens for upcoming ones.
    // function loadMessages() {
        // Create the query to load the last 12 messages and listen for new ones.
        var query = firebase.firestore()
                      .collection('user_chats').doc("{{$chatRoom['room_id']}}").collection('messages')
                      .orderBy('created_at', 'asc');
      
        // Start listening to the query.
        query.onSnapshot(function(snapshot) {
            snapshot.docChanges().forEach(function(change,ind) {
                // alert('here');
                var lastVisible = snapshot.docs[1];

                if (change.type === "added") {
                   // console.log("New city: ", change.doc.data());
                    var data = change.doc.data();
                    //insertChat(myName, change.doc.data().message, 0,change.doc.data());
                    console.log("data ========= ",change.doc.data());

                    // alert(data.room_id);

                    if(data.message_sent_by == "admin" || (data.message_sent_by == "user" && data.receiver_id==senderId)){
                        className = 'pull-left';
                    }else{
                        className = 'pull-right';
                    }
                    //     var req_data = {room_id:room_id, unique_code: data.thread_id, chatfor: 'admin'}
                    //   //  socket.emit('message read', req_data);
                    // }
                    // $(".chat_user_"+data.room_id).attr('ral_doc_id',change.doc.id);

                    var message_html = '';

                    if(data.attachment_type && data.attachment_type != null && data.attachment_type != 'null' && data.message == 'Read Attachment'){

                        var attachment_url = data.attachment;
                        var document_url = '{{url("public/frontend/img/document_thumbnail.png")}}';
                        var pdf_url = '{{url("public/frontend/img/pdf-thumbnail.jpeg")}}';

                        if(data.attachment_type == 'image'){

                            message_html = '<a href="javascript:void(0)" data-featherlight="'+attachment_url+'" ><img src="'+attachment_url+'" class="img-fluid chat-img"></a>';

                        }else if(data.attachment_type == 'audio'){

                            message_html = '<audio controls><source src="'+attachment_url+'"></audio>';

                        }else if(data.attachment_type == 'video'){

                            message_html = '<video class="chat_video" controls><source src="'+attachment_url+'"></video>';

                        }else if(data.attachment_type == 'document'){

                            message_html = '<a href="'+attachment_url+'"><img src="'+document_url+'" class="img-fluid"></a>';

                        }else if(data.attachment_type == 'pdf'){
                            message_html = '<a href="'+attachment_url+'" target="_blank"><img src="'+pdf_url+'" class="img-fluid"></a>';
                        }

                    }else{

                        message_html = '<p>'+data.message+'</p>';
                    }


                    // $('.typing_class').remove();
                    if(senderId == data.sender_id){
                        $('.uploading_percent_cls').hide();
                    }

                    $('.my-chat-convo-cls'+data.room_id).append('<li class="msg-box '+className+'"><div class="col-sm-12 chat_img_div">'+message_html+'<span class="msg-time">'+data.created_at+'</span></div></li>');
                    if(snapshot.docChanges().length -1 == ind){
                        scrollChat();
                    }

                    updateSidebarLastMessage(data.room_id,data.message);
                    $(".usr_mesg"+data.room_id).text(data.message);
                    // 
                    console.log('appending..............')

                }
                if (change.type === "modified") {
                    console.log("Modified city: ", change.doc.data());
                }
                if (change.type === "removed") {
                    console.log("Removed city: ", change.doc.data());
                }
            });
        });
    // }

    function updateSidebarLastMessage(room_id, message){

        $.ajax({
            url: "{{url('user/chat/updateSidebarLastMessage')}}",
            type: 'post',
            data: {_token: "{{csrf_token()}}", room_id:room_id, message:message},
            success: function(resp){

            },
            error: function(){

            }
        })
    }
</script>