<?php
$this->load->view('layout/layoutTop');
//print_r($data[0]);
?>

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-edit"></i> Set Date Schedule <br>
                <p style="font-size:14px">
                <span>Location : </span><span><?php echo $data[0]['location']; ?></span><br>
                <span>Address :  </span><span><?php echo $data[0]['address']; ?></span> 
                </p>
            </h4>
        </div>
        <div class="panel panel-body">
            <div class="col-md-12">
                <form method="post">

                    <div class="form-group">
                        <table> 

                            <td>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" >Select Date</button>
                            </span>
                            <div class="input-group default-daterange" id="default-daterange">
                                <input type="text" name="default-daterange" class="form-control" value="<?php echo date('Y-m-d') . '  To  ' . date('Y-m-d') ?>" placeholder="click to select the date range" style="width: 100%;margin: -34px 0px 0px 91px;"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" style="margin: -34px 0px 0px 90px;"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>

                            </td>
                        </table>
                    </div>

                    <button type = "submit" class = "btn btn-primary btn-xs" name="date_range_submit">
                       <b>Submit</b>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
                <i class="fa fa-edit"></i> All Date Schedule <br>

            </h4>
        </div>
        <div class="panel panel-body">

            <table id="location_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>S.No.</th>
                    <th>Dates</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    if(!empty($temp_data)){
                    for ($i = 0; $i < count($temp_data); $i++) {
                        $res = $temp_data[$i];
                        ?>
                        <tr>

                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $res['start_date'] . ' To ' . $res['end_date'] ?></td>
                        <td><a href="<?php echo base_url(); ?>index.php/Appointment/time_scheduler/<?php echo $res['id'] ?>" class = "btn btn-primary btn-xs" ><b>Set Time Schedule</b></a></td>
                        </tr>
                    <?php }  }?>
                        
                </tbody>
            </table>


        </div>
    </div>
</div>

<?php
$this->load->view('layout/layoutBottom');
?>

<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/masked-input/masked-input.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/password-indicator/js/password-indicator.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-plugins.demo.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        $("#location_table").DataTable();
        $("select[name='data-table_length']").hide();
        $(".dataTables_length").hide();
        $(".dataTables_filter").hide();
        $(".dataTables_info").hide();
        $("#data-table_paginate").hide();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>

<script>
    $(function () {
        $('.default-daterange').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' To ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2018',
        },
                function (start, end) {
                    $('#default-daterange input').val(start.format('YYYY-MM-DD') + ' To ' + end.format('YYYY-MM-DD'));
                });
    });


</script>