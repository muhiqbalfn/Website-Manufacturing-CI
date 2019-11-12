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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#mdlCheckstok"> Check availability</button>
                    <div class="pull-right">
                        <button class="btn btn-default disabled" style="background-color: #a4bfd8; color: white;">Confirmed</button>
                        <button class="btn btn-default disabled">In Progress</button>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="show_data">  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#mdlDetail" style="margin-bottom: 10px;">&nbsp; <b>List product component</b>
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

        <?php $this->load->view('modal/modalCheckstok'); ?>
        <?php $this->load->view('modal/modalConfirmed'); ?>
        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 

        //GET -----------------------------------------------------------------------------------------
        var no = 0;
        var tableajax = $('#tabelajax').DataTable({
          responsive: true,
            ajax: '<?php echo base_url("MoController/get_data_confirmed/") ?><?php echo $id_mo; ?>',
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
                { data: 'qty' },
                { data: 'deadline_start' },
                { data: 'username' },
                {
                    data: null,
                    render: function (data, type, row) {
                    return '<span class="badge"><h7>'+row.status+'</h7></span>';
                    }
                },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    var ret = '<a href="javascript:;" data="'+row.id_manufacturing+'" class="btn_edit"><span class="glyphicon glyphicon-edit" style="color: blue;"> </span></a>';
                        ret+= ' / ';
                        ret+= '<a href="javascript:;" data="'+row.id_manufacturing+'" class="btn_hapus"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>';
                    return ret;
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

       //GET Update ----------------------------------------------------------------------------------
        $('#show_data').on('click','.btn_edit',function(){
            var data1 = $(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('MoController/get_update_data')?>",
                dataType : "JSON",
                data : {data1:data1},
                success: function(data){
                    $.each(data,function(){
                        $('#mdlConfirmed').modal('show');
                        $('[name=qty_ku]').val(data.qty);
                        $('[name=deadline_start_ku]').val(data.deadline_start);
                    });
                }
            });
            return false;
        });
        //---------------------------------------------------------------------------------------------

        //Update --------------------------------------------------------------------------------------
        $('#btn_update').click(function(e){ 
            e.preventDefault();
            var data1 = $('[name=id_manufacturing]').val();
            var data2 = $('[name=qty_ku]').val();
            var data3 = $('[name=deadline_start_ku]').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('MoController/update_data')?>",
                dataType : "JSON",
                data : {data1:data1,data2:data2,data3:data3},
                success: function(data){
                    $('#mdlConfirmed').modal('hide'); 
                    swal({
                        type: 'success', 
                        title: 'Changed !',
                        text: 'Data berhasil diupdate.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    //triger
                    location.reload();
                },
                error:function(){
                    swal({
                        type: 'error', 
                        title: 'Oopss.. !',
                        text: 'Data gagal dirubah.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
            return false;
        });
        //---------------------------------------------------------------------------------------------


        //Delete --------------------------------------------------------------------------------------
        $('#show_data').on('click','.btn_hapus',function(){
            var data1 = $(this).attr('data');
            swal({
                title: "Anda yakin ?",
                text: "File akan dihapus dan tidak bisa dikembalikan.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, hapus !",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('MoController/del_data_confirmed')?>",
                    dataType : "JSON",
                    data : {data1:data1},
                    success: function(data){
                        swal({
                            type: 'success', 
                            title: 'Deleted !',
                            text: 'Data berhasil dihapus.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        window.location.href="<?php echo base_url('MoController'); ?>";
                    },
                    error:function(){
                        swal({
                            type: 'error', 
                            title: 'Oopss.. !',
                            text: 'Data gagal dihapus.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
            return false;
        });
        //---------------------------------------------------------------------------------------------

    });
</script>