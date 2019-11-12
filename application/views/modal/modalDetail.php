<!-- MODAL ADD -->
<div class="modal fade" id="mdlDetail" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Add Component</h3>
            </div>
            <form class="form-horizontal">
                <input type="hidden" name="id_bom" class="form-control" value="<?php echo $kode; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Product component</label>
                            <select class="form-control" name="id_product">
                                <?php
                                    foreach($product as $key){
                                        echo "<option value='".$key->id_product."'>".$key->product_name."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label>Quantity</label>
                            <input type="number" name="qty_detail" class="form-control" value="1.00">
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