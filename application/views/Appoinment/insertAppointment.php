<?php
$this->load->view('layout/layoutTop');
?>

<div class="col-md-4">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; "><i class="fa fa-map"></i> Add Country</h4>
        </div>
        <div class="panel panel-body">
            <form method="post" class="pure-form">
                <label class="control-label" style="">Country Name</label>
                <input type="text" class="form-control" placeholder="Enter country name" name="city_name" required style="width:260px">
                <button type="submit" name="add_city" class="btn btn-primary" style="margin: -54px 0px 0px 257px;">
                    <i class="fa fa-plus"></i>
                </button>


            </form>
            <hr>
            <table  id="data-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <td>S.No.</td>
                    <td>City</td>
                    <td>Edit</td>
                    </tr>
                </thead>
                <tbody class="tbody" id="tableShort">

                    <?php
                    $count = 1;
                    foreach ($result as $key => $value) {

                        echo '<tr>';
                        echo '<td>' . $count . '</td>';
                        echo '<td>' . $value['title'] . '</td>';
                        echo '<td><button class="btn btn-primary"><i class="fa fa-edit"></i></button></td>';
                        echo '</tr>';
                        $count +=1;
                    }
                    ?>


                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="col-md-8">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style ="font-size:17px; font-weight:500; "><i class="fa fa-edit"></i> Set Appointment Detail</h4>
        </div>
        <div class="panel panel-body">
            <form method="post" class="">
                <div>
                    <div class="col-md-6">
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="control-label" >Select City</label>
                            <select class="form-control"  name="main_city_name">
                                <?php
                                foreach ($result as $key1 => $value1) {

                                    echo '<option value="' . $value1['id'] . '">' . $value1['title'] . '</option>';
                                }
                                ?> 
                            </select>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="control-label" >Location</label>
                            <input type="text" required name="location" class="form-control"  value="" >
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="control-label" style="">Address (Line 1)</label>
                            <input type="text" required name="address1" class="form-control"  value="" >
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="control-label" style="">Address (Line 2)</label>
                            <input type="text" required name="address2" class="form-control"  value="" >
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="control-label" style="">City</label>
                            <input type="text" required name="city" class="form-control"  value="" >
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="control-label" style="">State</label>
                            <input type="text" required name="state" class="form-control"  value="" >
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <label class="control-label" style="">Contact No.</label>
                            <input type="text" required name="contact_no" class="form-control"  value="" >
                        </div>


                    </div>


                </div>

                <div style="clear: both"></div>

                <button type="submit" name="set_appoinment" class="btn btn-primary" value="" style="margin: 0px 0px 0px 30px;">
                    Submit
                </button>

            </form>
            <hr>

            <table id="location_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Country Name</th>
                    <th>City</th>
                    <th>Location</th>
                    <th>Set Date</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($temp_data); $i++) {
                        $res = $temp_data[$i];
                        ?>
                        <tr>
                        <td><?php echo $res['title'] ?></td>
                        <td><?php echo $res['city'] ?></td>
                        <td><?php echo $res['location'] ?></td>
                        <td><button  class = "btn btn-primary btn-xs" data-toggle = "modal" data-target = "#myModal_<?php echo $res['id'] ?>">Set Dates</button></td>
                        </tr>


                        <!-- Modal -->
                        <div class = "modal fade" id = "myModal_<?php echo $res['id'] ?>" tabindex = "-1" role = "dialog" 
                             aria-labelledby = "myModalLabel" aria-hidden = "true">

                            <div class = "modal-dialog">
                                <form method="post">
                                    <div class = "modal-content">

                                        <div class = "modal-header">
                                            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                                                &times;
                                            </button>

                                            <h4 class = "modal-title" id = "myModalLabel">
                                                This Modal title
                                            </h4>
                                        </div>
                                        <input type="hidden" value="<?php echo $res['id'] ?>" name="nfw_set_appointment">
                                        <div class = "modal-body">

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Default Date Ranges</label>
                                                <div class="col-md-8">
                                                    <div class="input-group default-daterange" id="default-daterange">
                                                        <input type="text" name="default-daterange" class="form-control" value="" placeholder="click to select the date range" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="clear:both"></div>
                                        </div>

                                        <div class = "modal-footer">


                                            <button type = "submit" class = "btn btn-primary" name="date_range_submit">
                                                Submit changes
                                            </button>
                                        </div>

                                    </div><!-- /.modal-content -->
                                </form>
                            </div><!-- /.modal-dialog -->

                        </div><!-- /.modal -->

                    <?php } ?>
                </tbody>
            </table>


        </div>

    </div>
</div>

<?php
$this->load->view('layout/layoutBottom');
?>

<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/moment.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        //FormPlugins.init();
        $('#timepicker').timepicker();
        $('#timepicker1').timepicker();
        $("#location_table").DataTable();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>
<script>
    $(function () {

        $("select[name='data-table_length']").hide();
        $(".dataTables_length").hide();
        $(".dataTables_filter").hide();
        $(".dataTables_info").hide();
        $("#data-table_paginate").hide();
    });
</script>
<script>

    $(".dateFormat").datepicker({'format': 'yyyy-mm-dd'})
            .on('changeDate', function (ev)
            {
                $('.datepicker').hide();
            }
            );
</script> 
<script>
    $(function () {
        $('.default-daterange').daterangepicker({
            opens: 'right',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2018',
        },
                function (start, end) {
                    $('#default-daterange input').val(start.format('YYYY-MM-DD') + 'to' + end.format('YYYY-MM-DD'));
                });
    });


</script>