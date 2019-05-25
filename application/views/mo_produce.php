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
                    <a href="<?php echo base_url('MoController/check_stok/'.$id_mo); ?>">
                        <button class="btn btn-primary" style="margin-bottom: 10px;"> 
                            <b>Mark as Done</b>
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
                            <div class="table-responsive">
                                <table id="tabelajax" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>BoM</th>
                                            <th>Deadline Start</th>
                                            <th>Responsible</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                },
                { data: 'product_name' },
                { data: 'qty' },
                { data: 'id_bom' },
                { data: 'deadline_start' },
                { data: 'username' },
                {
                    data: null,
                    render: function (data, type, row) {
                    return '<span class="badge bg-yellow"><h7>'+row.status+'</h7></span>';
                    }
                },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    var ret = '<a href="<?php echo base_url()?>MoController/done/'+row.id_manufacturing+'" class="btn_edit"><span style="color: blue;"> </span>Mark as Done</a>';
                    return ret;
                   }
                }
            ]
        });
        //---------------------------------------------------------------------------------------------

    });
</script>