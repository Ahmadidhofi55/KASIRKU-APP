<!-- Modal -->
<div class="modal fade" id="modal-edit2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT PRODUK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="produk_id2">
                <div class="form-group">
                    <label for="name-edit" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name-edit2" name="name-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="qr_produk-edit2" class="control-label">QR Produk</label>
                    <input type="text" class="form-control" id="qr_produk-edit2" name="qr_produk-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-qr_produk-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="qr_img-edit2" class="control-label">QR Image</label>
                    <br>
                    <img id="qr-img-preview" src="" alt="Preview" style="max-width: 100px; margin-bottom: 10px;">
                    <input type="file" class="form-control" name="qr_img-edit2" id="qr_img-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-qr_img-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="img-edit2" class="control-label">Image</label>
                    <br>
                    <img id="img-preview" src="" alt="Preview" style="max-width: 100px; margin-bottom: 10px;">
                    <input type="file" class="form-control" name="img-edit2" id="img-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-img-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="merek_id-edit2" class="control-label">Merek</label>
                    <select class="form-control" id="merek_id-edit2" name="merek_id-edit2" >
                        <option value="" selected disabled>Pilih Merek</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_id-edit2" class="control-label">Jenis</label>
                    <select class="form-control" id="jenis_id-edit2" name="jenis_id-edit2">
                        <option value="" selected disabled>Pilih Jenis</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="supliyer_id-edit2" class="control-label">Supplier</label>
                    <select class="form-control" id="supliyer_id-edit2" name="supliyer_id-edit2">
                        <option value="" selected disabled>Pilih Supplier</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="stok-edit2" class="control-label">Stock</label>
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
                    <input type="number" class="form-control no-spinner" id="stok-edit2" name="stok-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stok-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="harga_jual-edit2" class="control-label">Harga Jual</label>
                    <input type="number" class="form-control no-spinner" id="harga_jual-edit2" name="harga_jual-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_jual-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="harga_beli-edit2" class="control-label">Harga Beli</label>
                    <input type="number" class="form-control no-spinner" id="harga_beli-edit2"
                        name="harga_beli-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_beli-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="diskon-edit2" class="control-label">Diskon</label>
                    <input type="number" class="form-control no-spinner" id="diskon-edit2" name="diskon-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-diskon-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="tgl_exp-edit2" class="control-label">Tanggal Expired</label>
                    <input type="date" class="form-control" id="tgl_exp-edit2" name="tgl_exp-edit2" >
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_exp-edit2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="update2">UPDATE</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
