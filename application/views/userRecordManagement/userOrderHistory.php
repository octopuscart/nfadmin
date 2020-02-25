<?php
$this->load->view('layout/layoutTop'); 
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;">User Histroy</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-md-3 control-label" style="padding: 5px 0px 5px 0px;">Status Report</label>
                        <div class="col-md-9">
                            <select style="width: 100%;" class="form-control input-inline input-ls" name="status" onchange="select_status_record(this)">
                                <?php
                                $statusData = $this->Product_model->get_table_information('nfw_order_status_tag');
                                echo '<option value="0">Select</option>';
                                foreach ($statusData as $key => $value) {
                                    echo '<option value="' . $value['id'] . '">' . $value['title'] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12"><hr></div> 
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data">    
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 7%;">S.No.</th>
                                    <th style="width: 16%;">Name</th>
                                    <th style="width: 12%;">Order No.</th>
                                    <th style="width: 15%;">Frequency</th>
                                    <th style="width: 10%;">Cost</th>
                                    <th style="width: 16%;">Date/Time</th>
                                    <th style="width: 15%;">Status</th>
                                    <th style="width: 8%;"></th>
                                </tr>
                            </thead>
                            <tbody id="status_report"> 

                                <?php
                                $count = 1;
                                if ($orderHistory) { 
                                    foreach ($orderHistory as $key => $value) {
                                        echo '<tr>';
                                        echo '<td>' . $count . '</td>';
                                        echo '<td>' . $value['first_name'] . ' ' . $value['last_name'] . '</td>';
                                        echo '<td>' . $value['order_no'] . '</td>';
                                        echo '<td>' . $value['total_quantity'] . '</td>';
                                        echo '<td>' . $value['total_price'] . '</td>';
                                        echo '<td>' . $value['op_date'] .' '.$value['op_time']. '</td>';
                                        echo '<td>' . $value['order_status'] . '</td>';
                                        echo '<td><a href = "' . base_url('index.php/UserRecordManagement/update_order_status/' . $value['id']) . '/'.$value['billing_id'].'/'.$value['shipping_id'].'/'.$value['user_id'].'" class="btn btn-primary btn-sm"> Detail </a>
                                                  </td>';
                                        echo '</tr>';
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
</div>

<?php
$this->load->view('layout/layoutBottom');
?>
<script>
    function select_status_record(obj) {
        var status = $('select[name=status]').val();
        $.ajax({
            url: '<?php echo base_url() . 'index.php/UserRecordManagement/order_status_ajax_information'; ?>',
            data: {'status': status},
            dataType: 'json',
            type: 'GET',
            success: function (jsonData) {
                // console.log(data);
                var htmls = '';
                var count = 1;
                for (i in jsonData) {
                    htmls += '<tr>';
                    htmls += '<td>' + count + '</td>';
                    htmls += '<td>' + jsonData[i]['first_name'] + ' ' + jsonData[i]['last_name'] + '</td>';
                    htmls += '<td>' + jsonData[i]['product'] + '</td>';
                    htmls += '<td>' + jsonData[i]['total_quantity'] + '</td>';
                    htmls += '<td>' + jsonData[i]['total_price'] + '</td>';
                    htmls += '<td>' + jsonData[i]['op_date'] + ' ' + jsonData[i]['op_time'] +'</td>'; 
                    htmls += '<td>' + jsonData[i]['order_status'] + '</td>';
                    htmls += '<td><a class="btn btn-primary" href="<?php echo base_url('index.php/UserRecordManagement/update_order_status') ?>/' + jsonData[i]['id'] + '">update</a></td>';
                    htmls += '</tr>';
                    count++;
                }
                $('#status_report').html(htmls);
            }
        });
    }
</script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/masked-input/masked-input.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/password-indicator/js/password-indicator.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-plugins.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageTableTools.init();
        FormPlugins.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?> 