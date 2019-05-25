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
                            <!-- Custom Tabs -->
                            <div class="box box-solid nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-th-list"></i></a></li>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-th-large"></i></a></li>
                                    <li class="pull-right" style="padding-right: 5px;">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#mdlBom">
                                            <i class="fa fa-plus"></i> &nbsp;Create BoM
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content col-md-12 box-body"><br>
                                    <div class="tab-pane active" id="tab_1">
                                        <!--------------------------------------------------------------------------------------->
                                        <div class="table-responsive">
                                            <table id="tabelajax" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Product name</th>
                                                        <th>Quantity</th>
                                                        <th>Reference</th>
                                                        <th>BoM Type</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="show_data">  
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--------------------------------------------------------------------------------------->
                                    </div>
                                    <div class="tab-pane" id="tab_2">
                                        <!--------------------------------------------------------------------------------------->
                                        <!-- List contact -->
                                        <?php foreach ($data as $key) {  ?>
                                        <div class="col-lg-4">
                                            <div class="box box-primary" style="box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.2);">
                                                <div class="box-body">
                                                    <h4><?php echo $key->product_name ?></h4>
                                                    <h6 style="color: #333333;"><i>Quantity : <?php echo $key->qty_bom ?> Unit(s)</i></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!--------------------------------------------------------------------------------------->
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </aside>
        </div>

        <?php $this->load->view('modal/modalBom'); ?>
        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 

        //GET -----------------------------------------------------------------------------------------
        var no = 0;
        var tableajax = $('#tabelajax').DataTable({
          responsive: true,
            ajax: '<?php echo base_url("BomController/get_data") ?>',
            columns: [
                { 
                    data: null,
                    render: function(data,type,row){
                        no++;
                        return no;
                    }
                },
                { data: 'product_name' },
                { data: 'qty_bom' },
                { data: 'reference' },
                { data: 'bom_type' },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    var ret = '<a href="javascript:;" data="'+row.id_bom+'" class="btn_edit"><span class="glyphicon glyphicon-edit" style="color: blue;"> </span></a>';
                        ret+= ' / ';
                        ret+= '<a href="javascript:;" data="'+row.id_bom+'" class="btn_hapus"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>';
                        ret+= ' / ';
                        ret+= '<a href="<?php echo base_url("BomController/get_detail/") ?>'+row.id_bom+'" class="btn_detail"><span class="glyphicon glyphicon-eye-open" style="color: green;"></span></a>';
                    return ret;
                   }
                }
            ]
        });
        //---------------------------------------------------------------------------------------------

        //Add -----------------------------------------------------------------------------------------
        $('#btn_simpan').click(function(e){ 
            e.preventDefault(); 
            if ($('[name=qty_bom]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Quantity tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else if ($('[name=reference]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Reference tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else{
                var data1 = $('[name=id_product]').val();
                var data2 = $('[name=qty_bom]').val();
                var data3 = $('[name=reference]').val();
                var data4 = $('[name=bom_type]').val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('BomController/add_data')?>",
                    dataType : "JSON",
                    data : {data1:data1,data2:data2,data3:data3,data4:data4},
                    success: function(data){
                        $('#mdlBom').modal('hide');
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

        //GET Update ----------------------------------------------------------------------------------
        $('#show_data').on('click','.btn_edit',function(){
            var data1 = $(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('BomController/get_update_data')?>",
                dataType : "JSON",
                data : {data1:data1},
                success: function(data){
                    $.each(data,function(){
                        $('#mdlBom').modal('show');
                        $('[name=id_bom]').val(data.id_bom);
                        $('[name=id_product]').val(data.id_product);
                        $('[name=qty_bom]').val(data.qty_bom);
                        $('[name=reference]').val(data.reference);
                        $('[name=bom_type]').val(data.bom_type);
                        $("#btn_simpan").attr("disabled",true).css('background-color','#DCDCDC');
                        $("#btn_update").attr("disabled",false).css('background-color','#1E90FF');
                    });
                }
            });
            return false;
        });
        //---------------------------------------------------------------------------------------------

        //Update --------------------------------------------------------------------------------------
        $('#btn_update').click(function(e){ 
            e.preventDefault();
            var data1 = $('[name=id_bom]').val();
            var data2 = $('[name=id_product]').val();
            var data3 = $('[name=qty_bom]').val();
            var data4 = $('[name=reference]').val();
            var data5 = $('[name=bom_type]').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('BomController/update_data')?>",
                dataType : "JSON",
                data : {data1:data1,data2:data2,data3:data3,data4:data4,data5:data5},
                success: function(data){
                    $('#mdlBom').modal('hide');
                    $('[name=qty_bom]').val('1.00');
                    $("#btn_simpan").attr("disabled",false).css('background-color','#1E90FF');
                    $("#btn_update").attr("disabled",true).css('background-color','#DCDCDC');
                    swal({
                        type: 'success', 
                        title: 'Changed !',
                        text: 'Data berhasil diupdate.',
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
                    url  : "<?php echo base_url('BomController/del_data')?>",
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