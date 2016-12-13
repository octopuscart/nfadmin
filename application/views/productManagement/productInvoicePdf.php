<?php
$wordData = explode('%20', $word);
$toword = implode(' ', $wordData);
//$stylesheet = file_get_contents("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css");
//print_r(orderData);
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <title>Shipping Invoice</title>
        <style type="text/css">
            .invoiceTable,.invoiceTr,.invoiceTd{
                border: 1px solid rgb(157, 153, 150);
                border-collapse: collapse;
            }
            .invoiceTr,.invoiceTd{
                padding: 7px;
            }
        </style>

    </head>
    <body >

        <div>
            <div style="text-align:center;margin-bottom:0px"> 
                <span style="font-family: sans-serif;font-size:30px;">
                    Nita Fashions
                </span>
            </div>
            <div style="margin-top:0px;text-align:center;font-family: sans-serif;font-size:12px">
                <span style="">
                    16 Mody Road, GF, T. S. T, Kowloon, Hong Kong<br>
                    T: + (852) 27219990, 27219991,  F: +852 27234886, E: info@nitafashions.com, W: www.nitafashions.com  

                </span>
            </div>
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->
        <div style="width:150px;align:center; margin-left:250px;">
            <div style="text-align: center;margin-bottom: 0px;padding-left: 0px;padding-top: 0px;"> 
                <span style="font-family: sans-serif;font-size:15px;padding:5px;background:rgb(245, 245,245);">
                    <span>INVOICE</span>
                </span>
            </div>
        </div>


        <!----================================= Close==========================================----->

        <div style="width:100%;margin-bottom:13px;margin-top: 10px;font-family: sans-serif;">
            <div style="width:31%;height:177px;float: left;border:1px solid rgb(157, 153, 150); margin-left:0px;font-family: sans-serif;">
                <div style="background:rgb(245, 245, 245);width:220px;padding:5px 5px;" >
                    <span style="font-size:16px">Shipping Information</span>
                </div>
                <table style="padding-bottom:10px;margin-left: 2px;font-size:12px;font-family: sans-serif">
                    <tr style="border-bottom: 1px solid black">
                        <td colspan=3><b><?php echo $user_info[0]['first_name'] . ' ' . $user_info[0]['middle_name'] . ' ' . $user_info[0]['last_name']; ?></b></td> 

                    </tr>
                    <tr> 
                        <td colspan=3><?php echo $shipping_info[0]['add1'] ?></td> 
                    </tr>
                    <tr> 
                        <td colspan=3><?php echo $shipping_info[0]['add2'] ?></td> 
                    </tr> 
                    <tr> 
                        <td colspan=3><?php echo $shipping_info[0]['add3'] ?></td> 
                    </tr> 
                    <tr> 
                        <td colspan=3><?php echo $shipping_info[0]['add4'] ?></td> 
                    </tr>
                    <tr> 
                        <td colspan=3>Phone No.&nbsp;:&nbsp;<?php echo $user_info[0]['contact_no'] ?></td> 
                    </tr> 
                    <tr> 
                        <td colspan=3>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $user_info[0]['email'] ?></td> 
                    </tr>


                </table>   
            </div>
            <!----===================second div=======================------->
            <div style="width:31%;height:177px;float: left;border:1px solid rgb(157, 153, 150); margin-left:10px;font-family: sans-serif;">
                <div style="background:rgb(245, 245, 245);width:220px;padding:5px 5px;font-family: sans-serif;" >
                    <span style="font-size:16px">Billing Information</span>
                </div>
                <table style="padding-bottom:10px;margin-left: 2px;font-size:12px;font-family: sans-serif">
                    <tr style="border-bottom: 1px solid black">
                        <td colspan=3><b><?php echo $user_info[0]['first_name'] . ' ' . $user_info[0]['middle_name'] . ' ' . $user_info[0]['last_name']; ?></b></td> 

                    </tr>
                    <tr> 
                        <td colspan=3><?php echo $billing_info[0]['add1'] ?></td> 
                    </tr>
                    <tr> 
                        <td colspan=3><?php echo $billing_info[0]['add2'] ?></td> 
                    </tr> 
                    <tr> 
                        <td colspan=3><?php echo $billing_info[0]['add3'] ?></td> 
                    </tr> 
                    <tr> 
                        <td colspan=3><?php echo $billing_info[0]['add4'] ?></td> 
                    </tr> 
                    <tr> 
                        <td colspan=3>Phone No.&nbsp;:&nbsp;<?php echo $user_info[0]['contact_no'] ?></td> 
                    </tr> 
                    <tr> 
                        <td colspan=3>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $user_info[0]['email'] ?></td> 
                    </tr>


                </table>   
            </div>
            <!-----===================Close============================------->

            <div style="width:35%;height:176px;float: left;border:1px solid rgb(157, 153, 150); margin-left:10px;font-family: sans-serif;">
                <div style="background:rgb(245, 245, 245);width:250px;padding:5px 5px;" >
                    <span style="font-size:16px"> Invoice Information</span>
                </div>
                <table style="padding-bottom:10px;margin-left:1px;font-family: sans-serif;font-size:12px"> 
                    <tbody>
                        <tr style="">
                            <td>Invoice No</td>
                            <td>:</td>
                            <td><span><?php echo $invoice_info[0]['invoice_no'] ?></span></td>
                        </tr> 
                        <tr>
                            <td>Date/Time</td>
                            <td>:</td>
                            <td><span><?php echo $invoice_info[0]['op_time'] ?></span></td>
                        </tr>
                     
                        <tr>
                            <td>Order No.</td>
                            <td>:</td>
                            <td><span ><?php echo $orderNo[0]['order_no'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Client Code</td> 
                            <td>:</td>
                            <td><span ><?php echo $user_info[0]['registration_id']; ?></span></td>
                        </tr>
                        <tr>
                            <td>Currency</td> 
                            <td>:</td>
                            <td><span >USD</span></td>
                        </tr>
                        <tr>
                            <td>Payment Method</td> 
                            <td>:</td>
                            <td><span>Credit Card</span></td>
                        </tr>


                    </tbody>
                </table>                        
            </div>

        </div>

        <div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:0px;font-size:16px;border:1px solid rgb(157, 153, 150);">
            <div style="padding:10px;">
                Order Description
            </div>
        </div> 

        <!-- table description -->

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
            <input type="hidden" name="trLength" value="1" id="trlength"/>
            <tbody >
                <tr class="invoiceTr" style="font-weight: bold;text-align: left" class="fabricInvoiceTr" >
                    <th class="invoiceTd colspan" style="width:7%;text-align: left">S.N.</th>
                    <th class="invoiceTd colspan" style="width:8%;text-align: left">SKU</th>
                    <th class="invoiceTd colspan" style="width:14%;text-align: left">Item Code</th>
                    <th class="invoiceTd colspan" style="width:15%;text-align: left">Item Image</th>
                    <th class="invoiceTd colspan" style="width:15%;text-align: left">Item Name</th>
                    <th class="invoiceTd colspan" style="width:21%;text-align: left">Description</th>
                    <th class="invoiceTd colspan" style="width:6%;text-align: left">Qty</th>
                    <th class="invoiceTd colspan" style="width:10%;text-align: left">Price</th>
                    <th class="invoiceTd colspan" style="width:13%;text-align: left">Ext. Price</th>
                    <th class="invoiceTd colspan" style="width:14%;text-align: left">Total Price</th>

                </tr>
                <?php
                $total = 0;
                $count = 1;
                for ($i = 0; $i < count($orderData); $i++) {
                    $data5 = $orderData[$i];
                    ?>
                    <tr  class="invoiceTd">
                        <td class="invoiceTd" style="text-align:right"><?php echo $count++; ?></td>
                        <td class="invoiceTd" style="text-align:left"><?php echo $data5['sku']; ?></td>
                        <td class="invoiceTd" style="text-align:left"><?php echo $data5['product']; ?></td>
                        <td class="invoiceTd" style="text-align:left">
                            <img src="<?php echo image_server;?>"nfw/small/<?php echo $data5['image'] ?>" style="width: 40px;height: 40px;">

                        </td>
                        <td class="invoiceTd" style="text-align:left"><?php echo $data5['item_name']; ?></td>
                        <td class="invoiceTd" style="text-align:left">
                            <span>Style Id</span><br/>
                            <span style="font-size:12px"><?php echo $data5['style']; ?></span><br/>
                <spna>Measurement Profile</spna><br/>
                <span style="font-size:12px"><?php echo $data5['meas'] ?></span>

            </td>
            <td class="invoiceTd" style="text-align:right"><?php echo $data5['quantity']; ?></td>
            <td class="invoiceTd" style="text-align:right"><?php echo $data5['price']; ?></td>
            <td class="invoiceTd" style="text-align:right"><?php echo $data5['extra_price']; ?></td>
            <td class="invoiceTd" style="text-align:right"><?php echo $data5['total_price']; ?></td>
        </tr>
        <?php
        $total = $total + $data5['total_price'];
    }
    ?>

    <tr class="invoiceTr">
        <td class="invoiceTd" colspan=7 rowspan=5></td>
        <td class="invoiceTd colspan" colspan=2 ><b>Sub Total</b></td>
        <td class="invoiceTd colspan" style="text-align:right;"><span><?php echo $total ?></span> 
        </td>                      
    </tr> 
    <tr class="invoiceTr">

        <td class="invoiceTd colspan" colspan=2><b>Tax/Custom</b></td>
        <td class="invoiceTd colspan" style="text-align:right;"><span>0.0</span> 
        </td>                      
    </tr> 
    <tr class="invoiceTr">
        <td class="invoiceTd colspan" colspan=2><b>Discount/Coupon</b></td>  
        <td class="invoiceTd colspan" style="text-align:right;">
            <?php
            if ($coupon) {
                $val1 = $coupon[0]['value'];
                $val_type = $coupon[0]['value_type'];
                if ($val_type == '%') {
                    $data = ($total * $val1) / 100;
                }
                if ($val_type == 'Fix') {
                    $data = $val1;
                }
            }
            ?>
            <?php if ($coupon) { ?> <span><?php echo $data; ?> </span>
            <?php } else { ?><span>0.0</span> <?php }
            ?>
        </td>                  
    </tr>
    <tr class="invoiceTr">

        <td class="invoiceTd colspan" colspan=2> <b>Shipping Cost</b></td>
        <td class="invoiceTd colspan" style="text-align:right;"><span>0.0</span> 
        </td>                      
    </tr> 
    <tr class="invoiceTr">

        <td class="invoiceTd colspan" colspan=2><b>My Wallet</b></td>
        <td class="invoiceTd colspan" style="text-align:right;"><span>0.0</span> 
        </td>                      
    </tr> 

    <tr class="invoiceTr">
        <td class="invoiceTd " colspan=7>
            <b>Amount in Words</b> : <span style="text-align:right;">USD : <?php echo ucwords($toword); ?> </span>
        </td>
        <td class="invoiceTd colspan" colspan=2 style="width:108px"><b>Grand Total</b></td>
        <td class="invoiceTd colspan" style="text-align:right;width:114px"><span>
                <?php
                if ($coupon) {
                    echo explode('$', $coupon[0]['total_price'])[1];
                } else {
                    echo $total;
                }
                ?>
            </span></td>                      
    </tr> 
</table>  
</div>
</div>

<div style="background:#F5F5F5;width:100%;float:left;margin-top:10px;font-size:12px;font-family: sans-serif">
    <div style="padding:10px;" id="footer">
        <b>Note</b>:<br>

        1. Received the above merchandise in fine condition & correct quantity.<br>
        2. Goods once sold can not be returned.<br>
        3. This is computer generated receipt, bear no CHOP.
    </div>
</div> 

</body>
</html>