<!-- MODAL ADD -->
<div class="modal fade" id="mdlCheckstok" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Check stok component</h3>
            </div>
            <!-- ------------------------------------------------------------------------------ -->
             <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Form -->
                        <div class="box box-primary">
                            <div class="box-body">
                                    <form action="<?php echo base_url('MoController/produce'); ?>" method="POST">
                                    <input type="hidden" name="id_manufacturing" value="<?php echo $manufacturing[0]->id_manufacturing; ?>">
                                    <input type="hidden" name="id_bom" value="<?php echo $manufacturing[0]->id_bom; ?>">
                                    <input type="hidden" name="id_product" value="<?php echo $manufacturing[0]->id_product; ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="id_product" class="col-form-label">Product</label>
                                                <input type="text" class="form-control" name="product" id="product" value="<?php echo $manufacturing[0]->product_name; ?>" readonly>
                                            </div>
                                            <td rowspan="5">
                                                <img style="float: left; margin-right: 10px;" src="<?php echo base_url() ?>assets/img/product/<?php echo $manufacturing[0]->foto_product; ?>" height="150px" width="150px">
                                            </td>
                                            <div class="form-group">
                                                    <input type="hidden" class="form-control" name="qty" id="quantity" value="<?php echo $manufacturing[0]->qty; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="bom" id="bom" value="<?php echo $manufacturing[0]->product_name; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control" type="hidden" name="deadline_start" id="deadline_start" value="<?php echo $manufacturing[0]->deadline_start; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="responsible" id="responsible" value="<?php echo $manufacturing[0]->username; ?>" readonly><br><br>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4">
                                                        <a href="<?php echo base_url('MoController'); ?>" class="btn btn-danger btn-block">Kembali</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button class="btn btn-primary btn-block" type="submit"
                                                        <?php foreach ($detail_bom as $key => $value) : ?>
                                                        <?php $qty = $manufacturing[0]->qty; 
                                                              $bom = $value->qty_detail; 
                                                              $consumed = $qty*$bom; 
                                                        ?>
                                                        <?php if($consumed <= $value->stok) { 
                                                              }
                                                              else { 
                                                                echo "disabled"; 
                                                              } 
                                                        ?>
                                                        <?php endforeach; ?>
                                                        >Produce</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="box box-primary">
                            <div class="box-body">
                                <h4 class="header-title">Component of <?php echo $manufacturing[0]->product_name; ?></h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">Product</th>
                                                    <th scope="col">To Consume</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($detail_bom as $key => $value) : ?>
                                                <?php $qty = $manufacturing[0]->qty; 
                                                      $bom = $value->qty_detail; 
                                                      $consumed = $qty*$bom; 
                                                ?>
                                                <tr class="<?php    if($consumed <= $value->stok) { 
                                                                        echo "table-success"; 
                                                                    } else { 
                                                                        echo "table-danger"; 
                                                                    } 
                                                            ?>">
                                                    <th scope="row"><?php echo $value->product_name; ?></th>
                                                    <td><?php echo $consumed; ?></td>
                                                    <td><?php echo $value->stok; ?></td>
                                                    <td style="color: <?php if($consumed <= $value->stok) { echo "blue"; } else { echo "red"; } ?>">
                                                    	<?php if($consumed <= $value->stok) { echo "Tersedia"; } else { echo "Tidak Tersedia"; } ?>
                                                    		
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ------------------------------------------------------------------------------ -->
        </div>
    </div>
</div>