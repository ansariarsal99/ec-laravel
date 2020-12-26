<?php  
    if (!empty(Auth::guard('admin')->user()['image'])) {
        $imgpath= adminProfileImageBasePath.'/'.Auth::guard('admin')->user()['image'];    
    }                                                                                        
    if(!empty(Auth::guard('admin')->user()['image']) && file_exists($imgpath) ) { 
        // dd($imgpath);
        $admin_image = adminProfileImagePath.'/'.Auth::guard('admin')->user()['image'];    
    }else{
        $admin_image = defaultAdminImagePath.'/no_image.png';  
        // dd($admin_image);
    }                                           
?> 
@extends('admin.layout.adminLayout')
@section('title','profile')
@section('content')

   
<div class="content">
  	<div class="col-lg-12">
  		<div class="row">
  			<div class="col-lg-4">
  				<div class="card lfex_card">
  					<form id="photo" action="" method="post"  enctype="multipart/form-data" >
  						@csrf
	                    <div class="card-body">
		                    <div class="img_prof user-img">
		                       <img src="{{ $admin_image }}" id="img-fluid" name="image" value="{{@$admin['image']}}" class="img-fluid user-img">

		                       <span class="file_upload">
		                       	<i class="fa fa-pencil"></i>
		                       	<input type="file" id="botonAjax" name="uploader" class="file_type">
		                       </span>
		                    </div>
		                    <div class="name_pro text-center mb-3 mt-3">
		                        <h4>{{@$admin['first_name']}}</h3>
		                    </div>
		                     <div class="form-group text-center">
		                    	<button type="submit" id="btnSendData" class="cstm-azy-btn-red">Update Image
		                    	</button>
			                </div>
	                    </div>
                    </form>
                </div>
  			</div>

  			<div class="col-lg-8">
		        <div class="card">
		            <!-- <div class="card-header">
		                <h4>Custom Tab</h4>
		            </div> -->
		            <div class="card-body">
		                <div class="custom-tab">
		                    <nav>
		                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
		                            <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">Account Settings</a>
		                            <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#custom-nav-contact" role="tab" aria-controls="custom-nav-contact" aria-selected="false">Change Password</a>
		                        </div>
		                    </nav>
		                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
		                        <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
		                            <div class="card_inner">
			                            <div class="card-body card-block">
			                                <form action="{{url('admin/profile')}}" id="my_profile_form" method="post" enctype="multipart/form-data" class="">
			                                	@csrf
			                                	
			                                	<div class="row">
			                                		<div class="col-lg-10 offset-sm-1">
					                                    <div class="row">
					                                    	<div class="col-lg-6">
							                                    <div class="form-group">            
						                                        	<label class=""> First Name </label>
						                                        	<input type="text" name="first_name" class="form-control" value="{{isset($admin['first_name'])?$admin['first_name']:''}}">
							                                    </div>
					                                    	</div>
					                                    	<div class="col-lg-6">
							                                    <div class="form-group">            
						                                        	<label class=""> Last Name </label>
						                                        	<input type="text" name="last_name" class="form-control" value="{{isset($admin['last_name'])?$admin['last_name']:''}}">
							                                    </div>
					                                    	</div>
					                                    </div>
					                                    <div class="form-group">            
				                                        	<label class="">Email</label>
				                                        	<input type="text" name="email" class="form-control eml" value="{{isset($admin['email'])?$admin['email']:''}}">
					                                    </div>
					                                    <div class="form-group">            
				                                        	<label class="">  Contact No</label>
				                                        	<input type="text" name="phone_no" class="form-control " value="{{isset($admin['phone_no'])?$admin['phone_no']:''}}">
					                                    </div>
					                                    <div class="form-group">            
				                                        	<label class="">Mawad Mart Code</label>
				                                        	<input type="text" name="mawad_mart_code" class="form-control " value="{{isset($admin['mawad_mart_code'])?$admin['mawad_mart_code']:''}}">
					                                    </div>
					                                    <div class="form-group">
					                                     	<label>Address</label>          
						                                    <textarea class="form-control" rows="4" name="address" placeholder="">{{isset($admin['address'])?$admin['address']:''}}
						                                    </textarea>
					                                    </div>
					                                    <div class="form-group text-center">
						                                	<button type="submit" class="cstm-azy-btn-red">Submit
						                                	</button>
					                                    </div>
			                                		</div>
			                                	</div>
					                        </form>
			                             </div>
			                        </div>
			                    </div>
		                        <div class="tab-pane fade" id="custom-nav-contact" role="tabpanel" aria-labelledby="custom-nav-contact-tab">
		                           <div class="card_inner">
			                            <div class="card-body card-block">
			                                <form action="{{url('admin/profile/changePassword')}}" id="change_password_form"  method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
			                                	@csrf
			                                    <div class="form-group">            
		                                        	<label for="cpass" class="">Current Password</label>
		                                        	<input type="password" class="form-control cstm-inpt" placeholder="Current Password" name="old_password" required>
		                                        	<div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">Please fill out this field.</div>
			                                    </div>
			                                    <div class="form-group">            
		                                        	<label for="npass" class="">New Password </label>
		                                        	 <input type="password" class="form-control cstm-inpt" id="admin_new_pass" placeholder="New password" name="new_password" required>
			                                    </div>
			                                    <div class="form-group">            
		                                        	<label for="cfpass" class="">Confirm Password </label>
		                                        	<input type="password" class="form-control cstm-inpt"  placeholder="Confirm password" name="confirm_password" required>
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">Please fill out this field.</div>
			                                    </div>
				                                <div class="form-group text-center">
				                                	<button type="submit" class="cstm-azy-btn-red">Update Password
				                                	</button>
					                            </div>
			                                </form>
			                            </div>
			                        </div>
			                    </div>
		                    </div>
		                </div>
		            <!-- </div> -->
		        </div>
  			</div>
  		</div>
  	</div>
