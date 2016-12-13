<?php
$this->load->view('layout/layoutTop'); 
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5"> 
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;"><i class="fa fa-user"></i> &nbsp;&nbsp;User Tracking Report</h4>
        </div>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data">    
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th style="width: 7%;">S.No.</th>
                                <th style="width: 18%;">User Name</th>
                                <th style="width: 18%;">Contact No.</th>
                                <th style="width: 17%;">Table Name</th>
                                <th style="width: 16%;">Operation</th>
                                <th style="width: 24%;">Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $count = 1;
                            foreach ($trackData as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['first_name'] .$value['last_name']. '</td>';
                                echo '<td>' . $value['contact_no'] . '</td>';
                                echo '<td>' . $value['table_name'] . '</td>';
                                echo '<td class="capitalize">' . $value['operation'] . '</td>';
                                echo '<td>' .$value['op_date_time'] . '</td>';
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
        TableManageTableTools.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter'); 
?>