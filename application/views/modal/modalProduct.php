<!-- FORM PRODUCT -->
<div class="modal fade" id="mdlProduct" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Form Product</h3>
            </div>
            <form role="form" class="form-horizontal" id="submit">
                <input type="hidden" name="id_product">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="file" name="foto_productku">
                            <input type="hidden" name="foto_product">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="product_name" class="form-control" placeholder="Product name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Product type</label>
                            <select class="form-control" name="type">
                                <option value="Consumable">Consumable</option>
                                <option value="Service">Service</option>
                                <option value="Storable product">Storable product</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label>Product category</label>
                            <select class="form-control" name="id_product_category">
                                <?php
                                    foreach($ctg as $key){
                                        echo "<option value='".$key->id_product_category."'>".$key->category_name."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" name="internal_reference" class="form-control" placeholder="Internal reference">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="text" name="barcode" class="form-control" placeholder="Barcode">
                        </div>
                        <div class="col-xs-6">
                            <input type="number" name="stok" class="form-control" placeholder="Stok">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <input type="text" name="sales_price" class="form-control" placeholder="Sales price">
                            <input type="hidden" name="id_tax" class="form-control" value="1">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" name="cost" class="form-control" placeholder="Cost">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Internat notes</label>
                            <textarea class="form-control" name="internal_notes" rows="3" placeholder="This note is only for internal purpose."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-primary" id="btn_simpan" type="submit">Simpan</button>
                    <button class="btn btn-primary" id="btn_update" style="background-color: #DCDCDC"   >Update</button>
                </div>
            </form>
        </div>
    </div>
</div>