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
                        Setting
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
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-th-large"></i></a></li>
                                    <?php if ($this->session->userdata('id_user') == "1"){ ?>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-th-list"></i></a></li>
                                    <li class="pull-right">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#mdlSetting">
                                            <i class="fa fa-plus"></i> &nbsp;Create user
                                        </button>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <div class="tab-content col-md-12 box-body"><br>
                                    <div class="tab-pane active" id="tab_1">
                                        <!------------------------------------------------------------------------------------------>
                                        <!-- List user -->
                                        <?php foreach ($data as $key) {  ?>
                                        <div class="col-lg-4">
                                            <div class="box" style="box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.2);">
                                                <div class="box-body">
                                                    <img style="float: left; margin-right: 10px;" src="<?php echo base_url() ?>assets/img/nuzul.png" height="70px" width="70px">
                                                    <h5><?php echo $key->username ?></h5>
                                                    <h6 style="color: #a9a9a9;"><i><i class="fa fa-envelope"></i> &nbsp;<?php echo $key->email ?></i></h6><br>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!------------------------------------------------------------------------------------------>
                                    </div>
                                    <?php if ($this->session->userdata('id_user') == "1"){ ?>
                                    <div class="tab-pane" id="tab_2">
                                        <!------------------------------------------------------------------------------------------>
                                        <div class="table-responsive">
                                            <table width="100%" id="tabelajax" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Foto</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Password</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="show_data">  
                                                </tbody>
                                            </table>
                                        </div>
                                        <!------------------------------------------------------------------------------------------>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div> 
                       </div>
                    </div>
                </section>

            </aside>
        </div>

        <?php $this->load->view('modal/modalSetting'); ?>
        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){ 

        //GET -----------------------------------------------------------------------------------------
        var no = 0;
        var tableajax = $('#tabelajax').DataTable({
          responsive: true,
            ajax: '<?php echo base_url("SettingController/get_data") ?>',
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
                        return '<img src="<?php echo base_url() ?>assets/img/nuzul.png" height="40px" width="40px">';
                    }
                },
                { data: 'username' },
                { data: 'email' },
                { data: 'phone' },
                { data: 'address' },
                { data: 'password' },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    var ret = '<a href="javascript:;" data="'+row.id_user+'" class="btn_edit"><span class="glyphicon glyphicon-edit" style="color: blue;"> </span></a>';
                        ret+= ' / ';
                        ret+= '<a href="javascript:;" data="'+row.id_user+'" class="btn_hapus"><span class="glyphicon glyphicon-trash" style="color: red;"></span></a>';
                    return ret;
                   }
                }
            ]
        });
        //---------------------------------------------------------------------------------------------

        //Add -----------------------------------------------------------------------------------------
        $('#btn_simpan').click(function(e){ 
            e.preventDefault(); 
            if ($('[name=username]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Username tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else if ($('[name=email]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Email tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else if ($('[name=password]').val() == ''){
                swal({
                    type: 'warning',
                    title: '',
                    text: 'Password tidak boleh kosong !',
                    timer: 2000,
                    showConfirmButton: false
                });
            }else{
                var data1 = $('[name=username]').val();
                var data2 = $('[name=email]').val();
                var data3 = $('[name=password]').val();
                var data4 = $('[name=phone]').val();
                var data5 = $('[name=address]').val();
                var data6 = $('[name=level]').val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('SettingController/add_data')?>",
                    dataType : "JSON",
                    data : {data1:data1,data2:data2,data3:data3,data4:data4,data5:data5,data6:data6},
                    success: function(data){
                        $('#mdlSetting').modal('hide');
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
                url  : "<?php echo base_url('SettingController/get_update_data')?>",
                dataType : "JSON",
                data : {data1:data1},
                success: function(data){
                    $.each(data,function(){
                        $('#mdlSetting').modal('show');
                        $('[name=id_user]').val(data.id_user);
                        $('[name=username]').val(data.username);
                        $('[name=email]').val(data.email);
                        $('[name=password]').val(data.password);
                        $('[name=phone]').val(data.phone);
                        $('[name=address]').val(data.address);
                        $('[name=level]').val(data.level);
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
            var data1 = $('[name=id_user]').val();
            var data2 = $('[name=username]').val();
            var data3 = $('[name=email]').val();
            var data4 = $('[name=password]').val();
            var data5 = $('[name=phone]').val();
            var data6 = $('[name=address]').val();
            var data7 = $('[name=level]').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('SettingController/update_data')?>",
                dataType : "JSON",
                data : {data1:data1,data2:data2,data3:data3,data4:data4,data5:data5,data6:data6,data7:data7},
                success: function(data){
                    $('#mdlSetting').modal('hide');
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
                    url  : "<?php echo base_url('SettingController/del_data')?>",
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