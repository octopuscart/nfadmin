<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    ///***********   Upload image file    *************///
    public function image_upload($path) {
        $config = array(
            'upload_path' => "$path", //      ./assets/images/company_image/
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size
            'max_height' => "768",
            'max_width' => "1024",
            'picture' => "userfile"
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());
            //////****** Change file name  ******//////
            $file_path = $data['upload_data']['file_path'];

            $file = $data['upload_data']['full_path'];
            $file_ext = $data['upload_data']['file_ext'];
            $final_file_name = time() . $file_ext;
            rename($file, $file_path . $final_file_name);
            return $final_file_name;
            ///////**** End  *****///////
        } else {
            $error = array('error' => $this->upload->display_errors());
        }
    }

    //*** End Image upload function  **//
    //*****  Add Category detail   ****//
//    function add_category_information($id) {
//        $picture = $this->image_upload('./assets_main/images/product_category/');
//        $data = array(
//            'parent' => $id,
//            'name' => $this->input->post('category'),
//            'category_image' => $picture
//        );
//        $this->db->insert('nfw_category', $data);
//        $catId = $this->db->insert_id();
//        $this->User_model->tracking_data_insert('nfw_category',$catId,'insert');
//        return $id;
//    }
    //** End  **//
    //****  Get Detail of Category and Subcategory  *****//
    function get_table_information($tableName, $columnName = '', $id = '', $orderby = '') {
        if ($orderby) {
            $this->db->order_by($orderby);
        }
        if ($columnName) {
            $this->db->where($columnName, $id);
        }
        $query = $this->db->get($tableName);

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    ###########################

    function edit_table_information($tableName, $id) {
        $this->User_model->tracking_data_insert($tableName, $id, 'update');
        $this->db->update($tableName, $id);
    }

    ///*******  Get data for deepth of the array  ********///
    function parent_get($id) {
        //  $this->db->select('name, id');
        $this->db->where('parent', $id);
        $query = $this->db->get('nfw_category');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $test = $this->child($row['id']);
                $cat[$row['id']] = $test;
            }
            return $cat; //format the array into json data
        }
    }

    function child($id) {
        //$count=$count+1;;
//        $query = mysql_query("select * from nfw_category where parent=$id");
        // $this->db->select('name, id');
        $this->db->where('parent', $id);
        $query = $this->db->get('nfw_category');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $cat[] = $row;
                $cat[$row['id']] = $this->child($row['id']);
                $cat[] = $row;
            }
            return $cat; //format the array into json data
        }
    }

    // fetch all product sub category
    function product_subcategory($product_id) {
        $this->db->select('category_id');
        $this->db->from('nfw_product_subcategory');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $cat[] = $row;
               
            }
            return $cat; //format the array into json data
        }
    }

