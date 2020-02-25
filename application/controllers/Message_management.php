<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class Message_management extends CI_Controller { 

    // IMAP/POP3 (mail server) LOGIN
    var $imap_server = 'pop.nitafashions.com';
    var $imap_user = 'noreply@nitafashions.com';
    var $imap_pass = 'India$2017';

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('Imap');
    }

    public function index() {
        $this->inbox_information();
    }

    public function urlpath() {
        $url = base_url();
        return str_replace("nitaFashionsAdmin", "frontend", $url);
    }

    public function get_mail() {

        $this->load->view('messageManagement/mail_view');
    }

    public function inbox_information() {
        $this->load->view('messageManagement/inboxView');
    }

    public function compose_mail_information() {
        if (isset($_POST['send_mail'])) {
            $subject = $this->input->post('subject');
            include APPPATH . 'third_party/class.phpmailer.php';
            $email = $this->input->post('sender');
            $mail = new PHPMailer; // call the class  
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;  // authentication enabled
            // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = mail_host;
            $mail->Port = mail_port;
            $mail->Username = mail_username; //Username for SMTP authentication any valid email created in your domain
            $mail->Password = mail_password; //Password for SMTP authentication
            $mail->AddReplyTo(mail_reply_to, mail_tag); //reply-to address
            $mail->SetFrom(mail_from, mail_tag); //From address of the mail the mail
            // put your while loop here like below,
            $mail->Subject = $subject; //Subject od your mail
            $mail->AddCC(mail_reply_to);
            $mail->AddBCC(mail_username);
            foreach ($email as $to_add) {
                $mail->AddAddress($to_add);              // name is optional
            }
            $description = $this->input->post('content');
            $mail->MsgHTML($description); //Put your body of the message you can place html code here
//        $url = 'file:///home/atharva/Downloads/Order.pdf';
//        $mail->AddAttachment($url); //Attach a file here if any or comment this line, 
            for ($i = 0; $i < count($email); $i++) {
                $sendData = array(
                    'sender' => $email[$i],
                    'subject' => $subject,
                    'content' => $description,
                    'op_date_time' => date('Y-m-d h:m:s'),
                );
                $this->db->insert('nfw_mail_sending', $sendData);
                $sendId = $this->db->insert_id();
                $this->User_model->tracking_data_insert('nfw_mail_sending', $sendId, 'insert');
            }
            $send = $mail->Send(); //Send the mails
            redirect('Message_management/compose_mail_information');
        }
        $this->load->view('messageManagement/composeMailView');
    }

    public function news_letter_xls() {
        $html = $this->load->view('messageManagement/newsLetterXls', array(), TRUE);
        ob_clean();
        $filename = isset($_REQUEST['frequency']) ? $_REQUEST['frequency'] : 'Full Experience';
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Content-Type: application/vnd.ms-excel");
        echo $html;
    }

    public function news_letter_xls_unsubscrib() {
        $html = $this->load->view('messageManagement/newsLetterXlsUnsubscrib', array(), TRUE);
        ob_clean();
        $filename = 'Unsubscribed';
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Content-Type: application/vnd.ms-excel");
        echo $html;
    }

    public function news_letter($id = '', $operator = '') {
        $data['news_letter'] = $this->Product_model->get_table_information('nfw_news_letters');
        if (isset($_GET['unblock'])) {
            $unid = $_GET['unblock'];
            $this->db->where('user_id', $unid);
            $this->db->delete('nfw_news_letters_unsubscribe');
            redirect('Message_management/news_letter');
        }
        if (isset($_POST['submit'])) {

            $data = array(
                'title' => $this->input->post('title'),
                'short_description' => $this->input->post('short_description'),
                'message' => $this->input->post('message'),
                'op_date' => date('Y-m-d'),
                'op_time' => date('h:m:s')
            );
            $this->db->insert('nfw_news_letters', $data);
            $id = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_news_letters', $id, 'insert');
            $receiverId = $this->input->post('receipt');

            if ($receiverId) {
                $dataReceived = explode(', ', $receiverId);
                for ($i = 0; $i < count($dataReceived); $i++) {
                    $data1 = array(
                        'news_letter_id' => $id,
                        'receiver_id' => $dataReceived[$i],
                        'flag' => 0
                    );
                    $this->db->insert('nfw_news_letter_box', $data1);
                    $newsLetterId = $this->db->insert_id();
                    $this->User_model->tracking_data_insert('nfw_news_letter_box', $newsLetterId, 'insert');

                    $urlb = $this->urlpath();
                    $notification = array(
                        'title' => $this->input->post('title'),
                        'message' => 'Newsletter received',//$this->input->post('short_description'),
                        'user_id' => $dataReceived[$i],
                        'status' => '0',
                        'page_link' => $urlb . "views/newsLetter.php",
                    );
                    $this->User_model->user_notification($notification);
                }
            }

            //$receiverId = "";

            include APPPATH . 'third_party/class.phpmailer.php';
            $email = $this->input->post('receipt');
            $email = explode(", ", $email);
            $email_addr = array();
            foreach ($email as $key => $value) {
                $user_data = $this->Product_model->get_table_information('auth_user', 'id', $value);
                $tmail = end($user_data);
                array_push($email_addr, $tmail['email']);
            }
            $email = $email_addr;

            foreach ($email as $to_add) {
                $mail = new PHPMailer; // call the class  
                $mail->IsSMTP();
                $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true;  // authentication enabled
                // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = mail_host;
                $mail->Port = mail_port;
                $mail->Username = mail_username; //Username for SMTP authentication any valid email created in your domain
                $mail->Password = mail_password; //Password for SMTP authentication
                $mail->AddReplyTo(mail_reply_to, mail_tag); //reply-to address
                $mail->SetFrom(mail_from, mail_tag); //From address of the mail the mail
                // put your while loop here like below,
                $mail->Subject = $_POST['title']; //Subject od your mail
             $mail->AddCC(mail_reply_to);
            $mail->AddBCC(mail_username);

                $mail->AddAddress($to_add);              // name is optional


                $baselink = 'http://' . $_SERVER['SERVER_NAME'];
                $baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend/views' : $baselink . '/frontend/views';
                $unlink = $baselinkmain . '/unsubscribe.php?block_email=' . $to_add;
                $mass = $_POST['message'];
                $mass = str_replace('---userlink---', $unlink, $mass);
                $msg = "<div style='text-align:left;padding:20px 0px;' >" . $_POST['short_description'] . '</div><br/><br/>' . $mass;
                $mail->MsgHTML($msg); //Put your body of the message you can place html code here
                $send = $mail->Send(); //Send the mails
            }
            for ($i = 0; $i < count($email); $i++) {


                $sendData = array(
                    'mail' => $email[$i],
                    'subject' => $_POST['title'],
                    'content' => $_POST['short_description'] . '<br/><div style="padding:1px;background:#000"><br/>' . $mass,
                    'op_date_time' => date('Y-m-d h:m:s'),
                );
            }

//            //redirect('userRecordManagement/coupon_code_sending/' . $id);
            //redirect('Message_management/news_letter');
        }
        if ($operator == 'delete') {
            $this->User_model->tracking_data_insert('nfw_news_letters', $id, 'delete');
            $this->db->where('id', $id);
            $this->db->delete('nfw_news_letters');
            redirect('Message_management/news_letter');
        }

        $this->load->view('messageManagement/newsLetterView', $data);
    }

