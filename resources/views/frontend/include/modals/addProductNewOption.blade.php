<div class="modal fade add_product_nw_option" id="addProductNewOptionModal">
    <form id="addProductNewOptionForm">
        @csrf
        <div class="modal-dialog cout_info">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Option</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="Enter title" class="form-control" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label>Value</label>
                            <input type="text" name="value" placeholder="Enter value" class="form-control" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label>Option Type</label>
                            <!-- <input type="text" name="value" placeholder="Enter value" class="form-control" maxlength="100"> -->
                            <select class="form-control" name="option_type">
                                <option selected disabled>Select Option Type</option>
                                <option value="with_unit">With Unit</option>
                                <option value="without_unit">Without Unit</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" class="new_option_length_cls" name="option_length" value="" />
                </div>
                <div class="modal-footer">
                    <button type="Submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>