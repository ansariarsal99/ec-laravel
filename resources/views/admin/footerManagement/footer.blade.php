@extends('admin.layout.adminLayout')
@section('title','Build Mart Contact Detail')
@section('content')

 @include('admin.include.header')
    <!-- Sidebar menu-->
    @include('admin.include.sidebar')

            <div class="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="row m-0">
                        <div class="col-sm-4">
                            <div class="page-header float-left">
                                <div class="page-title">
                                    <h1>Footer Management</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#">Footer Management</a></li>
                                        <li class="active">Build Mart Contact Detail</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    
    <div class="content">
        <div class="animated fadeIn">
            <!-- <div class="col-md-12"> -->

           <!-- <div class="row">    -->
            <form  enctype="multipart/form-data" method="POST" id="footerForm" action="{{url('admin/footer/detail')}}">
              @csrf
                <div class="card">
                    <div class="card-header">
                       <strong class="card-title">Build Mart Contact Detail</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-md-2">
                            <div class="terms_page my-4">
                                <form>
                                    <label>Contact Number</label>
                                   
                                    <div class="mb-2">
                                        <input type="tel" name="contact_number" class="form-control mb-2" placeholder="Contact Number" value="{{$footerDetails['isd_code']}} {{@$footerDetails['contact_number']}}" id="phone2" >
                                       
                                        <input type="hidden" class="form-control" name="isd_code" id="isd_code2" value="{{ltrim(@$footerDetails['isd_code'], @$footerDetails['isd_code'][0])}}">   
                                    </div>

                                    <div class="mb-2">
                                        <label>Email</label>
                                        <input class="form-control mb-2" id="title" placeholder="Email" name="email" type="text"  value="{{@$footerDetails->email}}">
                                    </div>
                                     
                                    <label class="">Address</label>
                                    <input class="form-control" id="address_hidden_id" name="address" type="hidden">

                                    <textarea class="form-control textar" id="address_id" name="address_id">{{@$footerDetails->address}}</textarea>
                                    <label class="error" for="address_hidden_id"></label>


                                    <button type="button" id="save" class="cstm-azy-btn-red submit">Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </form>              
            <!-- </div>  -->
            <!-- </div> -->
        </div> 
    </div>                                  
       
      


@stop
@section('script')

<!-- <script type="text/javascript">
    $(document).on('click', '#submit', function () {
        if('#footerForm')isvalid(){
         form.submit();
        }
    });
</script>
 -->
<script src="{{ url('public/frontend/js/intlTelInput.js')}}"  type="text/javascript"></script>
<script src="{{ url('public/frontend/js/intlTelInput-jquery.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // IntlTelInput Plugin Initialization
    var inputIntl=$("#phone2").intlTelInput({             
        allowDropdown: true,
        autoHideDialCode: true,
        autoPlaceholder: "",
        dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        preferredCountries: [],
        separateDialCode: true,
        utilsScript: "public``/frontend/js/utils.js",
    });
</script>
<script type="text/javascript">    
    $("#phone2").on("countrychange", function(e, countryData) {
        var dial_code = $("#phone2").intlTelInput("getSelectedCountryData").dialCode;
        $('#isd_code2').val(dial_code);
    });
</script>



<script type="text/javascript">
  $('#footerForm').validate({
        ignore:[],
        rules:{
            "contact_number":{
                required:true,
                // number:true,
            },
            "email":{
                    required:true,
                    email: true,
            },
            "address":{
               required:true,
               minlength:20,
            }
        },
        messages:{
            "contact_number":{
                required:"Please enter contact number",
            },
            "email":{
                   required:"Please enter email",
                   maxlength:"Maximum 100 characters are allowed",
                   // regex: "Please enter valid email address",
            },
            "address":{
             required:"Please enter address",
             minlength:"address must contain 20 characters",
            }
        },
    });
</script>



<script type="text/javascript" src="{{asset('public/admin/js/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '.textar',
        height: 300,
        menubar: true,
        forced_root_block : "", /*to remove auto p tag */
        plugins: [
            'advlist autolink link image charmap print preview anchor',
            /*'advlist autolink lists link image charmap print preview anchor',*/
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media contextmenu paste code'
            /*'insertdatetime media table contextmenu paste code'*/
        ],
        // toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
         toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
        image_advtab: true,
        /*to take automatic urls starts*/
        relative_urls: false,
        remove_script_host: false,
        /*to take automatic urls ends*/
        file_browser_callback_types: 'file image media',
       
        image_title: true, 
        // enable automatic uploads of images represented by blob or data URIs
        automatic_uploads: true,
        // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: "{{url('admin/contentManagement/termAndCondtion')}}",

        file_picker_types: 'image media file', 
        setup: function (editor) {
            editor.on('change', function (e) {
                // alert(editor.getContent());
                $('textarea[name="'+editor.targetElm.name+'"]').next('input').val($.trim(editor.getContent()));
            });
        },     
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];

                var id = 'blobid' + (new Date()).getTime();
                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                var blobInfo = blobCache.create(id, file);
                blobCache.add(blobInfo);
                // alert(blobInfo.blobUri());
                cb(blobInfo.blobUri(), { title: file.name });
            };

           input.click();
        }
  
    });
</script>
<script type="text/javascript">
    $(document).on('click','#save',function(){
            if($('textarea').hasClass('textar')){
                var plainText = tinymce.activeEditor.getContent();
                $('#address_hidden_id').attr('value',plainText);

            }else{
                var val = $('#address_id').val();
                $('#address_hidden_id').attr('value',val);
            }

            $('#footerForm').submit();
          
         // Prince Abdulaziz Ibn Jalawi
         // street Al Sulaimaniyab
         // District Riyadh
         // 12234 Kingdom of Saudhi Arabia
        
    })
</script>



@stop