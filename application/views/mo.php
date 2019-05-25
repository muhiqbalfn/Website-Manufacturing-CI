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
                           <!-- Custom Tabs -->
                            <div class="box box-solid nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-th-list"></i></a></li>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-th-large"></i></a></li>
                                    <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-bar-chart-o"></i></a></li>
                                    <li class="pull-right" style="padding-right: 5px;">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#mdlMo">
                                            <i class="fa fa-plus"></i> &nbsp;Create manufacturing
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
                                                        <th>Deadline start</th>
                                                        <th>Responsible</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1; foreach ($data as $key => $value) : ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $value->product_name; ?></td>
                                                        <td><?php echo $value->qty; ?></td>
                                                        <td><?php echo $value->deadline_start; ?></td>
                                                        <td><?php echo $value->username; ?></td>
                                                        <td><span class="badge
                                                                <?php if($value->status == "Confirmed"){ 
                                                                        }else if($value->status == "In Progress"){ 
                                                                            echo "bg-yellow"; 
                                                                        }else if($value->status == "Done"){ 
                                                                            echo "bg-green"; 
                                                                        }
                                                                ?>"><?php echo $value->status; ?>
                                                            </span></td>
                                                        <td>
                                                            <a href="<?php 
                                                                        if($value->status == "Confirmed"){
                                                                            echo base_url("MoController/go_confirmed/".$value->id_manufacturing);
                                                                        }else if($value->status == "In Progress"){ 
                                                                            echo base_url("MoController/go_produce/".$value->id_manufacturing);
                                                                        }else if($value->status == "Done"){ 
                                                                            echo base_url("MoController/go_done/".$value->id_manufacturing);
                                                                        }
                                                                    ?>">
                                                               <span class="glyphicon glyphicon-eye-open"></span>
                                                           </a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; endforeach; ?>
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
                                                    <h6 style="color: #333333;" class="pull-right"><i>Quantity : <?php echo $key->qty ?> Unit(s)</h6>
                                                    <h4><?php echo $key->product_name ?></h4>
                                                    <h6 style="color: #333333;"><i><?php echo $key->deadline_start ?></h6>
                                                    <h5 class="badge pull-right <?php if($key->status == "Confirmed"){ 
                                                                                        }else if($key->status == "In Progress"){ 
                                                                                            echo "bg-yellow"; 
                                                                                        }else if($key->status == "Done"){ 
                                                                                            echo "bg-green"; 
                                                                                        } 
                                                                                ?>"><?php echo $key->status ?></h5>
                                                    <h5><?php echo $key->source ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!--------------------------------------------------------------------------------------->
                                    </div>   
                                    <div class="tab-pane" id="tab_3">
                                        <div class="col-md-12">
                                            <canvas id="canvas" height="280" width="600"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </aside>
        </div>

        <?php $this->load->view('modal/modalMo'); ?>
        <?php $this->load->view('sub/footer'); ?>
    </body>
</html>

<script type="text/javascript">
   $(document).ready(function(){  
        
        //Datatable -----------------------------------------------------------------------------------
        var tableajax = $('#tabelajax').DataTable({
          responsive: true
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
                var data1 = $('[name=id_product]').val();
                var data2 = $('[name=id_bom]').val();
                var data3 = $('[name=id_user]').val();
                var data4 = $('[name=qty]').val();
                var data5 = $('[name=deadline_start]').val();
                var data6 = $('[name=source]').val();
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('MoController/add_data')?>",
                    dataType : "JSON",
                    data : {data1:data1,data2:data2,data3:data3,data4:data4,data5:data5,data6:data6},
                    success: function(data){
                        $('#mdlMo').modal('hide');
                        swal({
                            type: 'success',
                            title: 'Saved !',
                            text: 'Data berhasil disimpan.',
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
                            text: 'Data gagal disimpan.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
        //---------------------------------------------------------------------------------------------

    });

</script>