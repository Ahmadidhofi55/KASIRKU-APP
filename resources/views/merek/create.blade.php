<script src="/js/jquery-3.7.0.min.js"></script>
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Konten modal -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH MEREK PRODUK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data"  id="create-form">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                        <label for="img" class="control-label">Image</label>
                        <input type="file" class="form-control" id="img" name="img">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-img"></div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
