    
    <!doctype html>
@include('admin.include.head')

<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <!-- <a href="index.html"> -->
                        <img class="align-content" src="{{asset('public/frontend/img/logo.png')}}"  alt="">
                    </a>
                </div>
                <div class="login-form">
                      <form action = "{{url('admin/passwordReset')}}" method = "post" id="RESETPasswordChange">
                            @csrf

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="admin_new_pass1" required="password" name="new_password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" required="password" name="confirm_password" placeholder="Password">
                            </div>
                                             
                           <button type="Submit" class="btn btn_theme btn-flat m-b-15">change password</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    
    @include('admin.include.scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#RESETPasswordChange').validate({
            ignore:[],
            rules:{
                
                new_password:{
                    required:true,
                    minlength:6,
                    maxlength:50
                },
                confirm_password:{
                    required:true,
                    equalTo:'#admin_new_pass1'
                },
            },
            messages:{
                
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


