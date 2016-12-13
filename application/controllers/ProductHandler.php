<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class ProductHandler extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index() {
        $this->add_category(0);
    }

    public function add_category() {
        $this->load->view('productManagement/addCategory');
    }

    public function delete_category_information($id) {
        $this->User_model->tracking_data_insert('nfw_category', $id, 'delete');
        $this->db->where('id', $id);
        $this->db->delete('nfw_category');
        redirect('ProductHandler/add_category');
    }

    public function add_edit_category_info_ajax() {

        $data = array(
            'name' => $_GET['title'],
            'parent' => $_GET['parent'],
        );
        if ($_GET['operation'] == 'new') {
            $this->db->insert('nfw_category', $data);
            $categoryId = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_category', $categoryId, 'insert');
            echo 'success';
        } else {
            $getId = $_GET['operation'];
            $id = explode('_', $getId);
            $this->User_model->tracking_data_insert('nfw_category', $id[1], 'update');
            $this->db->where('id', $id[1]);
            $this->db->update('nfw_category', $data);
            echo 'success';
        }
        redirect('ProductHandler/add_category');
    }

    public function add_product() {
        $data['main_category'] = $this->Product_model->get_table_information('nfw_category', 'parent', '0');
        $this->load->view('productManagement/selectCategory', $data);
    }

    public function ajaxSubCategoryInformation() {
        $id = $_GET['id'];
        $data = $this->Product_model->get_table_information('nfw_category', 'parent', $id);
        echo json_encode($data);
    }

    public function product_publishing($product_id, $publishing, $category_id) {

        if ($product_id) {
            $data = array(
                'publishing' => $publishing,
            );
            $this->User_model->tracking_data_insert('nfw_product', $product_id, 'publishing');
            $this->db->where('id', $product_id);
            $this->db->update('nfw_product', $data);

            $this->db->where('product_id', $product_id);
            $this->db->where('order_id is NULL');
            $this->db->delete("nfw_product_cart");

//            redirect("ProductHandler/add_product_information/$product_id/edit/$category_id");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function add_product_information($id, $operation, $category = '', $parent = 0) {

        $returnData['update_info'] = array(
            'product_id' => $id,
            'operation' => $operation,
            'category' => $category,
            'rdcategory' => $category,
            'parent_category' => $parent,
            'sub_category' => []
        );


        if ($category) {
            $query = "select name, id from nfw_category where id =$category";
            $returnData['category'] = $this->Product_model->query_exe($query);
        } else {
            $returnData['category'] = array(0 => array('name' => 'Category Not Selected', 'id' => ''));
        }



        $returnData['tagData'] = $this->Product_model->get_table_information('nfw_product_tag', '', '', 'tag_index');
        $returnData['fabric_list'] = $this->Product_model->get_table_information('nfw_fabric');
        $query = "select tag.* from nfw_category_tag_connection as ctc"
                . " join nfw_product_tag as tag on tag.id = ctc.tag_id"
                . " where ctc.category_id =$parent";
        $returnData['tagData'] = $this->Product_model->query_exe($query);



        $pre_search_tag_str = "";

        $returnData['pre_search_tag'] = $pre_search_tag_str;


        $returnData['edit_data'] = [];
        $returnData['tag_conn_data'] = [];
        if ($operation === 'new') {
            $returnData['getImageData'] = [];
            if (isset($_POST['addProduct'])) {

                $productInfoArray = array();
                $fquery = $this->db->list_fields('nfw_product');
                foreach ($fquery as $field) {
                    $productInfoArray[$field] = $this->input->post($field);
                }
                unset($productInfoArray['id']);
                $productInfoArray['product_category'] = $id;
                $productInfoArray['publishing'] = '1';
                $productInfoArray['opt_date'] = date('Y-m-d');
                $this->db->insert('nfw_product', $productInfoArray);
                $productId = $this->db->insert_id();
                if (isset($_POST['color_id'])) {
                    $temp = $this->input->post('color_id');
                    for ($i = 0; $i < count($temp); $i++) {
                        $data1 = array(
                            'nfw_product_id' => $productId,
                            'nfw_color_id' => $temp[$i]
                        );
                        $this->db->insert('nfw_product_color', $data1);
                    }
                }
                $this->User_model->tracking_data_insert('nfw_product', $productId, 'insert');

                $imageName = $this->input->post('image_name_list');

                if ($imageName) {
                    //$imageName = explode(',', $imageName);
                    for ($i = 0; $i < count($imageName); $i++) {
                        $imageData = array(
                            'nfw_product_id' => $productId,
                            'image' => $imageName[$i],
                            'op_date' => date('Y-m-d'),
                            'op_time' => date('h:m:s')
                        );
                        $this->db->insert('nfw_product_images', $imageData);
                        $imgId = $this->db->insert_id();
                        $this->User_model->tracking_data_insert('nfw_product_images', $imgId, 'insert');
                    }
                }
                $customId = $this->input->post('custom_check');
                for ($i = 0; $i < count($customId); $i++) {
                    $price = $this->input->post('price_' . $customId[$i]);
                    $sale_price = $this->input->post('sale_price_' . $customId[$i]);
                    $tagData = array(
                        'tag_id' => $customId[$i],
                        'price' => $price,
                        'sale_price' => $sale_price,
                        'product_id' => $id
                    );
                    $this->db->insert('nfw_product_tag_connection', $tagData);
                    $tagId = $this->db->insert_id();

                    $onsaleArray = array(
                        'product_id' => $id,
                        'tag_id' => $customId[$i],
                        'op_date_time' => date('Y-m-d h:m:s')
                    );
                    if ($sale_price) {
                        $this->db->insert('nfw_on_sale', $onsaleArray);
                    }

                    $this->User_model->tracking_data_insert('nfw_product_tag_connection', $tagId, 'insert');
                }



                redirect('ProductHandler/add_product_information/' . $id . '/new/' . $id . '');
            }
        }
        if ($operation == 'edit') {

            $product_subcate = $this->Product_model->product_subcategory($id);
            $returnData['update_info']['sub_category'] = $product_subcate;
            $squery = "select nsp.tag_title from nfw_product_search_tag  as nsp 
                join nfw_product_search_tag_connection as nptc on nptc.tag_id = nsp.id
                where nptc.product_id = '$id';
                        ";
            $pre_search_tag = $this->Product_model->query_exe($squery);

            if ($pre_search_tag) {
                foreach ($pre_search_tag as $key => $value) {
                    $pre_search_tag_str .= $value['tag_title'] . ",";
                }
            }

            $returnData['pre_search_tag'] = $pre_search_tag_str;




            $returnData['tag_conn_data'] = $this->Product_model->get_table_information('nfw_product_tag_connection', 'product_id', $id);
            $returnData['getImageData'] = $this->Product_model->get_table_information('nfw_product_images', 'nfw_product_id', $id, 'display_priority');
            $returnData['edit_data'] = $this->Product_model->get_table_information('nfw_product', 'id', $id);

//            check sub category



            $returnData['product_color'] = $this->Product_model->get_table_information('nfw_product_color', 'nfw_product_id', $id);
//            $returnData['stock_data']= $this->Product_model->current_stock_information($id);
            if (isset($_POST['update'])) {



                $this->db->where("product_id", $id);
                $this->db->delete("nfw_product_search_tag_connection");

                $searchtags = $this->input->post('searching_tag');
                $searchtags = explode(",", $searchtags);
                //print_r($searchtags);
                foreach ($searchtags as $tag) {
                    if ($tag) {
                        $tagarray = array(
                            'tag_title' => $tag,
                        );
                        $tagCheck = $this->Product_model->get_table_information('nfw_product_search_tag', 'tag_title', $tag);
                        if ($tagCheck) {
                            $tag_id = end($tagCheck)['id'];
                        } else {
                            $this->db->insert('nfw_product_search_tag', $tagarray);
                            $tag_id = $this->db->insert_id();
                        }

                        $tag_insert = array('product_id' => "$id", 'tag_id' => $tag_id);
                        $this->db->insert('nfw_product_search_tag_connection', $tag_insert);
                        $tagId = $this->db->insert_id();
                    }
                }


                $productInfoArray = array();
                $fquery = $this->db->list_fields('nfw_product');
                foreach ($fquery as $field) {
                    $productInfoArray[$field] = $this->input->post($field);
                }
                $productInfoArray['publishing'] = '1';
                unset($productInfoArray['id']);


                $this->User_model->tracking_data_insert('nfw_product', $id, 'update');
                $this->db->where('id', $id);
                $this->db->update('nfw_product', $productInfoArray);

                $this->db->where("nfw_product_id", $id);
                $this->db->delete("nfw_product_images");


                $stockData = array(
                    'fabric_id' => $id,
                    'stock_status' => '',
                    'op_date_time' => date('Y-m-d h:m:s')
                );


                $this->db->where("nfw_product_id", $id);
                $this->db->delete("nfw_product_color");
                if (isset($_POST['color_id'])) {
                    $temp = $this->input->post('color_id');
                    for ($i = 0; $i < count($temp); $i++) {
                        $data1 = array(
                            'nfw_product_id' => $id,
                            'nfw_color_id' => $temp[$i]
                        );
                        $this->db->insert('nfw_product_color', $data1);
                    }
                }
                if (isset($_POST['image_name_list'])) {
                    $imageName = $_POST['image_name_list'];
                    // print_r($stockData);
                    for ($i = 0; $i < count($imageName); $i++) {
                        $imageData = array(
                            'nfw_product_id' => $id,
                            'image' => $imageName[$i],
                            'op_date' => date('Y-m-d'),
                            'op_time' => date('h:m:s')
                        );
                        // print_r($imageData);
                        $imageDataCheck = $this->Product_model->get_table_information('nfw_product_images', 'image', $imageName[$i]);

                        $this->db->insert('nfw_product_images', $imageData);
                        $imgId = $this->db->insert_id();

                        $this->User_model->tracking_data_insert('nfw_product_images', $imgId, 'insert');
                    }
                }
                $customId = $this->input->post('custom_check');

                $this->db->where('product_id', $id);
                $this->db->delete('nfw_product_tag_connection');

                $this->db->where('product_id', $id);
                $this->db->delete('nfw_on_sale');

                for ($i = 0; $i < count($customId); $i++) {
                    $price = $this->input->post('price_' . $customId[$i]);
                    $sale_price = $this->input->post('sale_price_' . $customId[$i]);
                    $tagData = array(
                        'tag_id' => $customId[$i],
                        'price' => $price,
                        'sale_price' => $sale_price,
                        'product_id' => $id
                    );
                    $this->db->insert('nfw_product_tag_connection', $tagData);
                    $tagId = $this->db->insert_id();
                    $onsaleArray = array(
                        'product_id' => $id,
                        'tag_id' => $customId[$i],
                        'op_date_time' => date('Y-m-d h:m:s')
                    );
                    if ($sale_price) {
                        $this->db->insert('nfw_on_sale', $onsaleArray);
                    }

                    $this->User_model->tracking_data_insert('nfw_product_tag_connection', $tagId, 'insert');
                }
                $this->db->where('product_id', $id);
                $this->db->where('order_id IS NULL');
                $this->db->delete("nfw_product_cart");
                redirect("ProductHandler/add_product_information/$id/$operation/$category/$parent");
            }

            if (isset($_POST['addnewcat'])) {
                //print_r($_POST);
                $temp1 = array(
                    'product_id' => $this->input->post('product_id'),
                    'category_id' => $this->input->post('new_cat_id'),
                );
                $this->db->insert('nfw_product_subcategory', $temp1);
                redirect("ProductHandler/add_product_information/$id/$operation/$category/$parent");
            }

            if (isset($_POST['removesubcat'])) {
                //print_r($_POST);
                $temp1 = array(
                    'product_id' => $this->input->post('product_id'),
                    'category_id' => $this->input->post('new_cat_id'),
                );
                $this->db->where($temp1);
                $this->db->delete('nfw_product_subcategory');

                redirect("ProductHandler/add_product_information/$id/$operation/$category/$parent");
            }
        }
        $this->load->view('productManagement/addProduct', $returnData);
    }

    public function productColor() {
        $query = $this->db->get('nfw_color');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            $data['color_list'] = $data;
        }
        $data['color_data'] = array();
        if (isset($_POST['delete'])) {
            $id = $_POST['delete'];
            $this->Product_model->delete_table_information('nfw_color', 'id', $id);
            redirect('ProductHandler/productColor');
        }
        if (isset($_POST['addColor'])) {
            $colorData = array(
                'color_code' => $this->input->post('color_code'),
                'title' => $this->input->post('title'),
            );
            $this->db->insert('nfw_color', $colorData);
            $colorId = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_color', $colorId, 'insert');
            redirect('ProductHandler/productColor');
        }
        if (isset($_POST['updateColor'])) {
            $colorData = array(
                'color_code' => $this->input->post('color_code'),
                'title' => $this->input->post('title'),
            );
            $id = $this->input->post('edit_id');
            $this->User_model->tracking_data_insert('nfw_color', $id, 'update');
            $this->db->where('id', $id);
            $this->db->update('nfw_color', $colorData);
            redirect('ProductHandler/productColor');
        }
        $this->load->view('productManagement/productColor', $data);
    }

    public function test_info() {
        $this->load->helper('captcha');
        $this->load->helper('url');
        $vals = array(
            'img_path' => image_server . 'nfw/small/',
            'img_url' => image_server . 'nfw/small/',
            'img_width' => 150,
            'img_height' => '50',
            'expiration' => 7200
        );

        $data['cap'] = create_captcha($vals);
        $this->load->view('productManagement/test', $data);
    }

    public function productTag() {
        $this->db->order_by('tag_index');
        $query = $this->db->get('nfw_product_tag');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            $data['product_tag'] = $data;
        }

        if (isset($_POST['submit'])) {
            $tagData = array(
                'tag_title' => $this->input->post('tag_title')
            );
            $this->db->insert('nfw_product_tag', $tagData);
            $tagId = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_product_tag', $tagId, 'insert');
            redirect('productHandler/productTag');
        }
        if (isset($_POST['update'])) {
            $tagId = $this->input->post('edit_id');
            $tagData = array(
                'tag_title' => $this->input->post('tag_title')
            );
            $this->User_model->tracking_data_insert('nfw_product_tag', $tagId, 'update');
            $this->db->where('id', $tagId);
            $this->db->update('nfw_product_tag', $tagData);


            redirect('productHandler/productTag');
        }
        if (isset($_POST['delete'])) {
            $id = $this->input->post('delete');
            $this->User_model->tracking_data_insert('nfw_product_tag', $id, 'delete');
            $this->db->where('id', $id);
            $this->db->delete('nfw_product_tag');
            redirect('ProductHandler/productTag');
        }
        $this->load->view('productManagement/productTag', $data);
    }

    /* Function written for calculate related product  */

    public function relatedProduct($productId, $categoryId) {

        $data['check_related_product'] = $this->Product_model->related_information($productId);

        $this->db->where('id', $productId);
        $data['mainProduct'] = $this->Product_model->get_table_information('nfw_product');

        //$ignore = $this->Product_model->get_table_information('nfw_product_related');
        
        $query = "SELECT * FROM nfw_product_related WHERE nfw_product_id  = $productId";
        
        $ignore = $this->Product_model->query_exe($query);
        
        $len = count($ignore);
        for ($i = 0; $i < $len; $i++) {
            $notIn[] = $ignore[$i]['nfw_related_product_id'];
        }
        $notIn[] = $productId;
        $notInData = implode(',', $notIn);
        $data['related_product'] = $this->Product_model->feature_related_report_select($notInData, 'product_category', $categoryId);
        if (isset($_POST['submit'])) {
            $relatedProduct = $this->input->post('related_product');
            $length = count($relatedProduct);
            for ($i = 0; $i < $length; $i++) {
                $relatedArray = array(
                    'nfw_related_product_id' => $relatedProduct[$i],
                    'nfw_product_id' => $productId,
                );
                $this->db->insert('nfw_product_related', $relatedArray);
                $relatedId = $this->db->insert_id();
                $this->User_model->tracking_data_insert('nfw_product_related', $relatedId, 'insert');
            }
            redirect('productHandler/relatedProduct/' . $productId . '/' . $categoryId);
        }
        if (isset($_POST['delete'])) {
            $id = $this->input->post('delete');
            $this->Product_model->delete_table_information('nfw_product_related', 'id', $id);
            redirect('productHandler/relatedProduct/' . $productId . '/' . $categoryId);
        }

        $this->load->view('productManagement/relatedProduct', $data);
    }

    public function featureProduct() {
        $data['check_feature_product'] = $this->Product_model->featured_information();
        $ignore = $this->Product_model->get_table_information('nfw_product_featured');
        if ($ignore) {
            $len = count($ignore);
            for ($i = 0; $i < $len; $i++) {
                $notIn[] = $ignore[$i]['nfw_product_id'];
            }
            $notInData = implode(',', $notIn);
        } else {
            $notInData = '';
        }
        $data['feature_product'] = $this->Product_model->feature_related_report_select($notInData);

        if (isset($_POST['submit'])) {
            $featuredProduct = $this->input->post('featured_product');
            $length = count($featuredProduct);
            for ($i = 0; $i < $length; $i++) {
                $featureArray = array(
                    'nfw_product_id' => $featuredProduct[$i]
                );
                $this->db->insert('nfw_product_featured', $featureArray);
                $featureId = $this->db->insert_id();
                $this->User_model->tracking_data_insert('nfw_product_related', $featureId, 'insert');
            }
            redirect('ProductHandler/featureProduct');
        }
        if (isset($_POST['delete'])) {
            $id = $this->input->post('delete');
            $this->Product_model->delete_table_information('nfw_product_featured', 'nfw_product_id', $id);
            redirect('ProductHandler/featureProduct');
        }
        $this->load->view('productManagement/featuredProduct', $data);
    }

    #3-dec-2015
    #for on-sale entry

    function on_sale_product_list() {

        $data['product_report'] = $this->Product_model->most_popular_product_information('nfw_on_sale');

        $ignore = $this->Product_model->get_table_information('nfw_on_sale');

        if ($ignore) {
            $len = count($ignore);
            for ($i = 0; $i < $len; $i++) {
                $notIn[] = $ignore[$i]['product_id'];
            }
            $notInData = implode(',', $notIn);
        } else {
            $notInData = '';
        }

        $data['onsale_product'] = $this->Product_model->feature_related_report_select($notInData);
        if (isset($_POST['submit'])) {
            $onsaleProduct = $this->input->post('featured_product');
            $length = count($onsaleProduct);
            for ($i = 0; $i < $length; $i++) {
                $featureArray = array(
                    'product_id' => $onsaleProduct[$i],
                    'op_date_time' => date('Y-m-d h:m:s')
                );
                $this->db->insert('nfw_on_sale', $featureArray);
            }
            redirect('ProductHandler/on_sale_product_list');
        }
        if (isset($_POST['delete'])) {
            $id = $this->input->post('delete');
            $this->db->delete('nfw_on_sale', array('id' => $id));
            redirect('ProductHandler/on_sale_product_list');
        }
        $this->load->view('productManagement/onSaleProductList', $data);
    }

    # most popular product list

    function most_popular_product_list() {
        $data['product_report'] = $this->Product_model->most_popular_product_information('nfw_most_populat_product');
        $ignore = $this->Product_model->get_table_information('nfw_most_populat_product');

        if ($ignore) {
            $len = count($ignore);
            for ($i = 0; $i < $len; $i++) {
                $notIn[] = $ignore[$i]['product_id'];
            }
            $notInData = implode(',', $notIn);
        } else {
            $notInData = '';
        }

        $data['most_popular_product'] = $this->Product_model->feature_related_report_select($notInData);
        if (isset($_POST['submit'])) {
            $mostProduct = $this->input->post('featured_product');
            $length = count($mostProduct);
            for ($i = 0; $i < $length; $i++) {
                $featureArray = array(
                    'product_id' => $mostProduct[$i],
                    'op_date_time' => date('Y-m-d h:m:s')
                );
                $this->db->insert('nfw_most_populat_product', $featureArray);
            }
            redirect('ProductHandler/most_popular_product_list');
        }
        if (isset($_POST['delete'])) {
            $id = $this->input->post('delete');
            $this->db->delete('nfw_most_populat_product', array('id' => $id));
            redirect('ProductHandler/most_popular_product_list');
        }
        $this->load->view('productManagement/mostPopularProductList', $data);
    }

    ######### 4-dec-2015

    function new_arrival_product_list() {
        $data['product_report'] = $this->Product_model->most_popular_product_information('nfw_new_arrival');
        $ignore = $this->Product_model->get_table_information('nfw_new_arrival');

        if ($ignore) {
            $len = count($ignore);
            for ($i = 0; $i < $len; $i++) {
                $notIn[] = $ignore[$i]['product_id'];
            }
            $notInData = implode(',', $notIn);
        } else {
            $notInData = '';
        }

        $data['most_popular_product'] = $this->Product_model->feature_related_report_select($notInData);
        if (isset($_POST['submit'])) {
            $mostProduct = $this->input->post('featured_product');
            $length = count($mostProduct);
            for ($i = 0; $i < $length; $i++) {
                $featureArray = array(
                    'product_id' => $mostProduct[$i],
                    'op_date_time' => date('Y-m-d h:m:s')
                );
                $this->db->insert('nfw_new_arrival', $featureArray);
            }
            redirect('ProductHandler/new_arrival_product_list');
        }
        if (isset($_POST['delete'])) {
            $id = $this->input->post('delete');
            $this->db->delete('nfw_new_arrival', array('id' => $id));
            redirect('ProductHandler/new_arrival_product_list');
        }
        $this->load->view('productManagement/newArrival', $data);
    }

    ################################################################

    function search_product_tag_info($id) {
        $data['product_id'] = $id;
        $data['product_data'] = $this->Product_model->get_table_information('nfw_product', 'id', $id);
        $data['category_data'] = $this->Product_model->product_category_data($id);
        $this->load->view('productManagement/tagSearchingInformation', $data);
    }

    function product_menu_information($id = '', $opretor = '') {
        if ($opretor == 'delete') {
            $this->User_model->tracking_data_insert('nfw_menu', $id, 'delete');
            $this->db->where('id', $id);
            $this->db->delete('nfw_menu');
            redirect('ProductHandler/product_menu_information');
        }

        if (isset($_POST['submit'])) {
            unset($_POST['submit']);
            $data = $_POST;
            unset($data['update_id']);
            $this->db->insert('nfw_menu', $data);
            $menuId = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_menu', $menuId, 'insert');
            redirect('productHandler/product_menu_information');
        }
        if (isset($_POST['update'])) {
            $id = $this->input->post('update_id');
            $data = array(
                'parent' => $this->input->post('parent'),
                'name' => trim($this->input->post('name')),
                'menu_page' => $this->input->post('menu_page')
            );
            $this->User_model->tracking_data_insert('nfw_menu', $id, 'update');
            $this->db->where('id', $id);
            $this->db->update('nfw_menu', $data);
            redirect('productHandler/product_menu_information');
        }
        $this->load->view('productManagement/addProductMenu');
    }

    function ajax_menu_category_information() {
        $tagId = $_GET['tag_id'];
        if (empty($tagId)) {
            $tagInfo = array(
                'tag_title' => $_GET['category']
            );
            $this->db->insert('nfw_product_tag', $tagInfo);
            $tagId = $this->db->insert_id();
            $this->User_model->tracking_data_insert('nfw_product_tag', $tagId, 'insert');
        }
        $tagSearchInfo = array(
            'product_id' => $_GET['id'],
            'tag_id' => $tagId
        );
        $this->db->insert('nfw_product_tag_connection', $tagSearchInfo);
        $tagSearchId = $this->db->insert_id();
        $this->User_model->tracking_data_insert('nfw_product_tag_connection', $tagSearchId, 'insert');
        $data['category_data'] = $this->Product_model->product_category_data($_GET['id']);
        $data['all_category_data'] = $this->Product_model->get_table_information('nfw_product_tag');
        echo json_encode($data);
    }

    function ajax_sub_category_information() {
        $data = array(
            'name' => $_GET['title'],
            'parent' => $_GET['parent'],
            'menu_page' => $_GET['page']
        );
        //print_r($data);
        $this->db->insert('nfw_menu', $data);
        $menuId = $this->db->insert_id();
        $this->User_model->tracking_data_insert('nfw_menu', $menuId, 'insert');
    }

    function image_upload_ajax() {
        $data = array(
            'nfw_product_id' => $_GET['nfw_product_id'],
            'image' => $_GET['imageName'],
            'op_date' => date('Y-m-d'),
            'op_time' => date('h:m:s')
        );
        $this->db->insert('nfw_product_images', $data);
        $imgId = $this->db->insert_id();
        $this->User_model->tracking_data_insert('nfw_product_images', $imgId, 'insert');
        echo 'success';
    }

    function change_index_image($id, $productId, $index = '') {
        if ($index) {
            $data = array('display_priority' => $index);
            $this->User_model->tracking_data_insert('nfw_product_images', $id, 'update');
            $this->db->where('id', $id);
            $this->db->update('nfw_product_images', $data);
        } else {
            $this->User_model->tracking_data_insert('nfw_product_images', $id, 'delete');
            $this->db->where('id', $id);
            $this->db->delete('nfw_product_images');
        }
        redirect('ProductHandler/add_product_image_info/' . $productId);
    }

    function drag_n_drop_tree_menu() {
        $data = $_POST;
        $columnName = $data['column_name'];
        $tableName = $data['table_name'];
        for ($i = 0; $i < count($data['sr_data']); $i++) {
            $idData = $data['sr_data'][$i];
            $id = explode('-', $idData);
            $menu = array(
                $columnName => $i + 1
            );
            $this->User_model->tracking_data_insert($tableName, $id[1], 'update');
            $this->db->where('id', $id[1]);
            $this->db->update($tableName, $menu);
        }
    }

    function delete_product_image_ajax() {
        $imageId = $_GET['id'];
        $this->User_model->tracking_data_insert('nfw_product_images', $imageId, 'delete');
        $this->db->where('id', $imageId);
        $this->db->delete('nfw_product_images');
        $productId = $_GET['product_id'];
        $imageData = $this->Product_model->get_table_information('nfw_product_images', 'nfw_product_id', $productId, 'display_priority');
        echo json_encode($imageData);
    }

    function generate_product_pdf($id, $billingId, $shippingId, $userId, $toword) {

        $data['word'] = $toword;
        $data['invoice_info'] = $this->Product_model->get_user_invoice_info($id, $userId);
        $res = $this->Product_model->get_user_invoice_info($id, $userId);
        $pdfFilePath = $res[0]['invoice_no'];
        $data['orderData'] = $this->User_model->get_product_information($id);
        $data['orderNo'] = $this->Product_model->get_table_information('nfw_product_order', 'id', $id);
        $data['coupon'] = $this->Product_model->coupan_detail($id);
        $data['user_info'] = $this->Product_model->get_table_information('auth_user', 'id', $userId);
        $data['billing_info'] = $this->Product_model->bill_ship_address('nfw_billing_shipping_address', $billingId);
        $data['shipping_info'] = $this->Product_model->bill_ship_address('nfw_billing_shipping_address', $shippingId);
        $html = $this->load->view('productManagement/productInvoicePdf', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
//        echo $html;
        $pdf->Output($pdfFilePath, "I");
    }

    ##################################

    function delete_data_ajax() {
        $id = $_REQUEST['id'];
        $tableName = $_REQUEST['table_name'];
        $this->User_model->tracking_data_insert($tableName, $id, 'delete');
        $this->db->where('id', $id);
        $this->db->delete($tableName);
        echo 'success';
    }

    #19-sep-2015 
    #for show info products with tag
    #update code 25-sep-2015

    function product_filtering($ids = '') {
        ######################################
        $data['tag'] = $this->Product_model->get_table_information('nfw_product_tag');
        #######################################
        $data['result'] = $this->Product_model->product_info_filtering($ids);
        $this->load->view('productManagement/productFiltering', $data);
    }

    //*****   END   *******//
    public function popular_product_report() {
        $data['popularProduct'] = $this->Product_model->popular_product_info();
        $this->load->view('productManagement/popularProductReport', $data);
    }

    public function category_tag_connection() {
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $this->db->where('id', $id);
            $this->db->delete('nfw_category_tag_connection');
            redirect('ProductHandler/category_tag_connection');
        }
        if (isset($_POST['submit'])) {
            $categoryData = $this->input->post('category_data');
            $tagData = $this->input->post('tag_data');
            $tagLen = count($tagData);
            $catLen = count($categoryData);
            for ($i = 0; $i < $tagLen; $i++) {
                for ($j = 0; $j < $catLen; $j++) {
                    $conn = array(
                        'category_id' => $categoryData[$j],
                        'tag_id' => $tagData[$i]
                    );
                    $this->db->where('tag_id', $tagData[$i]);
                    $this->db->where('category_id', $categoryData[$j]);
                    $query = $this->db->get('nfw_category_tag_connection');
                    if ($query->num_rows() > 0) {
                        
                    } else {
                        $this->db->insert('nfw_category_tag_connection', $conn);
                        $connId = $this->db->insert_id();
                        $this->User_model->tracking_data_insert(nfw_category_tag_connection, $connId, 'insert');
                    }
                }
            }
            redirect('ProductHandler/category_tag_connection');
        }
        $data['tagData'] = $this->Product_model->get_table_information('nfw_product_tag', '', '', 'tag_index  asc');
        $data['categoryData'] = $this->Product_model->get_table_information('nfw_category', 'parent', '0', 'index_menu asc');
        $data['tagCategoryConn'] = $this->Product_model->category_tag_connection('nfw_category_tag_connection');
        $this->load->view('productManagement/categoryTagConnection', $data);
    }

    function add_element() {
        $this->load->view('add_element');
    }

    #28-oct-201 
    #for product filtering pdf

    function product_filtering_pdf($option = '', $ids = '') {
        $data['result'] = $this->Product_model->product_info_filtering($ids);
        $data['name'] = $this->Product_model->tag_name('tag_title', 'nfw_product_tag', $ids);
        $html = $this->load->view('productManagement/productFilteringPdf', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $current_date = date('Y-m-d H:i:s');
        $file_name = 'ProductFilteringReport' . $current_date . '.pdf';
        if ($option == 'D') {
            $pdf->Output($file_name, "D");
        }
        if ($option == 'I') {
            $pdf->Output($file_name, "I");
        }
    }

    #for popular_product_report

    function popular_product_report_pdf($option = '') {
        // $date1 = date('Y-m-d H:i:s');
        $data['popularProduct'] = $this->Product_model->popular_product_info();
        $html = $this->load->view('productManagement/popularProductReportPdf', $data, true);
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $current_date = date('Y-m-d H:i:s');
        $file_name = 'popularproductreport' . $current_date . '.pdf';
        if ($option == 'D') {
            $pdf->Output($file_name, "D");
        }
        if ($option == 'I') {
            $pdf->Output($file_name, "I");
        }
    }

    #29-oct-2015

    function product_list_report_pdf() {

        $option = $_REQUEST['opt'];
        $product_array = $_REQUEST['product_ids'];

        $tg = "join  nfw_product_tag_connection as nptc on nptc.product_id = p.id";




        $query = "select @a:=@a+1  as serial_number,concat('<img src=" . image_server . "/nfw/smaller/',pi.image,'>') as image,p.product_category,
                concat('<table class=price_table>',
                (SELECT replace(group_concat('<tr><td class=pricefirst>',npt.tag_title,'</td><td>', concat('$',price,  if(sale_price, concat('/', sale_price), ''), '</td></tr>')), ',', '') FROM nfw_product_tag_connection nptc
join nfw_product_tag as npt on npt.id = nptc.tag_id
where product_id = p.id), '</table>'
                 ) as tag_price, p.title as title, nc.color_code, nc.title as color,
                 
                p.publishing,
                p.sku,p.product_speciality,p.short_description,'' as edit from (select @a:=0) test1, nfw_product as p 
                 left join nfw_product_images as pi on p.id = pi.nfw_product_id
                 left join nfw_product_color as nfpc on nfpc.nfw_product_id = p.id 
                 left join nfw_color as nc on nc.id  = nfpc.nfw_color_id
                 $tg
                 where p.id in ($product_array) 
                 group by p.id ";


        $data = $this->Product_model->query_exe($query);


  

        

        function get_parentReq($id) {
            $query = mysql_query("select cd.id, cd.name as child_title, cd.parent as parent, pt.name as title  from nfw_category as cd
                                     join nfw_category as pt on pt.id = cd.parent
                                     where cd.id= '$id' ");

            $test = $id;

            while ($row = $this->Product_model->query_exe($query)) {
                $cat = get_parentReq($row['parent']);
                $test = $cat . "," . $test;
                //$parent_array[$row['parent']] = $row['title'];
            }

            //print_r($parent_array);
           ob_clean();
            return $test;
        }

        $temparray = array();

        if (count($data)) {

            foreach ($data as $key => $value) {
                $val = [];
                $catarray = get_parentReq($value['product_category']);
                $catarrays = explode(',', $catarray);
                $categoryarray = [];
                if ($catarray) {
                    foreach ($catarrays as $k => $v) {
                        $query = "select name from nfw_category where id = $v";
                        $data = $this->Product_model->query_exe($query);
                        $datat = end($data);
                        $rr = $datat['name'];
                        array_push($categoryarray, $rr);
                    }
                }

                $val['category'] = implode(" -> ", $categoryarray);
                $val["serial_number"] = $value["serial_number"];
                $val["image"] = $value["image"];
                $val["title"] = $value["title"];
                $val["sku"] = $value["sku"];
                $val["color"] = $value["color"];
                $val["color_code"] = $value["color_code"];
                $val["tag_price"] = $value["tag_price"];
                $val["product_speciality"] = $value["product_speciality"];
                $val["publishing"] = $value["publishing"] == '1' ? 'Published' : 'Unpublished';
                // $val["category"] = $value["product_category"];
                $val["edit"] = $value["edit"];
                array_push($temparray, $val);
            }
        }


        $data['product_list'] = $temparray;
        $html = $this->load->view('productManagement/productListReportPdf', $data, true);
        // echo $html;
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $current_date = date('Y-m-d H:i:s');
        $file_name = 'productlistreport' . $current_date . '.pdf';
        if ($option == 'D') {
            $pdf->Output($file_name, "D");
        }
        if ($option == 'I') {
            $pdf->Output($file_name, "I");
        }
    }

    function product_list() {

        $data['tag'] = $this->Product_model->get_table_information('nfw_product_tag');
        if (isset($_POST['submit_pdf'])) {
            $product_list = $_POST['product_ids'];
            $prdlist = implode(',', $product_list);
            redirect("ProductHandler/product_list_report_pdf?opt=I&product_ids=$prdlist");
        }

        $this->load->view('productManagement/product_list', $data);
    }

    function listData($tag = '0', $publising = '2') {

        $url = base_url() . 'index.php/ProductHandler/add_product_information';
        $classa = '"btn btn-success product_id"';
        $str = $_REQUEST['start'];
        $lem = $_REQUEST['length'];
        $search = $_REQUEST['search']['value'];
        $tg = "";
        $tgi = "";
        if ($tag != '0') {
            $tg = "join  nfw_product_tag_connection as nptc on nptc.product_id = p.id";
            $tgi = " and nptc.tag_id = $tag";
        }


        $pgi = '';
        if ($publising != '2') {

            $pgi = " and p.publishing = $publising";
        }


        $query = "select @a:=@a+1  as serial_number,concat('<img src=" . image_server . "/nfw/smaller/',pi.image,'>') as image,p.product_category,
                concat('<table class=price_table>',
                (SELECT replace(group_concat('<tr><td>',npt.tag_title,'</td><td>', concat('$',price, if(sale_price, concat('&nbsp;&nbsp;&nbsp;Sale: $', sale_price), ''),'</td></tr>')), ',', '') FROM nfw_product_tag_connection nptc
join nfw_product_tag as npt on npt.id = nptc.tag_id
where product_id = p.id), '</table>'
                 ) as tag_price, p.title as title,
                 
                
                p.sku,p.product_speciality,
                p.publishing,
                p.short_description,concat('<a class=$classa href=$url/',p.id, '/', 'edit/', p.product_category ,'>Edit</a><input type=hidden name=product_ids[] value=',p.id,'>') as edit from (select @a:=0) test1, nfw_product as p 
                 left join nfw_product_images as pi on p.id = pi.nfw_product_id
                 $tg
                 where p.title like '%$search%' $tgi $pgi
                 group by p.id limit $str,$lem";

        $query1 = "select @a:=@a+1  as serial_number,concat('<img src=" . image_server . "/nfw/smaller/',pi.image,'>') as image,p.product_category ,p.sku,p.product_speciality,p.short_description,concat('<a class=$classa href=$url/',p.id, '/', 'edit/', p.product_category ,'>Edit</a>') as edit from (select @a:=0) test1, nfw_product as p 
                 left join nfw_product_images as pi on p.id = pi.nfw_product_id
                 $tg
                 where p.title like '%$search%' $tgi $pgi
                 group by p.id ";

        $obj = $this;


        $data = $this->Product_model->query_exe($query);
        $data1 = $this->Product_model->query_exe($query1);

        

        function get_parentReq($obj, $id) {
            $query ="select cd.id, cd.name as child_title, cd.parent as parent, pt.name as title  from nfw_category as cd
                                     join nfw_category as pt on pt.id = cd.parent
                                     where cd.id= '$id' ";

            $test = $id;

            while ($row = $obj->Product_model->query_exe($query)) {
                $cat = get_parentReq($obj, $row['parent']);
                $test = $cat . "," . $test;
                //$parent_array[$row['parent']] = $row['title'];
            }

            //print_r($parent_array);

            return $test;
        }

        $temparray = array();

        if (count($data)) {

            foreach ($data as $key => $value) {
                $val = [];
                $catarray = '';// get_parentReq($obj, $value['product_category']);
                $catarrays = explode(',', $catarray);
                $categoryarray = [];
                if ($catarray) {
                    foreach ($catarrays as $k => $v) {
                        $query = "select name from nfw_category where id = $v";
                        $data = $this->Product_model->query_exe($query);
                        $datat = end($data);
                        $rr = $datat['name'];
                        array_push($categoryarray, $rr);
                    }
                }

                $val['category'] = implode(" -> ", $categoryarray);
                $val["serial_number"] = $value["serial_number"];
                $val["image"] = $value["image"];
                $val["title"] = $value["title"];
                $val["sku"] = $value["sku"];
                $val["publishing"] = $value["publishing"] == '1' ? 'Published' : 'Unpublished';
                $val["tag_price"] = $value["tag_price"];
                $val["product_speciality"] = $value["product_speciality"];
                // $val["category"] = $value["product_category"];
                $val["edit"] = $value["edit"];
                array_push($temparray, $val);
            }
        }

        $draw = $_REQUEST['draw'];
        $temp = array("draw" => $draw,
            "recordsTotal" => count($data1),
            "recordsFiltered" => count($data1),
            "data" => $temparray
        );

        echo json_encode($temp);
    }

    #11-dec-2015

    function fabricCategory() {

        $data['fabric_list'] = $this->Product_model->get_table_information('nfw_fabric');
        if (isset($_POST['submit'])) {
            $name = $this->input->post('fabric');
            $user_data = array(
                'title' => $name
            );
            $this->db->insert('nfw_fabric', $user_data);
            redirect('ProductHandler/fabricCategory');
        }
        if (isset($_POST['updatefebric'])) {
            $name = $this->input->post('fabric');
            $user_data = array(
                'title' => $name
            );
            $ids = $this->input->post('edit_fabric');
            $this->db->where('id', $ids);
            $this->db->update('nfw_fabric', $user_data);
            redirect('ProductHandler/fabricCategory');
        }
        if (isset($_POST['delete'])) {
            $id = $_POST['delete'];
            $this->Product_model->delete_table_information('nfw_fabric', 'id', $id);
            redirect('ProductHandler/fabricCategory');
        }
        $this->load->view('productManagement/fabric_category', $data);
    }

    function shipping_conf() {
        $shipping_data = $this->Product_model->get_table_information('nfw_shipping');
        $data['shipping_data'] = end($shipping_data);
        if (isset($_POST['update_shipping'])) {
            $ship_data = array(
                'shipping_amount' => $this->input->post('shipping_amount'),
                'min_amount' => $this->input->post('min_amount'),
            );
            $ids = $this->input->post('edit_fabric');
            $this->db->where('id', '1');
            $this->db->update('nfw_shipping', $ship_data);
            redirect('ProductHandler/shipping_conf');
        }
        $this->load->view('productManagement/shipping_conf', $data);
    }

    function notification_template() {

        if (isset($_REQUEST['submit'])) {
            //print_r($_POST);
            $date_time = date('Y-m-d H:i:s');
            $temp_arry = array(
                'template_title' => 'test',
                'mail_type' => 'test',
                'is_default' => 'test',
                'op_date_time' => $date_time,
                'header' => $this->input->post('elm1'),
                'footer' => $this->input->post('elm2')
            );
            $this->db->insert('nfw_mail_template', $temp_arry);
        }

        $this->load->view('productManagement/notificationTemplate.php');
    }

}
