<?php
$this->load->view('layout/layoutTop');
$invoiceData = $this->Product_model->get_table_information('nfw_order_invoice', 'order_id', $order_id);
$orderData = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
$orderNo = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
$currentStatus = $order_status_record[0]['status_tag'];
$orderData = $this->User_model->get_product_information($order_id);

function phpjsonstyle($data, $data_type) {

    $data = trim(trim($data, "{"), "}");
    $t = explode(",", $data);

    $temp = array();
    foreach ($t as $key => $value) {
        $t1 = explode(':', $value);
        $temp1 = $t1[0];
        $temp2 = $t1[1];
        $tt1 = trim($temp1, '"');
        $tt2 = trim($temp2, '"');
        $temp[$tt1] = $tt2;
    }

    if ($data_type == 'php') {
        return $temp;
    }
    if ($data_type == 'json') {
        return json_encode($temp);
    }
}
?>
<style>
    .close{
        opacity: 1;
    }
    .modal-header{
        padding: 8px 9px;
        background: black;
    }
    .tds{
        padding: 8px;
        line-height: 0.42857143 !important;
        vertical-align: top;
        //border-bottom: 1px solid;


    }
</style>
<div class="col-md-12">
    <!-- begin invoice -->
    <div class="invoice panel panel-body">
        <div class="invoice-company">
            <span class="pull-left"> <?php echo 'Nita Fashions'; ?></span>
            <span class="pull-right" style="margin: 0px 5px"><a href="<?php echo base_url('index.php/UserRecordManagement/worker_order_receipt_pdf/' . $order_id . '/' . $billing_info[0]['id'] . '/' . $shipping_info[0]['id'] . '/' . $user_info[0]['id']); ?>/all" class="btn btn-primary" target="_blank">Combined Worker Report</a></span>
            <?php
            if ($orderData) {
                $temp = array();
                for ($i = 0; $i < count($orderData); $i++) {
                    $value = $orderData[$i];
                    array_push($temp, $value['item_name']);
                }
            }
            if (in_array("Shirt", $temp) || in_array("Tuxedo Shirt", $temp)) {
                ?>
                <span class="pull-right" style="margin: 0px 5px"><a href="<?php echo base_url('index.php/UserRecordManagement/worker_order_receipt_pdf/' . $order_id . '/' . $billing_info[0]['id'] . '/' . $shipping_info[0]['id'] . '/' . $user_info[0]['id']); ?>/shirt" class="btn btn-primary" target="_blank">Shirt Specialist Report</a></span>
            <?php }
            if (in_array("Pant", $temp) || in_array("Waistcoat", $temp) || in_array("Jacket", $temp) || in_array("Tuxedo Shirt", $temp) || in_array("Tuxedo Pant", $temp) || in_array("Tuxedo Suit", $temp) || in_array("Suit", $temp) || in_array("Sports Jacket", $temp) || in_array("3 Piece Suit", $temp) || in_array("Overcoat", $temp) || in_array("Tuxedo Jacket", $temp)) {
                ?>

                <span class="pull-right" style="margin: 0px 5px">
                    <a href="<?php echo base_url('index.php/UserRecordManagement/worker_order_receipt_pdf/' . $order_id . '/' . $billing_info[0]['id'] . '/' . $shipping_info[0]['id'] . '/' . $user_info[0]['id']); ?>/jacket" class="btn btn-primary" target="_blank">Jacket Specialist Report</a>
                </span>
            <?php }
            ?>

        </div>
        <div style="clear:both"></div>

        <div class="col-md-12" style="background: #f0f3f4;padding: 20px">
            <div class="col-md-3"  style="">
                <h4 style="margin-top: -5px;">Shipping Information</h4>
                <address class="m-t-5 m-b-5">
                    <?php echo $shipping_info[0]['address1']; ?></td><tr/>
