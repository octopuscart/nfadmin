<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//ob_start();

class ElementController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('grocery_CRUD');
        // $this->load->library('image_CRUD');    
        $this->load->helper('url');
    }

    function add_element() {
        $this->grocery_crud->set_table('nfw_custom_element');
        // $this->add_action('More', '', '','ui-icon-plus');
        $output = $this->grocery_crud->render();
        $this->load->view('add_element', $output);
        // $this->addTest($output);
    }

    function add_element_sub_table() {
        $this->grocery_crud->set_table('nfw_custom_element_field');
        $this->grocery_crud->set_field_upload('set_image', 'assets/');
        $output = $this->grocery_crud->render();
        $this->load->view('add_element_sub_table', $output);
    }

    #9-Oct-2015

    function insert_custom_data() { 
        // insertion /////////////////////
        $data['result'] = $this->Product_model->get_table_information('nfw_custom_element');
        if (isset($_POST['submit'])) {
            //print_r($_POST);
            $productInfoArray = array();
            $fquery = $this->db->list_fields('nfw_custom_element');
            foreach ($fquery as $field) {
                $productInfoArray[$field] = $this->input->post($field);
            }
            unset($productInfoArray['id']);
            $this->db->insert('nfw_custom_element', $productInfoArray);
            redirect('ElementController/insert_custom_data');
        }
        // selection /////////////////////

        $this->load->view('insert_custom_data', $data);
    }

    function insert_sub_custom_data($ids = '', $product_id = '') {
        if ($ids) {
            $query = 'SELECT concat("custom_", id+1, nfw_custom_element_id,  replace( concat("",CURTIME()), ":", "")) as set_image FROM `nfw_custom_element_field` order by id desc limit 0, 1';
            $data = $this->Product_model->query_exe($query);
            $data['image_name'] = $data;
            $data['nfw_custom_element_id'] = $ids;
        }
        ####### Select data ########
        $data['result'] = $this->Product_model->get_table_information('nfw_custom_element_field', 'nfw_custom_element_id', $ids);
        $data['updateData'] = $this->Product_model->productDetail($product_id);
        $data['product_id'] = $product_id;
        //print_r($data['result']);
        #################################
        $this->load->view('insert_sub_custom_data', $data);
    }

    function deleteElement() {
        if ($_POST['productIds']) {
            $idss = $_POST['productIds'];

            $this->db->delete('nfw_custom_element_field', array('id' => $idss));
        }
    }

    function ajaxController() {
        $productInfoArray = array();
        $fquery = $this->db->list_fields('nfw_custom_element_field');
        foreach ($fquery as $field) {
            $productInfoArray[$field] = $this->input->get($field);
        }
        unset($productInfoArray['id']);

        unset($_GET['nfw_custom_element_id']);

        if ($_GET['id']) {

            $setdata = array(
                'title' => $this->input->get('title'),
                'child_label' => $this->input->get('child_label'),
                'standard' => $this->input->get('standard'),
                'set_image' => $this->input->get('set_image'),
            );
            $ids = $_GET['id'];
            $this->db->where('id', $ids); 
            $this->db->update('nfw_custom_element_field', $setdata);
        } else {
            $this->db->insert('nfw_custom_element_field', $productInfoArray);
        }
    }

    # 10-Oct-2015
    #for data updation
//    function dataUpdation($ids,$product_id=''){
//        $data['updateData'] = $this->Product_model->productDetail($product_id);
//        $this->load->view('insert_sub_custom_data', $data);
//    }
}

?>