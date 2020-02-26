<?php
$lng_array = array(
    'Profile' => '',
    'Gender' => '性別',
    'Height' => '高度',
    'Weight' => '重量',
    'Age' => '年齡',
    'Neck' => '領',
    'Chest' => '上圍',
    'Full Shoulder Width' => '肩',
    'Right Sleeve' => '右袖',
    'Left Sleeve' => '左袖',
    'Bicep' => '上臂',
    'Abdomen' => '肚',
    'Wrist' => '手腕',
    'Hips / Seat' => '下圍',
    'Front Shirt Length' => '衫長',
    'Front Jacket Length' => '衫長',
    'Front  Length' => '前長',
    'Trouser Waist' => '腰',
    'Crotch' => '內浪',
    'Trouser Inseam' => '內長',
    'Trouser Outseam' => '外長',
    'Thigh' => '髀',
    'Bottom' => '腳',
    'Waistcoat Front' => '前',
    'Waistcoat Back' => '後',
//    'Stance' => '',
//    'Shoulder Slop' => '',
//    'Chest' => '',
//    'Stomach' => '',
//    'Seat Shape' => '',
);


$wrist_watch = '';
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
    <head>
        <title>Tailoring Report</title>
        <style type="text/css">
            .invoiceTable,.invoiceTr,.invoiceTd{
                border: 1px solid #e4e4e4;
                border-collapse: collapse;

            } 
            .invoiceTr,.invoiceTd{
                padding: 1px;
            }
            .invoiceTd{
                padding-bottom: 0px;
                padding-left: 7px;
                padding-right: 0px;
                padding-top: 0px;
                font-size: 12px !important;

            }
        </style>
    </head>
    <body >

        <div>
            <?php echo pdf_header; ?>
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->


        

        <table style="width:100%;height:50px;border:1px solid rgb(157, 153, 150);font-family: sans-serif;">
            <tr>
                <td colspan="2" style="width:50%">
                    Order Information for Tailor 

                </td>
                <td colspan="2" style="width:50%">
                    Previous Order No. :
                </td>
            </tr>
            <tr>
                <td >Client</td>
                <td ><?php echo $user_info['first_name'] . " " .$user_info['middle_name']. " ".$user_info['last_name'] ;?></td>
                <td >Invoice No.:</td>
                <td ><?php echo $orderDetails['invoice_no'];?></td>
            </tr>
            <tr>
                <td >Order No.</td>
                <td ><?php echo $orderDetails['order_no'];?></td>
                <td >Date/Time</td>
                <td ><?php echo $orderDetails['op_date'];?> / <?php echo $orderDetails['op_time'];?></td>
            </tr>
        </table>


        <!-- tag loop -->
        <?php
        $count = 0;

         foreach ($cartdata as $ckey => $cvalue) {

         
            $item_id = $cvalue['tag_id'];

            switch ($report_type) {
                case 'all':
                    include 'workerReportSupport.php';

                    break;
                case 'shirt':
                    $shirt = array('1', '7');
                    if (in_array($item_id, $shirt)) {

                        include 'workerReportSupport.php';
                    }
                    break;
                case 'jacket':
                    $shirt = array('1', '7');
                    if (in_array($item_id, $shirt)) {
                        
                    } else {
                        include 'workerReportSupport.php';
                    }
                    break;
            }
        }
        ?>
        <!-- loop -->

    </body>
</html>