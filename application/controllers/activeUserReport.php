<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500; "><i class="fa fa-list"></i> Active User Report</h4>
        </div>
        <div class="panel-body" id="test"> 
             <div style="clear: both"></div>
            <div class="col-md-2 pull-right" style="padding: 0px;margin-top: 13px;">
                <div class="btn-group pull-right" role="group" aria-label="..." style="padding: 0px;margin-top: -10%;">
                    <a class="btn btn-default"  data-toggle="" data-placement="left" title="Download Pdf"  style="margin-right: -10%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/UserRecordManagement/active_user_report_pdf/D/') ?>"><i class="fa fa-download"></i> </a>
                    <a class="btn btn-default"   data-toggle="" data-placement="left" title="View Pdf"  style="margin-left: 10%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/UserRecordManagement/active_user_report_pdf/I/') ?>"><i class="fa fa-eye"></i> </a>
                </div>

            </div>
      <div style="clear: both"></div>
<!--            <a class="btn btn-primary btn-xs" data-toggle="" data-placement="left" title="Download Pdf"  style="margin-right: -10%" target="_blanck" href="<?php echo base_url('index.php/UserRecordManagement/active_user_report_pdf/D') ?>"><i class="fa fa-download"></i> PDF</a>
            <a class="btn btn-danger btn-xs"  data-toggle="" data-placement="left" title="View Pdf" style="margin-left: 10%" target="_blanck" href="<?php echo base_url('index.php/UserRecordManagement/active_user_report_pdf/I') ?>"><i class="fa fa-eye"></i> PDF</a>-->
            <hr>
            <table class="table table-striped table-bordered nowrap" id="data-table">
                <thead>
                    <tr>
                        <th style="width: 7%;">S.No.</th>
                        <th style="width: 12%;">User Name</th>
                        <th style="width: 12%;">Title</th>
                        <th style="width: 12;">Sku</th>
                        <th style="width: 9%;">Image</th>
                        <th style="width: 8%;">Frequency</th>
                        <th style="width: 40%;">Short Description</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php
                    if ($activeUser) {
                        $count = 1;
                        foreach ($activeUser as $key => $value) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td style="text-transform: capitalize;">' . $value['user_name'] . '</td>';
                            echo '<td>' . $value['title'] . '</td>';
                            echo '<td>' . $value['sku'] . '</td>';
                            echo '<td><img src="http://nf1.costcokart.com/nfw/small/' . $value['image'] . '" style="width:60px;height: 45px;"></td>';
                            echo '<td>' . $value['quantity'] . '</td>';
                            echo '<td>' . $value['short_description'] . '</td>';
                            echo '</tr>';
                            $count++;
                        }
                    }
                    ?>
                </tbody>
            </table>      
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
        FormPlugins.init();
        TableManageTableTools.init();
    });
</script>

<?php
$this->load->view('layout/layoutFooter');
?>  