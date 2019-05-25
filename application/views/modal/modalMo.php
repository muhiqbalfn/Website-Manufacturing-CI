<!-- MODAL ADD -->
<div class="modal fade" id="mdlMo" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Form Manufacturing</h3>
            </div>
            <form class="form-horizontal">
                <input type="hidden" name="id_manufacturing" class="form-control">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Product package</label>
                            <select class="form-control" name="id_product">
                                <?php
                                    foreach($product as $key){
                                        echo "<option value='".$key->id_product."'>".$key->product_name."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label>Qty to produce</label>
                            <input type="number" name="qty" class="form-control" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Bill of Material</label>
                            <select class="form-control" name="id_bom">
                                <?php
                                    foreach($bom as $key){
                                        echo "<option value='".$key->id_bom."'>".$key->product_name."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label>Responsible</label>
                            <select class="form-control" name="id_user">
                                <?php
                                    foreach($user as $key){
                                        echo "<option value='".$key->id_user."'>".$key->username."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Deadline start</label>
                            <input type="date" name="deadline_start" class="form-control">
                        </div>
                        <div class="col-xs-6">
                            <label>Source</label>
                            <input type="text" name="source" class="form-control" value="-">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-primary" id="btn_simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>