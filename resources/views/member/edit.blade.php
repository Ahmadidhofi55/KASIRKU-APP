<!-- Modal -->
<div class="modal fade" id="modal-edit2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT MEMBER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="member_id2">
                <div class="form-group">
                    <label for="name-edit" class="control-label">Name</label>
                    <input type="text" class="form-control" name="name-edit2" id="name-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="no_hp-edit" class="control-label">No. Hp</label>
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
                    <input type="number" class="form-control no-spinner" name="no_hp-edit2" id="no_hp-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-no_hp-edit2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="update2">UPDATE</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
