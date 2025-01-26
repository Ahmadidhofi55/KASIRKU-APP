<script src="/js/jquery-3.7.0.min.js"></script>
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Konten modal -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH SUPLIYER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="create-form">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                    </div>
                    <div class="form-group">
                        <label for="no_hp" class="control-label">No. Hp</label>
                        <style>
                            /* Menghilangkan spinner di Chrome, Edge, dan Safari */
                            .no-spinner::-webkit-inner-spin-button,
                            .no-spinner::-webkit-outer-spin-button {
                                -webkit-appearance: none;
                                margin: 0;
                            }

                            /* Menghilangkan spinner di Firefox */
                            .no-spinner[type="number"] {
                                -moz-appearance: textfield;
                            }
                        </style>
                        <input type="number" class="form-control no-spinner" id="no_hp" name="no_hp">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
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
