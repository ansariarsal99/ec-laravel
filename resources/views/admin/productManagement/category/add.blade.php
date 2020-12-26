@extends('admin.layout.adminLayout')
@section('title','Add Category')
@section('content')

 @include('admin.include.header')
    <!-- Sidebar menu-->
    @include('admin.include.sidebar')

    <style>
           .vw_pro_img img {
                width: 180px;
                height: 180px;
                border-radius: 100%;
                object-fit: cover;
                border: 1px dotted #b1b1b1;
                padding: 3px;
            }

          .bd_img img{
              width: 50px;
              object-fit: cover;
          }
          .nw_file_uplodr{
            right: 229px;
            top: 22px;
          }
    </style>

            <div class="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="row m-0">
                        <div class="col-sm-4">
                            <div class="page-header float-left">
                                <div class="page-title">
                                    <h1>Product Management</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#">Product Management</a></li>
                                        <li class="active">Add Category</li>
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
            <form method="post" id="termForm" action="{{url('admin/productManagement/category/add')}}" enctype="multipart/form-data">
              @csrf
                <div class="card">
                    <div class="card-header">
                       <strong class="card-title">Add Category</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-md-2">
                            <div class="terms_page my-4">
                                    <?php      
                                        $admin_image = defaultAdminImagePath.'/no_image.png';
                                    ?>
                                    <div class="text-center  user-img vw_pro_img img_prof user-img my-4" id="admin_img">
                                       <img src={{$admin_image}} id="" name="image" value="" class="img-fluid user-img">
                                       <label for="botonAjax" class="error" style="display: block;"></label>
                                       <span class="file_upload nw_file_uplodr">
                                            <i class="fa fa-edit"></i>
                                            <input type="file" id="botonAjax" name="uploader" class="file_type" required="">
                                       </span>
                                    </div>

                                <div class="form-group mb-2">
                                    <label>Name</label>
                                    <input class="form-control" id="name" name="name" type="text"  value="">
                                </div>
                                <div class="form-group">
                                    <label class="">Description</label>
                                    <input class="form-control" id="description_hidden_id" name="description" type="hidden">
                                    <textarea class="form-control textar" id="description_id" name="description_id" placeholder="Enter Description"></textarea>
                                    <label class="error" for="description_hidden_id"></label>
                                </div>
                                <button type="submit" id="save" class="cstm-azy-btn-red">Submit
                                </button>
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
            $('#description_hidden_id').attr('value',plainText);

        }else{
            var val = $('#description_id').val();
            $('#description_hidden_id').attr('value',val);
        }
        
        $('#termForm').submit();
    })
</script>
<script type="text/javascript">
    $('#termForm').validate({
        ignore:[],
        rules:{
            "name":{

                required:true,
                minlength:5,
            },
            "description":{
              required:true,
              maxlength:100,
            },
        },
        messages:{

            "name":{
               required:"Please enter category name",
               minlength:"Title must contain 5 characters",
            },

            "description":{
                required:"Please enter description ",
                maxlength:"Description must contain 50 characters",
            },
        },
    });
</script>
@stop