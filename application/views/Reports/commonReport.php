<?php
$this->load->view('layout/layoutTop');
?>
<style>
    .modal-header{
        border-bottom-color: white;
    }
</style>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        var data1 = google.visualization.arrayToDataTable([
            ['<?php echo $chart_data['chart1']['heads'][0]; ?>', '<?php echo $chart_data['chart1']['heads'][1]; ?>'],
<?php
foreach ($chart_data['chart1']['data']as $key => $value) {
    echo
    "['" . $key . "', " . $value . "],";
}
?>
        ]);
        var data2 = google.visualization.arrayToDataTable([
            ['<?php echo $chart_data['chart2']['heads'][0]; ?>', '<?php echo $chart_data['chart2']['heads'][1]; ?>'],
<?php
foreach ($chart_data['chart2']['data']as $key => $value) {
    echo "['" . $key . "', " . $value . "],";
}
?>
        ]);
        var options1 = {
            title: '<?php echo $chart_data['chart1']['heading']; ?>',
            is3D: true,
        };
        var options12 = {
            title: '<?php echo $chart_data['chart1']['heading']; ?>',
            is3D: true,
            width: 500,
            height: 400,
        };
        var options2 = {
            title: '<?php echo $chart_data['chart2']['heading']; ?>',
            is3D: true,
        };
        var options22 = {
            title: '<?php echo $chart_data['chart2']['heading']; ?>',
            is3D: true,
            width: 500,
            height: 400,
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('workingpiechart1'));
        chart1.draw(data1, options1);
        var chart12 = new google.visualization.PieChart(document.getElementById('workingpiechart2'));
        chart12.draw(data1, options12);
        var chart2 = new google.visualization.PieChart(document.getElementById('callTypepiechart1'));
        chart2.draw(data2, options2);
        var chart22 = new google.visualization.PieChart(document.getElementById('callTypepiechart2'));
        chart22.draw(data2, options22);
    }
</script> 
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['<?php echo $chart_data['chart3']['heads'][0]; ?>', '<?php echo $chart_data['chart3']['heads'][1]; ?>'],
<?php
foreach ($chart_data['chart3']['data'] as $key => $value) {
    echo "['" . $key . "', " . $value . "],";
}
?>
        ]);
        var options = {
            title: '<?php echo $chart_data['chart3']['heading']; ?>',
            hAxis: {
                title: 'Date', titleTextStyle: {
                    color: 'red'
                }
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('leadDateGraph'));
        chart.draw(data, options);
    }
</script>


