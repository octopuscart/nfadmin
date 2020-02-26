<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
// Call the Model constructor 
        parent::__construct();
        $this->load->database();
    }

#10-dec-2015

    public function user_wise_order_history($userid) {
        $query = "SELECT  oi.invoice_no,oi.total_amount,npo.id as order_id,npo.op_date,npo.op_time,ost.title,npo.order_no,npo.total_price,npo.total_quantity
                           FROM `nfw_product_order` as npo
                           join nfw_order_status as os on npo.id = os.order_id
                           join nfw_order_status_tag as ost on os.status = ost.id 
                           join nfw_order_invoice as oi on npo.id = oi.order_id
                           where npo.user_id = $userid";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    function user_order_history($status1 = '', $dateDiff1 = '', $user_id = '', $user = '') {
        $query = "SELECT po.id,po.order_no, po.total_price, po.total_quantity, po.op_date, po.op_time, au.first_name, au.last_name, pc.product_id,
                         p.title AS product, st.title AS order_status,po.billing_id,po.shipping_id,po.user_id
                         FROM nfw_product_order AS po
                         JOIN nfw_product_cart AS pc ON po.id = pc.order_id
                         JOIN auth_user AS au ON pc.user_id = au.id
                         JOIN nfw_product AS p ON pc.product_id = p.id
                         JOIN nfw_order_status AS os ON po.id = os.order_id
                         JOIN nfw_order_status_tag AS st ON os.status = st.id
                         join nfw_billing_shipping_address as bsa on po.billing_id = bsa.id
                         join nfw_billing_shipping_address as bssa on po.shipping_id = bssa.id ";

        if ($status1) {
            $query_status = " where os.status = $status1";
            $query = $query . $query_status;
        }


        if ($dateDiff1) {
            if ($user) {
                $query_date = " where po.op_date between $dateDiff1 and pc.user_id = $user";
            } else {
                $query_date = " where po.op_date between $dateDiff1";
            }
            $query = $query . $query_date;
        }


        if ($user_id) {
            $query_user = " where pc.user_id = $user_id ";
            $query = $query . $query_user;
        }

        $query_groupby = " GROUP BY po.id order by po.id desc";

        $query = $query . $query_groupby;

        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

#9-Nov-2015

    public function order_full_detail5($dateDiff1, $order_status, $user_id) {
        $uq = "";
        $sq = "";

        if ($user_id) {
            $uq = " and au.id = $user_id ";
        }

        if ($order_status != '0') {
            $sq = " and ost.id = $order_status ";
        }


        $query = "SELECT ncpo.coupon_code as coupon_code, ncpo.coupon_type as coupon_type, ncpo.value as coupon_value,  op.user_info, op.shipping_id  as shipping, op.billing_id as billing ,SUBSTRING_INDEX(SUBSTRING_INDEX(op.shipping_id, '" . '"country":"' . "', -1), '" . '"' . "', 1 ) as country,
            op.user_id, op.id as order_id,op.op_date,op.op_time,op.total_price,op.total_quantity,op.order_no,oi.invoice_no,op.user_info, ost.title, os.op_date_time as status_date
                   FROM `nfw_product_order` as op 
                    JOIN nfw_product_cart AS pc ON op.id = pc.order_id
                    JOIN nfw_product AS p ON pc.product_id = p.id
                    join nfw_order_invoice as oi on op.id = oi.order_id
                    join auth_user as au on op.user_id = au.id
                    join nfw_order_status as os on op.id = os.order_id
                    join nfw_order_status_tag as ost on os.status = ost.id
                    left join nfw_coupon as ncpo on ncpo.id = op.coupon_id
                    where op.op_date between $dateDiff1 $uq $sq GROUP BY op.id order by op.id desc";



        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data; //format the array into json data
        }
    }

    public function get_order_status($id) {
        $query = "select id,title from nfw_order_status_tag where id >(select status from nfw_order_status where order_id = $id) limit 0,1";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }

            return $data; //for
//mat the array into json data
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

    public function mailsetting_header($element) {
        $query = $this->db->query("SELECT * FROM `nfw_mail_template_setting`");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return end($data)[$element]; //format the array into json data
        }
    }

    public function mail_template($mailtype, $element) {
        $query = $this->db->query("SELECT * FROM nfw_mail_template where mail_type = '$mailtype'");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return end($data)[$element]; //format the array into json data
        }
    }

    public function get_old_status($id) {
        $query = "select order_id,status,remark,op_date_time from nfw_order_status where order_id=$id";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }

            return $data; //format the array into json data
        }
    }

