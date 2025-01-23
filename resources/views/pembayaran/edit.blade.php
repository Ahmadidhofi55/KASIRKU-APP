<!-- Modal -->
<div class="modal fade" id="modal-edit2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT PEMBAYARAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="pembayaran_id2">
                <div class="form-group">
                    <label for="name-edit" class="control-label">Name</label>
                    <input type="text" class="form-control" name="name-edit2" id="name-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="data_pembayaran-edit" class="control-label">Data Pembayaran</label>
                    <input type="text" class="form-control" name="data_pembayaran-edit2" id="data_pembayaran-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-data_pembayaran-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="img-edit2" class="control-label">Image</label>
                    <br>
                    <img id="img-preview" src="" alt="Preview" style="max-width: 100px; margin-bottom: 10px;">
                    <input type="file" class="form-control" name="img-edit2" id="img-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-img-edit2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="update2">UPDATE</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
