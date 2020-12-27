@extends('frontend.layout.providerLayout')
@section('title','Request Chat Document Center')
@section('content')
<section class="outer_db_wraper db_seller_items_list">
    <div class="combine_side_main_slr_db d-flex">
        <div class="sidenav_seller_db">
            @include('frontend.include.providerSidebar')
        </div>
        <div class="main_seller_db item_list_seller_db">
            <section class="bread_top_sec">
                <div class="db_container">
                    <div class="d-flex justify-content-between text-white pos_rel">
                        <div class="sid_controlr">
                            <i class="clos_sid fa fa-bars"></i>
                            <i class="opn_sid fa fa-times"></i>
                        </div>
                        <h3>Request Document Center</h3>
                        <nav class="bread_nav_sec">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:;">RFP</a></li>
                                <!-- <li class="breadcrumb-item active">Item List</li> -->
                            </ol>
                        </nav>
                    </div>
                </div>
            </section>
            <div class="marg_over_bread">
                <section class="item_list_sec p-0">
                    <div class="db_container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="wrp_allrfp_req">
                                            <!-- <div class="fltr_topp d-flex align-items-center">
                                                <div class="section-heading">
                                                    <span>All RFP Request</span>
                                                    <h2>Request Document Center</h2>
                                                </div>
                                            </div> -->
                                            <!-- <div class="fltr_topp d-flex justify-content-end align-items-center mb-3">
                                                <div class="rfp_quotatns_list dropdown">
                                                    <span class="clkd_span dropdown-toggle" data-toggle="dropdown">
                                                        <i class="fa fa-sort"></i>&nbsp;Sort
                                                    </span>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">User Name Ascending</a>
                                                        <a class="dropdown-item" href="#">User Name Descending</a>
                                                        <a class="dropdown-item" href="#">RFQ Name Ascending</a>
                                                        <a class="dropdown-item" href="#">RFQ Name Descending</a>
                                                        <a class="dropdown-item" href="#">RFQ Price High to Low</a>
                                                        <a class="dropdown-item" href="#">RFQ Price Low to High</a>
                                                        <a class="dropdown-item" href="#">Recent Submission Date</a>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="table_all_rfp_data">
                                                <!-- <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <p class="mb-0">Document Center of RFP ID: <span class="text-danger font-weight-bold"></span></p>
                                                    <div class="log_btn">
                                                        <a href="javascript:;" class="btn btn_theme"><span> Chat Document Center</span></a>
                                                        <a href="javascript:;" class="btn btn_theme resp_quot"><span>Respond</span></a>
                                                    </div>
                                                </div> -->
                                                <div class="table-responsive scroll_tbl">
                                                    <table class="table tabl_allrfp_botm table-bordered">
                                                        <thead class="non_edtble">
                                                            <tr>
                                                                <th>S.No.</th>
                                                                <th>Sent By</th>
                                                                <th>Date of Add</th>
                                                                <th>Attachment</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="non_edtble apnd_docs">
                                                            <!-- <tr class="nt_found_tr">
                                                                <td colspan="6">
                                                                    No Data Found
                                                                </td>
                                                            </tr> -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
@stop
@section('script')
<script type="text/javascript">
    var className;
    var exist;
    var user;
    var key = 1;
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

                    if(data.message_sent_by == "user" && data.receiver_id==senderId){
                        // user = 'user';
                        user = '{{$senderName}}';
                        className = 'pull-left';
                    }else{
                        // user = 'me';
                        user = '{{$receiverName}}';
                        className = 'pull-right';
                    }

                    var message_html = '';

                    if(data.attachment_type && data.attachment_type != null && data.attachment_type != 'null' && data.message == 'Read Attachment'){

                        // key = 1;
                        exist = "yes";

                        var attachment_url = data.attachment;
                        var document_url = '{{url("public/frontend/img/document_thumbnail.png")}}';
                        var pdf_url = '{{url("public/frontend/img/pdf-thumbnail.jpeg")}}';

                        if(data.attachment_type == 'image'){

                            message_html = '<a href="javascript:void(0)" data-featherlight="'+attachment_url+'" ><img src="'+attachment_url+'" class="img-fluid chat-img"></a>';

                        }else if(data.attachment_type == 'audio'){

                            message_html = '<audio controls><source src="'+attachment_url+'"></audio>';

                        }else if(data.attachment_type == 'video'){

                            message_html = '<video controls><source src="'+attachment_url+'"></video>';

                        }else if(data.attachment_type == 'document'){

                            message_html = '<a href="'+attachment_url+'"><img src="'+document_url+'" class="img-fluid chat-img"></a>';

                        }else if(data.attachment_type == 'pdf'){
                            message_html = '<a href="'+attachment_url+'" target="_blank"><img src="'+pdf_url+'" class="img-fluid chat-img"></a>';
                        }

                        $('.apnd_docs').append('<tr><td>'+key+'</td><td>'+user+'</td><td>'+moment(data.created_at).format("DD/MM/YYYY")+'</td><td><a href="'+attachment_url+'" target="_blank" class="text-danger"><i class="fa fa-file"></i></a></td></tr>');
                        // if(snapshot.docChanges().length -1 == ind){
                           
                        // }
                        key = key+1;
                    }
                    // else{

                    //     message_html = '<p>'+data.message+'</p>';
                    // }

                    // if(senderId == data.sender_id){
                    //     $('.uploading_percent_cls').hide();
                    // }

                    // $('.my-chat-convo').append('<li class="msg-box '+className+'"><div class="col-sm-12"><p>'+message_html+'</p><span class="msg-time">'+data.created_at+'</span></div></li>');
                    // if(snapshot.docChanges().length -1 == ind){
                       
                    // }

                    // $(".usr_mesg"+data.room_id).text(data.message);
                    console.log('appending..............')

                }
                if (change.type === "modified") {
                    console.log("Modified city: ", change.doc.data());
                }
                if (change.type === "removed") {
                    console.log("Removed city: ", change.doc.data());
                }
            });
            if (exist!="yes") {
                $('.apnd_docs').append('<tr class="nt_found_tr"><td colspan="4">No Data Found</td></tr>');
            }
            // else{
            //     $('.nt_found_tr').show();
            // }
        });

    // }
</script>
@stop