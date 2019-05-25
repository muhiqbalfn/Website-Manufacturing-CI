<!-- MODAL ADD -->
<div class="modal fade" id="mdlSetting" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Form user</h3>
            </div>
            <form class="form-horizontal">
                <input type="hidden" name="id_user" class="form-control">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-xs-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="081556772233">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="3" placeholder="Address..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Level</label>
                             <select class="form-control" name="level">
                                <option value="1">Administrator</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="fnfirdaus45@gmail.com">
                        </div>
                        <div class="col-xs-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-primary" id="btn_simpan">Simpan</button>
                    <button class="btn btn-primary" id="btn_update" style="background-color: #DCDCDC" disabled="true">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>