<?php echo $shipping_info[0]['address2']; ?></td><tr/>
                    <table>
                        <tr><td>City</td><td>:&nbsp;</td><td><?php echo $shipping_info[0]['city']; ?></td><tr/>
                        <tr><td>State</td><td>:&nbsp;</td><td><?php echo $shipping_info[0]['state']; ?></td><tr/>
                        <tr><td>Zip Code</td><td>:&nbsp;</td><td><?php echo $shipping_info[0]['zip']; ?> 
                        <tr><td>Country</td><td>:&nbsp;</td><td><?php echo $shipping_info[0]['country']; ?></td><tr/>
                        <tr><td>Fax</td><td>:&nbsp;</td><td><?php echo $user_info[0]['fax_no']; ?></td><tr/>
                        <tr><td>Email</td><td>:&nbsp;</td><td><?php echo $user_info[0]['email']; ?></td><tr/>
                    </table>
                </address>
            </div>
            <div class="col-md-3" style="">
                <?php if(count($billing_info)){?>
                <h4 style="margin-top: -5px;">Billing Information</h4>
                <address class="m-t-5 m-b-5">
                    <?php echo $billing_info[0]['address1']; ?></td><tr/>
<?php echo $billing_info[0]['address2']; ?></td><tr/>
                    <table>
                        <tr><td>City</td><td>:&nbsp;</td><td>&nbsp;<?php echo $billing_info[0]['city']; ?></td><tr/>
                        <tr><td>State</td><td>:&nbsp;</td><td>&nbsp;<?php echo $billing_info[0]['state']; ?></td><tr/>
                        <tr><td>Zip Code</td><td>:&nbsp;</td><td>&nbsp;<?php echo $billing_info[0]['zip']; ?></td><tr/>
                        <tr><td>Country</td><td>:&nbsp;</td><td><?php echo $shipping_info[0]['country']; ?></td><tr/>
                        <tr><td>Fax</td><td>:&nbsp;</td><td><?php echo $user_info[0]['fax_no']; ?></td><tr/>
                        <tr><td>Email</td><td>:&nbsp;</td><td><?php echo $user_info[0]['email']; ?></td><tr/>

                    </table>

                </address>
                <?php }?>
            </div>

            <div class="col-md-3" style="">
                <h4 style="margin-top: -5px;">Invoice Information</h4>
                <div class="date m-t-5"></div>
                <div class="invoice-detail">
                    <table class="addr">
                        <tr>
                            <td>Invoice No.</td>
                            <td>: &nbsp;</td>
                            <td><?php echo $invoice_info[0]['invoice_no'] ?><br/></td>
                        </tr>
                        <tr>
                            <td><span>Date/Time</span></td>
                            <td>: &nbsp;</td>
                            <td>
                                <?php echo $invoice_info[0]['op_date'] ?><br/>
