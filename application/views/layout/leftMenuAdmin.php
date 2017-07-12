<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="<?php echo base_url(); ?>assets_main/img/user-13.jpg" alt="" /></a>
                </div>
                <div class="info">
                    <?php
                    $session_data = $this->session->userdata('logged_in');
                    echo $session_data['first_name'];
                    ?>
                </div>
                <small><?php echo $session_data['user_type']; ?></small>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="has-sub ">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-laptop"></i>
                    <span>Dashboard</span> 
                </a>
                <ul class="sub-menu">
                    <li class="active"><a href="<?php echo base_url(); ?>index.php/Dashboard_management">Dashboard</a></li>
                </ul>
            </li>



            <li class="has-sub"> 
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-sitemap"></i>
                    <span>Product Management</span> 
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/add_product">Add New Product</a></li>

                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/product_list">Product Reports</a></li>
                </ul>
            </li>
            <li class="has-sub"> 
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-reorder"></i> 
                    <span>Order Details</span> 
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/user_current_order">Order Reports</a></li>

                    <li><a href="<?php echo base_url(); ?>index.php/Reports/user_order_date">Order Collection Reports</a></li>
<!--               <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/user_order_status_report/1">Order Status Wise Report</a></li>-->
                </ul>
            </li>
            <li class="has-sub">
                <a  href="javascript:;">
                    <b class="caret pull-right"></b> 
                    <i class="fa fa-list"></i>
                    <span>System Reports</span>  
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>index.php/Reports/user_item_date">Customization Reports</a></li>


                </ul>
            </li>


            <li class="has-sub"> 
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-gift"></i>
                    <span>Coupon Management</span> 
                </a>
                <ul class="sub-menu">

                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/coupon_generate">Send Coupon</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/universalCoupon">Universal Coupon/Discount</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/admin_sent_couponreport">Coupon Report</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/purchased_coupon_report">Coupon Purchased Report</a></li>

                </ul>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/UserRecordManagement/refund_management">

                    <i class="fa fa-money"></i>
                    <span>Refund Management</span>  
                </a>
            </li>
            <li class="has-sub"> 
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-clock-o"></i>
                    <span>Schedule Management</span> 
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>index.php/Appointment/setAppointment">Set Schedule</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Appointment/set_location_for_appointment">Schedule Info</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Appointment/appointment_report">Schedule Report</a></li>

                </ul>
            </li>


            <li class="has-sub"> 
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-cogs"></i>
                    <span>Configuration</span> 
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/shipping_conf">Shipping Config</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/profession">Add Profession</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/fabricCategory">Add Fabric Type</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/productColor">Add Color</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/add_category/0">Add Category</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/productTag">Add Product Tag</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/category_tag_connection">Add Category Tag</a></li>
                </ul>
            </li>
            <li class="has-sub"> 
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-newspaper-o"></i> 
                    <span>CMS</span>  
                </a> 
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/product_menu_information">Menu Style</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/featureProduct">Featured Products</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/on_sale_product_list">On Sale Products</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/most_popular_product_list">Most Popular Products</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/ProductHandler/new_arrival_product_list">New Arrival Products</a></li>


                </ul>
            </li>
            <li class="has-sub"> 
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-envelope"></i>
                    <span>Message Book</span> 
                </a> 
                <ul class="sub-menu">
<!--                    <li><a href="<?php echo base_url(); ?>index.php/Message_management/inbox_information">Inbox</a></li> 
                    -->
                    <li><a href="<?php echo base_url(); ?>index.php/Message_management/message_send">Compose Mail</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/Message_management/news_letter">Newsletter</a></li>
                    <!--<li><a href="<?php echo base_url(); ?>index.php/Message_management/mail_inbox">Mail Box</a></li>-->
                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/mail_template_creation">Create Mail Template</a></li>
                </ul>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-user"></i>
                    <span>Client Management</span>  
                </a>
                <ul class="sub-menu">
<!--                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/user_login_record">Login Record</a></li>-->
                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/user_profile_record">Profile Record</a></li>
                </ul>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b> 
                    <i class="fa fa-list"></i>
                    <span>User Management</span>  
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/user_registration">User Registration</a></li>
<!--                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/user_privileges">User Privileges</a></li>-->
                    <li><a href="<?php echo base_url(); ?>index.php/UserRecordManagement/admin_user_report">User Reports</a></li>  
                </ul>
            </li>

        </ul> 

        <!-- end sidebar nav --> 
    </div>
    <!-- end sidebar scrollbar -->
</div>