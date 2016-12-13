<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    #for user orderdate

    function user_order_date() {
        
        if (isset($_POST['daterange'])) {
            $dateRange = $_POST['daterange'];
            $user = $_POST['client_id'];
            $user_name =  $_POST['client'];
        } else {
            $dateRange = date("Y-m-d") . " to " . date("Y-m-d");
            $user = '';
            $user_name = '';
        }
        $data = $this->User_model->order_report_statics($dateRange, $user);
        $data['report_type'] = 'order_reports';
        $data['user_id'] = $user;
        $data['client'] = $user_name;
        
        $this->load->view('Reports/commonReport', $data);
    }

    function user_item_date() {
        
        
        
         if (isset($_POST['daterange'])) {
            $dateRange = $_POST['daterange'];
            $user = $_POST['client_id'];
            $user_name =  $_POST['client'];
        } else {
            $dateRange = date("Y-m-d") . " to " . date("Y-m-d");
            $user = '';
            $user_name = '';
        }

        $data = $this->User_model->customization_statics($dateRange, $user);
        $data['report_type'] = 'item_reports';
        $data['user_id'] = $user;
        $data['client'] = $user_name;
        $this->load->view('Reports/commonReport', $data);
    }

    function common_report() {
        if (isset($_REQUEST['daterange'])) {
            $dateRange = $_REQUEST['daterange'];
        } else {
            $dateRange = date("Y-m-d") . " to " . date("Y-m-d");
        }
        $user = $_REQUEST['user_id'];
        $user_name = $_REQUEST['user_name'];
        $data1 = $this->User_model->customization_statics($dateRange, $user);
        $data2 = $this->User_model->order_report_statics($dateRange, $user);


        
        $report_type = $_REQUEST['report_type'];
        $req1 = $_REQUEST['req1'];
        $req2 = $_REQUEST['req2'];
        $data = [];
        if ($report_type == 'item_reports') {
            if ($req1 == 'all_data') {

                $data['heads'] = $data2['table_head'];
                $data['data'] = $data2['table_data'];
                $data['title'] = 'All Data';
            } else {
                $heads = array();
                foreach ($data1[$req1][$req2]['heads'] as $key => $value) {
                    $heads[$value] = $value;
                }
                $data['heads'] = $heads;
                $data['data'] = $data1[$req1][$req2]['data'];
                $data['title'] = $data1[$req1][$req2]['tab_heading'];
            }
        }
        if ($report_type == 'order_reports') {
            if ($req1 == 'all_data') {

                $data['heads'] = $data2['table_head'];
                $data['data'] = $data2['table_data'];
                $data['title'] = 'All Data';
            } else {
                $heads = array();
                foreach ($data2[$req1][$req2]['heads'] as $key => $value) {
                    $heads[$value] = $value;
                }
                $data['heads'] = $heads;
                $data['data'] = $data2[$req1][$req2]['data'];
                $data['title'] = $data1[$req1][$req2]['tab_heading'];
            }
        }
        $data['daterange'] = $dateRange;
        $data['client'] = $user_name ? $user_name : 'All Client';
        
        $html = $this->load->view('Reports/commonReportPdf', $data, true);
       ob_clean();
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
  //      echo $html;
        $pdf->WriteHTML($html);
        $current_date = date('Y-m-d H:i:s');
        $file_name = 'productlistreport' . $current_date . '.pdf';
        $pdf->Output($file_name, "I");
    }

}
