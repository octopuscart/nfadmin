<?php

//$uid = $user_info[0]['id'];
//$oid = $orderNo[0]['id'];
//redirect("http://192.168.3.47/nf3/frontend/views/test.php?order_id=$oid&user_id=$uid");
 $welcomemsg = '
           
<p style="text-align: center;"><img src="http://nf1.costcokart.com/NF_V4/nf3/frontend/assets/images/logo/nf_logo_8.png" style="width: 141.0625px; height: 77.0437173344948px;"><span style="line-height: 1.2;"><br></span></p>
<p style="text-align: center;"><span style="font-size: 24px; font-weight: bold;">YOUR ORDER HAS BEEN PROCESSED</span></p>
<p style="text-align: center;"><span style="font-size: 24px; line-height: 28.799999237060547px;"><br></span></p>
<div style="text-align: left;"><span style="font-size: 14px;">Hello &nbsp;'. ucwords($user_info[0]['first_name'].' '.$user_info[0]['last_name']).',</span></div>
<div style="text-align: left;"><span style="font-size: 14px;"><br></span></div>
<div style="text-align: left; line-height: 1.5;"><span style="font-size: 14px;">Your order  &nbsp;'.$orderNo[0]['order_no']. '&nbsp;has been successfully processed!</span></div>
<div style="text-align: left; line-height: 1.5;"><span style="font-size: 14px;">You can see your order history by going to the <span style="color: rgb(0, 0, 255);">My Account</span>  page and by clicking on order summary.</span></div>
<div style="text-align: left; line-height: 1.5;"><span style="font-size: 14px;">Thanks for shopping with us!</span></div>
<p style="line-height: 1.5;"></p>
<p style="text-align: center; line-height: 1.5;"><span style="font-size: 24px; font-weight: bold; line-height: 28.799999237060547px;"><br></span></p>';

 
    include APPPATH . 'third_party/class.phpmailer.php';
    
    $email = array($user_info[0]['email']); //'imteyaz_bari@yahoo.com ';

    $mail = new PHPMailer; // call the class  
    $mail->IsSMTP();
    $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = "sayedhk123@gmail.com"; //Username for SMTP authentication any valid email created in your domain
    $mail->Password = "libglmetfakmwjyq"; //Password for SMTP authentication
    $mail->AddReplyTo("sayedhk123@gmail.com", "Reply name"); //reply-to address
    $mail->SetFrom("sayedhk123@gmail.com", "Nita Fashions Orders"); //From address of the mail
    // put your while loop here like below,
    $mail->Subject = 'Order'.' '.$orderNo[0]['order_no'].'  Successfully Processed!'; //Subject od your mail
    foreach ($email as $to_add) {
        $mail->AddAddress($to_add, "test send");              // name is optional
    }

    $mail->MsgHTML($welcomemsg); //Put your body of the message you can place html code here
    $send = $mail->Send(); //Send the mails
   // header('location:' . $_SERVER['HTTP_REFERER']);


?>