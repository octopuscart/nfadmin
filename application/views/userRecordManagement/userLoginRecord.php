<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5"> 
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;"><i class="fa fa-user"></i> &nbsp;&nbsp;Login & Logout Reports</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-2 pull-right" style="padding: 0px;margin-top: 13px">
                <?php $user_id = $this->uri->segment(3);?>
                <div class="btn-group pull-right" role="group" aria-label="..." style="padding: 0px;margin-top: -10%;">
                    <a class="btn btn-default"   data-toggle="" data-placement="left" title="View Pdf"  style="margin-left: 0%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/UserRecordManagement/user_login_record_pdf/I/'.$user_id) ?>"><i class="fa fa-eye"></i> </a>
                    <a class="btn btn-default"  data-toggle="" data-placement="left" title="Download Pdf"  style="margin-right: -10%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/UserRecordManagement/user_login_record_pdf/D/' .$user_id) ?>"><i class="fa fa-download"></i> </a>
                    
                </div>

            </div>
            <div style="clear: both"></div>
            <hr>

            <form method="post" enctype="multipart/form-data">    
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: ">S.No.</th>
                                <th style="width: ">Time Stamp</th>
                                <th style="width: ">Client IP</th>
                                <th style="width: ">Description</th>
                                <th style="width: ">Client Code</th>
                                <th style="width: ">First Name</th>
                                <th style="width: ">Middle Name</th>
                                <th style="width: ">Last Name/Surname</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $count = 1;
                            foreach ($loginRecord as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['time_stamp'] . '</td>';
                                echo '<td>' . $value['client_ip'] . '</td>';
                                echo '<td class="capitalize">' . substr($value['description'], 0, 150) . '</td>';
                                echo '<td class="capitalize">' . $value['registration_id'] . '</td>';
                                echo '<td class="capitalize">' . $value['first_name'] . '</td>';
                                echo '<td class="capitalize">' . $value['middle_name'] . '</td>';
                                echo '<td class="capitalize">' . $value['last_name'] . '</td>';

                                echo '</tr>';
                                $count++;
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
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>