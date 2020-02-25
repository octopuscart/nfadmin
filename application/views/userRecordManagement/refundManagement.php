<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

            </div>
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;  "><i class="fa fa-money"></i> Refund Management</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <form id="statics">
                    <div class="input-group" style="width: 100%;">
                        <input type="text" name="client" class="form-control "  placeholder="Search Client" id="searchUser" data-provide="typeahead" style="    background: #FFFFFF;
                               opacity: 1;width:100%" value='<?php echo $client; ?>'>
                        <input type="hidden" name="client_id" value='<?php echo $user_id; ?>'>
                        <span class="input-group-btn">

                            <button class="btn btn-default" type="button" id='remove_search_data' style="margin-top: -4px;"> <i class="fa fa-times"></i></button>
                        </span>
                    </div>
                </form>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">
                            Client Orders
                        </h1>
                    </div>
                    <div class="panel-body">

                        <table  class="table table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th style="width:200px"> Order No. / Invoice No. </th>
                                    <td><b>Refundable</b> <br/> (Total - Pre. Refund)</td>
                                    <th> </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (count($order_data)) {
                                    foreach ($order_data as $key => $value) {
                                        // for ($i = 0; $i < 50; $i++) {
                                        echo "<tr>";

                                        echo "<td><span class='select_order_no'>", $value['order_no'], "</span>/ <span class='select_invoice_no'>", $value['invoice_no'], "</span><br/><small class='select_datetime'>(", $value['datetime'], ")</small>", "</td>";
                                        echo "<td style='text-align:right'>", $value['total_price'], '  -  ', "$" . number_format($value['refund'], 2, '.', ''), '  =  <b class="total_amount">', "$" . number_format($value['refundable'], 2, '.', ''), "</b></td>";

                                        echo "<td style='width:10px;padding:auto 5px'><button class='btn btn-warning btn-xs select_refund' value='", $value['id'], "'><i class='fa fa-share-square-o'></i> </td>";

                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">
                            Add credit to client
                        </h1>
                    </div>
                    <div class="panel-body">
                        <h3 style="    border-bottom: 1px solid #000;margin-top: 0;
                            padding: 10px;">
                            <small>Client Name</small><br/>
                            <?php echo $client; ?>
                        </h3>
                        <table style="font-size: 15px;width:100%;
                               color: #CE4569;">
                            <tr>
                                <th style="width:90px;">Order No. </th>
                                <td>:&nbsp;<span id="order_no">--</span>
                                </td>
                                <td rowspan="3" style="text-align:right">Date Time<br/>
                                    <span id="datetime_select" style="    border-top: 1px solid #EFCECE;" ></span>
                                </td>
                            </tr>

                            <tr>
                                <th>Invoice No. </th>
                                <td>:&nbsp;<span id="invoice_no">--</span>
                                </td>
                            </tr>
                        </table>


                        <h3 class="pull-left">
                            <small>Refundable Amount</small> <br/>
                            <span id="total_amount">$0.00</span>
                        </h3>
                        <h3 class="pull-right">
                            <small>Wallet Balance</small> <br/>
                            <span id="total_amount">
                                <?php echo $balance; ?>
                            </span>
                        </h3>
                        <div class="col-md-12" style="    padding: 10px 0px;
                             border-top: 1px solid #DEDEDE;">


                            <form method="post"> 

                                <div class="form-group pull-left" style="    width: 140px;">
                                    <label class=" control-label" style=" text-align: right; font-weight: 600;font-size: 13px;">Enter Refund Amount</label>
                                    <input type="hidden" name="order_id">
                                    <input type="hidden" name="txn_type" value="Refund">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                    <input class="form-control is_number" type="text" name="credit_amt" required style="width: 100%;font-size: 15px;" value="">

                                </div>
                                <div class="form-group pull-right" style="width: 200px;
                                     text-align: right;">
                                    <h4>
                                        <small style='    font-size: 14px;'>Reference No.</small> <br/>
                                        <?php echo $reference_no; ?>
                                        <input type="hidden" name="reference_id" value="<?php echo $reference_no; ?>">
                                        <input type="hidden" name="date_time" value="<?php echo date('Y-m-d h:m:s'); ?>">
                                    </h4>
                                </div>

                                <div class="form-group pull-left" style="    width: 100%;margin-bottom: 20px">
                                    <label class=" control-label" style=" text-align: right; font-weight: 600;font-size: 13px;">Reason for Refund</label>

                                    <textarea class="form-control" name="remark" style="width: 100%;" rows="6" required></textarea>

                                </div>
                                <button type="submit" class="btn btn-primary pull-left " disabled="true" name="refund_now">
                                    <i class="fa fa-thumbs-up"></i> Refund Now
                                </button>



                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<?php
$this->load->view('layout/layoutBottom');
?>

<script>
    $(document).on("click", ".select_refund", function () {
        var trobj = $(this).parents("tr").first();
        var order_no = $(trobj).find(".select_order_no").text();
        $("#order_no").text(order_no);

        var invoice_no = $(trobj).find(".select_invoice_no").text();
        $("#invoice_no").text(invoice_no);

        var datetimes = $(trobj).find(".select_datetime").text();
        datetimes = datetimes.replace("(", "").replace(")", "");
        $("#datetime_select").text(datetimes);


        var amount = $(trobj).find(".total_amount").text();
        $("#total_amount").text(amount);

        var order_id = $(this).val();
        $("input[name=order_id]").val(order_id);

        $("button[name='refund_now']").attr("disabled", false);

    })


    $("input[name=credit_amt]").keyup(function () {

        var order_amt = $("#total_amount").text();
        order_amt = Number(order_amt.replace("$", ""));
        var amt = Number($(this).val());
        if (amt > order_amt) {
            alert("You can't enter greter amount then order amount");
            $(this).val("");
        }

    })

    $(document).ready(function () {
        var customers = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('client_code'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
<?php
$baselink = 'http://' . $_SERVER['SERVER_NAME'];
$baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend' : $baselink . '/frontend';
?>
                //url: "http://192.168.3.47/nf3/frontend/producthandler/customer_search.php?searchText=%QUERY%",
                url: "<?php echo $baselinkmain; ?>/producthandler/customer_search.php?searchText=%QUERY%",
                wildcard: '%QUERY%'
            },
        });
        customers.initialize(); // customer mobile search init


        /////////////////// Search Customer type ahead ////////////////////////////////////
        $('#searchUser').typeahead(
                {highlight: true},
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
    });</script> 

<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-plugins.demo.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {

        App.init();
        TableManageDefault.init();
        //FormPlugins.init();
        $(".data_table").DataTable({
            "ordering": false,
            "lengthChange": false,
            "info": false,
        });
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
<?php
$this->load->view('layout/layoutFooter');
?> 