//    function test_image() {
//        print_r($_FILES);
//        // $picture = $this->image_upload('./assets_main/images/product_category/');
//    }

    function get_table_information_not_in($tableName, $columnName, $ignore, $col2 = '', $id = '') {
        if ($col2) {
            $this->db->where($col2, $id);
        }
        $this->db->where_not_in($columnName, $ignore);
        $query = $this->db->get($tableName);

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    function related_information($productId) {
        $query = "SELECT pr.id, p.title, p.sku, p.short_description, p.product_speciality, pi.image
                         FROM nfw_product AS p
                         LEFT JOIN nfw_product_images AS pi ON p.id = pi.nfw_product_id
                         JOIN nfw_product_related AS pr ON p.id = pr.nfw_related_product_id
                         WHERE pr.nfw_product_id =$productId
                         GROUP BY p.id";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    function featured_information() {
        $query = "SELECT p.id, p.title, p.sku, p.product_speciality, pi.image
                  FROM nfw_product AS p
                  LEFT JOIN nfw_product_images AS pi ON p.id = pi.nfw_product_id
                  JOIN nfw_product_featured AS pf ON p.id = pf.nfw_product_id 
                  GROUP BY p.id";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    #3-dec-2015
    #update and all operation related to sorting done by this function

    function most_popular_product_information($tablename) {
        $query = "SELECT pf.id, p.title, p.sku, p.product_speciality, pi.image
                  FROM nfw_product AS p
                  LEFT JOIN nfw_product_images AS pi ON p.id = pi.nfw_product_id
                  JOIN $tablename AS pf ON p.id = pf.product_id 
                  GROUP BY p.id";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    ###########################################

    function feature_related_report_select($notIn, $col = '', $id = '') {
        $query = "SELECT p.id, p.title, p.sku, p.product_speciality,pi.image 
                  FROM nfw_product AS p
                 left JOIN nfw_product_images AS pi ON p.id = pi.nfw_product_id
                  WHERE ";
        if ($col) {
            $subquery1 = " $col = $id AND ";
            $query = $query . $subquery1;
        }
        if ($notIn) {
            $subQuery = " p.id NOT IN ( $notIn) GROUP BY p.id";
        } else {
            $subQuery = " p.id NOT IN ('') GROUP BY p.id";
        }

        $query = $query . $subQuery;
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    function product_category_data($id) {

        $this->db->select('pst.id,pst.tag_title,pstc.id as tag_conn_id');
        $this->db->from('nfw_product_tag pst');
        $this->db->join('nfw_product_tag_connection pstc', 'pst.id = pstc.tag_id');
        $this->db->where('product_id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    public function query_exe($query) {
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    function delete_table_information($tableName, $columnName, $id) {
        $this->User_model->tracking_data_insert($tableName, $id, 'delete');
        $this->db->where($columnName, $id);
        $this->db->delete($tableName);
    }

    function get_parent($id) {
        $query = "select * from nfw_category where id=$id";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $test1 = $row['name'];
                $test2 = $row['id'];
                $cat = $this->get_parent($row['parent']);
                $cat1 = $cat[0];
                $cat2 = $cat[1];

                $test1 = $cat1 . ", " . $test1;
                $test2 = $cat2 . ", " . $test2;
            }
            return [$test1, $test2];
        }
    }

    function get_last_id($tableName) {
        $this->db->order_by('id', 'desc');
        $this->db->select('id');
        $query = $this->db->get($tableName, 1, 0);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    /*     * ********************************************02-09-2015******************************* */

    function last_child($parentId) {
        $query = "select id from nfw_category where parent = $parentId";
        $query1 = $this->db->query($query);
        if ($query1->num_rows() > 0) {
            foreach ($query1->result_array() as $res) {
                $id = $res['id'];
                global $data;
                $childData = $this->last_child($id);
                if ($childData == '') {
                    $get_data = $this->db->query("select * from nfw_category where id=$id");
                    $get_id = $get_data->result_array();
                    $data[] = $get_id[0];
                }
            }
            return $data;
        }
    }

    /*     * *************************************************************************************** */

    function get_user_invoice_info($orderId, $userId) {
        $this->db->where('user_id', $userId);
        $this->db->where('order_id', $orderId);
        $query = $this->db->get('nfw_order_invoice');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function current_stock_information($id) {
        $query = "SELECT * FROM  nfw_stock_availability WHERE fabric_id =$id ORDER BY id DESC limit 0,1 ";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function shirt_custom_report() {
        $this->db->from('nfw_shirt_custom as sc');
        $this->db->join('auth_user as au', 'sc.user_id = au.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    #19-sep-2015 
    #for product image

    function productImage($product_id) {
        $query = "select concat('" . image_server . "/nfw/small/', image) as image from nfw_product_images 
                  where nfw_product_id = $product_id order by display_priority desc";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $allImages[] = $row;
            }
        }
        $profileImage = $allImages[0]['image'];
        return $profileImage;
    }

    #function for fetch taged data - 25-sep-2015

    function product_info_filtering($id) {
        $this->db->select('np.title,np.product_speciality,np.short_description,ptc.price');
        $this->db->from('nfw_product_tag_connection as ptc');
        $this->db->join('nfw_product as np', 'ptc.product_id = np.id');
        $this->db->where('tag_id', $id);
        $query = $this->db->get();
        //print_r($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data1[] = $row;
            }
            return $data1;
        }
    }

    function popular_product_info() {
        $query = 'SELECT (
                           SELECT image
                           FROM nfw_product_images
                           WHERE nfw_product_id = pc.product_id
                           ORDER BY display_priority DESC 
                           LIMIT 0 , 1
                         ) AS image, p.id AS product_id, p.title, p.sku, p.short_description, SUM( pc.quantity ) AS quantity
                  FROM  `nfw_product_cart` AS pc
                  JOIN nfw_product AS p ON pc.product_id = p.id
                  GROUP BY product_id
                  ORDER BY quantity DESC ';
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function category_tag_connection() {
        $query = 'SELECT ctc.id as id, c.name AS category, pt.tag_title
                  FROM nfw_category_tag_connection AS ctc
                  JOIN nfw_category AS c ON ctc.category_id = c.id
                  JOIN nfw_product_tag AS pt ON ctc.tag_id = pt.id
                  order by tag_index asc, index_menu asc
                   ';
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    #7-Oct-2015
    #function for fetch discount detail

    function coupan_detail($id) {
        $this->db->select('nc.value,nc.value_type,npo.total_price');
        $this->db->from('nfw_coupon as nc');
        $this->db->join('nfw_product_order as npo', 'nc.id = npo.coupon_id');
        $this->db->where('npo.id', $id);
        $query = $this->db->get();
        //print_r($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    #function for fetch address

    function bill_ship_address($table_name, $id) {
        $this->db->select(" CONCAT((address1),(' ,')) as add1, CONCAT((address2),(' ,')) as add2, CONCAT((city),(' ,'),(state)) as add3, CONCAT((zip),(' ,'),(country)) as add4 ,contact_no");
        $this->db->from($table_name);
        $this->db->where('id', $id);
        $query = $this->db->get();
        // print_r($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    #8-Oct-2015
    #function for find profile name

    function profileName($meas_id) {
        $this->db->select('profile_name');
        $this->db->from('nfw_measurement');
        $this->db->where('id', $meas_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    #10-Oct-2015

    function productDetail($product_id) {
        // echo $product_id;
        $this->db->select('title,child_label,standard,set_image');
        $this->db->from('nfw_custom_element_field');
        $this->db->where('id', $product_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            // print_r($data);
            return $data;
        }
    }

    function tag_name($colomn, $table_name, $tag_id) {
        $this->db->select($colomn);
        $this->db->from($table_name);
        $this->db->where('id', $tag_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            // print_r($data);
            return $data;
        }
    }

    #30-oct-2015
    #for card detail

    public function user_card_detail($order_id) {
        //echo $order_id;
        $query = "SELECT nuc.*,npo.total_price  FROM `nfw_user_card` as nuc join nfw_product_order as npo on nuc.id = npo.card_id where npo.id = $order_id";
        //echo $query;
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

//     
//     function commom_summary_pdf() {
//        $Text = urldecode($_REQUEST['data']);
//        $Mixed = json_decode($Text);
//        $data['result'] = $Mixed;
//        $tag = $_REQUEST['tag_id'];
//        $data['name'] = $this->tag_name($tag);
//        $html = $this->load->view('productManagement/productFilteringPdf', $data, true);
//        $this->load->library('M_pdf');
//        $pdf = $this->m_pdf->load();
//        $pdf->WriteHTML($html);
//        $current_date = date('Y-m-d H:i:s');
//        $file_name = 'productlistreport' . $current_date . '.pdf';
//        $pdf->Output($file_name, "D");
//    }
//    
}

class JsonSorting {

    public function __construct($source) {
        $this->source = $source;
    }

    public function count_values($keyname, $keyval) {
        $count = 0;
        foreach ($this->source as $key => $value) {
            if ($keyval == $value[$keyname]) {
                $count++;
            }
        }
        return [$keyval, $count];
    }

    public function collect_data($keyname) {
        $datalist = array();
        $ll2 = array();
        $count1 = 0;
        foreach ($this->source as $key => $value) {
            $temp = $value[$keyname];
            if (in_array($temp, $datalist)) {
                
            } else {
                array_push($datalist, $temp);
            }
        }
        foreach ($datalist as $key => $value) {
            $temp1 = $this->count_values($keyname, $value);
            $ll2[$temp1[0]] = $temp1[1];
        }
        return $ll2;
    }

    public function data_combination($keyname1, $keyname2) {
        $data_contain = array();
        $key_1 = $this->collect_data($keyname1);
        $key_2 = $this->collect_data($keyname2);
        $key_data1 = array_keys($key_1);
        $key_data2 = array_keys($key_2);
        foreach ($key_data2 as $kd2 => $vl2) {
            $sort_temp = array();
            foreach ($key_data1 as $kd1 => $vl1) {
                $count = 0;
                foreach ($this->source as $kd => $vl) {
                    $temp1 = $vl[$keyname1];
                    $temp2 = $vl[$keyname2];
                    if ($temp1 == $vl1 && $temp2 == $vl2) {
                        $count++;
                        $sort_temp[$vl1] = $count;
                    }
                }
                $data_contain[$vl2] = $sort_temp;
            }
        }
        return $data_contain;
    }

    public function data_combination_quantity($keyname1, $keyname2) {
        $data_contain = array();
        $key_1 = $this->collect_data($keyname1);
        $key_2 = $this->collect_data($keyname2);
        $key_data1 = array_keys($key_1);
        $key_data2 = array_keys($key_2);
        foreach ($key_data2 as $kd2 => $vl2) {
            $sort_temp = array();
            foreach ($key_data1 as $kd1 => $vl1) {
                $count = 0;
                foreach ($this->source as $kd => $vl) {
                    $temp1 = $vl[$keyname1];
                    $temp2 = $vl[$keyname2];
                    if ($temp1 == $vl1 && $temp2 == $vl2) {
                        $count = $count + $vl1;
                        $sort_temp[$vl1] = $count;
                    }
                }
                $data_contain[$vl2] = $sort_temp;
            }
        }
        $temp = array();
        foreach ($data_contain as $key => $value) {
            $temp2 = array_sum($value);
            $temp[$key] = $temp2;
        }

        return $temp;
    }

}
