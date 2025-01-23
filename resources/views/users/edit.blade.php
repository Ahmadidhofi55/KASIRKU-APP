<!-- Modal -->
<div class="modal fade" id="modal-edit2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT USERS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_id2">
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text"  class="form-control" name="name-edit2" id="name-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" name="email-edit2" id="email-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="img" class="control-label">Img</label>
                    <br>
                    <input type="file" class="form-control" name="img-edit2" id="img-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-img-edit2"></div>
                </div>
                <div class="form-group">
                    <label for="Password" class="control-label">Password</label>
                    <input type="password" class="form-control" id="password-edit2" name="password-edit2">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password-edit2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="update2">UPDATE</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
