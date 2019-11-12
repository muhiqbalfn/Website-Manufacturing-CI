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
                    <a href="<?php echo base_url('MoController/done/'.$id_mo); ?>">
                        <button class="btn btn-primary"> 
                            Mark as Done
                        </button>
                    </a>
                    <div class="pull-right">
                        <button class="btn btn-default disabled">Confirmed</button>
                        <button class="btn btn-default disabled" style="background-color: #a4bfd8; color: white;">In Progress</button>
                        <button class="btn btn-default disabled">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Done &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    </div>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12" style="margin-top: 10px;">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tabelajax" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Image</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Deadline Start</th>
                                                <th>Responsible</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="show_data">  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <button class="btn btn-sm btn-default"   style="margin-bottom: 10px;">&nbsp; <b>List product component</b>
                                </button>
                                <table id="tabelajax-component" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <td width="30">No.</td>
                                            <td>Image</td>
                                            <td>ID Product</td>
                                            <td width="70">Quantity</td>
                                        </tr>
                                    </thead>
                                    <tbody id="show_data">  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 

        //GET -----------------------------------------------------------------------------------------
        var no = 0;
        var tableajax = $('#tabelajax').DataTable({
          responsive: true,
            ajax: '<?php echo base_url("MoController/get_data_produce/") ?><?php echo $id_mo; ?>',
            columns: [
                { 
                    data: null,
                    render: function(data,type,row){
                        no++;
                        return no;
                    }
                },{
                    data: null,
                    render: function (data, type, row) {
                        return '<img src="<?php echo base_url() ?>assets/img/product/'+row.foto_product+'" height="40px" width="40px">';
                    }
                },
                { data: 'product_name' },
                { data: 'qty' },
                { data: 'deadline_start' },
                { data: 'username' },
                {
                    data: null,
                    render: function (data, type, row) {
                    return '<span class="badge bg-yellow"><h7>'+row.status+'</h7></span>';
                    }
                }
            ]
        });
        //---------------------------------------------------------------------------------------------

        //GET COMPONENT -------------------------------------------------------------------------------
        var no = 0;
        var tableajax = $('#tabelajax-component').DataTable({
          responsive: true,
            ajax: '<?php echo base_url("MoController/get_data_confirmed_component/") ?><?php echo $id_mo; ?>',
            columns: [
                { 
                    data: null,
                    render: function(data,type,row){
                        no++;
                        return no;
                    }
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<img src="<?php echo base_url() ?>assets/img/product/'+row.foto_product+'" height="40px" width="40px">';
                    }
                },
                { data: 'product_name' },
                { data: 'qty_detail' }
            ]
        });
        //---------------------------------------------------------------------------------------------

    });
</script>