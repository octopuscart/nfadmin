<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginAndLogout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $database_data = array(
            'host_name' => 'localhost',
            'user_name' => 'n1c7v2s5_nf',
            'password' => 'costcoin_nf',
            'database' => 'n1c7v2s5_nf'
        );
        $this->session->set_userdata('database', $database_data);
    }

    public function index() {
        $this->login_admin();
    }

    function login_admin($msg = '') {
        $data1['msg'] =$msg;
        if (isset($_POST['signIn'])) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->db->select('au.id,au.first_name,au.last_name,au.middle_name,au.email,au.password,ag.role');
            $this->db->from('auth_user au');
            $this->db->join('auth_membership am', 'au.id = am.user_id');
            $this->db->join('auth_group ag', 'am.group_id = ag.id');
            $this->db->where('email', $username);
            $this->db->where('password', md5($password));
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $data[] = $row;
                }
             
                
            } 
            else 
                {
                $data1['msg'] = 'this';
                redirect('LoginAndLogout/login_admin/');
            }
            $usr = $data[0]['email'];
            $pwd = $data[0]['password'];
            if ($username == $usr && md5($password) == $pwd) {
                $sess_data = array(
                    'username' => $username,
                    'password' => $password,
                    'first_name' => $data[0]['first_name'],
                    'last_name' => $data[0]['last_name'],
                    'login_id' => $data[0]['id'],
                    'user_type' => $data[0]['role'],
                );
                $this->session->set_userdata('logged_in', $sess_data);

                redirect('UserRecordManagement/user_current_order');
            }
        }
        $this->load->view('login',$data1);
    }

    // Logout from admin page
    function logout() {
        $newdata = array(
            'username' => '',
            'password' => '',
            'logged_in' => FALSE,
        );

        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();

        redirect('LoginAndLogout', 'refresh');
    }

}