<div class="col-md-12">


    <form method="post" id="statics">
        <div class="col-md-12" style="margin-left: -20px;">
            <div class="col-md-4" >
                <div class="input-group" style="width: 100%;">
                    <input type="text" name="client" class="form-control "  placeholder="Search Client" id="searchUser" data-provide="typeahead" style="    background: #FFFFFF;
                           opacity: 1;width:100%" value='<?php echo $client; ?>'>
                    <input type="hidden" name="client_id" value='<?php echo $user_id; ?>'>
                    <span class="input-group-btn">

                        <button class="btn btn-default" type="button" id='remove_search_data'> <i class="fa fa-times"></i></button>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group" id="daterangepicker">
                    <input type="text" name="daterange" class="form-control dateFormat"  placeholder="click to select the date range" readonly="" style="    background: #FFFFFF;
                           opacity: 1;" value="<?php echo $dateRange; ?>">
                    <span class="input-group-btn">

                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-info" name="search"><i class="fa fa-search"></i> Search</button>
            </div>

        </div>
    </form>

    <div class="col-md-12"><hr></div>



    <!-- ######################## -->
    <!-- Modal -->
    <div class="col-md-6" >
        <div class="panel panel-solid " style='height: 230px'>
            <div id="leadDateGraph" style="width: 100%; height: 100%;"></div>
        </div>      
    </div>
    <div class="modal fade" id="userSale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div id="workingpiechart2" style="width: 100%; height: 100%;">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-solid">
            <button class='btn btn-default btn-sm'  data-toggle="modal" data-target="#userSale">
                <i class="glyphicon glyphicon-zoom-in"></i>
            </button>
            <div id="workingpiechart1" style="width: 100%; height: 100%;"></div>
        </div>
    </div>
    <!-- second -->
    <div class="modal fade" id="byeSale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                    <div id="callTypepiechart2" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>    
    <div class="col-md-3" id="leadTypeChart">
        <div class="panel panel-solid ">
            <button class='btn btn-default btn-sm' data-toggle="modal" data-target="#byeSale">
                <i class="glyphicon glyphicon-zoom-in"></i>
            </button>
            <div id="callTypepiechart1" style="width: 100%; height: 100%;">
            </div>
        </div>
    </div>

    <!-- third -->




    <div style='clear: both'></div>
    <!-- model ------------------>
    <!-- tabing -->
    <div style='clear: both'></div>
    <div class="col-md-12" style="margin-top: 10px">

        <div role="tabpanel">
            <!-- Nav tabs -->
            <h3><?php echo $tab_top_heading; ?></h3>
            <ul class="nav nav-tabs" role="tablist" style="font-size: 15px">
                <?php foreach ($tab_data as $key => $value) { ?>
                    <li role="presentation" class="<?php echo $key == 'tab0' ? 'active' : ''; ?>">
                        <a href="#<?php echo $key; ?>" aria-controls="<?php echo $key; ?>" role="tab" data-toggle="tab">

                            <?php echo $value['tab_heading']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <!-- ##############################################  -->
            <div class="tab-content">
                <?php foreach ($tab_data as $key => $value) { ?>
                    <div role="tabpanel" class="tab-pane <?php echo $key == 'tab0' ? 'active' : ''; ?> " id="<?php echo $key; ?>"> 
                        <!--<code for distributor sales>-->   

                        <div class="panel panel-solid">


                            <div class="panel-body">
                                <a class="btn btn-default" data-toggle="" data-placement="left" title="Download Pdf"  style="margin-top: -20px;background: black;border-color: gray;    float: right;" target="_blanck" href="<?php echo base_url(); ?>index.php/Reports/common_report/?daterange=<?php echo $dateRange; ?>&report_type=<?php echo $report_type; ?>&req2=<?php echo $key; ?>&req1=tab_data&user_id=<?php echo $user_id; ?>&user_name=<?php echo $client; ?>">
                                    <i class="fa fa-download"></i> 
                                </a>


                                <hr>

                                <table class="data_table table table-striped table-bordered table-hover filterTable" id="">
                                    <thead>

                                        <tr>

                                            <?php
                                            $tab_table_head = $value['heads'];
                                            echo "<td>S. No.</td>";
                                            foreach ($tab_table_head as $key1 => $value1) {
                                                echo " <td>" . $value1 . "</td>";
                                            }
                                            ?>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $count = 0;
                                        foreach ($value['data'] as $key1 => $value1) {
                                            ?>
                                            <tr>
                                                <?php
                                                $count ++;

                                                echo "<td>", $count, "</td>";
                                                foreach ($tab_table_head as $key => $value) {
                                                    ?>
                                                    <td><?php echo $value1[$value]; ?></td>
                                                <?php } ?>

                                            </tr>   
                                        <?php } ?>


                                    </tbody>
                                </table>
                            </div>
                            <!--   <form>
                                   <input type="submit" name="xlsreport" value="XLS Report" class="btn btn-primary" style="margin: 0px 0px 0px 16px;">
                                </form> -->
                            <div style="clear:both"></div>
                        </div>
                    </div>
                <?php } ?>
                <!-- ######################################### -->

            </div>
        </div>
    </div>
    <!-- tabing end-->
    <div class="col-md-12">
        <div class="panel panel-solid">
            <div class="panel-body">
                <a class="btn btn-default" data-toggle="" data-placement="left" title="Download Pdf"  style="background: black;border-color: gray;    float: right;" target="_blanck" href="<?php echo base_url(); ?>index.php/Reports/common_report/?daterange=<?php echo $dateRange; ?>&report_type=<?php echo $report_type; ?>&req2=all_report&req1=all_data&user_id=<?php echo $user_id; ?>&user_name=<?php echo $client; ?>">
                    <i class="fa fa-download"></i> 
                </a>
                <hr style="margin-top: 41px !important;">
                <div style="clear:both"></div>
                <div class="col-md-12" style="margin-top:0px">
                    <table id="data_table" class="table table-striped table-bordered data_table">
                        <thead>

                            <tr>
                                <?php
                                echo "<td>S. No.</td>";
                                foreach ($table_head as $key => $value) {
                                    ?>
                                    <td><?php echo $value; ?></td>
                                <?php } ?>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (count($table_data)) {
                                $count = 0;
                                foreach ($table_data as $key1 => $value1) {
                                    ?>
                                    <tr>
                                        <?php
                                        $count ++;

                                        echo "<td>", $count, "</td>";
                                        foreach ($table_head as $key => $value) {
                                            ?>
                                            <td><?php echo $value1[$key]; ?></td>
                                        <?php } ?>

                                    </tr>   
                                    <?php
                                }
                            }
                            ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('layout/layoutBottom');
?>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
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
        // FormPlugins.init();
        TableManageTableTools.init();


    });



</script>
<?php
$this->load->view('layout/layoutFooter');
?>

<script>
    $(function () {
        $("#daterangepicker").daterangepicker({
            format: 'YYYY-MM-DD',
            dateLimit: {days: 60},
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                "Today's": [moment(), moment()],
                "Yesterday's": [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        }, function (start, end, label) {
            $('input[name=daterange]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
        $(".data_table").DataTable();
    })

</script>


<script>
    $(document).ready(function () {
        var customers = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('client_code'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
<?php
$baselink = 'http://' . $_SERVER['SERVER_NAME'];
$baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';
?>
                url: "<?php echo $baselinkmain; ?>/producthandler/customer_search.php?searchText=%QUERY%",
                wildcard: '%QUERY%'
            }
        });


        customers.initialize(); // customer mobile search init


        /////////////////// Search Customer type ahead ////////////////////////////////////
        $('#searchUser').typeahead({highlight: true},
        {
            name: 'customers',
            displayKey: 'client_code',
            limit: 8,
            source: customers.ttAdapter(),
            templates: {
                header: '<b class="typeaheadgroup text-primary"><i class="fa fa-search"></i>&nbsp;Clinet Information</b>',
            },
        }).bind('typeahead:selected', function (obj, datum) {
            $("input[name='client_id']").val(datum.id);
            $("input[name='client']").val(datum.client_code);
            $("#statics").submit();
            //var link = '<?php echo base_url('index.php/UserRecordManagement/user_detail_info/'); ?>' + '/' + userId;
            //window.open(link, "_self");
        });

        $("#remove_search_data").click(function () {
            $("input[name='client_id']").val('');
            $("input[name='client']").val('');
            $("#statics").submit();
        });

    });
</script> 