</div>
@stop
@section('script')

<script>
$(document).ready(function(){
	$('#btnSendData').click(function(){
		$("#photo").submit(function(e) {
		  var formData = new FormData($(this)[0]);
		  $.ajax({
		    url: '{{url('admin/profile-image')}}',
		    type: "POST",
		    data: formData,
		    success: function (msg) {
		      // alert(msg);
		    },
		    cache: false,
		    contentType: false,
		    processData: false
		  });

		  e.preventDefault();
		});
	})
});

</script>


<script type="text/javascript">

    $(document).ready(function(){
        $('#change_password_form').validate({
            ignore:[],
            rules:{
                old_password:{
                    required:true,
                    // minlength:6,
                    // maxlength:50
                },
                new_password:{
                    required:true,
                    minlength:6,
                    maxlength:50
                },
                confirm_password:{
                    required:true,
                    equalTo:'#admin_new_pass'
                },
            },
            messages:{
                old_password:{
                    required:"Please enter your current password",
                    // maxlength:"Maximum 50 characters are allowed",
                    // minlength:"Password must contain atleast 6 characters",
                },
                new_password:{
                    required:'Please enter your new password.'
                },
                confirm_password:{
                    required:'Please enter your new password again.',
                    equalTo:"Please enter same password again"

                },
            },submitHandler(form){
                form.submit();
            }
        });
    })

</script>

<script>

    $(function(){
        $("#my_profile_form").validate({
            rules:{
                first_name: {
                  required:true,
	               	maxlength:50,
	               	// regex: name_regex
               },
               last_name: {
                  required:true,
	              	maxlength:50,
	              	// regex: name_regex
               },
               email: {
                   required: true,
                   email:true,
               },
               phone_no: {
                  required:true,
	              	maxlength:12,
	              	minlength:10,
	              	// regex: contact_no_regex
               },
               address:{
                   required: true,
                   // email:true,
               },
           },
           messages: {
            first_name:{
                 required:"Please enter first name",
	                maxlength:"Maximum 50 characters are allowed",
	                // regex: "First name contains characters only"
            },
            last_name:{
               required:"Please enter last name",
	                maxlength:"Maximum 50 characters are allowed",
	                // regex: "Last name contains characters only"
            },
            email:{
                required: 'Please enter your email',
            },
            phone_no:{
               required:"Please enter mobile number",
                	maxlength:"Maximum 12 digits are allowed",
                	minlength:"Mobile number must contain 10 digits",
                	// regex: "Please enter valid mobile number"
            },
            address:{
                required: 'Please enter your address',},
         },

       });
    });
</script>


<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
         $('.user-img').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#botonAjax").change(function() {
      readURL(this);
    });
</script>


@stop