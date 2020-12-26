
@extends('admin.include.head')
@section('title','Login')
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
                      <form action="{{url('admin')}}" method="post" id="adminLogin">
                            @csrf
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="checkbox for_pwd">
                            <label class="rem_btn">
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="{{url('admin/forgetpassword')}}">Forgot Password?</a>
                            </label>

                        </div>
                        <button type="button " class="btn btn_theme btn-flat m-b-30 m-t-30">Sign in</button>
                       <!--  <div class="social-login-content">
                            <div class="social-button">
                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                            </div>
                        </div> -->
                       <!--  <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                        </div> -->
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
                maxlength:100,
                // regex: email_regex
                // regex: email_regex,    
            },
            "password":{
                required:true,
                maxlength:50,
            }
        },
        messages:{
            "email":{
                required:"Please enter email address",
                maxlength:"Maximum 100 characters are allowed",
                regex: "Plase enter valid email address"
            },
            "password":{
                required:"Please enter password",
                maxlength:"Maximum 50 characters are allowed",
            }
        }
    });
</script>