<?php echo $invoice_info[0]['op_time'] ?>
                            </td>
                        </tr>


                        <tr>
                            <td>Currency</td>
                            <td>: &nbsp;</td>
                            <td>USD</td>
                        </tr>
                        <tr>
                            <td>Order No.</td>
                            <td>: &nbsp;</td>
                            <td><?php echo $orderNo[0]['order_no'] ?></td>
                        </tr>
                        <tr>
                            <td>Client Code</td>
                            <td>: &nbsp;</td>
                            <td><?php echo $user_info[0]['registration_id']; ?> </td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td>: &nbsp;</td>
                            <td>Credit Card </td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="col-md-3" style="padding:0px">
                <h4 style="margin-top: -5px;">User Information</h4>
                <table>
                    <tr><td>First Name</td><td>: &nbsp;</td><td class="capitalize"><?php echo $user_info[0]['first_name']; ?></td></tr>
                    <tr><td>Middle Name</td><td>: &nbsp;</td><td class="capitalize"><?php echo $user_info[0]['middle_name']; ?></td></tr>
                    <tr><td>Last Name</td><td>: &nbsp;</td><td class="capitalize"><?php echo $user_info[0]['last_name']; ?></td></tr>
                    <tr><td>Email</td><td>: &nbsp;</td><td><?php echo $user_info[0]['email']; ?></td></tr>
                    <tr><td>Phone</td><td>: &nbsp;</td><td><?php echo $user_info[0]['contact_no']; ?></td></tr>
                </table>
            </div>

        </div>
        <div class="invoice-content col-md-12">
            <div class="table-responsive">
                <div class="col-md-12" style="background: rgba(207, 215, 218, 0.51);padding: 9px;height: 35px;">
                    <div class="col-md-1"><b>S.No.</b></div>
                    <div class="col-md-1" style="padding: 0px;"><b>Item Code</b></div>
                    <div class="col-md-1"><b>SKU</b></div>
                    <div class="col-md-1"><b>Image</b></div>
                    <div class="col-md-2"><b>Item Name</b></div>
                    <div class="col-md-1"><b>Price</b></div>
                    <div class="col-md-1"><b>Qty.</b></div>
                    <div class="col-md-2"><b>Extra Price</b></div>
                    <div class="col-md-2" style="padding: 0px;"><b>Total Price</b></div>
                </div>
                <div class="col-md-12"  style="padding: 0;">
                    <div class="panel-group" id="accordion">
                        <?php
                        if ($orderData) {
                            $count = 1;
                            $totals = 0;
                            for ($i = 0; $i < count($orderData); $i++) {
                                $value = $orderData[$i];
                                ?>
                                <div class="panel  overflow-hidden">
                                    <div class="panel-heading" style="background: rgba(179, 179, 179, 0.12);">
                                        <h3 class="panel-title">
                                            <a class="accordion-toggle accordion-toggle-styled collapsed" style="height: 40px;" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $count; ?>" aria-expanded="false">
                                                <div class="col-md-1">
        <?php echo $count; ?>
                                                </div>
                                                <div class="col-md-1" style="padding: 0;">
        <?php echo $value['product']; ?>
                                                </div>
                                                <div class="col-md-1">
        <?php echo $value['sku']; ?>
                                                </div>
                                                <div class="col-md-1">
                                                    <img src="<?php echo image_server;?>/nfw/small/<?php echo $value['image']; ?>" style="margin-top: -10px;width: 45px;height: 40px;text-align:center;">  
                                                </div>
                                                <div class="col-md-2">
        <?php echo $value['item_name']; ?>
                                                </div>
                                                <div class="col-md-1">
        <?php echo '$' . number_format($value['price'], 2, '.', ''); ?>
                                                </div>
                                                <div class="col-md-1">
        <?php echo $value['quantity']; ?>
                                                </div>
                                                <div class="col-md-2">

                                                    <?php
                                                    if ($value['extra_price'] > 0) {
                                                        echo '$' . number_format($value['extra_price'], 2, '.', '');
                                                        ?>
                                                        <button name="extra_detail" class="btn btn-default btn-xs btn-xs"  value="<?php echo $value['customization_id'] ?>" data-toggle="modal" data-target="#myModal_<?php echo $value['customization_id'] ?>__<?php echo $i; ?> ">
                                                            View detail
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal_<?php echo $value['customization_id'] ?>__<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form method="post">
                                                                        <div class="modal-header" style="color: white;background: black">
                                                                            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true" style="color:white">
                                                                                &times;
                                                                            </button>
                                                                            <p class="modal-title" id="myModalLabel" style="margin-left:">
                                                                                <span><?php echo ucwords($value['item_name']); ?> <span>SKU: <?php echo $value['sku']; ?>  Extra Price Detail</span>
                                                                            </p>
                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <table class="table table-bordered" id="">
                                                                                <?php
                                                                                $final_data = $this->User_model->style_detail($value['customization_id']);
                                                                                $data = $final_data[0]['custom_form_data'];
                                                                                $data2 = $final_data[0]['custom_form_data_price'];
                                                                                $final2 = $this->User_model->phpjsonstyle($data, 'php');
                                                                                $price_data = $this->User_model->phpjsonstyle($data2, 'php');
                                                                                $temp5 = array();
                                                                                foreach ($price_data as $k => $v) {
                                                                                    if (is_numeric($v)) {
                                                                                        if ($v > 0) {
                                                                                            $temp5[$k] = $v;
                                                                                        }
                                                                                    }
                                                                                }
                                                                                foreach ($temp5 as $key5 => $value5) {
                                                                                    if (array_key_exists($key5, $final2)) {
                                                                                        ?>

                                                                                        <tr style="font-size: 14px;padding-bottom: 0px;padding-top: 0px">
                                                                                            <td class="tds"><?php echo $key5; ?></td>
                                                                                            <td class="tds"><?php echo $final2[$key5]; ?></td>
                                                                                            <td class="tds"><?php echo '$' . $value5; ?></td>
                                                                                        </tr> 
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>

                                                                            </table>

                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" 
                                                                                    data-dismiss="modal">Close
                                                                            </button>

                                                                        </div>
                                                                    </form>

                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                        <!-- End -->

        <?php } else { ?> $00.00 <?php } ?>

                                                </div>
                                                <div class="col-md-2" style="padding: 0px;">
                                                    <span class="total_cost"> <?php echo '$' . number_format($value['total_price'], 2, '.', ''); ?></span>
                                                    <i class="fa fa-plus-circle pull-right"></i> 
                                                </div>
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapse<?php echo $count; ?>" class="panel-collapse collapse <?php
                                    if ($count == 1) {
                                        echo 'in';
                                    }
                                    ?>">
                                        <div class="panel-body">
                                            <div class="col-md-6" style="overflow-y: scroll;height: 500px;">
                                                <table class="table table-striped table-bordered" style="overflow: scroll;height: 500px;">

                                                    <?php
                                                    $customizId = $value['customization_id'];
                                                    $data = $this->User_model->style_detail($customizId);
                                                    $res = $this->User_model->phpjsonstyle($data[0]['custom_form_data'], 'php');
                                                    echo '<tbody>';
                                                    echo '<tr>';
                                                    echo '<td>Style</td>';
                                                    echo '<td>' . $data[0]['style_profile'] . '</td>';
                                                    echo '</tr>';
                                                    foreach ($res as $key1 => $value1) {
                                                        echo '<tr>';
                                                        echo '<td>' . $key1 . '</td>';
                                                        echo '<td>' . $value1 . '</td>';
                                                        echo '</tr>';
                                                    }
                                                    echo '</tbody>';
                                                    ?>
                                                </table>
                                            </div>
                                            <div class="col-md-6" style="overflow-y: scroll;height:500px">
                                                <table class="table table-striped table-bordered" style="overflow: scroll;height: 500px;">


                                                    <?php
                                                    $measurement_id = $value['measurement_id'];
                                                    $finalData = $this->User_model->measurement_detail($measurement_id);
                                                    echo '<tbody>';
                                                    $res1 = $this->User_model->phpjsonstyle($finalData[0]['measurement_data'], 'php');

                                                    foreach ($res1 as $key2 => $value2) {
                                                        echo '<tr>';
                                                        echo '<td>' . $key2 . '</td>';
                                                        echo '<td>' . $value2 . '</td>';
                                                        echo '</tr>';
                                                    }
                                                    $res2 = $this->User_model->phpjsonstyle($finalData[0]['posture_data'], 'php');
                                                    echo '<tr><th colspan =2>Your Posture</th></tr>';
                                                    foreach ($res2 as $key2 => $value2) {
                                                        $posimg = $this->User_model->posture_image($key2, $value2)[0];

                                                        echo "<tr>", '', "</tr>";
                                                        echo '<tr>';
                                                        echo '<td>' . $key2 . '</td>';
                                                        echo '<td>' . $value2 . ' <br/><img src="' . $posimg['image'] . '" style="height:100px;witdh:100px"></td>';
                                                        echo '</tr>';
                                                    }
                                                    echo "<tr><td colspan=2>";
                                                    $image_data = $finalData[0]['user_images'];
                                                    $image_data = trim($image_data, "[");
                                                    $image_data = trim($image_data, "]");
                                                    $image_data = explode(",", $image_data);
                                                    $timg = '';
                                                    foreach ($image_data as $key1 => $value1) {
                                                        $timg .= "<img style='height:300px;width:300px;float:left;margin:10px' src='http://costcointernational.com/nfw/medium/" . trim($value1, '"') . "' >";
                                                    }
                                                    echo $timg;
                                                    echo "</td></tr>";
                                                    echo '</tbody>';
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $count++;
                                $totals = $totals + $value['total_price'];
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="invoice-price">
                <div class="invoice-price-left">
                    <div class="invoice-price-row">
                        <div class="sub-price">
                            <small>SUBTOTAL</small>
                            <span id="subtotalCost"><?php echo '$' . number_format($totals, 2, '.', ''); ?></span>
                        </div>
                        <div class="sub-price">
                            <i class="fa fa-minus"></i>
                        </div>
                        <div class="sub-price">
                            <small>DISCOUNT/COUPON</small>
                            <?php
                            $coupon = $this->Product_model->coupan_detail($order_id);
                            // print_r($coupon);
                            if ($coupon) {
                                $val1 = $coupon[0]['value'];
                                $val_type = $coupon[0]['value_type'];
                                if ($val_type == '%') {
                                    $data = ($totals * $val1) / 100;
                                }
                                if ($val_type == 'Fixed') {
                                    $data = $val1;
                                }
                            }
                            ?>
                            <?php if ($coupon) { ?> <span><?php echo '$' . number_format($data, 2, '.', ''); ?> </span>
                            <?php } else { ?><span>$00.00</span> <?php }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="invoice-price-right">

                    <small>GRAND TOTAL</small><span>
                        <?php if ($coupon) {
                            ?> 
                            <span id="numtoword"><?php
                                $res = $totals - $data;
                                echo '$' . number_format($res, 2, '.', '');
                                ?> </span>
                            <?php } else {
                                ?><span id="numtoword"><?php echo '$' . number_format($totals, 2, '.', ''); ?> </span> <?php } ?>

                    </span>

                </div>
            </div>
        </div>

        
        
        
    </div>
    <!-- end invoice -->
</div>
<!---=========Model open===============---->
<!-- #modal-alert -->
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Extra Cost Information</h4>
            </div>
            <div class="modal-body panel-body">
                <div class="col-md-12" id="customizeData">
                    <table  class="table table-striped table-bordered customizeData"></table>
                </div> 
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>

    </div>
</div>
<?php
$shippingData = $this->Product_model->get_table_information('nfw_order_shipping', 'order_id', $order_id);
$jsonShipp = json_encode($shippingData);
$this->load->view('layout/layoutBottom');
?>
<script>
    $(function () {
        var num = 0;
        $('.total_cost').each(function () {
            // num1 += $(this).text();
            num += Number($(this).text());
        });
        //$('#subtotalCost').text(num);
//        var val = toWords(num);
//        var href = $('.invoice-company a').attr('href');
//        var href1 = href + '' + val;
//
//        $('.invoice-company a').attr('href', href1)
    });

    function get_extra_cost(obj) {
        var id = obj.id;
        var tableName = $(obj).attr('table_name');//ajax_data_edit
        console.log(id, tableName);
        $.ajax({
            type: "get",
            url: "<?php echo base_url('index.php/UserRecordManagement/ajax_data_edit'); ?>",
            data: {'id': id, 'table_name': 'nfw_custom_form_data_price', 'column_name': 'nfw_custom_form_data_id'},
            dataType: 'json',
            success: function (data)
            {
                console.log(JSON.parse(data['custom_form_data_price']));
                var htmls = '';
                $.each(JSON.parse(data['custom_form_data_price']), function (key, value) {
                    console.log(key, value);
                    if (value != '') {
                        htmls += '<tr>';
                        htmls += '<td style="text-transform: capitalize;">' + key + '</td>';
                        htmls += '<td>' + value + '</td>';
                        htmls += '</tr>';
                    }


                });
                $('.customizeData').html(htmls);
            }
        });
    }
    $(function () {
        $(".custom_table").each(function () {
            var id = $(this).attr('id');
            var custom_id = $(this).attr('custom_id');
            var table_name = $(this).attr('table_name');
            console.log(custom_id, table_name);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/UserRecordManagement/ajax_data_edit'); ?>",
                data: {'id': custom_id, 'table_name': table_name, 'column_name': 'id'},
                dataType: 'json',
                success: function (data)
                {
                    // console.log(data);
                    var htmls = '';
                    var count = 1;
                    $.each(data, function (key, value) {
                        $.each(value, function (key, value) {
                            //      console.log(key, value);
                            if (count >= 4) {
                                var keyData = key;
                                var keyData = key.split("_").join(" ");
                                htmls += '<tr>';
                                htmls += '<td style="text-transform: capitalize;">' + keyData + '</td>';
                                htmls += '<td>' + value + '</td>';
                                htmls += '</tr>';
                            }
                            count++;
                        });
                    });
                    $('#' + id).html(htmls);
//                    $('#' + id).parent().dataTable();
                }
            });
        })
        $('.measurement_table').each(function () {
            var id = $(this).attr('id');
            var tableId = $(this).attr('table_id');
            $.ajax({
                type: "get",
                url: "<?php echo base_url('index.php/UserRecordManagement/ajax_data_edit'); ?>",
                data: {'id': tableId, 'table_name': 'nfw_measurement_data', 'column_name': 'id'},
                success: function (data)
                {
                    console.log(data, "sdfsdfsd sdfsdf sd");
                    var tempData = data[0]['measurement_data'];
                    // console.log(tempData);



                }
            });
        });

    })

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_main/plugins/toword/toword.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>   