@extends('frontend.layout.providerLayout')
@section('title','Payment Methods')
@section('content')

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">

        <link href="{{asset('public/frontend/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" media="all" />

        <div class="wrapper_shala seller_db_inner">
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
			            			<h3>Inqueries</h3>
			            			<nav class="bread_nav_sec">
										<ol class="breadcrumb">
										    <li class="breadcrumb-item"><a href="#">Provider</a></li>
										    <li class="breadcrumb-item active"><a href="#">Inqueries</a></li>
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
		            								<div class="card_ttl d-flex align-items-center justify-content-end">
		            									<!-- <div class="chng_links">
		            										<ul type="none" class="d-flex align-items-center">
		            											<li><a href="javascript:;">Today</a></li>
		            											<li><a href="javascript:;">Yesterday</a></li>
		            											<li><a href="javascript:;">Current Week</a></li>
		            											<li><a href="javascript:;">Previous Week</a></li>
		            											<li><a href="javascript:;">Current Month</a></li>
		            											<li><a href="javascript:;">Previous Month</a></li>
		            											<li><a href="javascript:;">Current Year</a></li>
		            											<li><a href="javascript:;">Previous Year</a></li>
		            										</ul>
		            									</div> -->
					            						<div class="">
					            							<!-- <a href="javascript:void(0);" class="card_btn_top">+ Add Product</a> -->
					            						  <a class="btn btn-sm btn_theme" href="{{url('provider/export/user_InqueryList')}}"><span>Export</span></a>
					            						</div>
					            					</div>
					            					<div class="filter_div_seler new_div_seler">
					            						<form class="form-inline" id="search_form" action="{{url('provider/trackInqueries')}}" method="get">
					            							<label class="text_bold">Search:</label>
                                    <div class="col-sm-3">
					            						     	<span class="wd_form">
					            								   <input type="text" name="start_date" id="start_date" data-provide="datepicker" value="{{@$_GET['start_date']}}"  class="form-control datepicker" placeholder="From Date">
					            					    		</span>
                                    </div>
                                    <div class="col-sm-3">
					            						    	<span class="wd_form">
					            							  	<input type="text" name="end_date" id="end_date" data-provide="datepicker" value="{{@$_GET['end_date']}}" class="form-control datepicker" placeholder="To Date">
					            						     	</span>
                                    </div>

					            						  <div class="col-sm-3">
                                        <span class="wd_form">
                                          <select value="" name="sort" type="text" class="form-control custom-select sort">
                                             <option selected disabled>Sort User Name <body></body></option>
                                             <option value="asc" <?php if(@$_GET['sort'] == 'asc'){echo "selected";}?>>By User Name Ascending</option>
                                             <option value="desc" <?php if(@$_GET['sort'] == 'desc'){echo "selected";}?>>By User Name Descending</option>
                                          </select>
                                        </span>
                                    </div>  
					            						</form>                                
                                  
					            						<div class="searc_btn text-center mt-3">
					            							<button class="btn btn_theme searchSubmit"><span>Search</span></button>
					            							<button class="btn btn_theme reset"><span>Reset</span></button>
					            						</div>
					            					</div>
					            					<div class="table-responsive table_seler">
				            						  <table  class="table table-bordered table-striped  inqueryId">
                                    <thead>
                                      <tr>
                                        <th>Inquery No#</th>
                                        <th>Date & Time</th>
                                        <th>User Name</th>
                                        <th>Query</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                      <!-- <tbody></tbody> -->
                                    <tbody>
                                        @foreach(@$userInqueries as $inqueries)
                          
                                           <tr>
                                            <td>{{$inqueries['inquery_id']}}</td>
                                            <td>{{$inqueries['created_at']}}</td>
                                            <td>{{@ucfirst($inqueries['first_name'] . $inqueries['last_name'])}}</td>

                                            <td class="stats_item">
                                                <?php 
                                                 $string = strip_tags($inqueries['query']);
                                                 if (strlen($string) > 20) {

                                                     // truncate string
                                                     $stringCut = substr($string, 0, 20);
                                                     $endPoint = strrpos($stringCut, ' ');

                                                     //if the string doesn't contain any space then it will cut without word basis.
                                                     $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                     // $string .= '... <a href="/this/story">Read More</a>';
                                                 }
                                                 echo $string;

                                                 ?>

                                               @if(strlen($inqueries['query']) !=strlen($string))
                                                 <p> 
                                                     <a class="text-primary cp model_view" view_more="{{$inqueries['query']}}" data-toggle="modal" data-target="#view_more_msg">View More</a>
                                                 </p>
                                               @endif

                                              
                                               <input type="hidden" class="query_description" name="query_description" value="{{$inqueries['query']}}">

                                            </td>

                                            <td class="stats_item">
                                              @if($inqueries['respond_status'] == 'pending') 
                                                  <a class="text-success cp resp" data-id="{{$inqueries['id']}}" data-toggle="modal" data-target="#coun_modal">Respond</a>
                                                  
                                              @endif  
                                              @if($inqueries['respond_status'] != 'pending')  
                                                 
                                                 <a class="text-success cp view_resp_reply" reply_msg="{{$inqueries['response']}}" data-toggle="modal" data-target="#view_Response">View Response</a>
                                              @endif  
                                              
                                            
                                            </td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                    <section class="pg-sec background-white p-4">
                                      <div class="numbr_pagintn mt-3">
                                    
                                      </div>
                                    </section>

                                  </table>
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
        </div>

     
     <!-- //////////////////////// Respod - Model////////////////////// -->

             <div class="modal" id="coun_modal">
              <form method="post" id="respondform" action="{{url('provider/trackInqueries/response/send')}}">
                 @csrf
                 <div class="modal-dialog cout_info">
                     <div class="modal-content">
                         <!-- Modal Header -->
                             <div class="modal-header">
                                 <h4 class="modal-title">Respond</h4>
                                 <button type="button" class="close"  data-dismiss="modal">&times;</button>
                             </div>
                              <!-- Modal body -->
                             <div class="modal-body">
                                 <div class="country_div">
                                     <!-- <form> -->
                                     <div class="form-group">
                                         <label>Reply</label>
                                         <textarea class="form-control text-align:left" id="reply_id"  rows="4" name="reply" placeholder="Please enter reply"></textarea>
                                     </div>
                                    
                                 </div>
                                 <input class="inquery_Id" type="hidden" name="id" value=""> 
                             </div>
                                 <!-- Modal footer -->
                             <div class="modal-footer">
                                 <button type="Submit" id="send_btn" class="btn btn-danger">Send</button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>


     <!-- //////////////////////// View More - Model////////////////////// -->

             <div class="modal" id="view_more_msg">
                 <div class="modal-dialog cout_info">
                     <div class="modal-content">
                         <!-- Modal Header -->
                           <div class="modal-header">
                               <h4 class="modal-title">Query</h4>
                               <button type="button" class="close"  data-dismiss="modal">&times;</button>
                           </div>
                            <!-- Modal body -->
                           <div class="modal-body">
                               <div class="country_div">
                                   <!-- <form> -->
                                   <div class="form-group">
                                       <label>Question</label>
                                       <textarea  disabled="" class="form-control text-align:left view_more_class_model_Id"  rows="4" name="description" placeholder="Message"></textarea>
                                   </div>
                             
                               </div>
                           </div>
                      </div>
                  </div>
             </div>

  <!-- ////////////////////////View Response Model/////////////////            -->
     
     <div class="modal" id="view_Response">
         <div class="modal-dialog cout_info">
             <div class="modal-content">
                 <!-- Modal Header -->
                   <div class="modal-header">
                       <h4 class="modal-title">View Response</h4>
                       <button type="button" class="close"  data-dismiss="modal">&times;</button>
                   </div>
                    <!-- Modal body -->
                   <div class="modal-body">
                       <div class="country_div">
                           <!-- <form> -->
                           <div class="form-group">
                               <label>Response</label>
                               <textarea  disabled="" class="form-control text-align:left view_response_class"  rows="4" name=" View Response" placeholder="Message"></textarea>
                           </div>
                     
                       </div>
                   </div>
              </div>
          </div>
     </div>

   @stop

   @section('script')
    <script type="text/javascript" src="{{asset('public/frontend/js/bootstrap-datepicker.min.js')}}"></script>


  <script>
     $(document).on('click','.resp', function(){
          $('.inquery_Id').val($(this).data('id'));   
     })

     $(document).on('click','.model_view', function(){
          $('.view_more_class_model_Id').val($(this).attr('view_more'));   
     })

    $(document).on('click','.view_resp_reply', function(){
         $('.view_response_class').val($(this).attr('reply_msg'));   
    })     

  </script>
  

    <script>
       $(document).on('click','#send_btn', function(){
           $('#respondform').submit();
       })
    </script>

      <script type="text/javascript">
          $('#respondform').validate({
              ignore:[],
              rules:{
                  "reply":{
                      required:true,
                      maxlength:5000,
                  },
              },
              messages:{
                  "reply":{
                      required:"Please enter message",
                      maxlength:"Maximum 5000 characters are allowed",
                  },
              },
          });
      </script>

      <script>
          $(document).ready(function () {

              var date = new Date();
              $("#start_date").datepicker({
                  autoclose: true,
                  todayHighlight: true,
                  format: "dd-mm-yyyy",
                  viewMode: "days",
                  minViewMode: "days"
              }).on('changeDate', function (selected) {
                  var minDate = new Date(selected.date.valueOf());
                  $('#end_date').datepicker('setStartDate', minDate);
              });

              $("#end_date").datepicker({
                  autoclose: true,
                  todayHighlight: true,
                  format: "dd-mm-yyyy",
                  viewMode: "days",
                  minViewMode: "days"
              })
              .on('changeDate', function (selected) {
                  var maxDate = new Date(selected.date.valueOf());
                  $('#start_date').datepicker('setEndDate', maxDate);
              });
          });
      </script>

      <script>
            
          var start_date       = $('#start_date').val();
          var end_date         = $('#end_date').val();
          var user_name_order   = $('.sort').val();
          $(document).on('click', '.searchSubmit', function(){
           
        // alert(user_name_order);
                if(start_date != '' || end_date != ''  || user_name_order != '')    {
                 $('#search_form').submit(); 
                }else{
                  swal('plesae select Date to filter');
                }
              

          });

      $('.reset').on('click',function(){
      
          
             window.location.href = "{{ url('provider/trackInqueries') }}";   

      });
      </script>

   @stop