<!DOCTYPE html>
<html>
    <!-- Head -->
    <?php $this->load->view('sub/head'); ?>

    <body class="skin-blue">
        <!-- Header -->
        <?php $this->load->view('sub/header'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left-menu -->
            <?php $this->load->view('sub/left-menu'); ?>

            <!-- Tittle -->
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Manufacturing Orders
                        <small>Page</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form -->
                            <div class="box box-primary">
                                <div class="box-body">
                                    <h4 class="header-title">Manufacturing <?php echo $manufacturing[0]->product_name; ?></h4>
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
                                                <div class="form-group">
                                                    <label for="quantity" class="col-form-label">Quantity</label>
                                                        <input type="number" class="form-control" name="qty" id="quantity" value="<?php echo $manufacturing[0]->qty; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_bom" class="col-form-label">Bill Of Material</label>
                                                    <input type="text" class="form-control" name="bom" id="bom" value="<?php echo $manufacturing[0]->product_name; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="deadline_start" class="col-form-label">Deadline Start</label>
                                                    <input class="form-control" type="date" name="deadline_start" id="deadline_start" value="<?php echo $manufacturing[0]->deadline_start; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_user" class="col-form-label">Responsible</label>
                                                    <input type="text" class="form-control" name="responsible" id="responsible" value="<?php echo $manufacturing[0]->username; ?>" readonly><br><br>
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
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Component of <?php echo $manufacturing[0]->product_name; ?></h4>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-dark text-center">
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
                                                        <td><?php if($consumed <= $value->stok) { echo "Tersedia"; } else { echo "Tidak Tersedia"; } ?></td>
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

            </aside>
        </div>

        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>