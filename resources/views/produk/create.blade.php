<script src="/js/jquery-3.7.0.min.js"></script>
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Konten modal -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH PRODUK</h5>
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

                        <label for="qr_produk" class="control-label">QR Produk</label>
                        <input type="text" class="form-control" id="qr_produk" name="qr_produk">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-qr_produk"></div>

                        <label for="qr_img" class="control-label">QR Image</label>
                        <input type="file" class="form-control" id="qr_img" name="qr_img">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-qr_img"></div>

                        <label for="img" class="control-label">Image</label>
                        <input type="file" class="form-control" id="img" name="img">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-img"></div>

                        <label for="merek_id" class="control-label">Merek</label>
                        <select class="form-control" id="merek_id" name="merek_id">
                            <option value="" selected disabled>Pilih Merek</option>
                        </select>

                        <label for="jenis_id" class="control-label">Jenis</label>
                        <select class="form-control" id="jenis_id" name="jenis_id">
                            <option value="" selected disabled>Pilih Jenis</option>
                        </select>

                        <label for="supliyer_id" class="control-label">Supplier</label>
                        <select class="form-control" id="supliyer_id" name="supliyer_id">
                            <option value="" selected disabled>Pilih Supplier</option>
                        </select>

                        <label for="stok" class="control-label">Stock</label>
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
                        <input type="number" class="form-control no-spinner" id="stok" name="stok">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-stok"></div>

                        <label for="harga_jual" class="control-label">Harga Jual</label>
                        <input type="number" class="form-control no-spinner" id="harga_jual" name="harga_jual">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_jual"></div>

                        <label for="harga_beli" class="control-label">Harga Beli</label>
                        <input type="number" class="form-control no-spinner" id="harga_beli" name="harga_beli">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-harga_beli"></div>

                        <label for="diskon" class="control-label">Diskon</label>
                        <input type="number" class="form-control no-spinner" id="diskon" name="diskon">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-diskon"></div>

                        <label for="tgl_exp" class="control-label">Tanggal Expired</label>
                        <input type="date" class="form-control" id="tgl_exp" name="tgl_exp">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tgl_exp"></div>
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
