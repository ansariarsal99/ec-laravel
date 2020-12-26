@extends('admin.layout.adminLayout')
@section('title','Return & Exchange Policy')
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
                                    <h1>Content Management</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#">Content Management</a></li>
                                        <li class="active">Return & Exchange Policy</li>
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
            <form method="post" id="termForm" action="{{url('admin/contentManagement/ReturnAndExchangePolicy')}}">
              @csrf
                <div class="card">
                    <div class="card-header">
                       <strong class="card-title">Return & Exchange Policy</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-md-2">
                            <div class="terms_page my-4">
                                <form>
                                    <label>Title</label>
                                    <input class="form-control mb-2" id="title" name="title" type="text"  value="{{@$returnAndExchangePolicy->title}}"><br>
                                
                                    <label class="">Description</label>
                                    <input class="form-control" id="description_hidden_id" name="description" type="hidden">
                                    <textarea class="form-control textar" id="description_id" name="description_id">{{@$returnAndExchangePolicy->description}}</textarea>
                                    <label class="error" for="description_hidden_id"></label>
                               
                                    <button type="submit" id="save" class="cstm-azy-btn-red">Submit
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
            "title":{

                required:true,
                maxlength:200,
                minlength:5,
            },
            "description":{

              required:true,
              minlength:20,
            },
        },
        messages:{

            "title":{

               required:"Please enter title",
               maxlength:"Maximum 200 characters are allowed",
               minlength:"Title must contain 5 characters",
            },

            "description":{

            required:"Please enter description ",
            minlength:"Description must contain 20 characters",
            },
        },
    });
</script>
@stop