#20-nov-2015

    function message_send() {
        $data['userData'] = $this->Product_model->get_table_information('auth_user');
        if (isset($_POST['submit'])) {

            include APPPATH . 'third_party/class.phpmailer.php';
            $email = $this->input->post('receipt');
            $email = explode(", ", $email);

            $mail = new PHPMailer; // call the class  
            $mail->IsSMTP();
            $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;  // authentication enabled
            // $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = mail_host;
            $mail->Port = mail_port;
            $mail->Username = mail_username; //Username for SMTP authentication any valid email created in your domain
            $mail->Password = mail_password; //Password for SMTP authentication
            $mail->AddReplyTo(mail_reply_to, mail_tag); //reply-to address
            $mail->SetFrom(mail_from, mail_tag); //From address of the mail the mail
            // put your while loop here like below,
            $mail->Subject = $_POST['subject']; //Subject od your mail
            $mail->AddCC(mail_reply_to);
            $mail->AddBCC(mail_username); 

            
            foreach ($email as $to_add) {
//                $mail->AddAddress($to_add);    
                   $mail->AddBCC($to_add);// name is optional
            }

            $mail->MsgHTML($_POST['message']); //Put your body of the message you can place html code here
            for ($i = 0; $i < count($email); $i++) {
                $sendData = array(
                    'mail' => $email[$i],
                    'subject' => $_POST['subject'],
                    'content' => $_POST['message'],
                    'op_date_time' => date('Y-m-d h:m:s'),
                );
            }
            $send = $mail->Send(); //Send the mails
//            //redirect('userRecordManagement/coupon_code_sending/' . $id);
        }
        $this->load->view('messageManagement/messageSend', $data);
    }

    function bulknewslatter($title, $msg, $sortd, $receiverId) {
        $data = array(
            'title' => $title,
            'short_description' => $sortd,
            'message' => $msg,
            'op_date' => date('Y-m-d'),
            'op_time' => date('h:m:s')
        );
        $this->db->insert('nfw_news_letters', $data);
        $id = $this->db->insert_id();
        $this->User_model->tracking_data_insert('nfw_news_letters', $id, 'insert');


        if ($receiverId) {



            for ($i = 0; $i < count($receiverId); $i++) {
                $data1 = array(
                    'news_letter_id' => $id,
                    'receiver_id' => $receiverId[$i],
                    'flag' => 0
                );
                $this->db->insert('nfw_news_letter_box', $data1);
                $newsLetterId = $this->db->insert_id();
                $this->User_model->tracking_data_insert('nfw_news_letter_box', $newsLetterId, 'insert');

                $urlb = $this->urlpath();
                $notification = array(
                    'title' => $title,
                    'message' => $sortd,
                    'user_id' => $receiverId[$i],
                    'status' => '0',
                    'page_link' => $urlb . "views/newsLetter.php",
                );
                $this->User_model->user_notification($notification);
            }
        }
    }

    function bulk_message_send_newsletter() {
        $user_data = $this->Product_model->get_table_information('auth_user');
        $emails = array();
        $receiverId = array();
        foreach ($user_data as $key => $value) {
            array_push($emails, $value['email']);
            array_push($receiverId, $value['id']);
        }
        $message = $_POST['message'];
        if ($_POST['msg_type'] == 'newsletter') {



            include APPPATH . 'third_party/class.phpmailer.php';
            for ($i = 0; $i < count($emails); $i++) {



                $mail = new PHPMailer; // call the class  
                $mail->IsSMTP();
                $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true;  // authentication enabled
                //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = mail_host;
                $mail->Port = mail_port;
                $mail->Username = mail_username; //Username for SMTP authentication any valid email created in your domain
                $mail->Password = mail_password; //Password for SMTP authentication
                $mail->AddReplyTo(mail_reply_to, mail_tag); //reply-to address
                $mail->SetFrom(mail_from, mail_tag); //From address of the mail the mail
                // put your while loop here like below,
                $mail->Subject = $_POST['subject']; //Subject od your mail

                $to_add = $emails[$i];
                $mail->AddAddress($to_add);              // name is optional
             $mail->AddCC(mail_reply_to);
            $mail->AddBCC(mail_username);

                $baselink = 'http://' . $_SERVER['SERVER_NAME'];
                $baselinkmain = strpos($baselink, '192.168') ? $baselink . '/nf3/gitfrontend/views' : $baselink . '/frontend/views';
                $unlink = $baselinkmain . '/unsubscribe.php?block_email=' . $to_add;
                $message = $_POST['message'];
                $message = str_replace('---userlink---', $unlink, $message);
                $message = $_POST['sort_des'] . "<br/><br/>" . $message;
                // $this->bulknewslatter($_POST['subject'], $_POST['message'], $_POST['sort_des'], $receiverId);


                $mail->MsgHTML($message); //Put your body of the message you can place html code here

                $send = $mail->Send(); //Send the mails
                echo "success";
            }

            echo "success";
        }
    }

    function bulk_message_send() {
        $user_data = $this->Product_model->get_table_information('auth_user');
        $emails = array();
        $receiverId = array();
        foreach ($user_data as $key => $value) {
            array_push($emails, $value['email']);
            array_push($receiverId, $value['id']);
        }
        $message = $_POST['message'];
        if ($_POST['msg_type'] == 'newsletter') {
            $message = $_POST['sort_des'] . "<br/><br/>" . $message;
            $this->bulknewslatter($_POST['subject'], $_POST['message'], $_POST['sort_des'], $receiverId);
        }

        if (count($emails)) {

            include APPPATH . 'third_party/class.phpmailer.php';
//            $email = $this->input->post('receipt');
//            $email = explode(", ", $email);

            $mail = new PHPMailer; // call the class  
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;  // authentication enabled
            //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = mail_host;
            $mail->Port = mail_port;
            $mail->Username = mail_username; //Username for SMTP authentication any valid email created in your domain
            $mail->Password = mail_password; //Password for SMTP authentication
            $mail->AddReplyTo(mail_reply_to, mail_tag); //reply-to address
            $mail->SetFrom(mail_from, mail_tag); //From address of the mail the mail
            // put your while loop here like below,
            $mail->Subject = $_POST['subject']; //Subject od your mail
            // $mail->AddAddress('sayedhk123@gmail.com');
            foreach ($emails as $to_add) {
                $mail->AddBCC($to_add);              // name is optional
            }

            $mail->MsgHTML($message); //Put your body of the message you can place html code here

            $send = $mail->Send(); //Send the mails
//            //redirect('userRecordManagement/coupon_code_sending/' . $id);
        }
        echo "success";
    }

    function ckupload() {
        $url = 'images/uploads/' . time() . "_" . $_FILES['upload']['name'];

        //extensive suitability check before doing anything with the file…
        if (($_FILES['upload'] == "none") OR ( empty($_FILES['upload']['name']))) {
            $message = "No file uploaded.";
        } else if ($_FILES['upload']["size"] == 0) {
            $message = "The file is of zero length.";
        } else if (($_FILES['upload']["type"] != "image/pjpeg") AND ( $_FILES['upload']["type"] != "image/jpeg") AND ( $_FILES['upload']["type"] != "image/png")) {
            $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
        } else if (!is_uploaded_file($_FILES['upload']["tmp_name"])) {
            $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
        } else {
            $message = "";
            $move = @ move_uploaded_file($_FILES['upload']['tmp_name'], $url);
            if (!$move) {
                $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
            }
            $url = base_url() . $url; 
        }
        $funcNum = $_GET['CKEditorFuncNum'];
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }

    #19dec2015
    #19dec2015

    function mail_inbox() {
        $mbox = imap_open("{mail.nitafashions.com:143}/notls", mail_username, mail_password);

        $data['unseen'] = imap_search($mbox, 'UNSEEN');

        $this->load->view('messageManagement/mailInboxData', $data);
    }

    function mail_detail($msgno) {
        $mbox = imap_open("{mail.nitafashions.com:143}/notls", mail_username, mail_password);
        $MC = imap_check($mbox);
        $output = '';
        $data['unseen'] = imap_search($mbox, 'UNSEEN');
        $overview = imap_fetch_overview($mbox, $msgno, 0);
        $message = imap_fetchbody($mbox, $msgno, 2);

        /* output the email header information */

        $data['subject'] = $overview[0]->subject;
        $data['mail_from'] = $overview[0]->from;
        $data['mail_date'] = $overview[0]->date;

        $data['mail_body'] = $message;
        $this->load->view('messageManagement/mailDetail', $data);  
    }

    function ajax_mail_inbox() {
        $mbox = imap_open("{mail.nitafashions.com:143/imap}INBOX", mail_username, mail_password);
        $MC = imap_check($mbox);
        $MN = $MC->Nmsgs;
        $str = $_REQUEST['start'];
        $lem = $_REQUEST['length'];
        $emails = imap_search($mbox, 'ALL');
        rsort($emails);
        $marray = array_slice($emails, $str, $lem);
        $start = $marray[0];
        $end = end($marray);
        $overview = imap_fetch_overview($mbox, $start . ":" . $end);
        $size = sizeof($overview);
        $tempcontainer = array();
        for ($i = $size - 1; $i >= 0; $i--) {
            $val = $overview[$i];
            $msg = $val->msgno;
            $from = $val->from;
            $date = $val->date;
            $subj = $val->subject;
            $temparray = array();
            // echo "#$msg: From:'$from' Date:'$date' Subject:'$subj'<BR>";
            $temparray['from'] = $from;
            $temparray['sn'] = $msg;
            $temparray['date'] = $date;
            $temparray['sub'] = $val->seen ? $subj : "<b>$subj</b>";
            $temparray['seen'] = $val->seen ? 'Yes' : 'No';
            $temparray['button'] = "<a href='" . base_url() . "index.php/Message_management/mail_detail/" . $msg . "' class='btn btn-" . ($val->seen ? 'info' : 'primary') . " btn-xs'>View</a>";

            array_push($tempcontainer, $temparray);
            imap_close($mbox);
        }
        //print_r($temparray);
        $draw = $_REQUEST['draw'];
        $temp = array("draw" => $draw,
            "recordsTotal" => $MN,
            "recordsFiltered" => $MN,
            "data" => $tempcontainer
        );
        ob_clean();
        echo json_encode($temp);
    }
 
}

?>