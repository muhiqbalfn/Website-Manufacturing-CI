<!-- MODAL ADD -->
<div class="modal fade" id="mdlConfirmed" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Form Manufacturing</h3>
            </div>
            <form class="form-horizontal">
                <input type="text" name="id_manufacturing" class="form-control">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Qty to produce</label>
                            <input type="number" name="qty_ku" class="form-control">
                        </div>
                         <div class="col-xs-6">
                            <label>Deadline start</label>
                            <input type="date" name="deadline_start_ku" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-primary" id="btn_update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>