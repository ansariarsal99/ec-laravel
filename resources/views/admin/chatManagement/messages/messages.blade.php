@extends('admin.layout.adminLayout')
@section('title','Messages')
@section('content')

 @include('admin.include.header')
    <!-- Sidebar menu-->
    @include('admin.include.sidebar')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Chat Management</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="javascript:;">Chat Management</a></li>
                            <li class="active">Messages</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <strong class="card-title">Inbox</strong>
                       <!-- <a href="" class="btn btn-outline-danger" data-toggle="modal" data-target="#coun_modal" style="float:right;">Add New</a>
                       <a href="{{url('admin/export/countryList')}}" class="btn btn-outline-danger pull-right mr-2" style="float:right;">Export</a> -->
                    </div>
                    <div class="card-body">
                       <div class="cont_shd_frm wrap_inbox_dash">
                            <div class="wrap_inbox_user">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="chat-sidebar">
                                            <!-- begin chat sidebar -->
                                            <div class="side_inbox">
                                                <div class="scrll-bar">
                                                    <ul class="chat_users clearfix" type="none">
                                                        @if(isset($adminChatRooms) && sizeof($adminChatRooms)>0)
                                                            @foreach($adminChatRooms as $key => $adminChatRoom)
                                                                @if(!empty($adminChatRoom))
                                                                    <?php 
                                                                        if (!empty($adminChatRoom['user_detail']['profile_image']) && file_exists(userProfileImageBasePath.'/'.$adminChatRoom['user_detail']['profile_image']) ) {
                                                                            $imgPath = userProfileImagePath.'/'.$adminChatRoom['user_detail']['profile_image'];
                                                                        }else{
                                                                            $imgPath = defaultImagePath.'/no_image.png';      
                                                                        }

                                                                        if ($adminChatRoom['user_detail']['user_type_id']==1 || $adminChatRoom['user_detail']['user_type_id']==2) {
                                                                            $name = ucfirst($adminChatRoom['user_detail']['first_name']).' '.ucfirst($adminChatRoom['user_detail']['last_name']);
                                                                        }else{
                                                                            $name = ucfirst($adminChatRoom['user_detail']['contact_name']).' '.ucfirst($adminChatRoom['user_detail']['contact_last_name']);
                                                                        }
                                                                    ?>
                                                                    <li class="usr-msg-box d-flex align-items-center @if($key==0) active_now @endif" type="admin" data-id="{{base64_encode($adminChatRoom['id'])}}">
                                                                        <div class="usr-img">
                                                                            <img src="{{@$imgPath}}" class="img-fluid" alt="" /> 
                                                                        </div>
                                                                        <div class="meta_chat_info">
                                                                            <h4 class="nam_cht"><i class="@if($adminChatRoom['user_detail']['is_login']=='yes') online_dot @else offline_dot @endif fa fa-circle"></i> {{@$name}}</h4>
                                                                            <p class="usr_msg usr_mesg{{@$adminChatRoom['room_id']}}">{{@$adminChatRoom['last_message']}}</p>
                                                                            <!-- <span class="usr-status rounded ">2 New</span> -->
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        <!-- <li class="usr-msg-box d-flex align-items-center active_now">
                                                            <div class="usr-img">
                                                                <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img-fluid" alt="abc">
                                                            </div>
                                                            <div class="meta_chat_info">
                                                                <h4 class="nam_cht"><i class="offline_dot fa fa-circle"></i> Jack Crimson</h4>
                                                                <p class="usr_msg">Lorem ipsum dolor sit asda asda</p>
                                                            </div>
                                                        </li>
                                                        <li class="usr-msg-box d-flex align-items-center">
                                                            <div class="usr-img">
                                                                <img src="https://images.pexels.com/photos/1222271/pexels-photo-1222271.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="img-fluid" alt="abc">
                                                            </div>
                                                            <div class="meta_chat_info">
                                                                <h4 class="nam_cht"><i class="online_dot fa fa-circle"></i> Larry Paul</h4>
                                                                <p class="usr_msg">Lorem ipsum dolor sit</p>
                                                            </div>
                                                        </li>
                                                        <li class="usr-msg-box d-flex align-items-center">
                                                            <div class="usr-img">
                                                                <img src="https://ocdn.eu/pulscms-transforms/1/6wnk9kqTURBXy85Y2YxYjczODVlZDRkZTc5Yjg0YmRjYjgyNWI2YTk0My5qcGVnkpUDAAbNBVbNAwCVAs0DBwDDw4KhMAGhMQE" class="img-fluid" alt="abc"> 
                                                            </div>
                                                            <div class="meta_chat_info">
                                                                <h4 class="nam_cht"><i class="online_dot fa fa-circle"></i> Willson Mirahe</h4>
                                                                <p class="usr_msg">Lorem ipsum dolor sit</p>
                                                                <span class="usr-status rounded ">2 New</span>
                                                            </div>
                                                        </li>
                                                        <li class="usr-msg-box d-flex align-items-center">
                                                            <div class="usr-img">
                                                                <img src="https://image.shutterstock.com/image-photo/portrait-men-studio-gray-background-260nw-328098230.jpg" class="img-fluid" alt="abc">
                                                            </div>
                                                            <div class="meta_chat_info">
                                                                <h4 class="nam_cht"><i class="online_dot fa fa-circle"></i> Larry Paul</h4>
                                                                <p class="usr_msg">Lorem ipsum dolor sit</p>
                                                            </div>
                                                        </li> -->      
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- end chat sidebar -->
                                        </div>
                                    </div>
                                    <!-- chat right -->
                                    <div class="col-sm-9">
                                        <div class="chat-body"> 
                                            <div class="chat_render_view_cls">
                                                                                                              
                                            </div>
                                            <div class="progress pro-bar" style="display: none;">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                            <div class="write-msg-content pos_rel">
                                                <!-- <form> -->
                                                    <span class="attch_clip">
                                                        <i class="fa fa-paperclip"></i>
                                                        <!-- <input type="file" class="form-control"> -->
                                                        <input type="file" name="fileToUpload" id="fileToUpload" value="" accept="image/jpg, image/jpeg, image/png, image/bmp, audio/mp3, audio/wav, video/mp4, video/wmv, video/3gp, video/ogg, application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                                    </span>
                                                    <input type="text" class="form-control input_fit type_msg" name="msg" placeholder="Write a Message" value="" />
                                                    <button class="btn btn-green msg" id="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"></i></button>
                                                <!-- </form> -->
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- chat right -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
<!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-storage.js"></script>
<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyDm2VneSfR3H_6_RjGMoHQfMNLUo4HLU-4",
        authDomain: "mawad-test-4f5f6.firebaseapp.com",
        databaseURL: "https://mawad-test-4f5f6.firebaseio.com",
        projectId: "mawad-test-4f5f6",
        storageBucket: "mawad-test-4f5f6.appspot.com",
        messagingSenderId: "431132758481",
        appId: "1:431132758481:web:b53ed97688726ae005d0f0",
        measurementId: "G-CJ2TD4FX9K"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    var db = firebase.firestore();
    var storage = firebase.storage(); 
    console.log("db ===================== ",db);
    console.log("storage ===================",storage);
