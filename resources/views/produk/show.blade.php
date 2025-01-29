<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SHOW PRODUK </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_id">
                <div class="form-group">
                    <label for="name-edit" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name-edit" name="name-edit" readonly>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>
                </div>
                <div class="form-group">
                    <label for="qr_produk-edit" class="control-label">QR Produk</label>
                    <input type="text" class="form-control" id="qr_produk-edit" name="qr_produk-edit" readonly>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-qr_produk-edit"></div>
                </div>
                <div class="form-group">
                    <label for="qr_img-edit" class="control-label">QR Image</label>
                    <br>
                    <img src="" id="qr_img-edit" width="100px" alt="qr_img">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-qr_img-edit"></div>
                </div>
                <div class="form-group">
                    <label for="img-edit" class="control-label">Image</label>
                    <br>
                    <img src="" id="img-edit" width="100px" alt="img">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-img-edit"></div>
                </div>
                <div class="form-group">
                    <label for="merek_id-edit" class="control-label">Merek</label>
                    <select class="form-control" id="merek_id-edit" name="merek_id-edit" readonly>
                        <option value="" selected disabled>Loadaing ...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_id-edit" class="control-label">Jenis</label>
                    <select class="form-control" id="jenis_id-edit" name="jenis_id-edit" readonly>
                        <option value="" selected disabled>Loading ...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="supliyer_id-edit" class="control-label">Supplier</label>
                    <select class="form-control" id="supliyer_id-edit" name="supliyer_id-edit" readonly>
                        <option value="" selected disabled>Pilih Supplier</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="stok-edit" class="control-label">Stock</label>
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
                    <input type="number" class="form-control no-spinner" id="stok-edit" name="stok-edit" readonly>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stok-edit"></div>
                </div>
                <div class="form-group">
                    <label for="harga_jual-edit" class="control-label">Harga Jual</label>
                    <input type="number" class="form-control no-spinner" id="harga_jual-edit" name="harga_jual-edit" readonly>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_jual-edit"></div>
                </div>
                <div class="form-group">
                    <label for="harga_beli-edit" class="control-label">Harga Beli</label>
                    <input type="number" class="form-control no-spinner" id="harga_beli-edit" name="harga_beli-edit" readonly>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_beli-edit"></div>
                </div>
                <div class="form-group">
                    <label for="diskon-edit" class="control-label">Diskon</label>
                    <input type="number" class="form-control no-spinner" id="diskon-edit" name="diskon-edit" readonly>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-diskon-edit"></div>
                </div>
                <div class="form-group">
                    <label for="tgl_exp-edit" class="control-label">Tanggal Expired</label>
                    <input type="date" class="form-control" id="tgl_exp-edit" name="tgl_exp-edit" readonly>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_exp-edit"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
