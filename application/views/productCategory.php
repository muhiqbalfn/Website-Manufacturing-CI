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
                        Products category
                        <small>Page</small>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12" style="margin-top: 20px;">
                            <div class="col-lg-5">
                                <!-- Form -->
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <form role="form">
                                            <!-- ID hide -->
                                            <input type="hidden" name="id_product_category" class="form-control"/>
                                            <div class="form-group">
                                                <label>Category name</label>
                                                <input type="text" name="category_name" class="form-control" placeholder="category name"/>
                                            </div>
                                            <div class="form-group">
                                                <button id="btn_simpan" class="btn-sm btn-primary">
                                                    <i class="glyphicon glyphicon-saved"></i> Simpan
                                                </button>
                                                <button id="btn_update" disabled="true" class="btn-sm btn-primary" style="background-color: #DCDCDC">
                                                    <i class="glyphicon glyphicon-edit"></i> Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- List product category -->
                                <div class="table-responsive">
                                    <table id="tabelajax" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Category name</th>
                                                <th>Aksi</th>
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

        <?php $this->load->view('modal/modalProduct'); ?>
        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 

        //GET -----------------------------------------------------------------------------------------
        var no = 0;
        var tableajax = $('#tabelajax').DataTable({
          responsive: true,
            ajax: '<?php echo base_url("ProductCategoryController/get_data") ?>',
            columns: [
                { 
                    data: null,
                    render: function(data,type,row){
                        no++;
                        return no;
                    }
                },
                { data: 'category_name' },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    var ret = '<a href="javascript:;" data="'+row.id_product_category+'" class="btn_edit"><span class="glyphicon glyphicon-edit" style="color: blue;"> </span></a>';
                        ret+= ' / ';
                        ret+= '<a href="javascript:;" data="'+row.id_product_category+'" class="btn_hapus"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>';
                    return ret;
                   }
                }
            ]
        });
        //---------------------------------------------------------------------------------------------

        //Add -----------------------------------------------------------------------------------------
        $('#btn_simpan').click(function(e){ 
            e.preventDefault(); 
            if ($('[name=category_name]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Nama category tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else{
                var data1 = $('[name=category_name]').val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('ProductCategoryController/add_data')?>",
                    dataType : "JSON",
                    data : {data1:data1},
                    success: function(data){
                        $('[name=category_name]').val("");
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
                url  : "<?php echo base_url('ProductCategoryController/get_update_data')?>",
                dataType : "JSON",
                data : {data1:data1},
                success: function(data){
                    $.each(data,function(){
                        $('[name=id_product_category]').val(data.id_product_category);
                        $('[name=category_name]').val(data.category_name);
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
            var data1 = $('[name=id_product_category]').val();
            var data2 = $('[name=category_name]').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('ProductCategoryController/update_data')?>",
                dataType : "JSON",
                data : {data1:data1, data2:data2},
                success: function(data){
                    $('[name=category_name]').val("");
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
                    url  : "<?php echo base_url('ProductCategoryController/del_data')?>",
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