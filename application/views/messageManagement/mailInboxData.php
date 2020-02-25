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
                            <a href="#">
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
                  
                    
                <table id="example" class="display table table-email" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>Date/Time</th>
                            <th>Subject</th>
                            <th>Seen/Unseen</th>
                             <th>MSN</th>
                            <th></th>
                           
                        </tr>
                    </thead>

                </table>
                    
                    
                    
                    
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
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url() . 'index.php/Message_management/ajax_mail_inbox' ?>",
                "type": "GET",
            },
            "columns": [
                {"data": "from"},
                {"data": "date"},
                {"data": "sub"},
               
                {"data": "seen"},
                 {"data": "sn"},
                 {"data": "button"}

            ]
        });
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