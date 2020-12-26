<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script> -->
    <script src="{{asset('public/admin/js/main.js')}}"></script>
  <script type="text/javascript" src="{{asset('public/admin/js/jquery.validate.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/frontend/js/toastr.min.js')}}"></script>
   
   
    <script src="{{asset('public/admin/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    
    <script src="{{asset('public/admin/js/jquery.btnswitch.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/admin/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    
    
    <!-- <script type="text/javascript" src="{{asset('public/frontend/js/main.js')}}"></script> -->

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

<script type="text/javascript">
    $(document).ready(function(){
        $('.loader').hide();
    });
</script>