#update 10-dec-2015

    function get_product_information($id) {
        $query = "SELECT pc.item_image AS image, 
                   pc.product_id, pc.id AS cart_id, pc.user_id, pc.op_date, pc.quantity,  IF(pc.extra_price IS NULL,'0',pc.extra_price) as extra_price, pc.order_id, pc.item_code AS product, pc.sku,
                   pc.customization_id as style,pc.customization_data,pc.measurement_data,
                   pc.measurement_id, pc.tag_id, ( pc.price * pc.quantity + IF(pc.extra_price IS NULL,'0',pc.extra_price)  * pc.quantity) AS total_price,
                   pc.price,pc.tag_title as item_name,pc.customization_id,pc.customization_data_price,pc.user_images,pc.posture_data
                   FROM nfw_product_cart AS pc 
                   WHERE pc.order_id = $id";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }

            return $data; //format the array into json data
        }
    }

#19-nov-2015 

    function xls_report_data($order_id) {
        $query = "SELECT 
            (
                   SELECT image FROM nfw_product_images
                   WHERE nfw_product_id = pc.product_id ORDER BY display_priority DESC LIMIT 0 , 1 ) AS image, 
                   
                   pc.product_id, pc.id AS cart_id, pc.user_id, pc.op_date, sum(pc.quantity) as quantity,  IF(pc.extra_price IS NULL,'0',pc.extra_price) as extra_price, pc.order_id, p.title AS product, p.sku, pc.customize_table,
                   pc.customization_id as style,
                   pc.measurement_id as meas,
                   pc.measurement_id, pc.tag_id, ( tc.price * pc.quantity + IF(pc.extra_price IS NULL,'0',pc.extra_price)  * pc.quantity) AS total_price,
                   tc.price,pt.tag_title as item_name,pc.customization_id,count(pc.tag_id) as total
                   FROM nfw_product_cart AS pc 
                  
                   JOIN nfw_product AS p ON pc.product_id = p.id 
             
                   JOIN nfw_product_tag_connection AS tc ON pc.product_id = tc.product_id AND pc.tag_id = tc.tag_id 
                   JOIN nfw_product_tag AS pt ON pc.tag_id = pt.id WHERE pc.order_id = $order_id group by pc.tag_id, pc.product_id";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }

            return $data; //format the array into json data
        }
    }

