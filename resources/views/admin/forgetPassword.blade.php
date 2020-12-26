<!doctype html>
@include('admin.include.head')
@section('title','Forget Password')

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
                      <form action="{{url('admin/forgetpassword')}}" method="post" id="adminLogin">
                            @csrf
                            <div class="form-group text-center fogt_pwd">
                                <label>Forgot Password ?</label> 
                            </div>
                        <div class="form-group">
                            <!-- <label>Email address</label> -->
                            <span class="fget_line">Enter your email. We will send you a link to reset your Password.</span>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                           
                            <button type="Submit" class="btn btn_theme btn-flat m-b-15">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @include('admin.include.scripts')

 <script type="text/javascript">
    $('#adminLogin').validate({
        ignore:[],
        rules:{
            "email":{
                required:true,
                // maxlength:100,
                email:true,
                
            },
           
        },
        messages:{
            "email":{
                required:"Please enter email address",
               
            },
           
        }
    });
</script>