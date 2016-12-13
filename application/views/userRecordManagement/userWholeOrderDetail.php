<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5"> 
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;"><i class="fa fa-user"></i> &nbsp;&nbsp;Order Detail of&nbsp;&nbsp;<span><?php echo $userInfo[0]['first_name'].' '. $userInfo[0]['last_name'] ?></span></h4>
        </div>
        <div class="panel-body">
             <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">

                            <address>
                                <strong>Shipping Address</strong><br>

                                <?php echo $orderDetail[0]['add11'] ?><br/>
                                <?php echo $orderDetail[0]['add22'] ?><br/>
                                <?php echo $orderDetail[0]['add33'] ?><br/>
                                <?php echo $orderDetail[0]['add44'] ?><br/>
                                <table class="tb">
                                    <tr>
                                        <td>Contact No.</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo[0]['contact_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo[0]['fax_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo[0]['email'] ?></td>
                                    </tr>
                                </table>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <address>
                                <strong>Billing Address</strong><br>
                                <?php echo $orderDetail[0]['add1'] ?><br>
                                <?php echo $orderDetail[0]['add2'] ?><br>
                                <?php echo $orderDetail[0]['add3'] ?><br>
                                <?php echo $orderDetail[0]['add4'] ?><br>
                                <table class="tb">
                                    <tr>
                                        <td>Contact No.</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo[0]['contact_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo[0]['fax_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?php echo $userInfo[0]['email'] ?></td>
                                    </tr>
                                </table>


                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                            <b>Invoice Information</b><br/>

                            <table class="addr">
                                <tr>
                                    <td>Invoice No.</td>
                                    <td>:</td>
                                    <td><?php echo $invoice_data[0]['invoice_no'] ?><br/></td>
                                </tr>
                                <tr>
                                    <td><span>Date/Time</span></td>
                                    <td>:</td>
                                    <td><?php echo $invoice_data[0]['op_date'] ?><br/>
                                        <?php echo $invoice_data[0]['op_time'] ?></td>
                                </tr>


                                <tr>
                                    <td>Currency</td>
                                    <td>:</td>
                                    <td>USD</td>
                                </tr>
                                <tr>
                                    <td>Order No.</td>
                                    <td>:</td>
                                    <td><?php echo $orderDetail[0]['order_no'] ?></td>
                                </tr>
                                <tr>
                                    <td>Client Code</td>
                                    <td>:</td>
                                    <td><?php echo $userInfo[0]['registration_id']; ?> </td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td>:</td>
                                    <td>Credit Card</td>
                                </tr>

                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
<hr>

        <div class="invoice-content col-md-12">
            <div class="table-responsive">
                <div class="col-md-12" style="background: rgba(207, 215, 218, 0.51);padding: 9px;height: 35px;">
                    <div class="col-md-1"><b>S.No.</b></div>
                    <div class="col-md-1" style="padding: 0px;"><b>Item No.</b></div>
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
                                                    <?php echo '$' . number_format($value['price'],2,'.',''); ?>
                                                </div>
                                                <div class="col-md-1">
                                                    <?php echo $value['quantity']; ?>
                                                </div>
                                                <div class="col-md-2">

                                                    <?php
                                                    if ($value['extra_price'] > 0) {
                                                    echo '$' . number_format($value['extra_price'],2,'.','');
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
                                                    <span class="total_cost"> <?php echo '$' . number_format($value['total_price'],2,'.',''); ?></span>
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
                                                        echo '<td>' . $value2 . ' <img src="' . $posimg['image'] . '" style="height:100px;witdh:100px"></td>';
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
                            <span id="subtotalCost"><?php echo '$' . number_format($totals,2,'.',''); ?></span>
                        </div>
                        <div class="sub-price">
                            <i class="fa fa-minus"></i>
                        </div>
                        <div class="sub-price">
                            <small>DISCOUNT</small>
                            <?php
                            $coupon = $this->Product_model->coupan_detail($order_id);
                           // print_r($coupon);
                            if ($coupon) {
                                $val1 = $coupon[0]['value'];
                                $val_type = $coupon[0]['value_type'];
                                if ($val_type == '%') {
                                    $data = ($totals * $val1) / 100;
                                }
                                if ($val_type == 'Fix') {
                                    $data = $val1;
                                }
                            }
                            ?>
                            <?php if ($coupon) { ?> <span><?php echo '$' .  number_format($data,2,'.',''); ?> </span>
                            <?php } else { ?><span>$00.00</span> <?php }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="invoice-price-right">

                    <small>GRAND TOTAL</small><span>
                        <?php if ($coupon) {
                            ?> 
                            <span id="numtoword"><?php $res = $totals - $data;
                               echo '$' . number_format($res,2,'.','');
                            ?> </span>
                            <?php } else {
                                ?><span id="numtoword"><?php echo '$' . number_format($totals,2,'.',''); ?> </span> <?php } ?>

                    </span>

                </div>
            </div>
        </div>
            
            
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
        TableManageDefault.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>