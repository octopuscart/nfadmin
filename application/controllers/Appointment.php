<?php

defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class Appointment extends CI_controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    function set_location_for_appointment() {
        if (isset($_POST['location'])) {
            $dat = date('Y-m-d');
            $tm = date("H:i:s");

            $temp = array(
                'place_id' => $this->input->post('place_id'),
                'location' => $this->input->post('location'),
                'address' => $this->input->post('address2'),
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'contact_no' => $this->input->post('contact_no'),
                'op_date' => $dat,
                'op_time' => $tm
            );

            $this->db->insert('nfw_app_set_appointment', $temp);
        }

        $query = $this->db->get('nfw_app_set_appointment');

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            $data['result'] = $data;
        }

        ///////// Pop up 
        if (isset($_POST['date_range_submit'])) {
            $nfw_set_appointment_id = $this->input->post('nfw_set_appointment');
            $dates = $this->input->post('default-daterange');
            $dates = explode("To", $dates);
            $date1 = $dates[0];
            $date2 = $dates[1];
            $temp1 = array(
                'nfw_set_appointment_id' => $nfw_set_appointment_id,
                'start_date' => $date1,
                'end_date' => $date2,
            );
            $this->db->insert('nfw_app_start_end_date', $temp1);
            $ids = $this->db->insert_id();
            redirect('Appointment/scheduler/' . $ids);
        }
        $this->load->view('Appoinment/set_appointment_location', $data);
    }

    function date_scheduler($ids = '') {
        $query = $this->db->query("SELECT location,address FROM `nfw_app_set_appointment` where id = $ids");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data1[] = $row;
            }
            $data['data'] = $data1;
        }
        if (isset($_POST['date_range_submit'])) {
            $nfw_set_appointment_id = $ids;
            $dates = $this->input->post('default-daterange');
            $dates = explode("To", $dates);
            $date1 = $dates[0];
            $date2 = $dates[1];
            $temp1 = array(
                'nfw_set_appointment_id' => $nfw_set_appointment_id,
                'start_date' => $date1,
                'end_date' => $date2,
            );
            $this->db->insert('nfw_app_start_end_date', $temp1);
        }
        ///////////// For listing of dates
        $query = $this->db->query("SELECT * FROM `nfw_app_start_end_date` where nfw_set_appointment_id = $ids");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data2[] = $row;
            }
            $data['temp_data'] = $data2;
        }

        $this->load->view('Appoinment/date_scheduler', $data);
    }

    function time_scheduler($ids = '') {
        if (isset($_REQUEST['deletesubmit'])) {
            $time_id = $_POST['time_id'];
            $query = "delete FROM `nfw_app_time_schedule` where id not in(SELECT nfw_time_schedule_id FROM `nfw_app_userlist`) and id = $time_id ";
            $this->db->query($query);
        }
        $query = $this->db->query("SELECT * FROM `nfw_app_start_end_date` where id = $ids");
        $row = $query->row_array();

        if (isset($row)) {
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
        }
        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date);
        for ($i = $start_date; $i <= $end_date; $i+=86400) {
            $data1[] = date("Y-m-d", $i);
        }
        $data['all_dates'] = $data1;
        //// insert time schedule
        if (isset($_POST['submitPOP'])) {
            $start_time1 = $this->input->post('start_time');
            $end_time1 = $this->input->post('end_time');
            if (!empty($start_time1)) {

                $temp1 = array(
                    'nfw_app_start_end_date_id' => $ids,
                    'schedule_date' => $this->input->post('app_date'),
                    'schedule_start_time' => $start_time1,
                    'schedule_end_time' => $end_time1
                );

                $this->db->insert('nfw_app_time_schedule', $temp1);
            }
        }
        /////// startdate -enddate
        $query1 = $this->db->query(" SELECT ts.id,ts.schedule_date,ts.schedule_start_time,ts.schedule_end_time FROM `nfw_app_start_end_date`  as nas 
                                   join nfw_app_time_schedule as ts on
                                   nas.id = ts.nfw_app_start_end_date_id where nas.id  = $ids");
        if ($query1->num_rows() > 0) {
            foreach ($query1->result_array() as $row) {
                $data3[] = $row;
            }
            $data['date_date'] = $data3;
        }
        /////// address
        $query2 = $this->db->query("SELECT nas.location,nas.address,nas.country FROM `nfw_app_set_appointment` as nas join
                                       nfw_app_start_end_date as ase on
                                       nas.id = ase.nfw_set_appointment_id  where ase.id = $ids");
        if ($query2->num_rows() > 0) {
            foreach ($query2->result_array() as $row) {
                $data4[] = $row;
            }
            $data['adress'] = $data4;
        }

        $this->load->view('Appoinment/time_scheduler', $data);
    }

    function appointment_report() {
        $query = $this->db->query("SELECT concat(au.first_name,' ',au.last_name) as name,au.email,au.telephone, au.no_of_person,apt.schedule_date,apt.schedule_start_time,apt.schedule_end_time,asp.country, asp.state,asp.city,asp.address FROM `nfw_app_userlist` as au
                                     join nfw_app_time_schedule as apt on au.nfw_time_schedule_id = apt.id
                                     join nfw_app_start_end_date as sed on apt. nfw_app_start_end_date_id = sed.id
                                     join nfw_app_set_appointment as asp on sed.nfw_set_appointment_id =  asp.id
                                    order by au.id desc 
                                    ");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            $data['data'] = $data;
        }
        $this->load->view('Appoinment/appointment_report', $data);
    }

    function appointment_pdf() {
        $query = $this->db->query("SELECT concat(au.first_name,' ',au.last_name) as name,au.email,au.telephone, au.no_of_person,apt.schedule_date,apt.schedule_start_time,apt.schedule_end_time,asp.country, asp.state,asp.city,asp.address FROM `nfw_app_userlist` as au
                                     join nfw_app_time_schedule as apt on au.nfw_time_schedule_id = apt.id
                                     join nfw_app_start_end_date as sed on apt. nfw_app_start_end_date_id = sed.id
                                     join nfw_app_set_appointment as asp on sed.nfw_set_appointment_id =  asp.id
                                     order by au.id desc  
                                    ");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            $data['data'] = $data;
        }
        $html = $this->load->view('Appoinment/appointment_pdf', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        //echo $html;
        $current_date = date('Y-m-d H:i:s');
        //ob_end_clean();
        $file_name = 'Appointment_Report' . $current_date . '.pdf';
        $pdf->Output($file_name, "D");
    }

}

?>