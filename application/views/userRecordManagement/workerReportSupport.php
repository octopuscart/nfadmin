
<!-- Item name ######################################## -->
<div style="width:47%;background:#C0C0C0;float: left;margin-top: 10px;padding: 0 10x;font-family: sans-serif">Items List</div>
<div style="width:47%;background:#C0C0C0;float: right;margin-top: 0px;text-align: right;padding: 0 10x">Quantity : <?php echo $tag_data[$i]['quantity']; ?></div>
<!-- fdghgf########################################################## -->
<table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif">


    <tbody style="font-size:10px">
        <?php
        for ($s = 0; $s < count($p_detail); $s++) {
            $value = $p_detail[$s][0];
            ?>


            <tr class="invoiceTd" >
                <td  rowspan="5" style="width:65px;" class="invoiceTd colspan"> 
                    <img src="<?php echo image_server; ?>/nfw/small/<?php echo $value['image']; ?>" height="50px" width="50px">
                </td>
            </tr>  
            <tr class="invoiceTd" style="text-align:left">
                <th class="invoiceTd"  style="text-align:left">Item Name</th> <td class="invoiceTd" >  <?php echo $value['item_name']; ?></td>

                <td style='width: 300px;text-align: center' rowspan="4">
                    SWATCHES 
                </td>
            </tr>


            <tr style="text-align:left">
                <th class="invoiceTd"  style="text-align:left">Item Code/SKU</th> <td class="invoiceTd" >  <?php echo $value['title']; ?></td>
            </tr>

            <tr class="invoiceTd" >
                <th class="invoiceTd"  style="text-align:left">Item Feature</th> <td class="invoiceTd" > <?php echo $value['product_speciality']; ?></td>
            </tr>
            <tr class="invoiceTd" >
                <th class="invoiceTd"  style="text-align:left">Quantity</th> <td class="invoiceTd" > <?php echo $value['cquantity']; ?></td>
            </tr>
            <tr style="    background-color: #C0C0C0;">
                <td></td>
                <td></td>
                <td></td>
            </tr>

        <?php } ?>


    </tbody>  
