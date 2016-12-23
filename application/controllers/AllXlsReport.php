<?php

error_reporting(0);
/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class AllXlsReport extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function order_report($dateRange, $orderstatus, $user_id) {
        #$fobj = new FabricHandler();
        #$fabricList = $fobj->fabricList();
        $dateRange = urldecode($dateRange);
        $dateRange1 = "'" . str_replace(" to ", "' and '", $dateRange) . "'";
        $data1 = "'" . str_replace(" to ", " To ", $dateRange) . "'";
        //$data['date1'] = $dateRange;

        $orderList = $this->User_model->order_full_detail5($dateRange1, $orderstatus, $user_id);

        //print_r($orderList);
        $headers = array('S.No.', 'Client Code', 'First Name', 'Middle Name', 'Last Name', 'Mobile No.', 'Telephone No.', 'Fax No.', 'Email', 'Shipping Address', 'Shipping Country', 'Billing Address', 'Order No', 'Item Code - Item Name - Quantity', 'Payment Method ', 'Invoice No', 'Quantity', 'Coupon Information', 'Price', 'Date/Time', 'Status', 'Status Update On');
        $filename = 'order_list';

        function cleanData(&$str) {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"'))
                $str = '"' . str_replace('"', '""', $str) . '"';
        }

// filename for download
        $filename = $filename . "_" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename='$filename'");
         header("Content-Type: application/vnd.ms-excel");

        $flag = false;

        echo "\t\t" . 'All Order Reports Date ' . trim($data1, "'") . "\r\n \r\n";
        foreach ($headers as $key => $value) {

            echo $value . "\t";
        }

        echo "\r";
        $count = 0;
        foreach ($orderList as $k => $value) {

            $user_info = $this->User_model->phpjsonstyle($value['user_info'], 'php');
            foreach ($user_info as $k => $v) {
                $value[$k] = $v;
            }

            echo $count + 1 . "\t";
            echo $value['registration_id'] . "\t";

            echo $value['first_name'] . "\t";
            echo $value['middle_name'] . "\t";
            echo $value['last_name'] . "\t";
            echo str_replace("-", " ", $value['contact_no']) . "\t";
            echo str_replace("-", " ", $value['telephone_no']) . "\t";
            echo str_replace("-", " ", $value['fax_no']) . "\t";

            echo $value['email'] . "\t";

            $shipping = $this->User_model->phpjsonstyle($value['shipping'], 'php');
            $shipping_array = array_values($shipping);

            $billing = $this->User_model->phpjsonstyle($value['billing'], 'php');
            $billing_array = array_values($billing);


            echo implode(" ", $shipping_array) . "\t";
            //print_r($value['shipping_cont']);
            echo $value['country'] . "\t";
            echo implode(" ", $billing_array) . "\t";

            echo $value['order_no'] . "\t";
            $skudata = $this->User_model->xls_report_data($value['order_id']);
            $temp = [];
            $temp2 = [];

            foreach ($skudata as $s => $value1) {
                $v1 = $value1['sku'] . '-' . $value1['item_name'] . '-' . $value1['quantity'];
                array_push($temp2, $v1);
            }


            echo implode(', ', $temp2) . "\t";
            echo 'Card' . "\t";
            echo $value['invoice_no'] . "\t";
            echo $value['total_quantity'] . "\t";

            if ($value['coupon_code']) {
                echo $value['coupon_code'] . '/' . $value['coupon_type'] . '/$' . $value['coupon_value'] . "\t";
            } else {
                echo "\t";
            }
            echo $value['total_price'] . "\t";
            echo $value['op_date'] . ' ' . $value['op_time'] . "\t";
            echo $value['title'] . "\t";
            echo $value['status_date'] . "\t";
            echo "\r\n";
            $count++;
        }
    }

}

?>