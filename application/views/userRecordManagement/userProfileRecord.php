<?php
$this->load->view('layout/layoutTop');
$data['userProfile'] = $this->Product_model->get_table_information('auth_user');
//print_r($data);
?> 
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; "> 
                Active Client Information
                <div class="btn-group btn-group-sm pull-right" >
                    <a class="btn btn-success"  data-toggle="" data-placement="left" title="View XLS"     href="<?php echo base_url('index.php/UserRecordManagement/user_profile_record_xls/0') ?>" target="_blank"><i class="fa fa-file-excel-o"></i> </a>
                    <a class="btn btn-primary"  data-toggle="" data-placement="left" title="View Pdf"     href="<?php echo base_url('index.php/UserRecordManagement/user_profile_record_pdf/I/0') ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> </a>
                    <a class="btn btn-success"  data-toggle="" data-placement="left" title="Download Pdf" href="<?php echo base_url('index.php/UserRecordManagement/user_profile_record_pdf/D/0') ?>" target="_blank"><i class="fa fa-download"></i> </a>
                </div>
            </h4>
        </div>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data">    
                <div class="table-responsive">
                    <table id="data_table1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 7%;">S.No.</th>
                                <th>Client Details</th>
                                <th style="width: 120px">Birth Date</th>
                                <th style="width: 120px">Joining Date</th>
                                <th style="width:300px;">View Profile</th> 
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $count = 1;
                            if ($userProfile) {

                                //print_r($userProfile);
                                foreach ($userProfile as $key => $value) {
                                    $table_name = "auth_user";
                                    ?>

                                    <tr>
                                        <td><?php echo $count ?> </td>
                                        <td>
                                            <p class="capitalize" style="margin: 0 0 0px;">
                                                <b> <?php echo $value['registration_id'] ?></b> 
                                            </p>
                                            <p class="capitalize"  style="margin: 0 0 0px;">
                                                <i class="fa fa-user"></i> <?php echo $value['first_name'] . ' ' . $value['middle_name'] . ' ' . $value['last_name'] ?> 
                                            </p>
                                            <p style="margin: 0 0 0px;">
                                                <i class="fa fa-envelope"></i> <?php echo $value['email'] ?> 
                                            </p>
                                            <p  style="margin: 0 0 0px;">
                                                <i class="fa fa-phone"></i> <?php echo $value['contact_no'] ?>
                                            </p>
                                            <p  style="margin: 0 0 0px;">
                                                <i class="fa fa-suitcase"></i> <?php echo $value['profession_value'] ? $value['profession_value'] : '---' ?>
                                            </p>
                                        </td>
                                        <td><?php echo $value['birth_date'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['joining_date'] ?> </td>
                                        <td >

                                                                        <!--                                      <a class="btn btn-success btn-xs m-r-5" href="<?php echo base_url() ?>index.php/UserRecordManagement/user_profile_view_info/<?php echo $value['id'] ?>"> View</a>-->
                                            <a style="margin-left:4px;" class="btn btn-info btn-xs m-r-5" href="<?php echo base_url() ?>index.php/UserRecordManagement/user_detail_info/<?php echo $value['id'] ?>"> Detail</a>
                                            <a class="btn btn-danger btn-xs m-r-5" href="<?php echo base_url() ?>index.php/UserRecordManagement/user_login_record/<?php echo $value['id'] ?>"> Login Record</a>
                                            <a href="<?php echo base_url() ?>../frontend/views/frontend_login_from_adminpanel.php?email=<?php echo $value['email']; ?>&password=<?php echo $value['password']; ?>&table_name=<?php echo $table_name; ?>&userId=<?php echo $value['id'] ?>" class="btn btn-warning btn-xs m-r-5" target="_blank">Login as User</a>
                                        </td>

                                    </tr>
                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>                          
        </div>
    </div>


    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; "> 
                Inactive Client Information 
                <div class="btn-group btn-group-sm pull-right" >
                    <a class="btn btn-success"  data-toggle="" data-placement="left" title="View XLS"     href="<?php echo base_url('index.php/UserRecordManagement/user_profile_record_xls/I') ?>" target="_blank"><i class="fa fa-file-excel-o"></i> </a>
                    <a class="btn btn-primary"  data-toggle="" data-placement="left" title="View Pdf"     href="<?php echo base_url('index.php/UserRecordManagement/user_profile_record_pdf/I/I') ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> </a>
                    <a class="btn btn-success"  data-toggle="" data-placement="left" title="Download Pdf" href="<?php echo base_url('index.php/UserRecordManagement/user_profile_record_pdf/D/I') ?>" target="_blank"><i class="fa fa-download"></i> </a>
                </div>
            </h4>
        </div>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data">    
                <div class="table-responsive">
                    <table id="data_table2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 7%;">S.No.</th>
                                <th>Client Details</th>
                                <th style="width: 120px">Birth Date</th>
                                <th style="width: 120px">Joining Date</th>
                                <th style="width:280px;">View Profile</th> 
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $count = 1;
                            if (count($userProfileInactive)) {

                                //print_r($userProfile);
                                foreach ($userProfileInactive as $key => $value) {
                                    $table_name = "auth_user";
                                    ?>

                                    <tr>
                                        <td><?php echo $count ?> </td>
                                        <td>
                                            <p class="capitalize" style="margin: 0 0 0px;">
                                                <b> <?php echo $value['registration_id'] ?></b> 
                                            </p>
                                            <p class="capitalize"  style="margin: 0 0 0px;">
                                                <i class="fa fa-user"></i> <?php echo $value['first_name'] . ' ' . $value['middle_name'] . ' ' . $value['last_name'] ?> 
                                            </p>
                                            <p style="margin: 0 0 0px;">
                                                <i class="fa fa-envelope"></i> <?php echo $value['email'] ?> 
                                            </p>
                                            <p  style="margin: 0 0 0px;">
                                                <i class="fa fa-phone"></i> <?php echo $value['contact_no'] ?>
                                            </p>
                                            <i class="fa fa-suitcase"></i> <?php echo $value['profession_value'] ? $value['profession_value'] : '---' ?>
                                        </td>
                                        <td><?php echo $value['birth_date'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['joining_date'] ?> </td>

                                        <td>

                                                                        <!--                                      <a class="btn btn-success btn-xs m-r-5" href="<?php echo base_url() ?>index.php/UserRecordManagement/user_profile_view_info/<?php echo $value['id'] ?>"> View</a>-->
                                            <a style="margin-left:4px;" class="btn btn-info btn-xs m-r-5" href="<?php echo base_url() ?>index.php/UserRecordManagement/user_detail_info/<?php echo $value['id'] ?>"> Detail</a>
                                            <a class="btn btn-danger btn-xs m-r-5" href="<?php echo base_url() ?>index.php/UserRecordManagement/user_login_record/<?php echo $value['id'] ?>"> Login Record</a>
                                            <a href="https://www.nitafashions.com/index.php/Account/backendlogin?email=<?php echo $value['email']; ?>&password=<?php echo $value['password']; ?>&table_name=<?php echo $table_name; ?>&userId=<?php echo $value['id'] ?>" class="btn btn-warning btn-xs m-r-5" target="_blank">Login as User</a>
                                        </td>

                                    </tr>
                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>                          
        </div>
    </div>
</div>

<?php
$this->load->view('layout/layoutBottom');
?>


<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();

        TableManageDefault.init();

//         FormPlugins.init();
        $("#data_table1").DataTable(
                {"pageLength": 25});
        $("#data_table2").DataTable({"pageLength": 25});

    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>