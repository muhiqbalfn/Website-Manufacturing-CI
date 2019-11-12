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
                        Products
                        <small>Page</small>
                        <button id="tombol" type="button" onclick="Swal('Hello world !','Latihan Sweet !!!','success')">Klik saya</button>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Custom Tabs -->
                            <div class="box box-solid nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-th-large"></i></a></li>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-th-list"></i></a></li>
                                    <li class="pull-right">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#mdlProduct">
                                            <i class="fa fa-plus"></i> &nbsp;Create product
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content col-md-12 box-body"><br>
                                    <div class="tab-pane active" id="tab_1">
                                        <!------------------------------------------------------------------------------------------>
                                        <!-- List product -->
                                        <?php foreach ($data as $key) {  ?>
                                        <div class="col-lg-4">
                                            <div class="box" style="box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.2);">
                                                <div class="box-body">
                                                    <img style="float: left; margin-right: 10px;" src="<?php echo base_url() ?>assets/img/product/<?php echo $key->foto_product ?>" height="70px" width="70px">
                                                    <h5><?php echo $key->product_name ?></h5>
                                                    <h6 style="color: #a9a9a9;"><i>On Hand : <?php echo $key->stok ?> Unit(s)</i></h6>
                                                    <i><b>Price : Rp <?php echo $key->sales_price ?></b></i>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!------------------------------------------------------------------------------------------>
                                    </div>
                                    <div class="tab-pane" id="tab_2">
                                        <!------------------------------------------------------------------------------------------>
                                        <div class="table-responsive">
                                            <table width="100%" id="tabelajax" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Product name</th>
                                                        <th>Category</th>
                                                        <th>Type</th>
                                                        <th>Stok</th>
                                                        <th>Sales price</th>
                                                        <th>Name tax</th>
                                                        <th>Amount tax</th>
                                                        <th>Gambar</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="show_data">  
                                                </tbody>
                                            </table>
                                        </div>
                                        <!------------------------------------------------------------------------------------------>
                                    </div>   
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
            ajax: '<?php echo base_url("ProductController/get_data") ?>',
            columns: [
                { 
                    data: null,
                    render: function(data,type,row){
                        no++;
                        return no;
                    }
                },
                { data: 'product_name' },
                { data: 'category_name' },
                { data: 'type' },
                { data: 'stok' },
                { data: 'sales_price' },
                { data: 'tax_name' },
                { data: 'amount' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<img src="<?php echo base_url() ?>assets/img/product/'+row.foto_product+'" height="40px" width="40px">';
                    }
                },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    var ret = '<a href="javascript:;" data="'+row.id_product+'" class="btn_edit"><span class="glyphicon glyphicon-edit" style="color: blue;"> </span></a>';
                        ret+= ' / ';
                        ret+= '<a href="javascript:;" data="'+row.id_product+'" class="btn_hapus"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>';
                    return ret;
                   }
                }
            ]
        });
        //---------------------------------------------------------------------------------------------

        //Add -----------------------------------------------------------------------------------------
        $('#submit').submit(function(e){ 
            e.preventDefault(); 
            if ($('[name=product_name]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Nama produk tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }if ($('[name=sales_price]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Harga tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }if ($('[name=stok]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Stok tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else{
                $.ajax({
                    url:'<?php echo base_url('ProductController/add_data')?>',
                    type:"POST",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data){
                        $('#mdlProduct').modal('hide');
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
                url  : "<?php echo base_url('ProductController/get_update_data')?>",
                dataType : "JSON",
                data : {data1:data1},
                success: function(data){
                    $.each(data,function(){
                        $('#mdlProduct').modal('show');
                        $('[name=id_product]').val(data.id_product  );
                        $('[name=id_product_category]').val(data.id_product_category);
                        $('[name=product_name]').val(data.product_name);
                        $('[name=type]').val(data.type);
                        $('[name=internal_reference]').val(data.internal_reference);
                        $('[name=barcode]').val(data.barcode);
                        $('[name=sales_price]').val(data.sales_price);
                        $('[name=id_tax]').val(data.id_tax);
                        $('[name=cost]').val(data.cost);
                        $('[name=stok]').val(data.stok);
                        $('[name=internal_notes]').val(data.internal_notes);
                        $('[name=foto_product]').val(data.foto_product);
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
            var data1 = $('[name=id_product]').val();
            var data2 = $('[name=id_product_category]').val();
            var data3 = $('[name=product_name]').val();
            var data4 = $('[name=type]').val();
            var data5 = $('[name=internal_reference]').val();
            var data6 = $('[name=barcode]').val();
            var data7 = $('[name=sales_price]').val();
            var data8 = $('[name=id_tax]').val();
            var data9 = $('[name=cost]').val();
            var data10 = $('[name=stok]').val();
            var data11 = $('[name=internal_notes]').val();
            var data12 = $('[name=foto_product]').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('ProductController/update_data')?>",
                dataType : "JSON",
                data : {data1:data1,data2:data2,data3:data3,data4:data4,data5:data5,data6:data6,data7:data7,data8:data8,data9:data9,data10:data10,data11:data11,data12:data12},
                success: function(data){
                    $('#mdlProduct').modal('hide');
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
            var id = $(this).attr('data');
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
                    url  : "<?php echo base_url('ProductController/del_data')?>",
                    dataType : "JSON",
                    data : {id:id},
                    success: function(data){
                        //alert
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