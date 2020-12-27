<?php  
    $admin_image = defaultAdminImagePath.'/no_image.png';  
    // dd($admin_image);                                               
?>
<!-- ///////////Specification model start/////// -->
<div class="modal" id="specification">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Info Section</h4>
                <button type="button" class="close specification-close" data-dismiss="modal">&times;</button>
            </div>
              <!-- Modal body -->
            <div class="modal-body">
                <div class="add_form">
                    <form id="specification_form">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="" class="form-control title-class">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control description-class" name="description"></textarea>
                        </div>
                        <div class="form-group imge_uploader">
                            <label>Attachment</label>
                            <div class="profle_pic text-center">
                                <div class="img_prof text-center">
                                    <img src="{{@$admin_image}}" id="img-fluid" name="invoice_image" value="" class="img-fluid user-img">
                                    <span class="specific_upload">
                                        <i class="fa fa-pencil"></i>
                                        <input type="file" id="botonAjax" name="image" value="" class="file_img">
                                    </span>
                                </div>
                                <label id="botonAjax-error" class="error mt-3" for="botonAjax"></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn_theme add-list-btn"><span>Add to List</span></button>
            </div>
        </div>
    </div>
</div>      
<!-- ////////////////specification end////////////// -->