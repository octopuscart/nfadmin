<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500; "><i class="fa fa-list"></i> Custom Product Report</h4>
        </div>
        <div class="panel-body" id="test"> 
            <table id="data-table" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th style="width: 10%;">S.No.</th>
                        <th style="width: 40;">Customize</th>
                        <th style="width: 40%;">Frequency</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php
                    if ($customData) {
                        $count = 1;
                        foreach ($customData as $key => $value) {
                            if ($value['customize_table']) {
                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['customize_table'] . '</td>';
                                echo '<td>' . $value['quantity'] . '</td>';
                                echo '</tr>';
                                $count++;
                            }
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
       // TableManageDefault.init();
        TableManageTableTools.init();
    });
</script>

<?php
$this->load->view('layout/layoutFooter');
?>   