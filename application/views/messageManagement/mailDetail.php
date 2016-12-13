<?php
error_reporting(0);
$this->load->view('layout/layoutTop');
//print_r($product_report);
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"/>
<style>
    table.dataTable.display tbody tr:hover>.sorting_1, table.dataTable.order-column.hover tbody >.sorting_1 {
        background-color: #fff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #fff !important;
    }


    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: #fff !important;
    }


    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        color: #fff!important;
    }
</style>


<div id="content" class="content content-full-width" style="margin-left: 0px;padding: 0px 0px;">
    <div class="p-20">
        <!-- begin row -->
        <div class="row">
            <!-- begin col-2 -->
            <div class="col-md-2">
                <form>
                    <div class="input-group m-b-15">
<!--                        <input type="text" class="form-control input-sm input-white" placeholder="Search Mail" />-->
                        <span class="input-group-btn">
                            <a href="<?php echo base_url() . 'index.php/Message_management/message_send' ?>" class="btn btn-success"><i class="fa fa-edit"></i> Compose Mail</a>
                        </span>
                    </div>
                </form>
                <div class="hidden-sm hidden-xs">
                    <h5 class="m-t-20">Email</h5>
                    <ul class="nav nav-pills nav-stacked nav-inbox">
                        <li class="active">
                            <a href="<?php echo base_url() . 'index.php/Message_management/mail_inbox' ?>">
                                <i class="fa fa-inbox fa-fw m-r-5"></i> Inbox (<?php echo count($unseen);?>)
                            </a>
                        </li>
                        <li><a href="#"><i class="fa fa-inbox fa-fw m-r-5"></i> Sent</a></li>
                        <li><a href="#"><i class="fa fa-pencil fa-fw m-r-5"></i> Draft</a></li>
                        <li><a href="#"><i class="fa fa-trash-o fa-fw m-r-5"></i> Trash</a></li>
                        <li><a href="#"><i class="fa fa-star fa-fw m-r-5"></i> Archive</a></li>
                    </ul>

                </div>
            </div>
            <!-- end col-2 -->
            <!-- begin col-10 -->
            <div class="col-md-10">

                <div class="email-content">


                    <div class="wrapper">
                        <h4 class="m-b-15 m-t-0 p-b-10 underline"><?php 
                        echo $subject;
                        ?></h4>
                        <ul class="media-list underline m-b-20 p-b-15">
                            <li class="media media-sm clearfix">
                                
                                <div class="media-body">
                                    <span class="email-from text-inverse f-w-600">
                                        <small>From</small><br/>
                                        <?php
                                        echo str_replace(">", ") ", str_replace("<", " (",$mail_from));
                                        ?>

                                    </span><span class="text-muted m-l-5"><i class="fa fa-clock-o fa-fw"></i> <?php echo $mail_date;?></span><br>
                                    <span class="email-to">
                                       
                                    </span>
                                </div>
                            </li>
                        </ul>
                        <?php 
                        echo $mail_body;
                        ?>
                    </div>


                </div>
            </div>
            <!-- end col-10 -->
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end #content -->


<?php
$this->load->view('layout/layoutBottom');
?> 

<script>

    $(document).ready(function () {

    });
</script>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {


        App.init();
        TableManageDefault.init();
        FormPlugins.init();
        TableManageTableTools.init();

    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>