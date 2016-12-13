<?php
$this->load->view('layout/layoutTop');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />

<script src="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/lib/pikaday.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/lib/pikaday.css" />

<script src="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/lib/jquery.ptTimeSelect.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/lib/jquery.ptTimeSelect.css" />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" type="text/css" media="all" />

<script src="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/lib/moment.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/lib/site.js"></script>-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/lib/site.css" />-->

<script src="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/dist/datepair.js"></script>
<script src="<?php echo base_url(); ?>assets_main/date-time/Datepair.js-master/dist/jquery.datepair.js"></script>


<div class="panel panel-inverse" data-sortable-id="index-5">
    <div class="panel-heading">
        <h4 class="panel-title" style ="font-size:17px; font-weight:500; ">
            <i class="fa fa-edit"></i> Set Time Schedule
        </h4>
        <table>
            <tr style="border-top: 1px solid #B3A7A7;font-size: 16px">
                <td><span>Location</span></td>
                <td>&nbsp;:&nbsp;</td>
                <td> <b><?php echo $adress[0]['location'].' ('.$adress[0]['country'].' )'; ?></b></td>
            </tr>
            <tr>
                <td><span>Address</span></td>
                 <td>&nbsp;:&nbsp;</td>
                <td><b><?php echo $adress[0]['address']; ?></b></td>
            </tr>
            <tr>
                <td><span>Start Date </span></td>
                 <td>&nbsp;:&nbsp;</td>
                <td><b><?php echo current($all_dates); ?></b></td>
            </tr>
            <tr>
                <td> <span>End Date </span></td>
                 <td>&nbsp;:&nbsp;</td>
                <td><b><?php echo end($all_dates); ?></b></td>
            </tr>

        </table>
    </div>
    <div class="panel panel-body">

        <div class='col-md-12'> 
            <table id="location_table" class="table table-striped table-bordered" style="">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Set Time</th>
                        <th>Seted Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($all_dates); $i++) {
                        $data = $all_dates[$i];
                        ?>
                        <tr>
                            <td><?php echo $data; ?></td>
                            <td>
                                <button s_date="<?php echo $data; ?>" class="btn btn-primary btn-xs  make_appointment"  data-toggle = "modal" data-target = "#myModal"  last_time="12:00am">
                                    <i class='fa fa-plus'></i><b>Set Time</b>
                                </button>
                            </td>
                            <td class="last_td">
                                <?php
                                if (!empty($date_date)) {
                                    for ($k = 0; $k < count($date_date); $k++) {
                                        $vals = $date_date[$k];

                                        if ($vals['schedule_date'] === $data) {
                                            ?>

                                            <div class="btn-group btn-group" role="group" aria-label="...">
                                                <form method="post">
                                                    <button  class="btn btn-success btn-xs last_td_btn"><b><?php echo strtoupper($vals['schedule_start_time']) ; ?></b></button>
                                                    <button type="submit" name="deletesubmit" class="btn btn-danger btn-xs " style="margin-left: -6px;"><i class="fa fa-trash-o"></i></button>
                                                    <input type="hidden" name="time_id" value="<?php echo $vals['id'] ?>">

                                                </form>

                                            </div>


                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


    </div>
</div>


<!-- Modal -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">

    <div class = "modal-dialog">
        <div class = "modal-content">
            <form method="post">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                        &times;
                    </button>

                    <h4 class = "modal-title" id = "myModalLabel">
                        <i class='fa fa-clock'></i> Set Time Interval For Date <spna id="time_interval"></span>
                    </h4>
                </div>

                <div class = "modal-body">
                    <input type="hidden" name='app_date' >

                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="control-label">Enter Start And End Time Schedule</label><br>
                            <div class="row row-space-10" id="basicExample1">
                                <div class="col-md-12">
                                    <input type="text" class="time start form-control" name="start_time"  placeholder="Start Time" />
                                </div>
                                <div class="">
                                    <input type="hidden" class="time end form-control" name="end_time"  placeholder="End Time" />
                                </div>
                            </div>
                        </div>


                    </div>
                    <div style="clear: both"></div>
                </div>

                <div class = "modal-footer">


                    <button type = "submit" class = "btn btn-danger btn-xs pull-left" name="submitPOP">
                        <b>Submit</b> 
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->


<script src="<?php echo base_url(); ?>assets_main/plugins/date.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/moment.js"></script>
<!--<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets_main/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->
<script src="<?php echo base_url(); ?>assets_main/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/DataTables/js/dataTables.tableTools.js"></script>
<!--<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>-->

<script src="<?php echo base_url(); ?>assets_main/js/table-manage-default.demo.min.js"></script>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 

<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
    });
</script>

<script>
    $(document).ready(function () {
        $(".make_appointment").click(function () {
            var ids = $(this).attr('s_date');
            //console.log(ids);
            $("input[name='app_date']").val(ids);
            $("#time_interval").text(ids);
        });
    });
</script>

<script>

    var datepair1;
    function setdatedata(mintime) {
        $('#basicExample1 .time').timepicker("remove");
        $('#basicExample1 .time').timepicker({
            'minTime': mintime,
            'showDuration': true,
            'timeFormat': 'g:ia'
        });
        datepair1 = new Datepair(document.getElementById('basicExample1'));

    }

    $(document).ready(function () {

        $(".make_appointment").click(function () {

            var temp = $(this).parent().parent().find('td:last').find('.last_td_btn').last().text();
            var temp1 = temp.split("-")[1];
            var mintime = temp1 ? temp1 : '12:00am';
            $('input[name="start_time"]').attr("min", mintime );
            setdatedata(mintime);
        });
        
    });

</script>







