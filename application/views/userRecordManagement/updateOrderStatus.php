<?php
$this->load->view('layout/layoutTop');
//print_r($billing_info);
$invoiceData = $this->Product_model->get_table_information('nfw_order_invoice', 'order_id', $order_id);
$orderData = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
//print_r($orderData);
$shipping_order = $shipping_detail;
//echo "fdgfghgh";
$orderData1 = $this->User_model->get_product_information($order_id);
//print_r($orderData1);
//print_r($payment_option['option']);
?>
<style>
    .addr tr{
        border: none;
    }
    .addr td{
        padding-top: 2px;
        padding-bottom: 2px;
        padding-left: 0px;
        border: none;
        padding-right: 4px !important;
    }
    .badge{
        font-size: 13px;
    }
</style>
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

<!-- begin col-6 -->
<div class="col-md-12">
    <ul class="nav nav-tabs" id="status_record" style="font-size: 16px;">
        <li class="tab1 active">
            <a href="#default-tab-1" data-toggle="tab">Processing</a>
        </li>
        <li class="tab2"><a href="#default-tab-2" data-toggle="tab">Shipping</a></li>
        <li class="tab3"><a href="#default-tab-3" data-toggle="tab">Closed/Delivered</a></li>
        <li class="tab4"><a href="#default-tab-4" data-toggle="tab">Return/Pending</a></li>
        <li class="tab5"><a href="#default-tab-5" data-toggle="tab">Cancel Order</a></li> 
        <a href="<?php echo base_url(); ?>index.php/UserRecordManagement/user_current_order" class="btn btn-primary btn-xs pull-right" style="padding: 0px 0px 0px 0px;margin: 9px 10px 0px 0px;">
            <i class="fa fa-backward"></i> Back
        </a>
    </ul>
    <div class="tab-content panel panel-body" style="height:">
        <div class="tab-pane fade active in" id="default-tab-1">
            <form method="post">
                <div class="col-md-12">
                    <div id="printPyamentReport">


                        <div class="col-md-12" style="font-size: 13px">
                            <table class="table" style="width: 100%">
                                <tr>
                                    <td>Name</td><td>: &nbsp;</td><td class="capitalize"><?php echo $user_info['first_name']; ?> <?php echo $user_info['middle_name']; ?> <?php echo $user_info['last_name']; ?></td>
                                    <td>Email</td><td>: &nbsp;</td><td><?php echo $user_info['email']; ?></td>
                                    <td>Phone</td><td>: &nbsp;</td><td><?php echo $user_info['contact_no']; ?></td>
                                </tr>
                            </table>

                        </div>
                        <?php
                        if ($payment_option['option'] == 3) {
                            ?> 
                            <div >
                                <style>

                                    #printPyamentReport table td{


                                        font-weight: 500;
                                    }
                                    #printPyamentReport table th{


                                        font-weight: 500;
                                        text-align: left;
                                    }
                                    .form-control{
                                        border-top: 1px solid #ccc;
                                        background-color: #F1F1F1;
                                        font-weight: 500;
                                        width: 80%;
                                    }

                                </style>
                                <div class="col-md-12" style="border: 1px solid #000;padding: 0px">
                                    <h5 style="    padding: 6px 15px; background-color: #000;color: #fff; margin: 0px;">Payment Mode - Credit Card</h5>
                                    <table class="table" style="width: 100%">
                                        <tr>
                                            <td >
                                                <span style="font-size:14px;color:black">Name On Card&nbsp;:&nbsp;</span> 
                                                <span style="font-size:14px;color:maroon"> <?php echo $payment_option['card_holder_name']; ?></span>
                                            </td>
                                            <td>
                                                <span style="font-size:14px;color:black">Card No.&nbsp;:&nbsp;</span> 
                                                <span style="font-size:14px;color:maroon"> <?php echo $payment_option['card_number']; ?></span>
                                            </td>
                                            <td>
                                                <span style="font-size:14px;color:black">Exp.Month&nbsp;:&nbsp;</span> 
                                                <span style="font-size:14px;color:maroon"> <?php echo $payment_option['expiry_month']; ?></span>
                                            </td>
                                            <td>
                                                <span style="font-size:14px;color:black">Exp. Year&nbsp;:&nbsp;</span> 
                                                <span style="font-size:14px;color:maroon"> <?php echo $payment_option['expiry_year']; ?></span>
                                            </td>
                                            <td>
                                                <span style="font-size:14px;color:black">CVV&nbsp;:&nbsp;</span>   
                                                <span style="font-size:14px;color:maroon"> <?php echo $payment_option['cvv']; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>



                            </div>


                            <?php
                        }
                        if ($payment_option['option'] == 2) {
                            ?> 

                            <div class="form-group">
                                <span style="font-size:18px;color:black">Payment Mode </span>- <span style="font-size:18px;color:black"><?php echo $payment_option['transaction_id']; ?></span>

                            </div>


                            <?php
                        }
                        if ($payment_option['option'] == 1) {
                            ?>
                            <div class="form-group">
                                <span style="font-size:18px;color:black">Payment Mode </span>- <span style="font-size:18px;color:black"><?php echo $payment_option['transaction_type']; ?></span>

                            </div>


                        <?php } ?>


                        <div class="col-md-12" style="border: 1px solid #000;padding: 0px" >
                            <h5 style="padding: 6px 15px; background: #000;color: #fff; margin: 0px;">Shipping Information</h5>
                            <address class="m-t-5 m-b-5" style="    font-size: 13px; color: #000;">
                                <table class="table" style="    font-size: 13px;  color: #000;width: 100%">
                                    <tr>
                                        <td colspan="9"><?php echo $shipping_info['address1']; ?> <?php echo $shipping_info['address2']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td><td>:&nbsp;</td><td><?php echo $shipping_info['city']; ?></td>
                                        <td>State</td><td>:&nbsp;</td><td><?php echo $shipping_info['state']; ?></td>
                                        <td>Zip Code</td><td>:&nbsp;</td><td><?php echo $shipping_info['zip']; ?> </td>
                                    </tr>    
                                    <tr><td>Country</td><td>:&nbsp;</td><td><?php echo $shipping_info['country']; ?></td>
                                        <td>Fax</td><td>:&nbsp;</td><td><?php echo $user_info['fax_no']; ?></td>
                                        <td>Email</td><td>:&nbsp;</td><td><?php echo $user_info['email']; ?></td>
                                    <tr/>

                                </table>
                            </address>
                        </div>

                        <div style="clear: both"></div>


                        <table class="table" style="width: 100%;    padding: 10px;
                               border: 1px solid #000;">
                            <tr> 
                                <th style="  text-align: left;">Transaction No.</th>
                                <td>    
                                    <?php if ($payment_option['option'] == 1) { ?>
                                        <input type="text" class="form-control" name="transaction_no" required value="<?php echo $payment_option['transaction_id']; ?>" readonly>
                                    <?php } else { ?>
                                        <input type="text" class="form-control" name="transaction_no" required >

                                    <?php } ?>
                                </td>
                                <th  style="  text-align: left;">
                                    Order No.
                                </th>
                                <td>
                                    <input type="text" class="form-control" value="<?php
                                    if ($order_id) {
                                        $orderNo = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
                                        echo $orderNo[0]['order_no'];
                                    }
                                    ?>" readonly="readonly" name="order_no"  style="opacity: 1;
                                           background: white;    font-weight: 700;">
                                </td>
                            </tr>
                            <tr>
                                <th  style="  text-align: left;">Transaction Amount</th>
                                <td>
                                    <input type="text" class="form-control" name="transaction_no" value="<?php echo $orderData[0]['total_price'] ?>" readonly="" style="opacity: 1;
                                           background: white;    font-weight: 700;">
                                </td>
                                <th  style="  text-align: left;">
                                    Update Status</th>
                                <td>
                                    <input type="hidden" name="status"  value="2">
                                    <input type="text" class="form-control" name="" value="Processing"  placeholder="Processing">
                                </td>
                            </tr>
                            <tr>
                                <th  style="  text-align: left;">
                                    Status
                                </th>
                                <td>
                                    <select class="form-control input-inline input-ls" name="transaction_status" required>
                                        <option value="Approved">Approved</option>;
                                        <option value="Failed">Failed</option>;
                                    </select>  
                                </td>
                                <th  style="  text-align: left;">  Remark</th>
                                <td>
                                    <input class="form-control" name="remark" rows="4" required>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">

                        <div class="form-group ">
                            <button class="btn btn-success pull-left" onclick="printDivNext();" id="print_button">
                                Print 
                            </button>
                            <input type="submit" class="btn btn-primary pull-right" name ="submit"/>

                        </div>
                    </div>

                </div>
                <div style="clear: both"></div>
            </form>
        </div>
        <div class="tab-pane fade" id="default-tab-2">
            <form method="post">
                <div class="col-md-12" style="padding: 0px;">
                    <div class="col-md-4" style="padding: 0px;">
                        <div class="col-md-12" style="padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Client Code</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" value="<?php
                                    echo $user_info['registration_id'];
                                    ?>" name="client_code" style="height: 22px;" readonly> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Order No.</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="order_id" value="<?php
                                    if ($order_id) {
                                        echo $order_id;
                                    }
                                    ?>">
                                    <input type="text" class="form-control" placeholder="NFO151101" value="<?php
                                    if ($order_id) {
                                        echo $orderData[0]['order_no'];
                                    }
                                    ?>" name="order_no" style="height: 22px;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Invoice No.</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" value="<?php
                                    if ($order_id) {
                                        echo $invoiceData[0]['invoice_no'];
                                    }
                                    ?>" readonly name="invoice_no"  style="height: 22px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"  style="padding:  0px;margin-top: 10px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Shipping Date</label>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"  name="shipping_date" style="height: 22px;background:#fff;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"  style="padding:  0px;margin-top: 10px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Shipping Time</label>
                                <div class="col-md-8">
                                    <input type="time" class="form-control" value="<?php echo date('h:m:s'); ?>"  name="shipping_time" style="height: 22px;background:#fff;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Total Weight</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control is_number" placeholder=""  name="total_weight" style="height: 22px;" value="<?php echo $shipping_order['total_weight'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Weight Unit</label>
                                <div class="col-md-8">
                                    <select  class="form-control"  name="weight_unit" style="height: 25px;padding: 2px;">
                                        <option>Lbs</option>
                                        <option>Kg</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"  style="padding-right:  0px;">
                        <div class="col-md-12">
                            <div class="panel" data-sortable-id="index-5" style="border: 1px solid #E0E0E0;">
                                <div class="panel-heading" style="background: rgb(239, 242, 244);padding: 2px 0px 2px 5px;font-weight: 500;">
                                    <p class="panel-title" style="">Sender Company</p>
                                </div>
                                <div class="panel-body" style="padding: 14px;">
                                    Nita Fashions <input type="hidden" name="sender_company" value="Nita Fashions">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: -10px;">
                            <div class="panel" data-sortable-id="index-5" style="border: 1px solid #E0E0E0;">
                                <div class="panel-heading" style="background: rgb(239, 242, 244);padding: 2px 0px 2px 5px;font-weight: 500;">
                                    <p class="panel-title" style="">Destination Country</p>
                                </div>
                                <div class="panel-body" style="padding: 14px;">
                                    <?php echo $shipping_info['country']; ?>
                                    <input type="hidden" name="destination_country" value="<?php echo $shipping_info['country']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12" style="padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Tracking No.</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="" name="tracking_no" style="height: 22px;" value="<?php echo $shipping_order['tracking_no'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Tracking Link</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="" name="tracking_link" style="height: 22px;" value="<?php echo $shipping_order['tracking_link'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Shipping Tel  No.</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="" name="shipping_tel_no" style="height: 22px;" value="<?php echo $shipping_order['shipping_tel_no'] ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Shipping Comp.</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" placeholder="" name="shipping_company" style="height: 22px;" value="<?php echo $shipping_order['shipping_company'] ?>" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px;padding: 0px;">
                            <div class="form-group">
                                <label class="col-md-4 control-label" style="padding: 0px; text-align: right; font-weight: 600;">Status</label>
                                <div class="col-md-8">
                                    <select name="status" style="height: 22px;padding: 0px 0px 0px 4px;" class="form-control">
                                        <option value="3">Shipped</option>
                                        <option value="7">Picked at store</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <button name="shipping_done" class="btn btn-success pull-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="default-tab-3">
            <div class="col-md-12">
                <div class="col-md-12" style="margin-top: 15px;">
                    <form method="post">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-md-3 control-label" style="padding: 6px 0px 5px 0px; text-align: right; font-weight: 600;font-size: 13px;">Order No.</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="<?php
                                    if ($order_id) {
                                        $orderNo = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
                                        echo $orderNo[0]['order_no'];
                                    }
                                    ?>" readonly="readonly" name="order_no">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-4" style="padding: 0px;"> 
                                    <label class="col-md-12 control-label" style="padding: 6px 0px 5px 0px; text-align: right; font-weight: 600;font-size: 13px;">Update Status</label>
                                </div>
                                <div class="col-md-8" style="    padding-top: 6px;">
                                    <input type="hidden" name="status"  value="4">
                                    Delivered
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-1 control-label" style="font-weight: 600;font-size: 13px;">Remark</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="remark" style="width: 106%;margin-left: 5%;" rows="6" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-top: 15px;">
                            <div class="col-md-1 pull-right"><input type="submit" class="btn btn-primary pull-right" name ="close_order"/></div>
                        </div>
                    </form>
                </div>


            </div>

        </div>
        <div class="tab-pane fade" id="default-tab-4">
            <div class="col-md-12">

                <form method="post" class="form-inline">

                    <div class="form-group" style="    width: 100%;margin-bottom: 20px">
                        <label class=" control-label" style="text-align: right; font-weight: 600;font-size: 13px;">Order No.</label>
                        <input type="hidden" name="status"  value="5">
                        <input type="text" class="form-control" value="<?php
                        if ($order_id) {
                            $orderNo = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
                            echo $orderNo[0]['order_no'];
                        }
                        ?>" readonly="readonly" name="order_no">
                    </div>
                    </br>
                    <div class="form-group" style="    width: 100%;margin-bottom: 20px">
                        <label class=" control-label" style=" text-align: right; font-weight: 600;font-size: 13px;">Reason for Return/Pending</label>

                        <input class="form-control" type="text" name="pending_reason"  style="width: 100%" value="">

                    </div>
                    </br>

                    <div class="form-group" style="    width: 100%;margin-bottom: 20px">
                        <label class=" control-label" style="font-weight: 600;font-size: 13px;">Remark</label>

                        <textarea class="form-control" name="remark" style="width: 100%;" rows="6" required></textarea>

                    </div>
            </div>
            <div class="col-md-8" style="margin-top: 15px;">
                <div class=""><input type="submit" class="btn btn-primary " name="pending_order"/></div>
            </div>
            </form>
        </div>

        <!--order cancle-->
        <div class="tab-pane fade" id="default-tab-5">
            <div class="col-md-12">

                <form method="post" class="form-inline">

                    <div class="form-group" style="    width: 100%;margin-bottom: 20px">
                        <label class=" control-label" style="text-align: right; font-weight: 600;font-size: 13px;">Order No.</label>
                        <input type="hidden" name="status"  value="6">
                        <input type="text" class="form-control" value="<?php
                        if ($order_id) {
                            $orderNo = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
                            echo $orderNo[0]['order_no'];
                        }
                        ?>" readonly="readonly" name="order_no">
                    </div>
                    </br>
                    <div class="form-group" style="    width: 100%;margin-bottom: 20px">
                        <label class=" control-label" style=" text-align: right; font-weight: 600;font-size: 13px;">Reason for cancellation</label>

                        <input class="form-control" type="text" name="pending_reason"  style="width: 100%" value="">

                    </div>
                    </br>

                    <div class="form-group" style="    width: 100%;margin-bottom: 20px">
                        <label class=" control-label" style="font-weight: 600;font-size: 13px;">Remark</label>

                        <textarea class="form-control" name="remark" style="width: 100%;" rows="6" required></textarea>

                    </div>
            </div>
            <div class="col-md-8" style="margin-top: 15px;">
                <div class=""><input type="submit" class="btn btn-primary " name="pending_order"/></div>
            </div>
            </form>
        </div>

        <!--end of order cancel-->

    </div>
</div>
<div class="col-md-12">
    <div class="    nav nav-tabs
         "><p style="padding: 4px 0px 0px 11px;font-size: 17px;">Order Status Information</p></div>
    <div class="panel panel-body">

        <div class="col-md-12 ">
            <table class="table">
                <?php
                $count = 0;
                $currentStatus = $order_status_record[0]['status_tag'];
                ?>   
                <?php
                $proccessArray = [];
                $temp = ($order_status_record);
                foreach ($temp as $key => $value) {
                    $ht = "<tr '>";
                    $ht.= "<td style='width:170px'>" . $value['date'] . "</td>";
                    $ht.= "<td style='    border-left: 1px solid;padding: 0;width: 1px;'><i class='fa fa-circle fa-2x' style='margin-left: -25px;margin-left: -11px;
    margin-top: 11px;'></i></td>";
                    $ht.= '<th>' . $value['order_status'] . ' <br><small style="font-weight:300;font-size:13px">  ' . ($value['status_tag'] != '7' ? $value['remark'] : '') . '</small> </th>';


                    array_push($proccessArray, $ht);
                }
                $proccessStatus = implode('', $proccessArray);
                echo $proccessStatus;
                echo "</td></tr>";
                ?>
            </table>




        </div>
    </div>
</div>
<!-- end col-6 -->
<div class="col-md-12" 
     <!-- begin invoice -->
     <div class="invoice panel panel-body">


        <div class="invoice-company">
            <span data-toggle="" data-placement="left" title="View Pdf"><a href="<?php echo base_url() ?>../frontend/views/viewOrDownloadOrderPdf.php?order_id=<?php echo $order_id ?>&user_id=<?php echo $user_info['id'] ?>&option=I"  class="btn btn-danger " target="_blank"><i class="fa fa-file-pdf-o"></i></a></span>

            <span class="pull-right" style="margin: 0px 5px"><a href="<?php echo base_url('index.php/UserRecordManagement/worker_order_receipt_pdf/' . $order_id . '/' . $user_info['id']); ?>/all" class="btn btn-primary" target="_blank">Combined Worker Report</a></span>
            <?php
            if ($orderData1) {
                $temp = array();
                for ($i = 0; $i < count($orderData1); $i++) {
                    $value = $orderData1[$i];
                    array_push($temp, $value['item_name']);
                }
            }
            if (in_array("Shirt", $temp) || in_array("Tuxedo Shirt", $temp)) {
                ?>
                <span class="pull-right" style="margin: 0px 5px"><a href="<?php echo base_url('index.php/UserRecordManagement/worker_order_receipt_pdf/' . $order_id . '/' . $user_info['id']); ?>/shirt" class="btn btn-primary" target="_blank">Shirt Specialist Report</a></span>
                <?php
            }
            if (in_array("Pant", $temp) || in_array("Waistcoat", $temp) || in_array("Jacket", $temp) || in_array("Tuxedo Shirt", $temp) || in_array("Tuxedo Pant", $temp) || in_array("Tuxedo Suit", $temp) || in_array("Suit", $temp) || in_array("Sports Jacket", $temp) || in_array("3 Piece Suit", $temp) || in_array("Overcoat", $temp) || in_array("Tuxedo Jacket", $temp)) {
                ?>

                <span class="pull-right" style="margin: 0px 5px">
                    <a href="<?php echo base_url('index.php/UserRecordManagement/worker_order_receipt_pdf/' . $order_id . '/' . $user_info['id']); ?>/jacket" class="btn btn-primary" target="_blank">Suit Specialist Report</a>
                </span>
            <?php }
            ?>
        </div>


        <div class="col-md-12" style="background: #f0f3f4;padding: 20px;margin-top: 10px">
            <div class="col-md-3"  style="padding-left: 0px;">
                <h4 style="margin-top: -5px;">Shipping Information</h4>
                <address class="m-t-5 m-b-5">
                    <?php echo $shipping_info['address1']; ?></td><tr/>
                    <?php echo $shipping_info['address2']; ?></td><tr/>
                    <table>
                        <tr><td>City</td><td>:&nbsp;</td><td><?php echo $shipping_info['city']; ?></td><tr/>
                        <tr><td>State</td><td>:&nbsp;</td><td><?php echo $shipping_info['state']; ?></td><tr/>
                        <tr><td>Zip Code</td><td>:&nbsp;</td><td><?php echo $shipping_info['zip']; ?> 
                        <tr><td>Country</td><td>:&nbsp;</td><td><?php echo $shipping_info['country']; ?></td><tr/>
                        <tr><td>Fax</td><td>:&nbsp;</td><td><?php echo $user_info['fax_no']; ?></td><tr/>
                        <tr><td>Email</td><td>:&nbsp;</td><td><?php echo $user_info['email']; ?></td><tr/>
                    </table>
                </address>
            </div>
            <div class="col-md-3" style="padding-left: 0px;">
                <?php
                if (count($billing_info)) {
                    ?>
                    <!--                    <h4 style="margin-top: -5px;">Billing Information</h4>
                                        <address class="m-t-5 m-b-5">
                                         
                                            <table>
                                                <tr><td>City</td><td>:&nbsp;</td><td>&nbsp;<?php echo $billing_info['city']; ?></td><tr/>
                                                <tr><td>State</td><td>:&nbsp;</td><td>&nbsp;<?php echo $billing_info['state']; ?></td><tr/>
                                                <tr><td>Zip Code</td><td>:&nbsp;</td><td>&nbsp;<?php echo $billing_info['zip']; ?></td><tr/>
                                                <tr><td>Country</td><td>:&nbsp;</td><td>&nbsp;<?php echo $billing_info['country']; ?></td><tr/>
                                                <tr><td>Fax</td><td>:&nbsp;</td><td><?php echo $user_info['fax_no']; ?></td><tr/>
                                                <tr><td>Email</td><td>:&nbsp;</td><td><?php echo $user_info['email']; ?></td><tr/>
                                            </table>
                    
                                        </address>-->
                    <?php
                }
                ?>
            </div>

            <div class="col-md-3" style="padding: 0px;">
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
                            <td>US$</td>
                        </tr>
                        <tr>
                            <td>Order No.</td>
                            <td>: &nbsp;</td>
                            <td><?php echo $orderNo[0]['order_no'] ?></td>
                        </tr>
                        <tr>
                            <td>Client Code</td>
                            <td>: &nbsp;</td>
                            <td><?php echo $user_info['registration_id']; ?> </td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td>: &nbsp;</td>
                            <td><?php echo $incpayment; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-3" style="padding: 0px;">
                <h4 style="margin-top: -5px;">User Information</h4>
                <table>
                    <tr><td>First Name</td><td>: &nbsp;</td><td class="capitalize"><?php echo $user_info['first_name']; ?></td></tr>
                    <tr><td>Middle Name</td><td>: &nbsp;</td><td class="capitalize"><?php echo $user_info['middle_name']; ?></td></tr>
                    <tr><td>Last Name</td><td>: &nbsp;</td><td class="capitalize"><?php echo $user_info['last_name']; ?></td></tr>
                    <tr><td>Email</td><td>: &nbsp;</td><td><?php echo $user_info['email']; ?></td></tr>
                    <tr><td>Phone</td><td>: &nbsp;</td><td><?php echo $user_info['contact_no']; ?></td></tr>

                    <?php
                    $userinfo2 = $this->Product_model->get_table_information('auth_user', 'id', $user_info['id']);
                    ?>

                    <tr><td>Profession</td><td>: &nbsp;</td><td><?php echo $userinfo2[0]['profession_value']; ?></td></tr>
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
                        if ($orderData1) {
                            $count = 1;
                            $totals = 0;
                            for ($i = 0; $i < count($orderData1); $i++) {
                                $value = $orderData1[$i];
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
                                                    <img src="<?php echo $value['image']; ?>" style="margin-top: -10px;width: 45px;height: 40px;text-align:center;">  
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
                                                        <button name="extra_detail" class="btn btn-default btn-xs btn-xs"  value="<?php echo $value['cart_id'] ?>" data-toggle="modal" data-target="#myModal_<?php echo $value['cart_id'] ?>__<?php echo $i; ?> ">
                                                            View detail
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal_<?php echo $value['cart_id'] ?>__<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                                                                $data = $value['customization_data'];
                                                                                //print_r($data);
                                                                                $data2 = $value['customization_data_price'];
                                                                                //print_r($data2);
                                                                                $final6 = $this->User_model->phpjsonstyle($data, 'php');
                                                                                //print_r($final2);
                                                                                $price_data1 = $this->User_model->phpjsonstyle($data2, 'php');
                                                                                //print_r($price_data1);
                                                                                $temp11 = array();
                                                                                foreach ($price_data1 as $k1 => $v1) {
                                                                                    if (is_numeric($v1)) {
                                                                                        if ($v1 > 0) {
                                                                                            $temp11[$k1] = $v1;
                                                                                        }
                                                                                    }
                                                                                }
                                                                                foreach ($temp11 as $key15 => $value5) {
                                                                                    if (array_key_exists($key15, $final6)) {
                                                                                        ?>

                                                                                        <tr style="font-size: 14px;padding-bottom: 0px;padding-top: 0px">
                                                                                            <td class="tds"><?php echo $key15; ?></td>
                                                                                            <td class="tds"><?php echo $final6[$key15]; ?></td>
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
                                                    //$customizId = $value['customization_id'];
                                                    //$data = $this->User_model->style_detail($customizId);
                                                    $res = $this->User_model->phpjsonstyle($value['customization_data'], 'php');
                                                    echo '<tbody>';
                                                    echo '<tr>';
                                                    echo '<td>Style</td>';
                                                    echo '<td>' . $value['customization_id'] . '</td>';
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
                                                    //$measurement_id = $value['measurement_id'];
                                                    // $finalData = $this->User_model->measurement_detail($measurement_id);
                                                    echo '<tbody>';
                                                    $res1 = $this->User_model->phpjsonstyle($value['measurement_data'], 'php');

                                                    foreach ($res1 as $key2 => $value2) {
                                                        echo '<tr>';
                                                        echo '<td>' . $key2 . '</td>';
                                                        echo '<td>' . $value2 . '</td>';
                                                        echo '</tr>';
                                                    }
                                                    $res2 = $this->User_model->phpjsonstyle($value['posture_data'], 'php');
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
                                                    $image_data = $value['user_images'];
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
                            (
                        </div>
                        <div class="sub-price">
                            <small>SUBTOTAL</small>
                            <span id="subtotalCost"><?php echo '$' . number_format($totals, 2, '.', ''); ?></span>
                        </div>
                        <div class="sub-price">
                            <i class="fa fa-plus"></i>
                        </div >
                        <div class="sub-price">
                            <small>Shipping</small>
                            <?php echo $orderData[0]['shipping_amount']; ?> 
                        </div>
                        <div class="sub-price">
                            )
                        </div>


                        <div class="sub-price">
                            <i class="fa fa-minus"></i>
                        </div>

                        <div class="sub-price">
                            (
                        </div>
                        <div class="sub-price">
                            <small>DISCOUNT/COUPON</small>
                            <?php
                            $coupon = $this->Product_model->coupan_detail($order_id);
// print_r($coupon);
                            $data = 0;
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

                            $data = $data ? $data : 0;
                            ?>
                            <?php if ($coupon) { ?> <span><?php echo '$' . number_format($data, 2, '.', ''); ?> </span>
                            <?php } else { ?><span>$00.00</span> <?php }
                            ?>
                        </div>

                        <div class="sub-price">
                            <i class="fa fa-plus"></i>
                        </div >
                        <div class="sub-price">
                            <small>WALLET</small>
                            <?php echo '$' . number_format($orderData[0]['wallet_amount'], 2, '.', ''); ?> 
                        </div>
                        <div class="sub-price">
                            )
                        </div>

                    </div>
                </div>
                <div class="invoice-price-right">

                    <span>
                        <small style='    width: 100%;
                               padding-right: 32px;'>GRAND TOTAL</small>
                               <?php
                               $order_amount = $orderData[0]['total_price'];
                               echo $order_amount;
                               ?> 
                    </span>  

                    </span>

                </div>
            </div>
            <style>
                .refund_amt{
                    text-align: right;
                    font-size: 20px;
                    padding-right: 21px!important;

                }
            </style>

            <table class='table'>
                <tr>
                    <th></th>

                    <th class='refund_amt' style='    font-weight: 200;
                        font-size: 15px;    width: 245px;
                        padding: 5px'>Refund Amount</th>
                </tr>
                <?php
                $totalr = 0;
                if (count($refundData)) {
                    foreach ($refundData as $i => $v) {
                        echo "<tr>";
                        echo "<td style='text-align:right'>";
                        echo $v['remark'];
                        echo "<br/>";
                        echo "<b>", $v['date_time'], "</b>";
                        echo "</td>";
                        echo "<td class='refund_amt'>$";
                        echo $v['credit_amt'];
                        $totalr += $v['credit_amt'];
                        echo "</td>";

                        echo "</tr>";
                    }
                }
                $order_amount = str_replace("$", "", $order_amount);
                $order_amount = $order_amount - $totalr;
                ?>
                <tr>
                    <th></th>

                    <th class='refund_amt' style='  
                        font-weight: 600;
                        color: #CA013C;'>
                        <small style='    color: #908C8C;
                               font-weight: 200;'>Total: </small> <?php echo '$' . number_format($totalr, 2, '.', ''); ?> 
                    </th>
                </tr>
                <tr>


                    <th colspan="2" class='refund_amt' style='  
                        font-weight: 600;font-size: 26px;
                        color: #CA013C;'>
                        <small style='    color: #908C8C;
                               font-weight: 200;'>Total Order Amount: </small> <?php echo '$' . number_format($order_amount, 2, '.', ''); ?> 
                    </th>

                </tr>

            </table>
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
<!-- end #content -->  
<!--=========Model close===============---->
<?php
$shippingData = $this->Product_model->get_table_information('nfw_order_shipping', 'order_id', $order_id);
$jsonShipp = json_encode($shippingData);
$this->load->view('layout/layoutBottom');
?>
<script>
    $(function () {
        var num = 0;
        $('.total_cost').each(function () {
            num += Number($(this).text());
            console.log(num);
        });
        // $('#subtotalCost').text(num); 
        var num1 = $("#numtoword").text();
        var num2 = num1.split('$')[1];
        var val = '';//toWords(num2);
        var href = $('.invoice-company a').attr('href');
        var href1 = href + '&number1=' + val;
        //$('.invoice-company a').attr('href', href1)
    });
    $(function () {
        var status = <?php echo $currentStatus; ?>;



        if (status > 1) {

            $('#status_record .tab1').removeClass('active');
            $('#status_record .tab2').addClass('active');
            $('#default-tab-2').addClass('active in');
            $('#default-tab-1').removeClass('active in');
            $('input[name=submit]').attr('disabled', 'disabled');
            if (status > 2) {
                var shippdata = <?php echo $jsonShipp || []; ?>;
                for (key in shippdata[0]) {
                    var value = shippdata[0][key];
                    ///  console.log(value);
                    $("input[name='" + key + "']").val(value);
                }
                $('button[name=shipping_done]').attr('disabled', 'disabled');
            }
        } else {
        }
        if (status == 3) {
            $('input[name=close_order]').attr('disabled', false);
            $('[href="#default-tab-3"]').tab('show');
        }
        if (status == 4) {
<?php
$order_close = $order_status_record[0];
?>
            $('#default-tab-3 textarea').val("<?php echo $order_close['remark'] ?>")
            $('[href="#default-tab-3"]').tab('show');
        }


        if (status == 6) {
            $("[type=submit]").attr("disabled", true);
        }
    })
    function get_extra_cost(obj) {
        var id = obj.id;
        var tableName = $(obj).attr('table_name'); //ajax_data_edit
        $.ajax({
            type: "get",
            url: "<?php echo base_url('index.php/UserRecordManagement/ajax_data_edit'); ?>",
            data: {'id': id, 'table_name': 'nfw_custom_form_data_price', 'column_name': 'nfw_custom_form_data_id'},
            dataType: 'json',
            success: function (data)
            {                 //console.log(JSON.parse(data['custom_form_data_price']));
                var htmls = '';
                $.each(JSON.parse(data['custom_form_data_price']), function (key, value) {
                    //console.log(key, value);
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
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_main/plugins/toword/toword.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
    });
</script>

<script type = "text/javascript" >


    function printDivNext() {
        var printContents = "<h2 style='text-align:center'>Nita Fashions</h2>" + document.getElementById("printPyamentReport").innerHTML;
        var myWindow = window.open('', '');

        myWindow.document.write(printContents);
        myWindow.document.style = "margin:0px"
//        myWindow.document.close();
        myWindow.focus();
        myWindow.print();
//        myWindow.close();
    }

</script>

<?php
$this->load->view('layout/layoutFooter');
?>   
