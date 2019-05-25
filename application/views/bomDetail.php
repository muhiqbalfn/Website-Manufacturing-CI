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
                        Bills of Materials
                        <small>Page</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-8">
                                <div class="table-responsive">
                                    <?php foreach ($datas as $key) {  ?>
                                    
                                    <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td rowspan="5">
                                                <img style="float: left; margin-right: 10px;" src="<?php echo base_url() ?>assets/img/product/<?php echo $key->foto_product ?>" height="150px" width="150px">
                                            </td>
                                        </tr>
                                        <tr><td><b>Product : </b><?php echo $key->product_name ?></td></tr>
                                        <tr><td><b>Quantity : </b><?php echo $key->qty_bom ?>.00</td></tr>
                                        <tr><td><b>Reference : </b><?php echo $key->reference ?></td></tr>
                                        <tr><td><b>BoM Type : </b><?php echo $key->bom_type ?></td></tr>
                                    </table>
                                    <?php } ?>
                                    <div>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mdlDetail" style="margin-bottom: 10px;">
                                            <i class="fa fa-plus"></i> &nbsp; Component
                                        </button>
                                    </div>
                                    <table id="tabelajax" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <td width="30">No.</td>
                                                <td>Image</td>
                                                <td>ID Product</td>
                                                <td>Quantity</td>
                                                <td width="40">Aksi</td>
                                            </tr>
                                        </thead>
                                        <tbody id="show_data">  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </aside>
        </div>

        <?php $this->load->view('modal/modalDetail'); ?>
        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 

        //GET -----------------------------------------------------------------------------------------
        var no = 0;
        var tableajax = $('#tabelajax').DataTable({
          responsive: true,
            ajax: '<?php echo base_url("BomController/get_detail_product/") ?><?php echo $kode; ?>',
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
                { data: 'qty_detail' },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    var ret = '<a href="javascript:;" data="'+row.id_detail_bom+'" class="btn_hapus"><span class="glyphicon glyphicon-trash" style="color: red;"> </span></a>';
                    return ret;
                   }
                }
            ]
        });
        //---------------------------------------------------------------------------------------------

        //Add -----------------------------------------------------------------------------------------
        $('#btn_simpan').click(function(e){ 
            e.preventDefault(); 
            if ($('[name=qty]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Quantity tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else{
                var data1 = $('[name=id_bom]').val();
                var data2 = $('[name=id_product]').val();
                var data3 = $('[name=qty_detail]').val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('BomController/add_detail_product')?>",
                    dataType : "JSON",
                    data : {data1:data1,data2:data2,data3:data3},
                    success: function(data){
                        $('#mdlDetail').modal('hide');
                        swal({
                            type: 'success',
                            title: 'Saved !',
                            text: 'Data berhasil disimpan.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        //triger
                        no=0;
                        tableajax.ajax.reload();
                    },
                    error:function(){
                        swal({
                            type: 'error', 
                            title: 'Oopss.. !',
                            text: 'Data gagal disimpan.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
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
                    url  : "<?php echo base_url('BomController/del_detail_product')?>",
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
                        //triger
                        no=0;
                        tableajax.ajax.reload();
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