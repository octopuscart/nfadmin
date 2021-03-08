<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">  
    <!--<![endif]--> 
    <head>
        <meta charset="utf-8" />
        <title>Nita Fashions Admin</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets_main/favicon.png"/>

        <!-- ================== BEGIN BASE CSS STYLE ================== -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets_main/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/css/animate.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/css/style.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/css/style-responsive.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/css/theme/default.css" rel="stylesheet" id="theme" />
        <!-- ================== END BASE CSS STYLE ================== -->

        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
        <link href="<?php echo base_url(); ?>assets_main/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
        <!-- ================== END PAGE LEVEL JS ================== -->
        <link href="<?php echo base_url(); ?>assets_main/plugins/DataTables/css/data-table.css" rel="stylesheet" />

        <!-- ================== BEGIN BASE JS ================== -->
        <script src="<?php echo base_url(); ?>assets_main/plugins/pace/pace.min.js"></script>
        <!-- ================== END BASE JS ================== -->

        <!--   Image upload ---->
        <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
        <link href="<?php echo base_url(); ?>assets_main/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
        <!-- ================== END PAGE LEVEL CSS STYLE ================== --> 

        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
        <!-- ================== END PAGE LEVEL STYLE ================== -->
    </head>
    <body>
        <?php
        $session_data = $this->session->userdata('logged_in');
       
        if (empty($session_data)) {
//            redirect('LoginAndLogout', 'refresh');
        }
        ?>
        <!-- begin #page-loader -->
        <div id="page-loader" class="fade in"><span class="spinner"></span></div>
        <!-- end #page-loader -->

        <!-- begin #page-container -->
        <div id="page-container" class="fade page-header-fixed page-sidebar-fixed">
            <!-- begin #header -->
            <div id="header" class="header navbar navbar-default navbar-fixed-top">
                <!-- begin container-fluid -->
                <div class="container-fluid">
                    <!-- begin mobile sidebar expand / collapse button -->
                    <div class="navbar-header">
                        <a href="<?php echo base_url(); ?>index.php/productHandler/add_category/0" class="navbar-brand"><span class="navbar-logo"></span>Admin Panel</a>
                        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- end mobile sidebar expand / collapse button --> 

                    <!-- begin header navigation right -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <form class="navbar-form full-width">  
                                <div class="form-group">
                                    <input type="text" class="form-control " data-provide="typeahead" placeholder="Enter keyword"  id="searchCustomer" />
                                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </li>
<!--                        <li class="dropdown">
                            <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                                <i class="fa fa-bell-o"></i>
                                <span class="label">5</span>
                            </a>
                            <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                                
                                <?php
                                 $dateRange1 = date("Y-m-d") . " to " . date("Y-m-d");
                                 $quryrange1 = "'" . str_replace(" to ", "' and '", $dateRange1) . "'";
                                $notification = $this->User_model->user_order_history("1",'');
                                $len = $notification ? count($notification):0;
                                if ($notification) {
                                    if (count($notification) < 5) {
                                        $len = count($notification);
                                    } else {
                                        $len = 5;
                                    }
                                    
                                    //foreach ($notification as $key => $notification[$i]) {
                                    for ($i = 0; $i < $len; $i++) {
                                        echo '<li class="media">';
                                        echo '<a href = "' . base_url('index.php/UserRecordManagement/update_order_status/' . $notification[$i]['id']) . '/' . $notification[$i]['billing_id'] . '/' . $notification[$i]['shipping_id'] . '/' . $notification[$i]['user_id'] . '">';
                                        echo '<div class="media-left">' . $notification[$i]['first_name'] . ' ' . $notification[$i]['last_name'] . '</div>';
                                        echo '<div class="media-body">';
                                        echo '<h6 class="media-heading">' . $notification[$i]['order_no'] . '</h6>';
                                        echo '<div class="text-muted f-s-11">(' . $notification[$i]['total_quantity'] . ')   ' . $notification[$i]['op_date'] . ' ' . $notification[$i]['op_time'] . '</div>';
                                        echo '</div>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                }
                                echo '<li class="dropdown-header">Notifications ('.$len.')</li>';
                                ?>
                                <li class="dropdown-footer text-center">
                                    <a href="<?php echo base_url('index.php/UserRecordManagement/user_order_history'); ?>">View more</a>
                                </li>
                            </ul>
                        </li>-->
                        <li class="dropdown navbar-user"> 
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url(); ?>assets_main/img/user-13.jpg" alt="" /> 
                                <span class="hidden-xs"><?php echo $session_data['first_name']; ?></span> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu animated fadeInLeft">
                                <li class="arrow"></li>
                                <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/profile_update_info">Edit Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url('index.php/LoginAndLogout/logout'); ?>">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- end header navigation right -->
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end #header -->
            <?php
             $user = $session_data['user_type'];
            if ($user == 'Admin') {
                $this->load->view('layout/leftMenuAdmin');
            }else{
                $this->load->view('layout/leftMenuManager');
            }
            ?>
            <div class="sidebar-bg"></div> 
            <!-- end #sidebar -->
            <div class="sidebar-bg"></div>
            <!-- end #sidebar -->
            <!-- begin #content -->
            <div id="content" class="content">
                <!-- begin breadcrumb -->
                <!-- end page-header -->