#############3

    function order_status_record($id) {
        $query1 = '
                      SELECT ost.id as status_tag,ost.title AS order_status, os.remark,  os.id as status_id,
                      os.op_date_time as date
                             FROM nfw_order_status AS os
                             JOIN nfw_order_status_tag AS ost ON os.status = ost.id
                             WHERE os.order_id =' . $id;
        $query2 = 'SELECT ost.id as status_tag,ost.title AS order_status, os.remark, os.id as status_id,
                        os.op_date_time as date
                            FROM  nfw_old_order_status as os
                            JOIN   nfw_order_status_tag AS ost ON os.status = ost.id
                            WHERE os.order_id = ' . $id . '
                  order by status_id desc ';
        $query1 = $this->db->query($query1);
        $query2 = $this->db->query($query2);
        if ($query1->num_rows() > 0) {
            foreach ($query1->result_array() as $row) {
                $data[] = $row;
            }
        }
        if ($query2->num_rows() > 0) {
            foreach ($query2->result_array() as $row) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function customize_product_name($tableName) {
        $tmp = '';
        switch ($tableName) {
            case 'nfw_pant_customize_profile':
                $tmp = 'Pant';
                break;
            case 'shirt_customize_profile':
                $tmp = 'Shirt';
                break;
        }
        return $tmp;
    }

    public function search_order_information($searchText) {
        $query = "SELECT id,order_no, billing_id, shipping_id, user_id FROM nfw_product_order WHERE order_no LIKE  '%$searchText%'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function tracking_data_insert($tableName, $tableId, $operation) {
        $getData = $_REQUEST;
        $session_data = $this->session->userdata('logged_in');
        $trackData = array(
            'user_id' => $session_data['login_id'],
            'table_name' => $tableName,
            'table_id' => $tableId,
            'remark' => json_encode($getData),
            'operation' => $operation,
            'op_date_time' => date('Y-m-d h:m:s')
        );
        $this->db->insert('nfw_tracking', $trackData);
    }

    public function user_notification($notification_data) {
        $this->db->insert('nfw_notification_user', $notification_data);
    }

    function user_billing_shipping($id) {
        $this->db->where('default_shipping_address', 'yes');
        $this->db->where('user_id', $id);
        $query = $this->db->get('nfw_billing_shipping_address');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data['shipping'][] = $row;
            }
        } else {
            $data['shipping'][] = [];
        }
        $this->db->where('default_billing_address', 'yes');
        $this->db->where('user_id', $id);
        $query = $this->db->get('nfw_billing_shipping_address');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data['billing'][] = $row;
            }
        } else {
            $data['billing'][] = [];
        }

        $query = "SELECT *  FROM  `nfw_billing_shipping_address` 
                            WHERE user_id =$id ";
        $data['extra_address'][] = $this->query_exe($query);
        return $data;
    }

    function user_invoice_detail_info($id) {
        $query = "SELECT pc.quantity, pc.extra_price, pc.customize_table, p.title, p.sku, oi.invoice_no, oi.op_date, 
                         oi.op_time, oi.total_amount, po.user_id,po.id as order_id,po.order_no, st.title AS status 
                  FROM  `nfw_order_invoice` AS oi
                  JOIN nfw_product_cart AS pc ON pc.order_id = oi.order_id
                  JOIN nfw_product AS p ON pc.product_id = p.id
                  JOIN nfw_product_order AS po ON oi.order_id = po.id
                  JOIN nfw_order_status AS os ON po.id = os.order_id
                  JOIN nfw_order_status_tag AS st ON os.status = st.id
                  WHERE oi.user_id = $id group by oi.id order by oi.id desc";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

#23-noe-2015

    function user_whole_order_detail($order_id) {
        $query = "  SELECT  npo.id,npo.op_date,npo.op_time,npo.order_no,npo.total_price,npo.total_quantity,npo.coupon_id,
                           npo.billing_id,npo.shipping_id,npo.user_info,npo.payment_gateway,npo.payment_gateway_return
                           FROM `nfw_product_order` as npo
                           where npo.id = $order_id";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function user_order_tracking_info($id) {
        $query = "SELECT os.client_code, os.order_no, os.invoice_no, os.shipping_date, os.total_weight,os.weight_unit, os.sender_company, 
                         os.destination_country, os.tracking_no, os.shipping_company, os.op_date_time, st.title AS status 
                         FROM  `nfw_order_shipping` AS os
                         JOIN nfw_product_order AS po ON os.order_id = po.id
                         JOIN nfw_order_status_tag AS st ON os.status = st.id
                         WHERE po.user_id =$id order by po.id desc";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }

    function find_style_id($tag, $user_id) {
        $result = [];

        $query = "SELECT style_profile as style FROM `nfw_custom_form_data`
                       where user_id = $user_id and tag_id = $tag order by nfw_custom_form_data.default desc";
        $result = $this->query_exe($query);

        return $result;
    }

    function find_measurement_id($tag, $user_id) {
        $result = [];

        $query = "SELECT measurement_profile as style FROM `nfw_measurement_data`
                       where user_id = $user_id and tag_id = $tag order by nfw_measurement_data.default desc";
        $result = $this->query_exe($query);

        return $result;
    }

    function search_user_information($searchText) {
        $query = "SELECT id,registration_id as client_code,telephone_no,first_name,middle_name,last_name FROM auth_user WHERE registration_id LIKE  '%$searchText%'";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function tracking_data() {
        $query = "SELECT nt.id, au.first_name, au.last_name, nt.table_name,au.contact_no, nt.operation, nt.op_date_time
                  FROM  `nfw_tracking` AS nt
                  JOIN auth_user AS au ON nt.user_id = au.id";
        $result = $this->query_exe($query);
        return $result;
    }

    function admin_information() {
        $this->db->select('au.*,am.group_id');
        $this->db->from('auth_user au');
        $this->db->join('auth_membership am', 'au.id = am.user_id');
// $this->db->join('auth_group ag', 'am.group_id = ag.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function active_user_quantity_info() {
        $query = 'SELECT (
                          SELECT image
                          FROM nfw_product_images
                          WHERE nfw_product_id = pc.product_id
                          ORDER BY display_priority DESC 
                          LIMIT 0 , 1
                        ) AS image, SUM( pc.quantity ) AS quantity, p.title, p.sku, p.short_description, CONCAT( au.first_name, " ", au.last_name ) AS user_name
                  FROM nfw_product_cart AS pc
                 
                  JOIN nfw_product AS p ON pc.product_id = p.id
                  JOIN auth_user AS au ON pc.user_id = au.id
                  GROUP BY pc.user_id
                  ORDER BY pc.quantity DESC  ';
        $result = $this->query_exe($query);
        return $result;
    }

    function popular_custom_product() {
        $query = 'SELECT p.id, pc.customize_table,
                     (
                       SELECT image
                       FROM nfw_product_images
                       WHERE nfw_product_id = pc.product_id
                       ORDER BY display_priority DESC 
                       LIMIT 0 , 1
                     ) AS image, SUM( pc.quantity ) AS quantity
               FROM nfw_product_cart AS pc
               JOIN nfw_product AS p ON pc.product_id = p.id
               GROUP BY pc.customize_table
               ORDER BY quantity DESC ';
        $result = $this->query_exe($query);
        return $result;
    }

#21-oct-2015
#function for find tag,customization,measurement
#update 26-10-2015

    function getCartDataByOrderProduct($order_id, $product_id) {
        $this->db->where('order_id', $order_id);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('nfw_product_cart');
        return $query->row();
    }

    function tag_custom_measurement($order_id) {
        $this->db->select('pt.tag_title,pt.id as tag_id, pt.tag_title, npc.id,npc.customization_id,npc.measurement_id,npc.customization_data,npc.measurement_data, npc.user_images,npc.posture_data,sum(npc.quantity) as quantity');
        $this->db->from('nfw_product_cart as npc');
        $this->db->join('nfw_product_tag as pt', 'npc.tag_id = pt.id');
        $this->db->where('npc.order_id', $order_id);
        $this->db->group_by('npc.customization_id,npc.measurement_id');
        $this->db->order_by('npc.id');
        $query = $this->db->get();

        $cat_container = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
//print_r($row);
                $cat = array();
//$pro_id = array();
//$test = $this->style_detail($row['customization_id']);
                $ttt = $this->phpjsonstyle($row['customization_data'], 'php');

//$test1 = $this->measurement_detail($row['measurement_id']);
                $ppp = $this->phpjsonstyle($row['measurement_data'], 'php');

                $image_data = $row['user_images'];
                $image_data = trim($image_data, "[");
                $image_data = trim($image_data, "]");
                $image_data = explode(",", $image_data);



                $kkk = $this->phpjsonstyle($row['posture_data'], 'php');
                $pro_id = $this->product_id($order_id, $row['customization_id'], $row['measurement_id']);

                $temp = array();
                for ($i = 0; $i < count($pro_id); $i++) {
                    $p_id = $pro_id[$i];
                    $temp2 = $this->product_detail($p_id['product_id']);

                    $cartproductobj = $this->getCartDataByOrderProduct($order_id, $p_id['product_id']);


                    $temp2[0]['item_name'] = $cartproductobj ? $cartproductobj->tag_title : $row['tag_title'];
                    $temp2[0]['cquantity'] = $p_id['quantity'];
                    array_push($temp, $temp2);
                }

                $cat['p_data'] = $temp;
                $cat['quantity'] = $row['quantity'];
                $cat['custom'] = $ttt;
                $cat['meas'] = $ppp;
                $cat['posture'] = $kkk;
                $cat['style_id'] = $row['customization_id'];
                $cat['user_image'] = $image_data;
                $cat['tag'] = $row['tag_title'];
                $cat['tag_id'] = $row['tag_id'];
                array_push($cat_container, $cat);
//$cat[$row['meas']] = $test1;
            }
            return $cat_container; //format the array into json data
        }
    }

