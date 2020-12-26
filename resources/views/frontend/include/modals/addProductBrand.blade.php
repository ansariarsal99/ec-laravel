<div class="modal fade" id="addProductBrandModal">
    <form id="addProductBrandForm">
        @csrf
        <div class="modal-dialog cout_info">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Brand</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" name="brand_name" placeholder="Enter Brand Name" class="form-control" maxlength="100">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="Submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>