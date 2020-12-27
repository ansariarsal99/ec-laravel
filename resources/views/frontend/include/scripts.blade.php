<!-- script files -->
<script type="text/javascript" src="{{asset('public/frontend/js/jquery-2.2.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/frontend/js/popper.js')}}"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
<script type="text/javascript" src="{{asset('public/frontend/js/bootstrap.js')}}"></script> <!-- Necessary-JavaScript-File-For-Bootstrap --> 
<script type="text/javascript" src="{{asset('public/frontend/js/owl.carousel.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-html5-1.6.2/fh-3.1.7/datatables.min.js"></script>
<script src="{{asset('public/frontend/js/imageuploader.js')}}"></script>
<script src="{{asset('public/frontend/js/parallax.js')}}"></script>
<script src="{{asset('public/frontend/js/toastr.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.validate.js')}}"></script>
<script src="{{asset('public/frontend/js/additional-methods.js')}}"></script>
<script src="{{asset('public/frontend/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('public/frontend/js/dropzone.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="{{asset('public/frontend/js/featherlight.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('public/frontend/js/magiczoomplus.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.loader').hide();
    });
</script>
<script type="text/javascript">
    $('.opn_sid').hide();
</script>
<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });

    $(function () {
        $('.dtpckr').datetimepicker({
            format: 'L',
            minDate: moment(),
            // ignoreReadonly: true
        });
    });

    $(document).ready(function() {
        $('.dt_table').DataTable({

        });
    });
</script>
<!-- New images uploader  -->
<script>
    (function(){
        var options = {};
        $('.js-uploader__box').uploader(options);
        }()
    );
</script>
<!-- End -->

<!-- Seller profile change div -->
<script>
    // $('.common_list').hide(); 
    //     $(function() {
    //         $('#select_value').change(function(){
    //         $('.common_list').hide();
    //         $('#' + $(this).val()).show();
    //     });
    // });
</script>

<script type="text/javascript">
    $('.owl_slide').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        nav: false,
        autoplay: true,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.newprod_slider').owlCarousel({
        loop: false,
        // margin:10,s
        nav: true,
        dots: false,
        autoplay: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:4
            }
        }
    });
    $('.hot_slider').owlCarousel({
        loop: true,
        // margin:10,s
        nav: true,
        dots: false,
        autoplay: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:4
            }
        }
    });
    $('.brands_slider').owlCarousel({
        loop: true,
        // margin:10,s
        nav: true,
        dots: false,
        autoplay: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:6
            }
        }
    });
</script>
<!-- custom validations -->
<script type="text/javascript">
    var proto = window.location.protocol;
    var host = window.location.host;
    var ajax_url = proto+"//"+host+"/mawad_mart";
    var msg_error_oops = 'Oops, Something went wrong. Please try again';
    var name_regex = /^[A-Z,a-z ]+$/;
    var email_regex = /^.{1,}@.{2,}\..{2,}/;
    var regex_no_space = /^\S*$/;
    var regex_user_name = /^[a-zA-Z][a-zA-Z\s]*$/;
    var auth = "{{Auth::check()}}";

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please enter in proper format."
    );

    jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value.indexOf(" ") < 0 && value != ""; 
    }, "Please do not use space");
</script>
<!-- session -->
<!-- session message start -->
<script>
    @if(Session::has('success'))
        $(function () {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success("{{ Session::get('success') }}");
        });
    @endif    
    @if(Session::has('error'))
        $(function () {
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "10000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            toastr.error("{{ Session::get('error') }}");
        });
    @endif  
</script>
<!-- session message end -->

<!-- Inner Dropdown arrow rotate script in sidebar-->
<script>
    $('.child_ul').hide();
    $(document).ready(function(){
        $('.drop_ul').on('click', function(){
            $(this).closest('li').find('i').toggleClass('down');
            $(this).closest('li').find('ul').slideToggle();
            $(this).closest('li').siblings().find('.child_ul').slideUp();
            $(this).closest('li').siblings().find('.drop_ul > i').removeClass('down');
        })
    });
</script>

<!-- Seller profile change div -->
<script>
    // $('.common_list').hide(); 
    // $(function() {
    //     $('#designer').show();
    //     $('#select_value').change(function(){
    //     $('.common_list').hide();
    //     $('#' + $(this).val()).show();
    //   });
    // });
</script>

<!-- Multiple select -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".mul_category").select2({
            placeholder: "Select"
        });
    });
</script>

<!-- User dbsidebar Inner Dropdown arrow rotate script in sidebar-->
<script>
    $('.child_ul').hide();
    $(document).ready(function(){
        $('.user_drop_ul').on('click', function(){
            $(this).closest('li.has_child_li').find('.arrow').toggleClass('down');
            $(this).closest('li.has_child_li').find('ul.child_ul').slideToggle();
            $(this).next().find('.new_arrow').removeClass('innnerdown');
            $(this).next().find('.sub_child').slideUp();
            // $(this).closest('li.has_child_li').siblings().find('.child_ul').slideUp();
            // $(this).closest('li.has_child_li').siblings().find('.drop_ul > i').removeClass('down');
        })
    });
</script>

<script>
    $('.sub_child').hide();
    $(document).ready(function(){
        $('.sub_drop_ul').on('click', function(){
            $(this).closest('li.inr_has_li').find('.new_arrow').toggleClass('innnerdown');
            $(this).closest('li.inr_has_li').find('ul.sub_child').slideToggle();
            $(this).closest('li.inr_has_li').siblings().find('.sub_child').slideUp();
            $(this).closest('li.inr_has_li').siblings().find('.sub_drop_ul > i').removeClass('innnerdown');
        })
    });
</script>

<!-- header dropdown script for user start -->
<script>
    $(document).ready(function(){
      $('.test').on("click", function(e){
        $(this).next('ul').slideToggle();
        if ($(this).hasClass('abc')) {
            $(this).parents().siblings().find('.dropdown-menu').slideUp();
            // alert($(this).parent().siblings().html());            
        }else{
            $(this).find('.dropdown-menu').slideUp();

        }
        e.stopPropagation();
        e.preventDefault();
      });
    });
</script>
<!-- header dropdown script for user end -->


<script>

      $(document).ready(function(){
         $('.emptyCartClass').on('click',function(){
            var cartCount  = $('.totalItemCount').val();
            if(cartCount==0){
                swal('Cart is empty');
                   // location.replace("https://pro.promaticstechnologies.com/build_mart/login");
            }
         });
      }) 

</script>


<script>

      $(document).ready(function(){
         $('.noLoginWishlist').on('click',function(){
                // location.href='{{url('/login')}}';
                swal('Please Login First');
         });
      }) 

</script>

<script>

      $(document).ready(function(){
         $('.withoutLoginCart').on('click',function(){
                // location.href='{{url('/login')}}';
                // swal('Please Login First');
                location.replace("https://pro.promaticstechnologies.com/build_mart/login");
         });
      }) 

</script>