</script>

<script type="text/javascript">
    // scrollChat();

    function scrollChat(){
        var get_height = $('.my-chat-convo').prop('scrollHeight');
        $('.my-chat-convo').animate({scrollTop: get_height}, 400);
    }    

    // $('.msg').on('click',function(){
    //     var cur_msg = $(this).closest('.write-msg-content').find('input').val();
    //     var cur_date = new Date();
    //     var h =  cur_date.getHours(), m = cur_date.getMinutes();
    //     var time = (h > 12) ? (h-12 + ':' + m +' PM') : (h + ':' + m +' AM');
    //     var da_tm = time;

    //     $('.my-chat-convo').append('<li class="msg-box pull-right"><div class="col-sm-12"><p> '+ cur_msg +' </p><span class="msg-time"> '+ da_tm +' </span></div></li>');
    //     $('.write-msg-content').find('input').val('');

    //     scrollChat();
    // });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // alert($('.chat_users').find('.active_now').data('id'));
        var chatRoomId = $('.chat_users').find('.active_now').data('id');
        var chatRoomType = $('.chat_users').find('.active_now').attr('type');
        var roomId;
        var senderId;
        var receiverId;
        var userId;
        var adminId;
        var file_selected;
        var file_selected_encoded;
        var file;
        var FR= new FileReader();
        var all_file_extension = ['jpeg', 'jpg', 'png', 'bmp','mp4','wmv','3gp','ogg','mp3','wav','doc','docx','pdf'];
        var img_file_extension = ['jpeg', 'jpg', 'png','bmp'];
        var video_file_extension = ['mp4','wmv','3gp','ogg'];
        var audio_file_extension = ['mp3','wav'];
        var doc_file_extension = ['doc','docx'];
        var pdf_file_extension = ['pdf'];
        var file_selected_data = [];

        // alert(chatRoomType);

        chatView(chatRoomId,chatRoomType);

        function chatView(chatRoomId,chatRoomType){
            // alert('here');
            $.ajax({
                url: "{{url('admin/chat/getView')}}",
                data: {_token:"{{csrf_token()}}", chatRoomId:chatRoomId, chatRoomType:chatRoomType},
                type:'post',
                success: function(resp){
                    if(resp.status == 'success'){
                        $('.chat_render_view_cls').html(resp.chatView);
                        senderId = resp.senderId;
                        receiverId = resp.receiverId;
                        userId = resp.userId;
                        adminId = resp.adminId;
                        roomId = resp.roomId;
                        // alert(resp.senderId);
                        // alert(resp.receiverId);
                    }else{
                        $('.chat_render_view_cls').html('');
                    }
                    scrollChat();
                }, 
                error: function(){

                }
            });            
        }

        $("body").on('click','.usr-msg-box',function(){
            chatRoomId = $(this).data('id');
            $(this).siblings().removeClass('active_now');
            $(this).addClass('active_now');
            chatRoomType = $('.chat_users').find('.active_now').attr('type');
            // alert(chatRoomId);
            chatView(chatRoomId,chatRoomType);
        });

        $(document).on('click','#msg_send_btn', function(){
            
            if($('.type_msg').val().trim() != ''){

                // alert(senderId);
                // alert(receiverId);
                // alert(userId);
                // alert(adminId);
                //var data = { message: $('.type_msg').val(), user_id: user_id, admin_id: admin_id, room_id:room_id, message_sent_type: 'admin', unique_code: Math.floor(Date.now() / 1000)+Math.floor(Math.random()*(1000000-10000+1)+10000) };
                // alert(JSON.stringify(data));
                // socket.emit('admin_message', data);
                // alert(roomId);
                db.collection("user_chats").doc(roomId).collection("messages").add({
                    room_id : roomId,
                    sender_id: senderId,
                    receiver_id : receiverId,
                    user_id : userId,
                    admin_id : adminId,
                    // unique_code : Math.floor(Date.now() / 1000)+Math.floor(Math.random()*(1000000-10000+1)+10000),
                    message :  $('.type_msg').val(),
                    attachment_type : "",
                    attachment : null,
                    message_type  : null,
                    message_sent_by  : 'admin',
                    check_status  :"unread",
                    local_time : null,
                    delete_chat_by_sender :'no' ,
                    delete_chat_by_receiver :'no' ,
                    delete_chat_by_user :'no' ,
                    delete_chat_by_admin :'no' ,
                    created_at : moment().format('YYYY-MM-DD HH:mm:ss'),
                    updated_at : moment().format('YYYY-MM-DD HH:mm:ss'),
                });

                // socket.emit('room join',{room_id: room_id, sender_id: user_id});
                $('.type_msg').val('');
            }
        });

        $(document).on('keypress','.type_msg', function(e){
            if(e.which == 13){
                $('#msg_send_btn').trigger('click');
            }
        });

        // upload file start
        $('#fileToUpload').on('change', function(e) {
            file_selected = e.target.files,file;

            if (!file_selected || file_selected.length == 0) return;
            file = file_selected[0]; // in `file` you have the file properties like "name" and "size"
            // console.log(file);

            if(file.size > 8388608){
                swal('Maximum file size upto 8MB is acceptable');
                return false;
            }
            // console.log("sto ================== ", storage);
            var storage = firebase.storage().ref();       
            var name = Math.floor(Date.now() / 1000)+Math.floor(Math.random()*(1000000-10000+1)+10000)+ file.name
            var media = storage.child('media/'+name);
            // alert(storage);
            /*media.put(file).then(function(snapshot) {
              console.log('Uploaded a blob or file!');
            }).catch(err => {
                console.log(err);
            });*/

            var uploadTask = storage.child('media/'+name).put(file);
            // starting drom 0
            $('.pro-bar').children('div').css('width',"0%");
            $('.pro-bar').children('div').text("0%");
            uploadTask.on('state_changed', function(snapshot){
              // Observe state change events such as progress, pause, and resume
              // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                console.log('Upload is ' + progress + '% done');
                $('#icon-ch').removeClass('fas fa-paperclip');
                $('#icon-ch').addClass('fas fa-circle-notch fa-spin');
                $('#fileToUpload').prop('disabled',true);
                $('.pro-bar').show();
                $('.pro-bar').children('div').css('width',parseInt(progress)+"%");
                $('.pro-bar').children('div').text(parseInt(progress) + "%");

                switch (snapshot.state) {
                    case firebase.storage.TaskState.PAUSED: // or 'paused'
                      console.log('Upload is paused');
                      break;
                    case firebase.storage.TaskState.RUNNING: // or 'running'
                      console.log('Upload is running');
                      break;
                }
            }, function(error) {
              // Handle unsuccessful uploads
              console.log(error);
            }, function() {
              // Handle successful uploads on complete
              // For instance, get the download URL: https://firebasestorage.googleapis.com/...
                uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
                    $('#icon-ch').removeClass('fas fa-circle-notch fa-spin');
                    $('#icon-ch').addClass('fas fa-paperclip');
                    $('#fileToUpload').prop('disabled',false);
                    $('.pro-bar').hide();
                    console.log('File available at', downloadURL);

                    var file_extension = file.name.substr( (file.name.lastIndexOf('.') +1) ).toLowerCase();
                   
                    if ($.inArray(file_extension, all_file_extension) == -1) {
                        swal("Only formats are allowed : "+all_file_extension.join(', '));
                        return false;
                    }else{
                        var attachmentType = "";
                        if($.inArray(file_extension, img_file_extension) != -1){

                            attachmentType = 'image';
                        }else if($.inArray(file_extension, audio_file_extension) != -1){
                            
                            attachmentType = 'audio';
                        }else if($.inArray(file_extension, video_file_extension) != -1){
                            
                            attachmentType = 'video';
                        }else if($.inArray(file_extension, doc_file_extension) != -1){
                            
                            attachmentType = 'document';
                        }else if($.inArray(file_extension, pdf_file_extension) != -1){
                            
                            attachmentType = 'pdf';
                        }

                        db.collection("user_chats").doc(roomId).collection('messages').add({
                            room_id : roomId,
                            sender_id: senderId,
                            receiver_id : receiverId,
                            user_id : userId,
                            admin_id : adminId,
                            unique_code : Math.floor(Date.now() / 1000)+Math.floor(Math.random()*(1000000-10000+1)+10000),
                            message :  "Read Attachment",
                            attachment_type : attachmentType,
                            attachment : downloadURL,
                            message_type  : null,
                            message_sent_by  : 'admin',
                            check_status  :"unread",
                            local_time : null,
                            delete_chat_by_sender :'no' ,
                            delete_chat_by_receiver  :'no' ,
                            delete_chat_by_user :'no' ,
                            delete_chat_by_admin :'no' ,
                            created_at : moment().format('YYYY-MM-DD HH:mm:ss'),
                            updated_at : moment().format('YYYY-MM-DD HH:mm:ss'),
                            // country: "Japan"
                        })

                    }

                });
            });


            return

            
            FR.onload = function (e) {
                // ATTENTION: to have the same result than the Flash object we need to split
                // our result to keep only the Base64 part
                file_selected_encoded = e.target.result.split(",")[1];
                // var file_extension = file.name.split(".")[1].toLowerCase();
                var file_extension = file.name.substr( (file.name.lastIndexOf('.') +1) ).toLowerCase();
               
                if ($.inArray(file_extension, all_file_extension) == -1) {
                    swal("Only formats are allowed : "+all_file_extension.join(', '));
                    return false;
                }else{

                    if($.inArray(file_extension, img_file_extension) != -1){

                        file_selected_data[0]['attachment_type'] = 'image';
                    }else if($.inArray(file_extension, audio_file_extension) != -1){
                        
                        file_selected_data[0]['attachment_type'] = 'audio';
                    }else if($.inArray(file_extension, video_file_extension) != -1){
                        
                        file_selected_data[0]['attachment_type'] = 'video';
                    }else if($.inArray(file_extension, doc_file_extension) != -1){
                        
                        file_selected_data[0]['attachment_type'] = 'document';
                    }else if($.inArray(file_extension, pdf_file_extension) != -1){
                        
                        file_selected_data[0]['attachment_type'] = 'pdf';
                    }

                    file_selected_data[0]['file_size'] = file.size;
                    file_selected_data[0]['file_name'] = file_selected_data[0].Name;

                    console.log(file_selected_data);

                    // socket.emit('uploadFileStart',{room_id: room_id,file_name: file_selected_data[0].Name, file_size: file.size,sender_id: sender_id});
                    //socket.emit('uploadFileStart',file_selected_data);
                    $('.uploading_percent_cls').html('Uploading...');
                    $('.uploading_percent_cls').show();
                }
            };

            FR.readAsDataURL(file);

        }); 
        // upload file end

        setInterval(function(){ 
            // alert("Hello"); 
            $.ajax({
                url: "{{url('user/chat/onlineStatus')}}",
                data: {_token:"{{csrf_token()}}"},
                type:'post',
                success: function(resp){
                    if(resp.status == 'success'){
                        $.each( resp.chatRooms, function( key, chatRoom ) {
                            if (userId==chatRoom.sender_id) {
                                if (chatRoom.receiver_detail.is_login=='yes') {
                                    $(".usr_chat"+chatRoom.receiver_detail.id).removeClass("offline_dot").addClass("online_dot");
                                    $('.usr_chat_stts'+chatRoom.receiver_detail.id).css('display','block');
                                }else{
                                    $(".usr_chat"+chatRoom.receiver_detail.id).removeClass("online_dot").addClass("offline_dot");
                                    $('.usr_chat_stts'+chatRoom.receiver_detail.id).css('display','none');
                                }
                            }else{
                                if (chatRoom.sender_detail.is_login=='yes') {
                                    $(".usr_chat"+chatRoom.sender_detail.id).removeClass("offline_dot").addClass("online_dot");
                                    $('.usr_chat_stts'+chatRoom.sender_detail.id).css('display','block');
                                }else{
                                    $(".usr_chat"+chatRoom.sender_detail.id).removeClass("online_dot").addClass("offline_dot");
                                    $('.usr_chat_stts'+chatRoom.sender_detail.id).css('display','none');
                                }
                            }
                        });
                        if (resp.adminChatRoom.admin_detail.is_login=='yes') {
                            $(".admn_chat"+resp.adminChatRoom.admin_detail.id).removeClass("offline_dot").addClass("online_dot");
                            $('.admn_chat_stts'+resp.adminChatRoom.admin_detail.id).css('display','block');
                        }else{
                            $(".admn_chat"+resp.adminChatRoom.admin_detail.id).removeClass("online_dot").addClass("offline_dot");
                            $('.admn_chat_stts'+resp.adminChatRoom.admin_detail.id).css('display','none');
                        }
                        // alert(resp.adminChatRoom.admin_detail.id);
                        // console.log("admin room ========= ",resp.adminChatRoom)
                        // console.log("chat rooms ========= ",resp.chatRooms)
                    }
                }, 
                error: function(){

                }
            });
        }, 5000);

    });
</script>
@stop