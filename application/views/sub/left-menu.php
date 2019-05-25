<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('username') ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="<?php echo base_url('ProductController'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('ContactController'); ?>">
                    <i class="fa fa-phone"></i> <span>Contacts</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dropbox"></i> <span>Product</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('ProductController'); ?>">
                        <i class="fa fa-angle-double-right"></i>List product
                        </a>
                    </li>
                    <li><a href="<?php echo base_url('ProductCategoryController'); ?>">
                        <i class="fa fa-angle-double-right"></i>Product category
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('BomController'); ?>">
                    <i class="fa fa-laptop"></i> <span>Bills of Materials</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('MoController'); ?>">
                    <i class="fa fa-refresh"></i> <span>Manufacturing Orders</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('SettingController'); ?>">
                    <i class="fa fa-wrench"></i> <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('AppController'); ?>">
                    <i class="fa fa-adn"></i> <span>Apps</span>
                    <small class="badge pull-right bg-green">16</small>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('CalendarController'); ?>">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>