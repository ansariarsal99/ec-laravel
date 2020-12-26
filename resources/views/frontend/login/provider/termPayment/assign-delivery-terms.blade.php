@extends('frontend.layout.providerLayout')
@section('title','Terms Of Payment')
@section('content')

        <title>Assign Delivery Terms</title>
        
        
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
        <style>
	        .aapnd_ins {
				display: inline-block;
				border-radius: 100%;
				line-height: 30px;
				text-align: center;
				color: #cc3f2f;
				font-size: 27px;
				margin: 10px 8px 0;
				cursor: pointer;
			}
			.delvry_terms{
				border: 1px solid #ddddcf;
			}
			.delv-head{
				padding: 10px 14px;
				background-color: #cc3f2f;
				color: #fff;
			}
			.delvry_terms form{
				padding: 30px 30px;
			}
			.apnd_val, .ins_val {
				background: #cc3f2f;
				padding: 3px 8px;
				color: #fff;
				border-radius: 4px;
				cursor: pointer;
				margin: 5px 10px 0;
				display: inline-block;
			}
        </style>
    </head>
    <body>
        <!-- Header -->
        
        <!-- Header ends -->
        
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
			            			<h3>Delivery Terms & Conditions</h3>
			            			<nav class="bread_nav_sec">
										<ol class="breadcrumb">
										    <li class="breadcrumb-item"><a href="#">Home</a></li>
										    <li class="breadcrumb-item active"><a href="#">Assign Delivery Terms</a></li>
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
		            								<div class="delvry_terms ordr-addr">
		            									<div class="delv-head">
                                                            <h4> Assign Delivery Terms % Fees: (By amount of order)</h4>
                                                        </div>
                                                         <form method="post" id="deliveryTermCondtion" action="{{url('provider/deliveryTerm/condtion')}}">

                                                        	<div class="del_fields">
                                                        		<div class="apnd_sec">
					            									<div class="row">
					            										<div class="col-lg-2">
					            											<div class="form-group">
					            												<input type="text" id="from_price_range_0" name="term_append_div[0][from_price_range]" value="" class="form-control from_price_range" placeholder="From">
					            											</div>
					            										</div>
					            										<div class="col-lg-2">
					            											<div class="form-group">
					            												<input type="text" id="to_price_range_0" name="term_append_div[0][to_price_range]" value="" class="form-control to_price_range" placeholder="To">
					            											</div>
					            										</div>
					            										<div class="col-lg-3">
					            											<div class="form-group">
					            												<select id="price_type_0" value="" class="paid_selectd form-control price_type" name="term_append_div[0][price_type]">
					            													<option selected disabled>Select<body></body></option>       
					            													<option value="nodeal">No Deal</option>
					            													<option value="free">Free</option>
					            													<option value="paid">Paid</option>
					            												</select>
					            											</div>
					            										</div>
					            										<div class="col-lg-2">
					            											<div class="form-group paid_div">
					            												<input type="text" id="" name="term_append_div[0][delivery_price]" value="" class="form-control" placeholder="Price">
					            											</div>
					            										</div>


					            										<div class="col-lg-3">
					            											<div class="form-group">
<!-- 					            												<span class="aapnd_ins">
																					<i class="fa fa-pencil-square-o"></i>
																				</span> -->
																				<!-- <span class="ins_val"></span> -->
																				<button class="ins_val insert_val" type="button">Insert</button>

																				<button class="ins_val edit_val"  type="button">Edit</button>

																				<button class="ins_val update_val" rel="" type="button">Update</button>

																				<span class="aapnd_ins">
																					<i class="fa fa-plus-circle dlv_add"></i>
																				</span>
					            												<!-- <span class="apnd_val">Remove</span>
					            												<span class="apnd_val">Insert</span> -->
					            											</div>
					            										</div>
					            										<input type="hidden" name="submitted_delivery_id" class="submitted_delivery_id" value="">
					            									</div>
                                                        		</div>
                                                        	</div>
                                                        </form>
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

 @stop
@section('script')    


<script type="text/javascript">

	 $(document).ready(function(){
        var userFormValidator = $('#deliveryTermCondtion').validate({

 // var userFormValidator = $('.fourth_form').validate({

    // $('#deliveryTermCondtion').validate({
        ignore:[],
        rules:{
            "from_price_range[]":{
                required:true,
                // number:true,
            },
            "to_price_range[]":{
                required:true,
                // number:true,

            },
             "price_type[]":{
                required:true,
            },

        },
        messages:{
            "from_price_range[]":{
                required:"Please enter from_price_range",
            },

            "to_price_range[]":{
                required:"Please enter to_price_range",

            },
            "price_type[]":{
                required:"Please select payment method",

            },
     
        },
        submitHandler:function(form){
            
            form.submit();
        }
    });


        $("input[id^=from_price_range_").each(function(){
              $(this).rules("add", {
                  required: true,
                   messages: {
                      required: "please enter from Price",
                  } 
              });   
          });

        $("input[id^=to_price_range_").each(function(){
              $(this).rules("add", {
                  required: true,
                   messages: {
                      required: "please enter to price",
                  } 
              });   
          });

        $("input[id^=price_type_").each(function(){
              $(this).rules("add", {
                  required: true,
                   messages: {
                      required: "please enter from Number",
                  } 
              });   
          });

});
</script>


