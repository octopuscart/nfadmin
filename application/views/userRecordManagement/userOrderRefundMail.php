<?php echo $this->User_model->mailsetting_header('header'); ?>
<table width="100%" border="0" style="padding: 5px; background-color: white;" cellspacing="0" cellpadding="0" align="center">
    <tbody>
        <tr>
            <td>
                <table style="    width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 38px  30px  30px  30px; background-color: #fafafa;">
                    <tbody>
                        <tr style="background-color: #FFF;">
                            <td style="width:100%;    padding: 10px;">
                    <center><img src="http://costcointernational.com/frontend/assets/images/logo/nf_logo_8.png" style="height: 100px;width:183px;"></center>
            </td>

        </tr>



    </tbody>
</table>
</td>
</tr>
</tbody>
</table>


<table style="    width: 100%;" border="0" align="center" >
    <tr>
        <td style="text-align:center">

            Reference No.: <?php echo $reference_no; ?>
        </td>
    </tr>
</table>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="    width: 100%;">
    <tbody>
        <tr>
            <td colspan="3" height="10" style="border-bottom: 1px  solid  #eaedef;"></td>
        </tr>
        <tr>
            <td colspan="3" readonly="readonly"><span readonly="readonly" style="
                                                      text-align: center;
                                                      width: 100%;
                                                      font-size: 24px;
                                                      float: left;
                                                      border-bottom: 1px solid #eaedef;
                                                      margin-bottom: 20px;
                                                      padding: 20px 0;
                                                      background-color: #000;
                                                      text-transform: capitalize;
                                                      color: #fff;">


                    Your Refund
                </span>
            </td>

        </tr>
    </tbody>
</table>



<p>Dear <span style="text-transform: capitalize"><?php echo $user_firtname; ?> <?php echo $user_lastname; ?></span>,</p>

<p>
    <?php
    $dateobj = date_create($refund_date);
    $rdate = date_format($dateobj, "d F Y--g:ia");
    $rrdate = str_replace('--', ' at ', $rdate);
    ?>
    We would like to inform you that your refund has been processed on <b><?php echo $rrdate; ?></b> for <b>Order No. <?php echo $order_no; ?></b>, we have credited the

    amount of <b>US<?php echo str_replace("$", "$ ", $refund_amount); ?></b> into your Nita Fashions account.                                                                                                                                            

</p>
<p>
    Please go to <b>My Wallet &gt; Store Credit</b>, to view your account balance.                                                                         
</p>

<p style="">
    Refund Reason: <?php echo $refund_remark; ?>
</p> 

<p>
    If the amount mentioned above has not been updated on to your account, kindly contact us at

    <b>sales@nitafashions.com</b> immediately.                                                                                                                                    
</p>
<table style="    padding-bottom: 40px;">

    <tr>
        <td>
            <h3 class="" style="box-sizing: border-box;  color: rgb(36, 42, 48); margin-top: 20px; margin-bottom: 10px; font-size: 24px;"><small style="box-sizing: border-box; font-size: 14.3999996185303px; line-height: 1; color: rgb(124, 127, 131);">Refund&nbsp;Amount</small>&nbsp;<br style="box-sizing: border-box;" />
                <span id="total_amount" style="box-sizing: border-box;">US<?php echo str_replace("$", "$ ", $refund_amount); ?></span>
            </h3>
        </td>
        <td>
            <h3 class="" style="box-sizing: border-box;  color: rgb(36, 42, 48); margin-top: 20px; margin-bottom: 10px; font-size: 24px;"><small style="box-sizing: border-box; font-size: 14.3999996185303px; line-height: 1; color: rgb(124, 127, 131);">Wallet&nbsp;Account&nbsp;Balance                        </small>&nbsp;<br style="box-sizing: border-box;" />
                <span id="total_amount" style="box-sizing: border-box;">US<?php echo str_replace("$", "$ ", $wallet_balance); ?></span>
            </h3>

        </td>

    </tr>
    <tr>
        <td colspan="2" style="font-size: 14px;
            border-bottom: 1px solid #DCDCDC;">
            Note: Refund amount has been credited in your wallet.
        </td>
    </tr>
</table>





<?php echo $this->User_model->mail_template('General', 'footer'); ?>
<?php echo $this->User_model->mailsetting_header('footer'); ?>
