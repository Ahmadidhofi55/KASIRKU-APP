<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SHOW MEREK PRODUK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_id">
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" readonly class="form-control" id="name-edit">
                </div>
                <div class="form-group">
                    <label for="img" class="control-label">Image</label>
                    <br>
                    <img src="" id="img-edit" width="100px" alt="img">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
