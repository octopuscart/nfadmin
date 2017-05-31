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
            <?php echo  pdf_header;?>
        </div>   
        <hr></hr>
        <!---================================== Invoice header=================================----->


        <div style="width:100%;height:50px;border:1px solid rgb(157, 153, 150);font-family: sans-serif;">
            <div style="background:rgb(245, 245, 245);width:100%;padding:5px 5px;" >
               <table style="width:100%;">
                 <tr>
                    <td style="font-size:16px;text-align: left;width:68%;float:left;font-family: sans-serif;"> Order Information for Tailor </td>
                    <td style="font-size:14px;text-align: left;width:32%;float:left;font-family: sans-serif;padding-left:5px"> Previous Order No. : </td>
                    </tr>
              </table>
            </div>

            <table style="font-family: sans-serif;font-size:14px;margin-left:1%;margin-top: 1%"> 
                <tbody>
                
                

                    <tr>
                        <td>Client</td> 
                        <td>:</td>
                        <td><span ><?php 
                        echo $user_info['first_name'], " ", $user_info['middle_name'], " ", $user_info['last_name'], " (" . $user_info['registration_id'] . ")"; ?></span>
                        </td>
                    </tr>
                    <tr >
                        <td>Order No.</td>
                        <td>:</td>
                        <td><span ><?php echo $orderNo[0]['order_no'] ?></span></td>
                    </tr>



                </tbody>
            </table> 
            <table style="margin-left:68%;margin-top:-6%;font-family: sans-serif;font-size:14px">

                <tbody>
                    <tr >
                        <td>Invoice No.</td>
                        <td>:</td>
                        <td><span style="text-align:left"><?php echo $invoice_info[0]['invoice_no']; ?></span></td>
                    </tr>
                    <tr >
                        <td>Date/Time</td>
                        <td>:</td>
                        <td><span style="text-align:left"><?php echo $invoice_info[0]['op_date'] . '/' . $invoice_info[0]['op_time']; ?></span></td>
                    </tr>
                </tbody>
            </table>  
        </div>
        <!-- tag loop -->
        <?php
        $count = 0;
      
        for ($i = 0; $i < count($tag_data); $i++) {
           
            $p_detail = $tag_data[$i]['p_data'];
            $item_id = $tag_data[$i]['tag_id'];
                
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
                      
                    }
                    else{
                          include 'workerReportSupport.php';
                         
                    }
                    break;
            }
           
        }
        ?>
        <!-- loop -->
    </body>
</html>