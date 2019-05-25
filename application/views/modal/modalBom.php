<!-- MODAL ADD -->
<div class="modal fade" id="mdlBom" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Form BoM</h3>
            </div>
            <form class="form-horizontal">
                <input type="hidden" name="id_bom" class="form-control">
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
                            <label>Quantity</label>
                            <input type="text" name="qty_bom" class="form-control" value="1.00">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Reference</label>
                            <input type="text" name="reference" class="form-control" value="-">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>BoM Type</label>
                            <select class="form-control" name="bom_type">
                                <option value="Manufacture this product">Manufacture this product</option>
                                <option value="Kit">Kit</option>
                            </select>
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