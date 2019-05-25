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
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Form -->
                            <div class="box box-primary">
                                <div class="box-body">
                                    <form role="form" id="submit">

                                        <!-- ID hide -->
                                        <input type="hidden" name="id_hp" class="form-control"/>

                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" name="merk" class="form-control" placeholder="Nokia"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipe</label>
                                            <input type="text" name="tipe" class="form-control" placeholder="Lumia 3 pro"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" name="warna" class="form-control" placeholder="Putih"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Kondisi</label><br>
                                            <input type="radio" name="kondisi" class="flat-red" value="Baru" checked/> Baru 
                                            &nbsp;&nbsp;
                                            <input type="radio" name="kondisi" class="flat-red" value="Bekas" /> Bekas
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="text" name="harga" class="form-control" placeholder="3.200.000"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Gambar</label>
                                            <input type="file" name="gambar" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <button id="btn_simpan" type="submit" class="btn-sm btn-success">
                                                <i class="glyphicon glyphicon-saved"></i> Simpan
                                            </button>
                                            <button id="btn_update" class="btn-sm btn-primary" style="background-color: #DCDCDC">
                                                <i class="glyphicon glyphicon-edit"></i> Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table width="100%" id="tabelpetugas" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Merk</td>
                                            <td>Tipe</td>
                                            <td>Warna</td>
                                            <td>Kondisi</td>
                                            <td>Harga</td>
                                            <td>Gambar</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody id="show_data">  
                                    </tbody>
                                </table>
                            </div>
                            <?php foreach ($data as $key) {  ?>
                            <div class="col-lg-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <td colspan="2"><img  src="<?php echo base_url('assets/img/hp/nokia.jpg') ?>"></td>
                                    </tr>
                                    <tr><td><?php echo $key->merk ?></td><td><?php echo $key->tipe ?></td></tr>
                                    <tr><td>Warna : <?php echo $key->warna ?></td><td>Rp. <?php echo $key->harga ?></td></tr>
                                    <tr align="center">
                                        <td><a href=""><i class="glyphicon glyphicon-edit" style="color: blue;"></i></a> / 
                                             <a href=""><i class="glyphicon glyphicon-trash" style="color: red;"></i></a>
                                        </td>
                                        <td>
                                            <span class="glyphicon glyphicon-star" style="color: orange;"></span>
                                            <span class="glyphicon glyphicon-star-empty" style="color: orange;"></span>
                                            <span class="glyphicon glyphicon-star-empty" style="color: orange;"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>

            </aside>
        </div>

        <style type="text/css">
            .table{ width: 200px; }
        }
        </style>

        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 

        //GET -----------------------------------------------------------------------------------------
        var no = 0;
        var tableajax = $('#tabelpetugas').DataTable({
          responsive: true,
            ajax: '<?php echo base_url("HomeController/get_hp") ?>',
            columns: [
                { 
                    data: null,
                    render: function(data,type,row){
                        no++;
                        return no;
                    }
                },
                { data: 'merk' },
                { data: 'tipe' },
                { data: 'warna' },
                { data: 'kondisi' },
                { data: 'harga' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<img src="<?php echo base_url() ?>assets/img/hp/'+row.gambar+'" height="40px" width="40px">';
                    }
                },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    var ret = '<a href="javascript:;" data="'+row.id_hp+'" class="btn_edit"><span class="glyphicon glyphicon-edit" style="color: blue;"> </span></a>';
                        ret+= ' / ';
                        ret+= '<a href="javascript:;" data="'+row.id_hp+'" class="btn_hapus"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>';
                    return ret;
                   }
                }
            ]
        });
        //---------------------------------------------------------------------------------------------

        //Add -----------------------------------------------------------------------------------------
        $('#submit').submit(function(e){
            e.preventDefault(); 
            if ($('[name=merk]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Merk tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else if ($('[name=tipe]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Tipe tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else if ($('[name=warna]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Warna tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else if ($('[name=harga]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Harga tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else{
                $.ajax({
                    url:'<?php echo base_url('HomeController/add_hp')?>',
                    type:"post",
                    data:new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data){
                        $('[name=merk]').val("");
                        $('[name=tipe]').val("");
                        $('[name=warna]').val("");
                        $('[name=kondisi]:checked').prop('checked',false);
                        $('[name=harga]').val("");
                        $('[name=gambar]').val("");
                        swal({
                            type: 'success',
                            title: 'Saved !',
                            text: 'Data berhasil disimpan.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        //triger
                        rownumber=0;
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
            var id = $(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('HomeController/get_update_hp')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    $.each(data,function(){
                        $('[name=id_hp]').val(data.id_hp);
                        $('[name=merk]').val(data.merk);
                        $('[name=tipe]').val(data.tipe);
                        $('[name=warna]').val(data.warna);
                        $('[name=harga]').val(data.harga);
                        $('[name=gambar]').val(data.gambar);
                        $("#btn_simpan").attr("disabled",true).css('background-color','#DCDCDC');
                        $("#btn_update").attr("disabled",false).css('background-color','#1E90FF');
                    });
                }
            });
            return false;
        });
        //---------------------------------------------------------------------------------------------

        //Update --------------------------------------------------------------------------------------
        $('#btn_update').on('click',function(){
            var id      = $('[name=id_hp]').val();
            var merk    = $('[name=merk]').val();
            var tipe    = $('[name=tipe]').val();
            var warna   = $('[name=warna]').val();
            var kondisi = $('[name=kondisi]:checked').val();
            var harga   = $('[name=harga]').val();
            var gambar  = $('[name=gambar]').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('HomeController/update_hp')?>",
                dataType : "JSON",
                data : {id:id, merk:merk, tipe:tipe, warna:warna, kondisi:kondisi, harga:harga, gambar:gambar},
                success: function(data){
                    $('[name=merk]').val("");
                    $('[name=tipe]').val("");
                    $('[name=warna]').val("");
                    $('[name=kondisi]:checked').prop('checked',false);
                    $('[name=harga]').val("");
                    $('[name=gambar]').val("");
                    swal({
                        type: 'success',
                        title: 'Changed !',
                        text: 'Data berhasil diupdate.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    //triger
                    rownumber=0;
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
                    url  : "<?php echo base_url('HomeController/del_hp')?>",
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
                        rownumber=0;
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