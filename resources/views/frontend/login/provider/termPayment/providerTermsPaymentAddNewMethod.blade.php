@extends('frontend.layout.providerLayout')
@section('title','Terms Of Payment')
@section('content')
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
	            			<h3>Terms Of Payment</h3>
	            			<nav class="bread_nav_sec">
								<ol class="breadcrumb">
								    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
								    <li class="breadcrumb-item active"><a href="javascript:;">Terms Of Payment</a></li>
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
		                                    <section class="register_sec pymnt_type selr_pymt">
		                                        <div class="new_div_aded">
		                                            <div class="section-heading">
		                                                <h2>Add New Method</h2>
		                                            </div>
		                                            <div class="wrap_register_white selr_reg_white">
		                                                <div class="row">
		                                                    <div class="col-sm-12">
		                                                        <div class="pro-paymnt_new">
													            	<form method="post" id="addPayment" action="{{url('provider/termsPaymentAddNewMethod')}}">
													                    @csrf
													            		<div class="row">
																            <div class="col-sm-10 offset-sm-1">
													            				<div class="row">
													            					<div class="col-sm-3">
													            						<label>Name</label>
													            					</div>
													            					<div class="col-sm-9">
													            						<div class="form-group">
													            							<input type="text" placeholder="Name" name="name" class="form-control custom-control">
													            						</div>
													            					</div>
													            				</div>
													            				<div class="row">
													            					<div class="col-lg-3">
													            						<label>Select Quota</label>
													            					</div>
													            					<div class="col-lg-9">
													            						<div class="form-group">
															            					<select class="form-control custom-control changeQuota" name="number_of_quota">
															            					<option selected disabled>Select Quota</option>
															            						<option value="1">1</option>
															            						<option value="2">2</option>
															            						<option value="3">3</option>
															            						<option value="4">4</option>
															            					</select>
													            						</div>
													            					</div>
													            				</div>
													            				<div class="new_inputs">
													            				</div>
															                    <input type="hidden" name="user_id" value="{{@$userId}}">
													            				<div class="text-right">
																					<button class="btn btn_theme save"><span>Add Payment Method</span></button>
																				</div>
													                		</div>
													                	</div>
													            	</form>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </section>
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

@stop
@section('script')

   <script src="{{asset('public/admin/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script>
	
	$(document).on('change', '.changeQuota', function() {
	      var selectedQuota = $(this).val();
	      // alert(selectedQuota);
	      var i;
	      $('.new_inputs').html("");
	     
			for (i = 0; i <selectedQuota ; i++) {
			   $('.new_inputs').append('<div class="row"><div class="col-sm-2"><div class="form-group"><input  type="text" name="changeQuota['+i+'][quota_percent]" id="quota_data'+i+'" class="form-control quota " placeholder="Amount(%)"><label for="quota_data'+i+'" generated="true" class="error"></label></div></div><div class="col-sm-10"><div class="fomr-group"><input id="title_data'+i+'" type="text" name="changeQuota['+i+'][title]" placeholder="Enter Title" class="form-control title"><label for="title_data'+i+'" generated="true" class="error"></label></div></div></div>');

          	} 
         

          	$("input[id^=quota_data]").each(function(){
		        $(this).rules("add", {
		            required: true,
		            digits:true,
		           
		            messages: {
		                required: "Please enter amount(%)"
		            }
		        });   
		    });

		   $("input[id^=title_data]").each(function(){
		        $(this).rules("add", {
		            required: true,
		            // digits:true,
		           
		            messages: {
		                required: "Please enter title"
		            }
		        });   
			});

    });
    $('#addPayment').validate({
    	rules:{
    		name:{
    			required:true
    		}
    	},
    	messages:{
    		name:{
    			required:"Please enter name"
    		}
    	}
    });


        $(".save").click(function(e){
             e.preventDefault();

	        if ($('#addPayment').valid()) {
	        	// alert('valid');
		            var sum = 0;

		            $('.quota').each(function(){
		              sum += Number($(this).val());
				    });

				 
				    if(sum==100){
		                $('#addPayment').submit();
				    }else{
				        swal('Your sum of calculated values is not 100');
				    }
					
			 }  else{
			 	// alert(' valid else');
			 }

      });

</script>

@stop