# style detail
#24-nov-2015
//    function style_detail($customization_id) {
//        $this->db->select('custom_form_data,style_profile');
//        $this->db->from('nfw_custom_form_data');
//        $this->db->where('id', $customization_id);
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            foreach ($query->result_array() as $row) {
//                $data[] = $row;
//            }
//            // print_r($data);
//            return $data;
//        }
//    }

    function style_detail($customization_id) {
        $this->db->select('cfd.custom_form_data,cfd.style_profile,cfdp.custom_form_data_price');
        $this->db->from('nfw_custom_form_data as cfd');
        $this->db->join('nfw_custom_form_data_price as cfdp', 'cfd.id = cfdp.nfw_custom_form_data_id');
        $this->db->where('cfd.id', $customization_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
// print_r($data);
            return $data;
        }
    }

#26-Oct-2015
#find product id

    function product_id($order_id, $style_id, $mes_id) {
        $query = "SELECT product_id, quantity FROM `nfw_product_cart` where order_id= $order_id and measurement_id= '$mes_id' and customization_id = '$style_id'";
        $result = $this->query_exe($query);
        return $result;
    }

#function for fetch product detail

    function product_detail($product_id) {
        $query = "select pi.image,p.title,p.sku,p.short_description, p.product_speciality from nfw_product as p left join nfw_product_images as pi on p.id = pi.nfw_product_id where p.id = $product_id group by p.id";
        $result = $this->query_exe($query);
        return $result;
    }

    function product_detail_cart($product_id) {
        $query = "select pi.image,p.title,p.sku,p.short_description, p.product_speciality from nfw_product as p left join nfw_product_images as pi on p.id = pi.nfw_product_id where p.id = $product_id group by p.id";
        $result = $this->query_exe($query);
        return $result;
    }

#14-Oct-2015
#function for fetch mesurement

    function posture_image($key, $value) {
        $query = "SELECT set_image as image FROM nfw_custom_element_field as ncef
               join nfw_custom_element as nce on nce.id = ncef.nfw_custom_element_id 
               where nce.title = '$key' and ncef.child_label = '$value'";
        $result = $this->query_exe($query);
        return $result;
    }

    function measurement_detail($meas_id) {
        $this->db->select('measurement_data,posture_data, user_images');
        $this->db->from('nfw_measurement_data');
        $this->db->where('id', $meas_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

#21-nov-2015

    function payment_history($user_id) {
        $query = "SELECT np.transaction_no,np.status,po.order_no,ni.invoice_no,ni.op_date,ni.op_time,ni.total_amount,nc.card_number,nc.bank_name FROM `nfw_order_invoice` as ni
                      join nfw_order_payment as np on ni.order_id = np.order_id
                      join nfw_product_order as po on ni.order_id = po.id
                      join nfw_user_card as nc on np.card_id = nc.id
                      where ni.user_id = $user_id order by ni.invoice_no desc,ni.op_date desc";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function phpjsonstyle($data, $data_type) {

        $data = trim(trim($data, "{"), "}");
        $t = explode(",", $data);

        $temp = array();
        foreach ($t as $key => $value) {
            $t1 = explode(':', $value);
            $temp3 = $t1[1];
            $temp3 = substr($temp3, 0, -1);
            $temp3 = ltrim($temp3, '"');
            $temp31 = str_replace("++*++", ",", $temp3);
            $temp32 = str_replace("|||||", "'", $temp31);
            $temp[trim($t1[0], '"')] = $temp32;
        }
        if ($data_type == 'php') {
            return $temp;
        }
        if ($data_type == 'json') {
            return json_encode($temp);
        }
    }

    function order_report_statics($dateRange, $user) {





        if ($user) {
            $userquery = " and po.user_id = '$user' ";
        } else {
            $userquery = '';
        }
        $quryrange = "'" . str_replace(" to ", "' and '", $dateRange) . "'";
        $query = "
            SELECT po.user_id, po.op_date, replace(total_price, '$', '') as total_price, total_quantity, order_no,  
               " .
                " SUBSTRING_INDEX(SUBSTRING_INDEX(po.shipping_id, '" . '"country":"' . "', -1), '" . '"' . "', 1 ) as country,"
                . "

               concat(au.first_name,' ', au.middle_name, ' ', au.last_name, ' (',au.registration_id, ')') as user
               FROM nfw_product_order as po
                  join auth_user as au on au.id  = po.user_id
             
                   where po.op_date between " . $quryrange . $userquery . " 
                  order by po.op_date desc
                  ";

        $result = $this->db->query($query);
        $data1 = [];
        foreach ($result->result_array() as $row) {
            $data1[] = $row;
        }
        $obj = new JsonSorting($data1);


        $date_order = $obj->collect_data('op_date');
        $date_collection = $obj->data_combination_quantity('total_price', 'op_date');
        $date_order_data = array();
        foreach ($date_order as $key => $value) {
            $temp['Date'] = $key;
            $temp['Frequency'] = $value;
            $temp['Collection'] = $date_collection[$key];
            $date_order_data[] = $temp;
        }


        $user_order = $obj->collect_data('user');
        $user_collection = $obj->data_combination_quantity('total_price', 'user');
        $user_order_data = array();
        foreach ($user_order as $key => $value) {
            $temp['Client'] = $key;
            $temp['Frequency'] = $value;
            $temp['Collection'] = $user_collection[$key];
            $user_order_data[] = $temp;
        }


        $country_order = $obj->collect_data('country');
        $country_collection = $obj->data_combination_quantity('total_price', 'country');
        $country_order_data = array();
        $totalFeq = 0;
        $totalCol = 0;
        foreach ($country_order as $key => $value) {
            $temp['Country'] = $key;
            $temp['Frequency'] = $value;
            $totalFeq += $value;
            $temp['Collection'] = $country_collection[$key];
            $totalCol += $country_collection[$key];
            $country_order_data[] = $temp;
        }


        $chart_data = array(
            'chart2' => array(
                'data' => $country_collection,
                'heading' => 'Collection by Country',
                'heads' => ['Country', 'Collection'],
            ),
            'chart1' => array(
                'data' => $user_collection,
                'heading' => 'Collection by Client',
                'heads' => ['Client', 'Collection'],
            ),
            'chart3' => array(
                'data' => $date_collection,
                'heading' => 'Collection by Date',
                'heads' => ['Date', 'Collection'],
            ),
        );
        $data['chart_data'] = $chart_data;

        $tab_data = array(
            'tab0' => array(
                'heads' => array('Date', 'Frequency', 'Collection'),
                'data' => $date_order_data,
                'tab_heading' => 'Date',
                'tab_detail' => 'How much order taken by each date.',
            ),
            'tab1' => array(
                'heads' => array('Client', 'Frequency', 'Collection'),
                'data' => $user_order_data,
                'tab_heading' => 'Client',
                'tab_detail' => 'How much order taken by each user.',
            ),
            'tab2' => array(
                'heads' => array('Country', 'Frequency', 'Collection'),
                'data' => $country_order_data,
                'tab_heading' => 'Country',
                'tab_detail' => 'How much order and collection by each country.',
            )
        );
        $data['tab_data'] = $tab_data;

        $data['table_data'] = $data1;
        $table_heads = array(
            'user' => 'Client',
            'order_no' => 'Order No.',
            'op_date' => 'Date',
            'total_quantity' => 'Quantity',
            'total_price' => 'Total Price',
            'country' => 'Country',
        );
        $data['table_head'] = $table_heads;
        $data['dateRange'] = $dateRange;
        $data['tab_top_heading'] = 'Order by';

        return $data;
    }

    function customization_statics($dateRange, $user) {
        $quryrange = "'" . str_replace(" to ", "' and '", $dateRange) . "'";
        if ($user) {
            $userquery = " and pc.user_id = '$user' ";
        } else {
            $userquery = '';
        }

        $query = "SELECT pt.title as item_code, tg.tag_title as item_name, pc.op_date as date, pc.quantity as quantity, au.id as user_id,
       concat(au.first_name,' ', au.middle_name, ' ', au.last_name, ' (',au.registration_id, ')') as user
       FROM nfw_product_cart as pc 
      join nfw_product as pt on pt.id = pc.product_id
      join auth_user as au on au.id  = pc.user_id
      join nfw_product_tag as tg on tg.id = pc.tag_id 
      join nfw_product_order as nop on nop.id = pc.order_id
       where nop.op_date between " . $quryrange . $userquery . "
      order by pc.op_date desc
         ";
        $data1 = [];
        $result = $this->db->query($query);
        foreach ($result->result_array() as $row) {
            for ($i = 0; $i < $row['quantity']; $i++) {
                $temp = $row;
                $temp['quantity'] = 1;
                $data1[] = $temp;
            }
        }

        $obj = new JsonSorting($data1);

        $item_code = $obj->collect_data('item_code');
        $item_code_data = array();
        foreach ($item_code as $k => $v) {
            $temp = array();
            $temp['Item Code'] = $k;
            $temp['Quantity'] = $v;
            $item_code_data[] = $temp;
        }


        $item_name = $obj->collect_data('item_name');
        $item_name_data = array();
        foreach ($item_name as $k => $v) {
            $temp = array();
            $temp['Item Name'] = $k;
            $temp['Quantity'] = $v;
            $item_name_data[] = $temp;
        }

        $client = $obj->collect_data('user');
        $client_data = array();
        foreach ($client as $k => $v) {
            $temp = array();
            $temp['Client'] = $k;
            $temp['Quantity'] = $v;
            $client_data[] = $temp;
        }


        $date_item_name = $obj->data_combination('item_name', 'date');
        $date_item_code_data = array();
        foreach ($date_item_name as $k => $v) {
            $count = 0;
            foreach ($v as $k1 => $v1) {
                $temp1 = array();
                $temp1['Date'] = $k;
                $temp1['Item Name'] = $k1;
                $temp1['Quantity'] = $v1;
                $date_item_code_data[] = $temp1;
                $count++;
            }
        }


        $item_name_code = $obj->data_combination('item_code', 'item_name');
        $item_name_code_data = array();
        foreach ($item_name_code as $k => $v) {
            $count = 0;
            foreach ($v as $k1 => $v1) {
                $temp1 = array();
                $temp1['Item Name'] = $k;
                $temp1['Item Code'] = $k1;
                $temp1['Quantity'] = $v1;
                $item_name_code_data[] = $temp1;
                $count++;
            }
        }



        $item_name_user = $obj->data_combination('item_name', 'user');
        $item_name_user_data = array();
        foreach ($item_name_user as $k => $v) {
            $count = 0;
            foreach ($v as $k1 => $v1) {
                $temp1 = array();
                $temp1['Client'] = $k;
                $temp1['Item Name'] = $k1;
                $temp1['Quantity'] = $v1;
                $item_name_user_data[] = $temp1;
                $count++;
            }
        }

        $date_user = $obj->data_combination('date', 'user');
        $date_user_data = array();
        foreach ($date_user as $k => $v) {
            $count = 0;
            foreach ($v as $k1 => $v1) {
                $temp1 = array();
                $temp1['Client'] = $k;
                $temp1['Date'] = $k1;
                $temp1['Quantity'] = $v1;
                $date_user_data[] = $temp1;
                $count++;
            }
        }


        $tab_data = array(
            'tab0' => array(
                'heads' => array('Date', 'Item Name', 'Quantity'),
                'data' => $date_item_code_data,
                'tab_heading' => 'Date & Item Name',
                'tab_detail' => 'Date and item name.',
            ),
            'tab1' => array(
                'heads' => array('Item Name', 'Item Code', 'Quantity'),
                'data' => $item_name_code_data,
                'tab_heading' => 'Item Name & Code',
                'tab_detail' => 'How much customization done by each item name.',
            ),
            'tab2' => array(
                'heads' => array('Client', 'Item Name', 'Quantity'),
                'data' => $item_name_user_data,
                'tab_heading' => 'Client & Item Name',
                'tab_detail' => 'How much customization done by each Client.',
            ),
            'tab3' => array(
                'heads' => array('Client', 'Date', 'Quantity'),
                'data' => $date_user_data,
                'tab_heading' => 'Client & Date',
                'tab_detail' => 'How much customization report for Client & Date combination.',
            ),
            'tab4' => array(
                'heads' => array('Item Name', 'Quantity'),
                'data' => $item_name_data,
                'tab_heading' => 'Item Name',
                'tab_detail' => 'How much customization report for Client & Date combination.',
            ),
            'tab5' => array(
                'heads' => array('Item Code', 'Quantity'),
                'data' => $item_code_data,
                'tab_heading' => 'Item Code',
                'tab_detail' => 'How much customization report for Client & Date combination.',
            ),
            'tab6' => array(
                'heads' => array('Client', 'Quantity'),
                'data' => $client_data,
                'tab_heading' => 'Client',
                'tab_detail' => 'How much customization report for Client & Date combination.',
            )
        );
        $data['tab_data'] = $tab_data;
        $data['tab_top_heading'] = 'Customization by';


        $date_quantity = $obj->collect_data('date');

        $chart_data = array(
            'chart2' => array(
                'data' => $item_code,
                'heading' => 'Customization by Item Code',
                'heads' => ['Item Code', 'Quantity'],
            ),
            'chart1' => array(
                'data' => $item_name,
                'heading' => 'Customization by Item Name',
                'heads' => ['Item Name', 'Quantity'],
            ),
            'chart3' => array(
                'data' => $date_quantity,
                'heading' => 'Customization by Date',
                'heads' => ['Date', 'Quantity'],
            ),
        );
        $data['chart_data'] = $chart_data;
        $data['table_data'] = $data1;
        $table_heads = array(
            'date' => 'Date',
            'item_name' => 'Item Name',
            'item_code' => 'Item Code',
            'quantity' => 'Quantity',
            'user' => 'Client',
        );
        $data['table_head'] = $table_heads;
        $data['dateRange'] = $dateRange;
        return $data;
    }

#8-dec-2015

    function order_status($status_id) {
        $this->db->select('op.order_no,os.op_date_time,concat((au.first_name),(""),(au.last_name)) as user,ost.title');
        $this->db->from('nfw_order_status as os');
        $this->db->join('nfw_order_status_tag as ost', 'os.status = ost.id');
        $this->db->join('nfw_product_order as op', 'os.order_id = op.id');
        $this->db->join('auth_user as au', 'op.user_id = au.id');
        $this->db->where('ost.id', $status_id);
        $query = $this->db->get();
//print_r($query);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data1[] = $row;
            }
            return $data1;
        }
    }

    function references_user_report() {
        $query = "SELECT cr.id,cr.op_date_time,cr.receiver_email,au.email,au.id as sender_ids,concat(au.first_name,' ',au.last_name) as sender ,concat(aa.first_name,' ',aa.last_name) as receiver FROM `auth_user` as au
                    join nfw_site_reference as cr on au.id = cr.sender_id
                    join auth_user as aa on cr.receiver_id = aa.id where cr.status = 0";
        $result = $this->query_exe($query);
        return $result;
    }

    function purchased_coupon_report() {
        $query = " SELECT concat(au.first_name,' ',au.last_name) as name,c.coupon_code,cp.op_date_time,cp.amount,cp.payment_method,cp.payment_data
                  FROM `nfw_coupon_purchase` as cp join nfw_coupon as c on cp.coupon_id = c.id
                  join auth_user as au on cp.user_id = au.id";
        $result = $this->query_exe($query);
        return $result;
    }

    function send_gift_coupon_report() {
        $query = "SELECT c.coupon_code,c.value,cs.user_name,cs.user_email,cs.op_date_time,concat(au.first_name,' ',au.last_name) as name,au.email  FROM `nfw_coupon_sendgift` as cs
                  join nfw_coupon_purchase as cp on cs.nfw_purchase_id = cp.id
                  join nfw_coupon as c on cp.coupon_id = c.id
                  join auth_user as au on cp.user_id = au.id ";
        $result = $this->query_exe($query);
        return $result;
    }

    function admin_consumed_coupon() {
        $query = "SELECT c.coupon_code,c.value,c.end_date,concat(au.first_name,' ',au.last_name) as name,au.email,csi.op_date_time FROM `nfw_coupon_sending_info` as csi 
                    join nfw_coupon as c on csi.coupon_id = c.id
                    join auth_user as au on csi.user_id = au.id
                    where csi.coupon_id not in(select coupon_id from nfw_coupon_purchase)";

        $result = $this->query_exe($query);
        return $result;
    }

    function getCustomizationDataById($custom_id) {
        $this->db->where('id', $custom_id);
        $query = $this->db->get('nfw_custom_form_data');
        $customdata = $query->row();
        $tempcustom = array("Style Profile" => "", "style" => array(), "extra_price" => array());
        if ($customdata) {
            $customDataArray = array();
            $this->db->where('style_profile', $custom_id);
            $query = $this->db->get('nfw_custom_form_data_attr');
            $customdataattr = $query->result_array();
            $tempcustom["Style Profile"] = $customdata->style_profile;
            foreach ($customdataattr as $key1 => $value1) {
                $tempcustom['style'][$value1['style_key']] = $value1['style_value'];
                if ($value1['extra_price']) {
                    $tempcustom['extra_price'][$value1['style_key']] = $value1['extra_price'];
                }
            }
        }
        return $tempcustom;
    }

    function getMeasurementDataById($measurementid) {
        $this->db->where('id', $measurementid);
        $query = $this->db->get('nfw_measurement_data');
        $customdata = $query->row();
        $tempcustom = array("Profile" => "", "meausrements" => array(), "posture" => array());
        if ($customdata) {
            $customDataArray = array();
            $this->db->where('profile_id', $measurementid);
            $query = $this->db->get('nfw_measurement_attr');
            $customdataattr = $query->result_array();
            $tempcustom["Profile"] = $customdata->measurement_profile;
            foreach ($customdataattr as $key1 => $value1) {

                if ($value1['measurement_type'] == 'measurement') {
                    $tempcustom['meausrements'][$value1['measurement_key']] = $value1['measurement_value'];
                }

                if ($value1['measurement_type'] == 'posture') {
                    $tempcustom['posture'][$value1['measurement_key']] = $value1['measurement_value'];
                }
            }
        }
        return $tempcustom;
    }

    function getOrderDetails($order_id) {
        $this->db->where('id', $order_id);
        $query = $this->db->get('nfw_product_order');
        $orderDetails = $query->row_array();
        $orderData = array();
        $orderData['details'] = $orderDetails;
        $this->db->where("order_id", $order_id);
        $querycart = $this->db->get("nfw_product_cart");
        $cartdata = $querycart->result_array();
        $productlist = [];
        foreach ($cartdata as $key => $value) {
     
            $measurementdata = $this->getMeasurementDataById($value['measurement_id']);
            $customdata = $this->getCustomizationDataById($value['customization_id']);
            $value['measurements'] = $measurementdata;
            $value['customdata'] = $customdata;
            array_push($productlist, $value);
        }
        $orderData['cartdata'] = $productlist;
        return $orderData;
    }

}

?>