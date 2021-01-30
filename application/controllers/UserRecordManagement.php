<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class UserRecordManagement extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Product_model');
        $this->load->library('session');
        $GLOBALS['session_data'] = $this->session->userdata('logged_in');
    }

    public function index() {
        
    }

    public function user_login_record($user_id = '') {
        $query = "select ae.time_stamp,ae.client_ip,au.registration_id,au.first_name,au.last_name,au.middle_name,ae.origin,ae.description from "
                . "  auth_event as ae join auth_user as au on au.id = ae.user_id where au.id = $user_id order by ae.time_stamp desc";
        $data['loginRecord'] = $this->User_model->query_exe($query);
        $this->load->view('userRecordManagement/userLoginRecord', $data);
    }

    public function user_order_history() {
        $data['orderHistory'] = $this->User_model->user_order_history();
        $this->load->view('userRecordManagement/userOrderHistory', $data);
    }

    public function user_current_order($date = '') {
        if (isset($_POST['daterange'])) {
            $dateRange = $_POST['daterange'];
            $user = $_POST['client_id'];
            $user_name = $_POST['client'];
            $orderstatus = $_POST['order_status'];
        } else {
            $dateRange = date("Y-m-d") . " to " . date("Y-m-d");
            $user = '';
            $user_name = '';
            $orderstatus = '0';
        }

        $quryrange = "'" . str_replace(" to ", "' and '", $dateRange) . "'";

        $query = "SELECT * FROM  `nfw_order_status_tag` ";
        $data['orderStatus'] = $this->User_model->query_exe($query);


        $data['orderHistory'] = $this->User_model->order_full_detail5($quryrange, $orderstatus, $user);
        $data['dateRange'] = $dateRange;
        $data['user_id'] = $user;
        $data['client'] = $user_name;
        $data['order_status'] = $orderstatus;
        $this->load->view('userRecordManagement/userCurrentOrder', $data);
    }

    function pdf_report($option, $dateRange, $orderstatus = '0', $user_id = '') {
        $dateRange = urldecode($dateRange);
        $dateRange1 = "'" . str_replace(" to ", "' and '", $dateRange) . "'";
        $data1 = "'" . str_replace(" to ", " To ", $dateRange) . "'";
        $data['date1'] = $dateRange;

        $data['orderHistory'] = $this->User_model->order_full_detail5($dateRange1, $orderstatus, $user_id);

        $html = $this->load->view('userRecordManagement/pdfReport', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        //echo $html;
        $current_date = date('Y-m-d H:i:s');
        //ob_end_clean();
        $file_name = 'orderdetailreport' . $current_date . '.pdf';
        if ($option == 'D') {
            $pdf->Output($file_name, "D");
        }
        if ($option == 'I') {
            $pdf->Output($file_name, "I");
        }
    }

    public function user_profile_record() {
        $data['userProfileInactive'] = $this->User_model->query_exe('select * from auth_user where id not in (SELECT user_id FROM auth_membership) and status = "Inactive" order by id desc');
        $data['userProfile'] = $this->User_model->query_exe('select * from auth_user where id not in (SELECT user_id FROM auth_membership) and status != "Inactive"  order by id desc');
        $this->load->view('userRecordManagement/userProfileRecord', $data);
    }

    public function user_profile_record_xls($user_type) {
        $statusquery = 'status != "Inactive" ';
        $data['usertype'] = 'Active';
        if ($user_type == 'I') {
            $statusquery = 'status = "Inactive" ';
            $data['usertype'] = 'Inactive';
        }

        $data['userProfile'] = $this->User_model->query_exe('select * from auth_user where id not in (SELECT user_id FROM auth_membership) and ' . $statusquery . ' order by id desc');
        $filename = 'customers_report' . "_" . date('Ymd') . ".xls";
        $html = $this->load->view('userRecordManagement/userProfileRecordPdf', $data, TRUE);
        ob_clean();
        header("Content-Disposition: attachment; filename='$filename'");
        header("Content-Type: application/vnd.ms-excel");
        echo $html;
    }

    function user_profile_record_pdf($option, $user_type) {
        $statusquery = 'status != "Inactive" ';
        $data['usertype'] = 'Active';
        if ($user_type == 'I') {
            $statusquery = 'status = "Inactive" ';
            $data['usertype'] = 'Inactive';
        }
        $data['userProfile'] = $this->User_model->query_exe('select * from auth_user where id not in (SELECT user_id FROM auth_membership) and ' . $statusquery . ' order by id desc');
        $data['type'] = 'paf';

        $html = $this->load->view('userRecordManagement/userProfileRecordPdf', $data, TRUE);
        //echo $html;
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $current_date = date('Y-m-d H:i:s');
        $file_name = 'UserReport' . $current_date . '.pdf';
        if ($option == 'D') {
            $pdf->Output($file_name, "D");
        }
        if ($option == 'I') {
            $pdf->Output($file_name, "I");
        }
    }

    public function user_profile_view_info($id) {
        $data['user_id'] = $id;
        $data['profileData'] = $this->Product_model->get_table_information('auth_user', 'id', $id);
        $data['orderHistory'] = $this->User_model->user_wise_order_history($id);
        $this->load->view('userRecordManagement/userProductViewInfo', $data);
    }

    public function order_status_ajax_information() {
        $status = $_GET['status'];
        $data = $this->User_model->user_order_history($status, "");
        echo json_encode($data);
    }

    #17-nov-2015

    public function update_status_mail($order_id, $user_id) {
        //echo 'dfdgfg';
        $data['invoice_info'] = $this->Product_model->get_user_invoice_info($order_id, $user_id);
        $data['user_info'] = $this->Product_model->get_table_information('auth_user', 'id', $user_id);
        $data['orderNo'] = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
        $this->load->view('userRecordManagement/userOrderStatusMail', $data);
    }

    #18-nov-2015

    public function order_shippment_mail($order_id, $user_id) {
        //echo 'dfdgfg';
        $data['invoice_info'] = $this->Product_model->get_user_invoice_info($order_id, $user_id);
        $data['user_info'] = $this->Product_model->get_table_information('auth_user', 'id', $user_id);
        $data['orderNo'] = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
        $this->load->view('userRecordManagement/userOrderShipmentMail', $data);
    }

    public function mailsending($order_id, $user_id) {
        $urlb = $this->urlpath();
        $url = "http://email.nitafashions.com/nfemail/views/sendMail.php?order_id=$order_id&user_id=$user_id&mail_type=1&mail_set=order";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
//        redirect($urlb . "views/sendMail.php?order_id=$order_id&user_id=$user_id");
    }

    public function urlpath() {
        $url = base_url();
        return str_replace("nitaFashionsAdmin", "frontend", $url);
    }

    #########################################
    #10dec2015

    public function update_order_status($id, $userId) {

        $data['order_id'] = $id;

        $data['checkcard'] = FALSE;


        $order_refund_query = "SELECT date_time, credit_amt, remark FROM nfw_refund_admin where order_id = $id";
        $refundData = $this->User_model->query_exe($order_refund_query);

        //$refundData = end($refundData);

        $data['refundData'] = $refundData;

        $data['invoice_info'] = $this->Product_model->get_user_invoice_info($id, $userId);
        $orderDetail = $this->User_model->user_whole_order_detail($id);
        //print_r($orderDetail);
        $data['user_info'] = $this->User_model->phpjsonstyle($orderDetail[0]['user_info'], 'php');
        $data['billing_info'] = []; //$this->User_model->phpjsonstyle($orderDetail[0]['billing_id'], 'php');
        $data['shipping_info'] = $this->User_model->phpjsonstyle($orderDetail[0]['shipping_id'], 'php');
        //$data['card_data'] = $this->User_model->phpjsonstyle($orderDetail[0]['card_id'], 'php');
        $payment_method = $orderDetail[0]['payment_gateway'];
        $data['incpayment'] = $payment_method;
        if ($payment_method == 'PayPal') {
            $dassss = $this->User_model->phpjsonstyle($orderDetail[0]['payment_gateway_return'], 'php');
            $temp_arry = array(
                'transaction_id' => $dassss['PAYMENTREQUESTINFO_0_TRANSACTIONID'],
                'transaction_type' => 'Paypal',
                'option' => '1'
            );
            $data['payment_option'] = $temp_arry;
        } elseif ($payment_method == 'Manual payment') {
            $temp_arry = array(
                'transaction_id' => 'Manual payment',
                'option' => '2'
            );
            $data['payment_option'] = $temp_arry;
        } else {
            $dassss = $this->User_model->phpjsonstyle($orderDetail[0]['payment_gateway_return'], 'php');

            $temp_arry = array(
                'card_holder_name' => '',
                'card_number' => '',
                'expiry_month' => '',
                'expiry_year' => '',
                'cvv' => '',
                'option' => '3'
            );
            $data['payment_option'] = $temp_arry;
        }
        $data['order_status'] = $this->User_model->get_order_status($id);
        //print_r($data['order_status']);
        $shipping_detail = $this->Product_model->get_table_information('nfw_order_shipping', 'order_id', $id);
        $temparray = array('tracking_no' => '',
            'tracking_link' => '',
            'total_weight' => '',
            'shipping_company' => '',
            'shipping_tel_no' => ''
        );
        $data['shipping_detail'] = count($shipping_detail) ? end($shipping_detail) : $temparray;
        // $query = "select ost.title as order_status,os.remark,os.op_date_time from nfw_order_status_tag as ost join nfw_old_order_status as os on os.status = ost.id where os.order_id = $id ";
        $data['order_status_record'] = $this->User_model->order_status_record($id);

        //print_r($_POST);


        if (isset($_POST['submit'])) {
            $data = $this->User_model->get_old_status($id);
            $this->db->insert('nfw_old_order_status', $data[0]);
            $this->User_model->tracking_data_insert('nfw_order_status', $id, 'update');
            $order_status_data = array();
            $order_status_data['status'] = $_POST['status'];
            $order_status_data['order_id'] = $id;
            $order_status_data['remark'] = $_POST['remark'];
            $order_status_data['op_date_time'] = date('Y-m-d h:m:s');
            $this->db->where('order_id', $id);
            $this->db->update('nfw_order_status', $order_status_data);
            ###########################
            $trans_no = $_POST['transaction_no'];
            $trans_amnt = $_POST['transaction_amount'];
            $stat = $_POST['transaction_status'];
            $query = "update nfw_order_payment set transaction_no = '$trans_no',status = '$stat' where order_id = $id";
            $this->db->query($query);
            ##########################
            $this->mailsending($id, $userId);
            #################3

            redirect('userRecordManagement/update_order_status/' . $id . '/' . $userId);
        }



        if (isset($_POST['close_order'])) {
            $status = $_POST['status'];
            $statusCheck = "SELECT os.order_id,os.status FROM `nfw_order_status` as os 
                              join nfw_old_order_status as ors on
                              os.order_id = ors.order_id
                              where os.order_id = $id and os.status = $status ";
            $checkResult = $this->User_model->query_exe($statusCheck);
            if ($checkResult) {
                //print_r($checkResult);
            } else {
                $data = $this->User_model->get_old_status($id);
                $this->db->insert('nfw_old_order_status', $data[0]);
                $this->User_model->tracking_data_insert('nfw_order_status', $id, 'update');
                $order_status_data = array();
                $order_status_data['status'] = $_POST['status'];

                $order_status_data['order_id'] = $id;
                $order_status_data['remark'] = $_POST['remark'];
                $order_status_data['op_date_time'] = date('Y-m-d h:m:s');

                $this->db->where('order_id', $id);
                $this->db->update('nfw_order_status', $order_status_data);
                ###########################
                $this->mailsending($id, $userId);
            }
            redirect('userRecordManagement/update_order_status/' . $id . '/' . $userId);
        }

        if (isset($_POST['pending_order'])) {
            $status = $_POST['status'];
            $statusCheck = "SELECT os.order_id,os.status FROM `nfw_order_status` as os 
                              join nfw_old_order_status as ors on
                              os.order_id = ors.order_id
                              where os.order_id = $id and os.status = $status ";
            $checkResult = $this->User_model->query_exe($statusCheck);
            if ($checkResult) {
                //print_r($checkResult);
            } else {
                $data = $this->User_model->get_old_status($id);

                $this->db->insert('nfw_old_order_status', $data[0]);
                $this->User_model->tracking_data_insert('nfw_order_status', $id, 'update');
                $order_status_data = array();
                $order_status_data['status'] = $_POST['status'];
                $order_status_data['order_id'] = $id;
                $remark = $_POST['pending_reason'] . '<br/> ' . $_POST['remark'];
                $order_status_data['remark'] = $remark;
                $order_status_data['op_date_time'] = date('Y-m-d h:m:s');

                $this->db->where('order_id', $id);
                $this->db->update('nfw_order_status', $order_status_data);
                ###########################
                $this->mailsending($id, $userId);
                redirect('userRecordManagement/update_order_status/' . $id . '/' . $userId);
            }
        }

        if (isset($_POST['checkpassword'])) {
            $masterpassword = $_POST['masterpassword'];

            $this->db->from("server_conf");
            $query = $this->db->get();
            $passwordconf = $query->row();
            if ($passwordconf->static_password == $masterpassword) {
                $data['checkcard'] = TRUE;
            }
        }
        if (isset($_POST['hidecard'])) {
            $data['checkcard'] = FALSE;
            redirect('userRecordManagement/update_order_status/' . $id . '/' . $userId);
        }

        if (isset($_POST['shipping_done'])) {
            $data = $_POST;

            $spdate = $data['shipping_date'];
            $sptime = $data['shipping_time'];
            $spdatetime = $spdate . " " . $sptime;
            $data['op_date_time'] = $spdatetime;

            unset($data['shipping_done']);
            unset($data['shipping_date']);
            unset($data['shipping_time']);

            $this->db->insert('nfw_order_shipping', $data);
            $insertId = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_order_shipping', $insertId, 'insert');

            $data1 = $this->User_model->get_old_status($id);

            $this->db->insert('nfw_old_order_status', $data1[0]);
            $this->User_model->tracking_data_insert('nfw_order_status', $id, 'update');
            $order_status_data = array();
            $order_status_data['status'] = $data['status'];
            $order_status_data['order_id'] = $id;
            $order_status_data['remark'] = $data['tracking_no'] . ',<a href="' . $data['tracking_link'] . '" target="_blank">' . $data['tracking_link'] . '</a>' . ' ,' . $data['shipping_company'];
            $order_status_data['op_date_time'] = $spdatetime;
            $this->db->where('order_id', $id);
            $this->db->update('nfw_order_status', $order_status_data);
            $this->mailsending($id, $userId);
            redirect('userRecordManagement/update_order_status/' . $id . '/' . $userId);
        }

        $this->load->view('userRecordManagement/updateOrderStatus', $data);
    }

    public function profile_update_info() {
        if (isset($_POST['update'])) {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
            );
            $id = $this->input->post('login_id');
            $this->User_model->tracking_data_insert('auth_user', $id, 'update');
            $this->db->where('id', $id);
            $this->db->update('auth_user', $data);
            redirect('LoginAndLogout', 'refresh');
        }
        $this->load->view('userRecordManagement/profileUpdateView');
    }

    public function search_order_information() {
        $searchText = $_REQUEST['searchText'];
        $data = $this->User_model->search_order_information($searchText);
        echo json_encode($data);
    }

    function universalCoupon() {
        $shipping_data = $this->Product_model->get_table_information('nfw_universal_coupon');
        $data['coupon_data'] = end($shipping_data);

        $discount_data = $this->Product_model->get_table_information('nfw_flat_discount');
        $data['discount_data'] = end($discount_data);

        if (isset($_POST['update_coupon'])) {
            $coupon_data = array(
                'coupon_code' => $this->input->post('coupon_code'),
                'coupon_amount' => $this->input->post('coupon_amount'),
                'coupon_status' => $this->input->post('coupon_status'),
                'created_datetime' => date('Y-m-d H:m:s'),
            );

            $this->db->where('id', '1');
            $this->db->update('nfw_universal_coupon', $coupon_data);
            redirect('userRecordManagement/universalCoupon');
        }


        if (isset($_POST['update_discount'])) {
            $discount_data = array(
                'discount_type' => $this->input->post('discount_type'),
                'discount_value' => $this->input->post('discount_value'),
                'discount_status' => $this->input->post('discount_status'),
                'discount_datetime' => date('Y-m-d H:m:s'),
            );

            $this->db->where('id', '1');
            $this->db->update('nfw_flat_discount', $discount_data);
            redirect('userRecordManagement/universalCoupon');
        }


        $this->load->view('userRecordManagement/universal_coupon', $data);
    }

    public function coupon_generate() {


        $balancequery = "SELECT nc.* FROM nfw_coupon as nc
                  WHERE id not in(select coupon_id from nfw_product_order) 
                  and coupon_code not in(SELECT reference_id FROM nfw_wallet)
                  and CURDATE() between start_date and end_date
                  and nc.id not in( select coupon_id from nfw_coupon_purchase)
                  and nc.id not in( select coupon_id from nfw_coupon_sending_info)";
        $data['couponData'] = $this->User_model->query_exe($balancequery);

        if (isset($_POST['submit'])) {
            $data = $_POST;
            unset($data['submit']);
            $data['coupon_type'] = 'Gift';
            $this->db->insert('nfw_coupon', $data);
            $lastId = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_coupon', $lastId, 'insert');
            redirect('userRecordManagement/coupon_generate');
        }
        if (isset($_POST['update'])) {
            $data = $_POST;
            $id = $data['update_id'];
            unset($data['update_id']);
            unset($data['update']);
            $this->User_model->tracking_data_insert('nfw_coupon', $id, 'update');
            $this->db->where('id', $id);
            $this->db->update('nfw_coupon', $data);
            redirect('userRecordManagement/coupon_generate');
        }
        $this->load->view('userRecordManagement/coupon', $data);
    }

    public function ajax_data_edit() {
        $id = $_REQUEST['id'];
        $this->db->select('*');
        $this->db->from($_REQUEST['table_name']);
        $this->db->where($_REQUEST['column_name'], $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }

            $data1 = $data[0];
            //$data2 = $this->phpjsonstyle($data1, 'php');
            echo json_encode($data1);
        }
    }

    public function ajax_data_delete() {
        $id = $_REQUEST['id'];
        $this->User_model->tracking_data_insert('nfw_coupon', $id, 'delete');
        $this->db->where($_REQUEST['column_name'], $id);
        $this->db->delete($_REQUEST['table_name']);
        echo 'success';
    }

    public function user_detail_info($id) {
        if (isset($_POST['updateProfile'])) {
            $profileData = $_POST;
            $userId = $profileData['user_id'];
            unset($profileData['updateProfile']);
            unset($profileData['user_id']);
            $this->User_model->tracking_data_insert('auth_user', $userId, 'update');
            $this->db->where('id', $userId);
            $this->db->update('auth_user', $profileData);
            redirect('userRecordManagement/user_detail_info/' . $id);
        }
        if (isset($_POST['updateStatus'])) {
            $userId = $this->input->post('user_id');
            $statusData = array(
                'status' => $this->input->post('status'),
                'remark' => $this->input->post('remark'),
            );
            $this->User_model->tracking_data_insert('auth_user', $userId, 'update');
            $this->db->where('id', $userId);
            $this->db->update('auth_user', $statusData);
            redirect('userRecordManagement/user_detail_info/' . $id);
        }
        if (isset($_POST['updateAddress'])) {
            $addId = $this->input->post('id');

            $addData = array(
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'zip' => $this->input->post('zip'),
                'contact_no' => $this->input->post('contact_no'),
            );

            $addDataTemp = array();
            foreach ($addData as $key => $value) {
                $v1 = str_replace(':', ' ', $value);
                $v2 = str_replace(',', ' ', $v1);
                $addDataTemp[$key] = $v1;
                $addDataTemp[$key] = $v2;
            }


            $this->db->where('id', $addId);
            $this->db->update('nfw_billing_shipping_address', $addDataTemp);
            redirect('UserRecordManagement/user_detail_info/' . $id);
        }
        $data['user_id'] = $id;
        $data['profile'] = $this->Product_model->get_table_information('auth_user', 'id', $id);
        $billShipp = $this->User_model->user_billing_shipping($id);
        //print_r($billShipp);
        $data['billing'] = $billShipp['billing'][0];
        $data['shipping'] = $billShipp['shipping'][0];
        $data['extraAddress'] = $billShipp['extra_address'][0];
        $data['invoiceData'] = $this->User_model->user_wise_order_history($id);
        $data['trackingData'] = $this->User_model->user_order_tracking_info($id);
        $data['paymentinfo'] = $this->User_model->payment_history($id);
        $this->load->view('userRecordManagement/userDetailInfo', $data);
    }

    public function search_user_information() {
        $searchText = $_REQUEST['searchText'];
        $data = $this->User_model->search_user_information($searchText);
        echo json_encode($data);
    }

    public function user_registration() {
        if (isset($_POST['submit'])) {
            $fields = $this->db->list_fields('auth_user');
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = $this->input->post($field);
            }
            unset($data['id']);
            unset($data['password']);
            $data['password'] = md5($this->input->post('password'));
            $groupId = $this->input->post('user_type');
            $this->db->insert('auth_user', $data);
            $id = $this->db->insert_id();
            $clientId = 1100 + $id;
            $clientId = 'CLO' . date('ym') . $clientId;
            $authUpdate = array(
                'registration_id' => $clientId,
            );
            $this->User_model->tracking_data_insert('auth_user', $id, 'update');
            $this->db->where('id', $id);
            $this->db->update('auth_user', $authUpdate);
            $this->User_model->tracking_data_insert('auth_user', $id, 'insert');
            $memberData = array(
                'user_id' => $id,
                'group_id' => $groupId
            );
            $this->db->insert('auth_membership', $memberData);
            $id1 = $this->db->insert_id();
            $this->User_model->tracking_data_insert('auth_user', $id1, 'insert');
            redirect('UserRecordManagement/user_registration');
        }
        $this->load->view('userRecordManagement/usersRegistration');
    }

    public function user_privileges() {
        if (isset($_POST['submit'])) {
            $groupId = $this->input->post('group_id');
            $permission = $this->input->post('permission');
        }
        $this->load->view('userRecordManagement/usersPrivileges');
    }

    public function user_tracking_report() {
        $data['trackData'] = $this->User_model->tracking_data();
        $this->load->view('userRecordManagement/userTrackingReport', $data);
    }

    public function custom_style($userId, $id = '') {
        $data['customId'] = $id;
        $customizTable = array('nfw_shirt_custom', 'nfw_pant_custom', ' nfw_waist_coat_custom', 'nfw_jacket_custom', 'nfw_tuxedo_shirt_custom',
            'nfw_tuxedo_pant_custom', 'nfw_tuxedo_suit_custom', 'nfw_suit_custom', '', '');
        $data['customizTable'] = $customizTable[$id - 1];
        if (isset($_POST['submit'])) {
            $data = $_POST;
            $updateId = $data['id'];
            unset($data['id']);
            unset($data['submit']);
            $this->db->where('id', $updateId);
            $this->db->update($customizTable[$id - 1], $data); //$customizTable[$id-1]
            redirect('UserRecordManagement/custom_style/' . $userId . '/' . $id);
        }
        $data['customData'] = $this->Product_model->get_table_information($customizTable[$id - 1], 'user_id', $userId);
        $data['tagData'] = $this->Product_model->get_table_information('nfw_product_tag');
        $this->load->view('userRecordManagement/userCustomStyle', $data);
    }

    public function coupon_code_sending($id) {
        $data['userData'] = $this->Product_model->get_table_information('auth_user');
        $couponData = $this->Product_model->get_table_information('nfw_coupon', 'id', $id);

        $subject = 'Coupon Information';
        include APPPATH . 'third_party/class.phpmailer.php';
        $data['couponData'] = $couponData;
        if (isset($_POST['submit'])) {



            $email = $this->input->post('user_id');

            $user_id = explode('/', $email[0])[1];
            $receiver = $this->Product_model->get_table_information('auth_user', 'id', $user_id);
            $receiver = end($receiver);
            $receiver_name = $receiver['first_name'] . ' ' . $receiver['last_name'];
            $bodymail = $_POST['message'];

            $bodymail = str_replace('--UserName--', $receiver_name, $bodymail);

            //print_r($email);imteyaz_bari@yahoo.com ';
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
            $mail->AddCC(mail_reply_to);
            $mail->AddBCC(mail_username);
            $mail->Subject = $subject; //Subject od your mail
            foreach ($email as $to_add) {
                $res2 = explode('/', $to_add);
                $mail->AddAddress($res2[0], $receiver_name);              // name is optional
            }
            $coupon = $data['couponData'][0];
            $mail->MsgHTML($bodymail); //Put your body of the message you can place html code here
            for ($i = 0; $i < count($email); $i++) {
                $res = explode('/', $email[$i]);

                $sendData = array(
                    'user_id' => $res[1],
                    'coupon_id' => $id,
                    'mail' => $res[0],
                    'subject' => $subject,
                    'content' => $_POST['message'],
                    'op_date_time' => date('Y-m-d h:m:s'),
                );
                //print_r($sendData);
                $this->db->insert('nfw_coupon_sending_info', $sendData);

                $urlb = $this->urlpath();

                $msg = "You have received " . $couponData[0]['value'] . ' ' . ($couponData[0]['value_type'] == 'Fixed' ? 'USD' : $couponData[0]['value_type']) . " Discount.";

                $notification = array(
                    'title' => 'Coupon Received',
                    'message' => "Congratulations!!! " . $msg . "<br/>Start Shoping now",
                    'user_id' => $res[1],
                    'status' => '0',
                    'page_link' => $urlb . "views/storCredit.php",
                );
                $this->User_model->user_notification($notification);

                $sendId = $this->db->insert_id();
                $this->User_model->tracking_data_insert('nfw_coupon_sending_info', $sendId, 'insert');
            }
            $send = $mail->Send(); //Send the mails
            //redirect('userRecordManagement/coupon_generate');
        }
        if (isset($_POST['submitReference'])) {
            $email = $this->input->post('user_ids');
            $res2 = explode('/', $email);
            $delete_ids = $res2[2];
            $datak = array(
                'status' => '1'
            );
            $this->db->where('id', $delete_ids);
            $this->db->update('nfw_site_reference', $datak);
            $content = $this->input->post('msg');
            //// mail ///

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
            $mail->Subject = $subject; //Subject od your mail
            $mail->AddCC(mail_reply_to);
            $mail->AddBCC(mail_username);
            $mail->AddAddress($res2[0], "Nita Fashions");              // name is optional

            $coupon = $data['couponData'][0];
            $mail->MsgHTML("$content"); //Put your body of the message you can place html code here
            $send = $mail->Send(); //Send the mails
            //// end ///
        }
        $data['data'] = $this->User_model->references_user_report();
        $this->load->view('userRecordManagement/couponCodeSending', $data);
    }

    function promoter_pdf($option = '') {
        $data['data'] = $this->User_model->references_user_report();
        $html = $this->load->view('userRecordManagement/promoterPdfReport', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $current_date = date('Y-m-d H:i:s');
        $file_name = 'promoterPdfReport' . $current_date . '.pdf';
        $pdf->Output($file_name, "D");
    }

    public function order_full_detail($id, $billingId, $shippingId, $userId) {
        $data['order_id'] = $id;
        $data['invoice_info'] = $this->Product_model->get_user_invoice_info($id, $userId);
        $data['user_info'] = $this->Product_model->get_table_information('auth_user', 'id', $userId);
        $data['billing_info'] = $this->Product_model->get_table_information('nfw_billing_shipping_address', 'id', $billingId);
        $data['shipping_info'] = $this->Product_model->get_table_information('nfw_billing_shipping_address', 'id', $shippingId);
        $data['order_status'] = $this->User_model->get_order_status($id);
        $data['order_status_record'] = $this->User_model->order_status_record($id);

        $this->load->view('userRecordManagement/orderFullDetail', $data);
    }

    #23-Nov

    function user_whole_order_detail($order_id, $user_id) {
        $data['order_id'] = $order_id;
        $data['orderDetail'] = $this->User_model->user_whole_order_detail($order_id, $user_id);
        $data['invoice_data'] = $this->Product_model->get_user_invoice_info($order_id, $user_id);
        $data['userInfo'] = $this->Product_model->get_table_information('auth_user', 'id', $user_id);
        $data['orderData'] = $this->User_model->get_product_information($order_id);
        $this->load->view('userRecordManagement/userWholeOrderDetail', $data);
    }

    #14-Oct-2015
    ################

    public function admin_user_report() {
        if (isset($_POST['submit'])) {
            $fields = $this->db->list_fields('auth_user');
            $data = [];
            foreach ($fields as $field) {
                $data[$field] = $this->input->post($field);
            }
            $id = $data['id'];
            unset($data['id']);
            unset($data['password']);
            $data['password'] = md5($this->input->post('password'));
            $this->db->where('id', $id);
            $this->db->update('auth_user', $data);
            redirect('userRecordManagement/admin_user_report');
        }
        $data['userData'] = $this->User_model->admin_information();
        $this->load->view('userRecordManagement/adminUserReport', $data);
    }

    public function active_user_report() {
        $data['activeUser'] = $this->User_model->active_user_quantity_info();
        $this->load->view('userRecordManagement/activeUserReport', $data);
    }

    public function popular_custom_product() {
        $data['customData'] = $this->User_model->popular_custom_product();
        $this->load->view('userRecordManagement/popularCustomProduct', $data);
    }

    #21-Oct-2015
    #update 10dec2015

    function worker_order_receipt_pdf($order_id, $userId, $report_type) {
        $orderData = $this->User_model->getOrderDetails($order_id);


        $orderDetails = $orderData['details'];

        $order_no = $orderDetails['order_no'];
        $invoice_no = str_replace("ON", "IN", $order_no);
        $orderDetails['invoice_no'] = $invoice_no;
        $pdfFilePath = $invoice_no;
        $data['orderDetails'] = $orderDetails;

        $data['user_info'] = $this->User_model->phpjsonstyle($orderDetails['user_info'], 'php');

        $data['cartdata'] = $orderData['cartdata'];

        $data['report_type'] = $report_type;
        $this->load->library('M_pdf');

        $pdf = $this->m_pdf->load();
//        ob_end_clean();
        $pdf->useAdobeCJK = true;
        $pdf->setFooter('Page {PAGENO} of {nb}');

        echo $html = $this->load->view('userRecordManagement/workerOrderReceipt', $data, true);
        //$pdf->WriteHTML($html);
        //$pdf->Output($pdfFilePath . ".pdf", "I");
    }

    #28-oct-2015
    #user current order report
    #active_user_pdf

    function active_user_report_pdf($option = '') {
        $data['activeUser'] = $this->User_model->active_user_quantity_info();
        $html = $this->load->view('userRecordManagement/activeUserReportPdf', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $current_date = date('Y-m-d H:i:s');
        $file_name = 'activeuserreport' . $current_date . '.pdf';
        if ($option == 'D') {
            $pdf->Output($file_name, "D");
        }
        if ($option == 'I') {
            $pdf->Output($file_name, "I");
        }
    }

    function user_login_record_pdf($option = '', $user_id) {
        $query = "select ae.time_stamp,ae.client_ip,au.first_name,ae.origin,ae.description from auth_event as ae join auth_user as au on au.id = ae.user_id  where au.id = $user_id order by ae.time_stamp desc";
        $data['loginRecord'] = $this->User_model->query_exe($query);
        $html = $this->load->view('userRecordManagement/userLoginReportPdf', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $current_date = date('Y-m-d H:i:s');
        $file_name = 'userloginreport' . $current_date . '.pdf';
        if ($option == 'D') {
            $pdf->Output($file_name, "D");
        }
        if ($option == 'I') {
            $pdf->Output($file_name, "I");
        }
    }

    #8-dec-2015

    function user_order_status_report($ids = '') {
        $query = "SELECT id,title FROM `nfw_order_status_tag`";
        $data['status_tag'] = $this->Product_model->query_exe($query);
        $data['result'] = $this->User_model->order_status($ids);
        //print_r($result);
        $this->load->view('userRecordManagement/userOrderStatusReport', $data);
    }

    public function refund_mail($user_id, $order_id, $refundId) {
        $user_info = $this->Product_model->get_table_information('auth_user', 'id', $user_id);
        $user_info = end($user_info);
        $order_data = $this->Product_model->get_table_information('nfw_product_order', 'id', $order_id);
        $order_data = end($order_data);
        $refundarray = $this->Product_model->get_table_information('nfw_refund_admin', 'id', $refundId);
        $refund_data = end($refundarray);
        // $referance_no
        $balancequery = "SELECT (sum(credit_amt)-sum(debit_amt) ) as balance FROM nfw_wallet where user_id = $user_id";
        $balace = $this->User_model->query_exe($balancequery);
        if ($balace) {
            $balance = end($balace)['balance'];
        }
        $data['user_firtname'] = $user_info['first_name'];
        $data['user_lastname'] = $user_info['last_name'];
        $data['reference_no'] = $refund_data['reference_id'];
        $data['order_no'] = $order_data['order_no'];
        $data['refund_amount'] = "$" . number_format($refund_data['credit_amt'], 2, '.', '');
        ;
        $data['refund_date'] = $refund_data['date_time'];
        $data['wallet_balance'] = "$" . number_format($balance, 2, '.', '');
        $data['refund_remark'] = $refund_data['remark'];
        $htmls = $this->load->view('userRecordManagement/userOrderRefundMail', $data, true);

        include APPPATH . 'third_party/class.phpmailer.php';
        $email = array($user_info['email']); //'imteyaz_bari@yahoo.com ';
        $mail = new PHPMailer; // call the class  
        $mail->IsSMTP();
        $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = mail_host;
        $mail->Port = mail_port;
        $mail->Username = mail_username; //Username for SMTP authentication any valid email created in your domain
        $mail->Password = mail_password; //Password for SMTP authentication
        $mail->AddReplyTo(mail_reply_to, mail_tag); //reply-to address
        $mail->SetFrom(mail_from, mail_tag); //From address of the mail the mail
        // put your while loop here like below,
        $mail->AddCC(mail_reply_to);
        $mail->AddBCC(mail_username);
        $mail->Subject = 'Your refund has been processed'; //Subject od your mail
        foreach ($email as $to_add) {
            $mail->AddAddress($to_add);              // name is optional
        }
        $mail->MsgHTML($htmls); //Put your body of the message you can place html code here
        $send = $mail->Send(); //Send the mails
    }

    public function refund_management() {
        $referanceq = "SELECT id FROM  nfw_refund_admin";
        $ref = $this->User_model->query_exe($referanceq);
        $refid = '1';
        if ($ref) {
            $refid = end($ref)['id'];
        }
        $balance = 0;
        $reference_no = "RF" . date("Ymd") . $refid;
        $user = '';
        $user_name = '';
        $userquery = "";
        $order_data = NULL;
        if (isset($_GET['client_id'])) {
            if ($_GET['client_id']) {
                $user = $_GET['client_id'];
                $user_name = $_GET['client'];
                $userquery = "where nfo.user_id = '$user'";
                $balancequery = "SELECT (sum(credit_amt)-sum(debit_amt) ) as balance FROM nfw_wallet where user_id = $user";
                $balace = $this->User_model->query_exe($balancequery);
                if ($balace) {
                    $balance = end($balace)['balance'];
                }
                $query = " SELECT nfo.id, nfi.invoice_no, nfo.order_no, nfo.total_price, 
                           ifnull((SELECT sum(credit_amt) FROM nfw_refund_admin where order_id = nfo.id), 0) as refund,
                           (replace(nfo.total_price, '$', '') - ifnull((SELECT sum(credit_amt) FROM nfw_refund_admin where order_id = nfo.id), 0)) as refundable,
                           concat(nfo.op_date, ' ',nfo.op_time) as datetime
                           from nfw_product_order as nfo 
                           join nfw_order_invoice as nfi on nfi.order_id = nfo.id
                           $userquery order by nfo.id desc    ";

                $order_data = $this->User_model->query_exe($query);
            }
        }



        $data['user_id'] = $user;
        $data['balance'] = "$" . number_format($balance, 2, '.', '');
        $data['reference_no'] = $reference_no;
        $data['client'] = $user_name;
        $data['order_data'] = $order_data;

        if (isset($_POST['refund_now'])) {
            $data = $_POST;
            $txn_type = $data['txn_type'];
            $order_id = $data['order_id'];
            $user_id = $data['user_id'];
            $ref_id = $data['reference_id'];
            unset($data['refund_now']);
            unset($data['txn_type']);
            $data['credit_amt'] = number_format($data['credit_amt'], 2, '.', '');

            $this->db->insert('nfw_refund_admin', $data);
            $refundId = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_refund_admin', $refundId, 'update');
            unset($data['order_id']);
            $data['txn_type'] = $txn_type;
            $this->db->insert('nfw_wallet', $data);


            $urlb = $this->urlpath();
            $notification = array(
                'title' => 'Refund Processed',
                'message' => "Your refund have been processed and creadited in your wallet.
                              Reference Id: $ref_id",
                'user_id' => $user_id,
                'status' => '0',
                'page_link' => $urlb . "views/storCredit.php",
            );
            $this->User_model->user_notification($notification);

            $this->refund_mail($data['user_id'], $order_id, $refundId);

            redirect('userRecordManagement/refund_management');
        }

        $this->load->view('userRecordManagement/refundManagement', $data);
    }

    function purchased_coupon_report() {
        $data['data'] = $this->User_model->purchased_coupon_report();
        $data['gift_data'] = $this->User_model->send_gift_coupon_report();
        $this->load->view('userRecordManagement/couponPurchasedReport', $data);
    }

    function purchased_coupon_pdf() {
        $query = $this->db->query(" SELECT concat(au.first_name,' ',au.last_name) as name,c.coupon_code,cp.op_date_time,cp.amount,cp.payment_method
                                      FROM `nfw_coupon_purchase` as cp join nfw_coupon as c on cp.coupon_id = c.id
                                      join auth_user as au on cp.user_id = au.id");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            $data['data'] = $data;
        }
        $html = $this->load->view('userRecordManagement/couponPurchasedPdfReport', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        //echo $html;
        $current_date = date('Y-m-d H:i:s');
        //ob_end_clean();
        $file_name = 'Coupon_Purchased_Report' . $current_date . '.pdf';
        $pdf->Output($file_name, "D");
    }

    function gift_coupon_pdf() {
        $query = $this->db->query("SELECT c.coupon_code,c.value,cs.user_name,cs.user_email,cs.op_date_time,concat(au.first_name,' ',au.last_name) as name,au.email  FROM `nfw_coupon_sendgift` as cs
                  join nfw_coupon_purchase as cp on cs.nfw_purchase_id = cp.id
                  join nfw_coupon as c on cp.coupon_id = c.id
                  join auth_user as au on cp.user_id = au.id ");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            $data['gift_data'] = $data;
        }
        $html = $this->load->view('userRecordManagement/couponGiftPdfReport', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        //echo $html;
        $current_date = date('Y-m-d H:i:s');
        //ob_end_clean();
        $file_name = 'Gifted_Coupon_Report' . $current_date . '.pdf';
        $pdf->Output($file_name, "D");
    }

    function admin_sent_couponreport() {
        $data['data'] = $this->User_model->admin_consumed_coupon();
        $this->load->view('userRecordManagement/adminUsedCoupon', $data);
    }

    function admin_coupon_pdf() {
        $data['data'] = $this->User_model->admin_consumed_coupon();
        $html = $this->load->view('userRecordManagement/adminCouponPdfReport', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        //echo $html;
        $current_date = date('Y-m-d H:i:s');
        //ob_end_clean();
        $file_name = 'Admin_Coupon_Report' . $current_date . '.pdf';
        $pdf->Output($file_name, "D");
    }

    function mail_template_creation($id) {
        $query = "select * from nfw_mail_template";
        $template_data = $this->User_model->query_exe($query);
        if ($id > 0) {
            $query = "select * from nfw_mail_template where id = '$id'";
            $template_data_detail = $this->User_model->query_exe($query);
            $data['template_data'] = $template_data;
            $data['template_data_detail'] = end($template_data_detail);
            $data['template_id'] = $id;
            if (isset($_REQUEST['submit'])) {
                $temp_arry = array(
                    'header' => $this->input->post('elm1'),
                    'footer' => $this->input->post('elm3')
                );
                $this->db->where('id', $id);
                $this->db->update('nfw_mail_template', $temp_arry);
                redirect('userRecordManagement/mail_template_creation/' . $id);
            }
            $this->load->view('userRecordManagement/mailTemplateCreate', $data);
        } else {
            $endid = $template_data[0]['id'];
            redirect('userRecordManagement/mail_template_creation/' . $endid);
        }
    }

    function test() {
        $query = $this->db->query("SELECT header,content,footer FROM `nfw_mail_template`");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            $data['data'] = $data;
        }
        $this->load->view('userRecordManagement/test', $data);
    }

}

?> 