</table> 
<!-- style##################################################################### -->
<div style="background:#F5F5F5;width:100%;height:5px;font-family:sans-serif;margin-top:5px;font-size:12px;border:1px solid rgb(157, 153, 150);">
    <div style="padding:5px;text-align: center;font-size:15px;">
        Style Details (#<?php echo $tag_data[$i]['style_id']; ?>)
    </div>
</div> 

<!-- table description -->

<table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif">

    <thead>
        <tr class="invoiceTr" style="text-align: left" >
            <th class="invoiceTd colspan" style="width:50%;text-align: left">Style Field</th>
            <th class="invoiceTd colspan" style="text-align: left">Value</th>
        </tr>
    </thead>
    <tbody style="font-size:10px">
        <
        <?php foreach ($tag_data[$i]['custom'] as $key => $value) { ?>

            <?php
            if ($key == 'Wrist Watch') {
                $wrist_watch = $value;
            }
            ?>
            <tr class="">
                <td class="invoiceTd"><?php echo $key; ?></td>
                <td class="invoiceTd"><?php echo $value; ?></td>
            </tr>

        <?php } ?>

    </tbody>  
</table>  

<!-- Measurement ##################################################################### -->

<div style="background:#F5F5F5;width:100%;height:1%;font-family:sans-serif;margin-top:10px;font-size:12px;border:1px solid rgb(157, 153, 150);">
    <div style="padding:5px;text-align: center;font-size:15px;">
        Measurement Details
    </div>
</div> 

<!-- table description -->
<table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
    <input type="hidden" name="trLength" value="1" id="trlength"/>
    <thead>
        <tr class="invoiceTr" style="text-align: left">
            <th class="invoiceTd colspan" style="width:40%;text-align: left" colspan="2">Measurement Field</th>
            <th class="invoiceTd colspan" style="width: 25%;text-align: left;border-left: none;">Value</th>

            <th class="invoiceTd colspan" style="width: 17.5%;text-align: left;border-left: none;">Allowance</th>
            <th class="invoiceTd colspan" style="width: 17.5%;text-align: left;border-left: none;"> Final Size <br/>
                <small style="font-size: 8px">(Measurement + Allowance)</small>
            </th>
        </tr>
    </thead>
    <tbody >
        <?php
        foreach ($tag_data[$i]['meas'] as $key => $value) {
            ?>

            <tr  class="" style="width:5%">
                <td  class="invoiceTd" style='border-right: none;'>
                    <?php
                    echo $key;
                    ?>
                </td>

                <td class="invoiceTd" style="border-left: none;">
                    <?php
                    echo "<span style='font-family: Sun-ExtA ;font-size: 15px;'>" . $lng_array[$key] . "</span>";
                    ?>
                </td>
                <td class="invoiceTd"><?php echo $value; ?></td>
                <td class="invoiceTd"></td>
                <td class="invoiceTd"></td>
            </tr>



        <?php } ?>
    </tbody>
</table>
<?php
switch ($item_id) {
    case '1':
        ?>
        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:10px; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
            <tbody>
                <tr  class="" style="background:#F5F5F5;">
                    <td colspan="5" style='text-align: center;font-size:15px;padding:5px;'>Remarks</td>
                </tr>
                <tr  class="" >
                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Wrist Watch 
                        <br/>

                        <br/>
                        <?php echo $wrist_watch; ?>
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Armhole 
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Cuff Finish  (Left)
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Cuff Finish  (Right) 
                    </td>
                    <td style='text-align:center;  padding-top: 5px;  vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                    </td>

                </tr> 
            </tbody>
        </table>



        <?php
        break;
    case '7':
        ?>

        <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:10px; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
            <tbody>
                <tr  class="" style="background:#F5F5F5;">
                    <td colspan="5" style='text-align: center;font-size:15px;padding:5px;'>Remarks</td>
                </tr>
                <tr  class="" >
                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Wrist Watch 
                        <br/>
                        <?php echo $wrist_watch; ?>
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Armhole 
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Cuff Finish  (Left)
                    </td>

                    <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                        Cuff Finish  (Right) 
                    </td>
                    <td style='text-align:center;  padding-top: 5px;  vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                    </td>

                </tr> 
            </tbody>
        </table>

        <?php
        break;
    default:
        $armhome = array('5', '10', '11', '12', '13', '14', '15');
        if (in_array($item_id, $armhome)) {
            ?>
            <table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:10px; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
                <tbody>
                    <tr  class="" style="background:#F5F5F5;">
                        <td colspan="5" style='text-align: center;font-size:15px;padding:5px;'>Remarks</td>
                    </tr>
                    <tr  class="" >
                        <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                            Armhole  
                        </td>

                        <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                        </td>

                        <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                        </td>

                        <td style='text-align:center; padding-top: 5px;   vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                        </td>
                        <td style='text-align:center;  padding-top: 5px;  vertical-align: top;height:100px;width:20%;font-size: 12px;border:1px solid #000'>

                        </td>

                    </tr> 
                </tbody>
            </table>
            <?php
        }
}
?>


</tbody>  
</table>  
</div>
<!-- Measurement  ##################################################################### -->

<div style="background:#F5F5F5;width:100%;font-family:sans-serif;margin-top:10px;font-size:15px;border:1px solid rgb(157, 153, 150);">
    <div style="padding:5px;text-align: center">
        Posture Details
    </div>
</div> 

<!-- table description -->
<table class="invoiceTable table" id="footerTable" style="width: 100%;margin-top:0; border:1px solid rgb(157, 153, 150);font-family: sans-serif" >
    <input type="hidden" name="trLength" value="1" id="trlength"/>

    <tbody>
        <tr style="text-align:center;font-size: 12px;">
            <?php
            $posturearray = [];
            $posturearraydiv = $tag_data[$i]['posture'];
            foreach ($tag_data[$i]['posture'] as $key => $value) {
                array_push($posturearray, $key);
            }

            for ($t = 0; $t < 5; $t++) {
                $ky = $posturearray[$t];
                $vl = $posturearraydiv[$ky];
                $posimg = $this->User_model->posture_image($ky, $vl)[0];
                ?>
                <td style='vertical-align: top;text-align:center;padding-top: 5px;height:100px;width:20%;font-size: 12px;border:1px solid #000'>
                    <span ><?php echo $ky; ?></span>

                    <br/> 
                    <?php
                    if ((count($posturearray)) > $t) {
                        ?>
                        <img src="<?php echo $posimg['image']; ?>" style="height:100px;witdh:100px;margin-top: 10px">
                    <?php } ?>
                    <br/>
                    <span ><?php echo $vl; ?></span>
                </td>
                <?php
            }
            ?>
        </tr>
    </tbody>

<!--                <thead>
    <tr class="invoiceTr" style="text-align: left">
        <th class="invoiceTd colspan" style="width:50%;text-align: left">Measurement Field</th>
        <th class="invoiceTd colspan" style="text-align: left">Value</th>
    </tr>
</thead>
<tbody >
    <?php
    foreach ($tag_data[$i]['posture'] as $key => $value) {
        ?>

                                                                        <tr  class="" style="width:5%">
        <?php $posimg = $this->User_model->posture_image($key, $value)[0]; ?>
                                                                            <td  class="invoiceTd"><?php echo $key; ?></td>
                                                                            <td class="invoiceTd" style="padding-top: 10px;">
                                                                                <span ><?php echo $value; ?></span>
                                                                                <br/> 
                                                                                <img src="<?php echo $posimg['image']; ?>" style="height:100px;witdh:100px;margin-top: 10px">
                                                                            </td>
                                                                        </tr>

    <?php } ?>
</tbody>  -->
</table>  
<div>
    <h3 style="font-family:sans-serif;width:100%;float:left">Client Images <p style="font-size:10px">See Below</p></h3>

    <?php
    if (count($tag_data[$i]['user_image'])) {
        foreach ($tag_data[$i]['user_image'] as $key => $value) {
            ?>  <img style='width:330px;margin:10px' src='<?php echo image_server; ?>nfw/medium/<?php echo trim($value, '"'); ?>'  >

            <?php
        }
        echo "<pagebreak />";
    }
    ?>
</div>



</div>



<!--        <PageBreak>-->