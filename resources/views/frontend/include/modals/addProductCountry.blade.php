<div class="modal fade" id="addProductCountryModal">
    <form id="addProductCountryForm">
        @csrf
        <div class="modal-dialog cout_info">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Country</h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                 <!-- Modal body -->
                <div class="modal-body">
                    <div class="country_div">
                        <div class="form-group">
                            <label>Country Name</label>
                            <input type="text" name="name" placeholder="Enter Country Name" class="form-control" maxlength="100">
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