<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">

            <h4 style="font-size: 17px;font-weight: 500;" class="panel-title">Order Reports</h4> 
        </div>

        <div class="panel-body">
            <form method="post">
                <div class="col-md-12" style="    padding-bottom: 15px;">
                    Search orders information according to status, client and date.
                    <div class="btn-group btn-group-sm pull-right" >
                        <a class="btn btn-info"  data-toggle="" data-placement="top" title="Download Xls"  href="<?php echo base_url('index.php/AllXlsReport/order_report/' . $dateRange . '/' . $order_status . '/' . $user_id) ?>" ><i class="fa fa-file-excel-o"></i> </a>
                        <a class="btn btn-primary"  data-toggle="" data-placement="left" title="View Pdf"     href="<?php echo base_url('index.php/UserRecordManagement/pdf_report/I/' . $dateRange . '/' . $order_status . '/' . $user_id) ?>" target="_blanck"><i class="fa fa-file-pdf-o"></i> </a>
                        <a class="btn btn-success"  data-toggle="" data-placement="left" title="Download Pdf" href="<?php echo base_url('index.php/UserRecordManagement/pdf_report/D/' . $dateRange . '/' . $order_status . '/' . $user_id) ?>" target="_blanck"><i class="fa fa-download"></i> </a>

                    </div>
                </div>
                <div class="col-md-12" style="">


                    <div class="col-md-3" style="padding-left: 0px;">
                        <div class="input-group" id="daterangepicker">
                            <input type="text" name="daterange" class="form-control dateFormat"  placeholder="click to select the date range" readonly="" style="    background: #FFFFFF;
                                   opacity: 1;" value="<?php echo $dateRange; ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4" style="    padding-left: 0px;">
                        <div class="input-group" style="width: 100%;">
                            <input type="text" name="client" class="form-control "  placeholder="Search Client" id="searchUser" data-provide="typeahead" style="    background: #FFFFFF;
                                   opacity: 1;width:100%" value='<?php echo $client; ?>'>
                            <input type="hidden" name="client_id" value='<?php echo $user_id; ?>'>
                            <span class="input-group-btn">

                                <button class="btn btn-default" type="button" id='remove_search_data' style="margin-top: -4px;"> <i class="fa fa-times"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding-left: 0px;">
                        <div class="input-group" style="width: 100%;">
                            <span class="input-group-addon" id="basic-addon1">Order Status</span>
                            <select name="order_status" class="form-control "   style="    background: #FFFFFF;
                                    opacity: 1;width:100%" >
                                    <?php
                                    echo "<option value='0'>All</option>";
                                    foreach ($orderStatus as $key => $value) {
                                        echo "<option value='", $value['id'], "'>", $value['title'], "</option>";
                                    }
                                    ?>
                            </select>

                        </div>
                    </div>

                    <div class="col-md-1" style="padding: 0px;">
                        <button class="btn btn-info" name="search"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </form>

            <div class="col-md-12"><hr></div>
            <div class="col-md-12">

                <div class="table-responsive">
                    <style>
                        table.custom_table{
                            width: 100%;margin: 5px 0;
                        }
                        table.custom_table td {
                            border-right: 1px solid #D0D0D0;
                            border-bottom: 1px solid #D0D0D0;
                            height: 100%;
                            padding: 4px!important;
                        }
                        table.custom_table td:last-child {
                            border-right: 0px solid #D0D0D0;
                            border-bottom: 1px solid #D0D0D0;
                            height: 100%;
                            padding: 4px!important;
                        }
                        .csku{
                            width:40%;
                        }
                        .citem{
                            width: 50%;
                        }
                        .ctotal{
                            width: 10%;
                        }
                        .rightalign{
                            text-align: right!important;
                        }
                    </style>
                    <table  class="table table-striped table-bordered data_table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">S.No.</th>
                                <th style="width: 10%;">Date/Time</th>
                                <th style="width: 16%;">Client</th>
                                <th style="width: 10%;">Order No./<br/>Invoice No.</th>
                                <th style="width: 30%;padding: 0px">
                        <table class="custom_table">
                            <tr><td class="csku">SKU</td><td class="citem">Item Name</td><td class="ctotal">Q.</td></tr>
                        </table>
                        </th>
                        <th style="width: 5%;">Qty.</th> 
                        <th style="width: 10%;">Price</th>

                        <th style="width: 10%;">Status</th>

                        <th style="width: 7%">Update status</th>
                        </tr>
                        </thead>
                        <tbody id="status_report"> 
                            <?php
                            $count = 1;
                            $totalq = 0;
                            $totalg = 0;
                            if ($orderHistory) {
                                foreach ($orderHistory as $key => $value) {
                                    echo '<tr>';
                                    echo '<td>' . $count . '</td>';
                                    echo '<td>' . $value['op_date'] . ' ' . $value['op_time'] . '</td>';

                                    $user_info = $this->User_model->phpjsonstyle($value['user_info'], 'php');



                                    echo '<td class="capitalize">' . $user_info['first_name'] . '  ' . $user_info['last_name'] . '<br/>(' . $user_info['registration_id'] . ')<br/>M:' . $user_info['contact_no'] . '</td>';
                                    echo '<td>' . $value['order_no'] . '/<br/>' . $value['invoice_no'] . '</td>';

                                    $skudata = $this->User_model->xls_report_data($value['order_id']);

                                    $temp2 = [];
                                    if (count($skudata)) {
                                        foreach ($skudata as $s => $value1) {
                                            $v1 = "<td class='csku'>" . $value1['sku'] . '</td><td class="citem">' . $value1['item_name'] . '</td><td class="cprice">' . $value1['quantity'] . "</td>";
                                            array_push($temp2, $v1);
                                        }
                                    }

                                    echo '<td style="padding:0px"><table class="custom_table">' . implode("</tr><tr>", $temp2) . '</tr></table></td>';
                                    $totalq += $value['total_quantity'];
                                    $totalg += explode('$', $value['total_price'])[1];
                                    echo '<td>' . $value['total_quantity'] . '</td>';
                                    echo '<td>$' . number_format(explode('$', $value['total_price'])[1], 2, '.', '') . '</td>';
                                    echo '<td>' . $value['title'] . '<br/>' . $value['status_date'] . '</td>';
//                                    echo '<td><a class="btn btn-xs btn-info" href="' . base_url('index.php/UserRecordManagement/order_full_detail/' . $value['order_id']) . '">Detail</a></td>';
                                    echo '<td><a href = "' . base_url('index.php/UserRecordManagement/update_order_status/' . $value['order_id']) . '/' . $value['user_id'] . '" class="btn btn-info btn-xs"> Update Now </a>
                                                  </td>';
                                    echo '</tr>';
                                    $count++;
                                }
                            }
                            ?> 
                        </tbody> 

                    </table>
                </div>
                <table style="    font-size: 18px;">

                    <tr>
                        <th class="rightalign">Total Quantity:</th>
                        <th class=""> &nbsp;&nbsp;<?php echo $totalq; ?></th>
                    </tr>
                    <tr>
                        <th class="rightalign">Grand Total:</th>
                        <th class=""> &nbsp;&nbsp;$<?php echo number_format($totalg, 2, '.', ''); ?></th>

                    </tr>

                </table>

            </div>
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
        // FormPlugins.init();
        TableManageTableTools.init();
    });


    $(function () {
        $("#daterangepicker").daterangepicker({
            format: 'YYYY-MM-DD',
          
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
<?php
$this->load->view('layout/layoutFooter');
?>
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
        $("select[name=order_status]").val("<?php echo $order_status; ?>")
    });
</script> 