<script type="text/javascript">
  $('.update_val').hide();
  $('.edit_val').hide();
  $("body").on('click', '.insert_val', function() {
       if ($('#deliveryTermCondtion').valid()) {
	        // alert('come');
	        $.ajax({

		        url: "{{url('provider/delveryterms/add')}}",
		        type:'post',
		        data:$("#deliveryTermCondtion").serialize(),

		        success:function(response){

		            $('.submitted_delivery_id').val(response['id']);                   
                        if(response['status']=="true"){
		                    $('.update_val').hide();
		                    $('.edit_val').show()
		                    $('.insert_val').hide();
		                    $(".from_price_range").prop("readonly", true);
		                    $(".to_price_range").prop("readonly", true);
		                    $('.update_val').attr('rel',response['id'])
		                    // $("#price_type").prop("readonly", true);   
		                    $('.price_type').attr("disabled", true); 

		                }      
		        },error(){
		            toastr.error('Something went wrong');
		        }
	        })
        }
  });
</script> 




<script type="text/javascript">
    $("body").on('click', '.edit_val', function() {

        $('.price_type').prop("disabled", false);
        $(".from_price_range").prop("readonly", false);
	    $(".to_price_range").prop("readonly", false);
	    // delivery_price
        
        $('.update_val').show();
        $('.edit_val').hide();  

    });
  </script>
</script>

<script type="text/javascript">
  // $('.ins_val')
  // $('.update_val').hide();
  $("body").on('click', '.update_val', function() {
    // alert('here');
       if ($('#deliveryTermCondtion').valid()) {
	        // alert('come');
	        $.ajax({
		        url: "{{url('provider/delveryterms/add')}}",
		        type:'post',
		        data:$("#deliveryTermCondtion").serialize(),

		        success:function(response){
		        	if(response['status']=="true"){
                        toastr.success('Update successfully');
		                $('.update_val').show();
		                $('.insert_val').hide();
		            }else{
		            toastr.error('Something went wrong');
		            alert('out');
		            }

		            
		        },error(){
		            toastr.error('Something went wrong');
		        }
	        })
        }
  });
</script>

        <!--Rohit script 21 sep  -->
        	<script>
        		$(document).ready(function(){
			        $(".paid_div").hide();
				    $(document).on('change', '.paid_selectd', function() {
				      if ( this.value == 'paid')
				      {
				        $(this).closest('.apnd_sec').find(".paid_div").show();
				      }
				      else
				      {
				        $(this).closest('.apnd_sec').find(".paid_div").hide();
				      }
				    });
				});
        	</script>

        	<!-- Append div -->
        	<script>
        		$(document).ready(function(){
                    var lengt = $('.pack_info').length;

        			$(document).on('click', '.dlv_add', function(){
        				$('.del_fields').append('<div class="apnd_sec"> <div class="row"> <input type="hidden" name="term_append_div['+lengt+'][submitted_delivery_id]" class="submitted_delivery_id" value=""> <div class="col-lg-2"> <div class="form-group"> <input type="text" id="from_price_range_'+lengt+'" name="term_append_div['+lengt+'][from_price_range]" value class="form-control" placeholder="From"> </div></div><div class="col-lg-2"> <div class="form-group"> <input type="text" name="term_append_div['+lengt+'][to_price_range]" id="to_price_range_'+lengt+'"  value class="form-control" placeholder="To"> </div></div><div class="col-lg-3"> <div class="form-group"> <select class="paid_selectd form-control" id="price_type_'+lengt+'" name="term_append_div['+lengt+'][price_type]"> <option selected="">Select</option> <option>No Deal</option> <option>Free</option> <option value="paid">Paid</option> </select> </div></div><div class="col-lg-2"> <div class="form-group paid_div"> <input type="text" name="term_append_div['+lengt+'][delivery_price]" value="" class="form-control" placeholder="Price"> </div></div><div class="col-lg-3"> <div class="form-group"> <span class="apnd_val">Remove</span> <span class="ins_val insert_val">Insert</span> </div></div></div></div>');
        				       

        				$(".paid_div").hide();

        				$(this).closest('.apnd_sec').find(".paid_div").show();
        			
	        			$("input[id^=from_price_range").each(function(){
        			        $(this).rules("add", {
        			            required: true,
        			            messages: {
        			                required: "please enter from_price_range",
        			            }
        			        });   
        			    });

	        			$("input[id^=to_price_range").each(function(){
        			        $(this).rules("add", {
        			            required: true,
        			            messages: {
        			                required: "please enter to_price_range",
        			            }
        			        });   
        			    });

	        			$("input[id^=price_type").each(function(){
        			        $(this).rules("add", {
        			            required: true,
        			            messages: {
        			                required: "please select price_type",
        			            }
        			        });   
        			    });

        			});

        			$(document).on('click', '.apnd_val', function(){
        				$(this).parents('.apnd_sec').remove();
        			});



        		});
        	</script>
        	<!-- Append div -->
        <!--Rohit script 21 sep  -->

 @stop


