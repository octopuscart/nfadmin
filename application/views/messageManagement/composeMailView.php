<?php
$this->load->view('layout/layoutTop');
?>  
<link href="<?php echo base_url(); ?>assets_main/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />
<!-- begin vertical-box-column -->
<div class="col-md-3">
    <!-- begin wrapper -->
    <div class="wrapper bg-silver text-center">
        <a href="email_compose.html" class="btn btn-success p-l-40 p-r-40 btn-sm">
            Compose
        </a>
    </div>
    <!-- end wrapper -->
    <!-- begin wrapper -->
    <div class="wrapper">
        <p><b>FOLDERS</b></p>
        <ul class="nav nav-pills nav-stacked nav-sm">
            <li><a href="email_inbox_v2.html"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox <span class="badge pull-right">52</span></a></li>
            <li><a href="email_inbox_v2.html"><i class="fa fa-flag fa-fw m-r-5"></i> Important</a></li>
            <li><a href="email_inbox_v2.html"><i class="fa fa-send fa-fw m-r-5"></i> Sent</a></li>
            <li><a href="email_inbox_v2.html"><i class="fa fa-pencil fa-fw m-r-5"></i> Drafts</a></li>
            <li><a href="email_inbox_v2.html"><i class="fa fa-trash fa-fw m-r-5"></i> Trash</a></li>
        </ul>
        <p><b>LABEL</b></p>
        <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
            <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-inverse"></i> Admin</a></li>
            <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-primary"></i> Designer & Employer</a></li>
            <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-success"></i> Staff</a></li>
            <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-warning"></i> Sponsorer</a></li>
            <li><a href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-danger"></i> Client</a></li>
        </ul>
    </div>
    <!-- end wrapper -->
</div>
<!-- end vertical-box-column -->
<!-- begin vertical-box-column -->
<div class="col-md-9">
    <!-- begin wrapper -->
    <div class="wrapper bg-silver-lighter">
        <!-- begin btn-toolbar -->
        <div class="btn-toolbar">
            <div class="btn-group">
                <a href="inbox_v2.html" class="btn btn-white btn-sm p-l-20 p-r-20"><i class="fa fa-file"></i></a>
                <a href="inbox_v2.html" class="btn btn-white btn-sm p-l-20 p-r-20"><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <!-- end btn-toolbar -->
    </div>
    <!-- end wrapper -->
    <!-- begin wrapper -->
    <div class="wrapper">
        <div class="p-30 bg-white">
            <!-- begin email form -->
            <form method="POST">
                <!-- begin email to -->
                <label class="control-label">To:</label>
                <div class="m-b-15">
                    <ul id="email-to" class="inverse">

                    </ul>
                </div>
                <!-- end email to -->
                <!-- begin email subject -->
                <label class="control-label">Subject:</label>
                <div class="m-b-15">
                    <input type="text" class="form-control" name="subject"/>
                </div>
                <!-- end email subject -->
                <!-- begin email content -->
                <label class="control-label">Content:</label>
                <div class="m-b-15">
                    <textarea class="textarea form-control" id="wysihtml5" placeholder="Enter text ..." rows="12" name="content"></textarea>
                </div>
                <!-- end email content -->
                <button type="submit" class="btn btn-primary p-l-40 p-r-40" name="send_mail" onclick="set_sender_info()">Send</button>
            </form>
            <!-- end email form -->
        </div>
    </div>
    <!-- end wrapper -->
</div>
<!-- end vertical-box-column -->
</div>
<!-- end vertical-box -->
</div>
<!-- end #content -->

<!-- begin theme-panel -->
<div class="theme-panel">
    <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
    <div class="theme-panel-content">
        <h5 class="m-t-0">Color Theme</h5>
        <ul class="theme-list clearfix">
            <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
            <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
            <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
            <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
            <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
            <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
        </ul>
        <div class="divider"></div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label double-line">Header Styling</div>
            <div class="col-md-7">
                <select name="header-styling" class="form-control input-sm">
                    <option value="1">default</option>
                    <option value="2">inverse</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label">Header</div>
            <div class="col-md-7">
                <select name="header-fixed" class="form-control input-sm">
                    <option value="1">fixed</option>
                    <option value="2">default</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label double-line">Sidebar Styling</div>
            <div class="col-md-7">
                <select name="sidebar-styling" class="form-control input-sm">
                    <option value="1">default</option>
                    <option value="2">grid</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label">Sidebar</div>
            <div class="col-md-7">
                <select name="sidebar-fixed" class="form-control input-sm">
                    <option value="1">fixed</option>
                    <option value="2">default</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label double-line">Sidebar Gradient</div> 
            <div class="col-md-7">
                <select name="content-gradient" class="form-control input-sm">
                    <option value="1">disabled</option>
                    <option value="2">enabled</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label double-line">Content Styling</div>
            <div class="col-md-7">
                <select name="content-styling" class="form-control input-sm">
                    <option value="1">default</option>
                    <option value="2">black</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-12">
                <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i> Reset Local Storage</a>
            </div>
        </div>
    </div>

    <?php
    $this->load->view('layout/layoutBottom');
    ?> 
    <script>
        function set_sender_info() {
            $('input[name=tags]').attr('name', 'sender[]');
        }
    </script>
    <script src="<?php echo base_url(); ?>assets_main/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
    <script src="<?php echo base_url(); ?>assets_main/js/email-compose.demo.min.js"></script>
    <script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script>
    <script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
    <script>
        $(document).ready(function () {
            App.init();
            TableManageDefault.init();
            EmailCompose.init();
        });
    </script> 

    <?php
    $this->load->view('layout/layoutFooter');
    ?>