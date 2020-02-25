<?php
error_reporting(0);
$this->load->view('layout/layoutTop');
$data11 = json_encode($edit_data);

$stock_data = $this->Product_model->current_stock_information($update_info['product_id']);
$stockData = json_encode($stock_data);
$imageId = $this->Product_model->get_last_id('nfw_product_images');
$tagConnData = json_encode($tag_conn_data);
//print_r($fabric_list);
?>
<?php
$database = $this->session->userdata('database');
$conn = \mysql_connect($database['host_name'], $database['user_name'], $database['password']);
mysql_select_db($database['database'], $conn);
$main_caegory = $this->Product_model->get_parent($category[0]['id']);
$mainParent_list = explode(", ", trim($main_caegory[1], ", "));
$GLOBALS['parent_array'][] = $category[0]['name'];
if (count($mainParent_list)) {
    if ($update_info['parent_category']) {
        
    } else {
        $product_id = $update_info['product_id'];
        $operation = $update_info['operation'];
        $category = $update_info['category'];
        $parent_category = $mainParent_list[0];

        $url = base_url() . 'index.php/ProductHandler/add_product_information/' . $product_id . '/' . $operation . '/' . $category . '/' . $parent_category;

        redirect($url);
    }
}
//echo $update_info['product_id']
?>
<link href="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />
<style>
    .your_image{
        width: 100%;
        margin-bottom: -11px;
    }

    .delete_image span{
        background-color: #F00;
        color: #fff;
        cursor: pointer;
        margin-top: -15px!important;
        position: absolute;
        line-height: 16px;
        font-size: 18px;
        margin-left: 184px;
        padding-left: 1px;

    }
    .userimageclass{
        width: 100px;
        height: 100px;
        margin: 5px;
    }
    .product_selection .col-md-12{
        border-bottom: 1px solid #D0D0D0;
        padding-bottom: 13px!important;
    }

    .product_selection .control-label{
        font-size: 17px;
    }

</style>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">

        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="<?php
                if ($update_info['category']) {
                    echo base_url('index.php/ProductHandler/product_list');
                } else {
                    echo base_url('index.php/ProductHandler/add_product');
                }
                ?>" style="width: 70%;margin-right: 30px;" class="btn btn-sm btn-icon btn-primary"><i class="fa fa-backward"></i>  Back</a>
            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><?php if ($update_info['operation'] == 'new') { ?>Product Will Add In <span style="font-weight: 700;color: #27EF9D;"> <?php echo implode('->', $GLOBALS['parent_array']); ?> </span> Category<?php } else { ?>Edit Product Information: <?php } ?><span id="productName" style="font-weight: 700;color: #27EF9D;"></span></h4>
        </div>

        <div class="panel-body">

            <div class="col-md-9 product_selection" style="padding: 0px;">

                <div class="col-md-12"  style="padding: 0px;">
                    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-12"  style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Category</label>
                                <div class="col-md-9">
                                    <span class="product_category"> 
                                        <?php
                                        $main_caegory = $this->Product_model->get_parent($update_info['category']);
                                        echo $category_string =  str_replace(", ", " => ", trim($main_caegory[0], ", "));
                                        ?></span>
                                    <input type="hidden" name ="product_category" class="form-control" placeholder="Product Category." required>
                                    <input type="hidden" name ="product_category_string1" class="form-control" placeholder="Product Category." value="<?php echo $category_string?>" >
                                    <?php
                                    if ($update_info['operation'] == 'edit') {
                                        echo '<button id="change_category" type = "button" class = "btn btn-primary btn-xs pull-right" data-toggle = "modal" data-target = ".category_model">Change Category</button>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12"  style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Item Code</label>
                                <div class="col-md-9">
                                    <input type="text" name ="title" class="form-control" placeholder="Item Code" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"  style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Item Feature</label>
                                <div class="col-md-9">
                                    <input type="text" name ="product_speciality" class="form-control" placeholder="Item Feature"  required>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">SKU</label>
                                <div class="col-md-9">
                                    <input type="text" name="sku" class="form-control" placeholder="SKU" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Fabric Type</label>
                                <div class="col-md-9">
                                    <select name="fabric_title" class="form-control">    
                                        <?php
                                        for ($f = 0; $f < count($fabric_list); $f++) {
                                            $data1 = $fabric_list[$f];
                                            ?>
                                            <option value="<?php echo $data1['id'] ?>"><?php echo $data1['title']; ?></option>
                                        <?php } ?>                     
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Short Description</label>
                                <div class="col-md-9">
                                    <textarea name ="short_description" class="form-control" placeholder="Short Description" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Long Description</label>
                                <div class="col-md-9">
                                    <textarea name ="description" class="textarea form-control ckeditor" id="editor1" placeholder="Long Description" rows="12"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Color</label>
                                <div class="col-md-9" >
                                    <div class="col-md-12" style="border: 1px solid #E0E1E0;">   
                                        <lable>Selected Colors  (For sorting please use drag and drop method)</lable>
                                        <div class="row selected_colors"></div>
                                    </div>
                                    <div class="col-md-12" style="border: 1px solid #E0E1E0;">    

                                        <div class="row precolor">
                                            <?php
                                            $colorData = $this->Product_model->get_table_information('nfw_color');
                                            for ($i = 0; $i < count($colorData); $i++) {
                                                $data5 = $colorData[$i];
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="checkbox" style="background: <?php echo $data5['color_code'] ?>;border: 1px solid #D8C8C8;padding: 10px;">
                                                        <label style="padding-left: 23px;
                                                               padding-right: 10px;
                                                               background: #fff;
                                                               line-height: 20px;">
                                                            <input type="checkbox" value="<?php echo $data5['id'] ?>" name="color_id[]" />
                                                            <?php echo $data5['title'] ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12" style="padding: 0px;margin-top: 15px;">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Customizable Items</label>
                                <div class="col-md-9">
                                    <div class="col-md-12" style="border: 1px solid #E0E1E0;">
                                        <?php
                                        if ($tagData) {
                                            $count = 1;
                                            echo '<table style="width:100%;" class="table table-striped table-bordered dataTable no-footer">';
                                            echo '<tr><th style="width:10%;"></th><th style="width:50%;"></th><th style="width:20%;">Regular Price </th><th style="width:20%;">Sale Price </th></tr>';
                                            foreach ($tagData as $key => $value) {
                                                echo '<tr>';
                                                echo '<td ><input type="checkbox" name="custom_check[]" value="' . $value['id'] . '" id="check_' . $value['id'] . '"></td>';
                                                echo '<td >' . $value['tag_title'] . '</td>';
                                                echo '<td ><input type="text" class="is_number" name ="price_' . $value['id'] . '"></td>';
                                                echo '<td ><input type="text" class="is_number" name ="sale_price_' . $value['id'] . '"></td>';
                                                echo '</tr>';
                                            }
                                            echo '</table>';
                                        } else {
                                            echo "No item tagged with this category. <a href='" . base_url() . "index.php/ProductHandler/category_tag_connection'>Add Category Tag</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <input type="hidden" name="opt_date" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <!--                           
                            <div class="col-md-12" style="padding: 0px;margin-top: 15px;">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Stock Availability</label>
                                                                <div class="col-md-9">
                                                                    <select class="form-control" name="stock_status">
                                                                        <option>Yes</option>
                                                                        <option>No</option>
                                                                    </select>    
                                                                </div>
                                                            </div>
                                                        </div>-->

                        </div>

                        <div class="col-md-12 well well-sm" style="margin-top: 15px;">
                            <style>
                                ul.tagit li.tagit-choice-editable {
                                    background: #000000!important;}
                                .tagit .ui-icon-close {
                                    background: 0 0!important;
                                    height: 22px!important;
                                    width: 16px!important;
                                    text-indent: 0!important;
                                    color: #fff;
                                    border-left: 1px solid #3A3A3A;
                                }
                                .tagit .ui-icon-close:hover {
                                    background: 0 0!important;
                                    height: 22px!important;
                                    width: 16px!important;
                                    text-indent: 0!important;
                                    color: #fff;
                                    border-left: 1px solid #3A3A3A;
                                }
                            </style>
                            <div class="col-md-12">
                                <label class="control-label">Searching Tag</label>
                                <input name="searching_tag" id="searchingtag" value="<?php echo $pre_search_tag; ?>">

                                <p>Try to enter "Platinum Solid, Solid Red" </p>
                            </div>

                        </div>

                        <div class="col-md-12 well well-sm" style="margin-top: 15px;">
                            <button type="submit"  name ="addProduct" id="addProduct" class="btn btn-lg btn-success" style="display: blobk">
                                <i class="fa fa-save"></i>  Submit
                            </button>

                        </div>

                        <div class="imageclass" style="display:none"></div> 
                    </form>

                    <div class="col-md-12" style="margin-top: 15px;">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Add Images For Product. (1st Image will be primary image, you can arrange image sequence by drag and drop.)
                                <button tyle="button" onclick="addNew()" class="pull-right btn btn-warning btn-xs">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-3 fileUploadDiv animated template_image" style="display:none">
                                        <div class="thumbnail">
                                            <div class="delete_image" style="display: none;">
                                                <span class="circle icon_wrap_size_1 d_inline_m m_right_8">x</span>
                                            </div>
                                            <img class="vfileTag" src="" alt="Choose a file from your device and upload it." style="height: 200px;">
                                            <i class="votherFile fa fa-file" style="font-size: 184px;margin: 8px;display:none"></i>
                                            <form class="vuploadFile" action="" method="post" enctype="multipart/form-data">
                                                <div style="width:100%;height: 7px">
                                                    <div class='vdisplayprogress vprogress-bar' style="width:0%;height:5px;background:red;margin-bottom: 5px"></div>
                                                </div>
                                                <center><input type="file" name="file"  required class="vfilestyle vfile" style="width: 100%"></center>
                                                <input type='hidden' name='image_name' value='<?php
                                                echo ($category[0]['id']), ($imageId[0]['id']);
                                                ?>'>
                                                <input type="hidden" name="file_name">
                                                <button type="submit" value="Upload" class="submit form-control btn btn-primary vuploadButton" value="upload" style="  margin-top: 12px;">
                                                    <i class="fa fa-upload vuploadIcon"></i> 
                                                    <span class="vuploadText">Upload</span>
                                                </button>

                                            </form>
                                        </div>
                                    </div>



                                    <div class="row vfileContainer" style="padding: 10px;">
                                        <?php
                                        if ($getImageData) {

                                            foreach ($getImageData as $key => $value) {
                                                ?>
                                                <div class="col-sm-3 fileUploadDiv animated">

                                                    <div class="thumbnail">
                                                        <div class="delete_image" style="display: none;" image_delete ="<?php
                                                        echo ($category[0]['id']), ($imageId[0]['id']);
                                                        ?> ">
                                                            <span class="circle icon_wrap_size_1 d_inline_m m_right_8">x</span>
                                                        </div>
                                                        <img class="vfileTag" src="<?php echo image_server; ?>/nfw/small/<?php echo $value['image']; ?>" alt="Choose a file from your device and upload it." style="height: 200px;">
                                                        <i class="votherFile fa fa-file" style="font-size: 184px;margin: 8px;display:none"></i>

                                                        <form class="vuploadFile" action="" method="post" enctype="multipart/form-data">

                                                            <div style="width:100%;height: 7px">
                                                                <div class='vdisplayprogress vprogress-bar' style="width:0%;height:5px;background:red;margin-bottom: 5px"></div>
                                                            </div>
                                                            <center><input type="file" name="file"  required class="vfilestyle vfile" style="width: 100%"></center>
                                                            <input type='hidden' name='image_name' value='<?php
                                                            echo $imgname = explode(".", $value['image'])[0];
                                                            //echo date('YmdHis');
                                                            ?>'>
                                                            <input type="hidden" name="file_name" value="<?php echo $value['image']; ?>">
                                                            <button type="submit" value="Upload" class="submit form-control btn vuploadButton btn-success" style="  margin-top: 12px;">
                                                                <i class="fa vuploadIcon fa-check-circle"></i> 
                                                                <span class="vuploadText">Change File</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>




                                        <!--starting of file updaders-->

                                        <!--                                        <div class="col-sm-3 fileUploadDiv animated">
                                        
                                                                                    <div class="thumbnail">
                                                                                        <div class="delete_image "  style="display: none;">
                                                                                            <span class="circle icon_wrap_size_1 d_inline_m m_right_8">x</span>
                                                                                        </div>
                                                                                        <img class="vfileTag" src="" alt="Choose a file from your device and upload it." style="height: 200px;">
                                                                                        <i class="votherFile fa fa-file" style="font-size: 184px;margin: 8px;display:none"></i>
                                        
                                                                                        <form class="vuploadFile" action="" method="post" enctype="multipart/form-data">
                                        
                                                                                            <div style="width:100%;height: 7px">
                                                                                                <div class='vdisplayprogress vprogress-bar' style="width:0%;height:5px;background:red;margin-bottom: 5px"></div>
                                                                                            </div>
                                                                                            <center><input type="file" name="file"  required class="vfilestyle vfile" style="width: 100%"></center>
                                                                                            <input type='hidden' name='image_name' value='<?php
                                        echo ($category[0]['id']), ($imageId[0]['id']);
//echo date('YmdHis');
                                        ?>'>
                                        
                                                                                            <input type="hidden" name="file_name">
                                        
                                                                                            <button type="submit" value="Upload" class="submit form-control btn btn-primary vuploadButton" value="upload" style="  margin-top: 12px;">
                                                                                                <i class="fa fa-upload vuploadIcon"></i> 
                                                                                                <span class="vuploadText">Upload</span>
                                                                                            </button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>-->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                    <style>
                        .your_image{
                            width: 100%;
                            margin-bottom: -11px;
                        }

                        .delete_image span{
                            background-color: #F00;
                            color: #fff;
                            cursor: pointer;
                            margin-top: -15px!important;
                            position: absolute;
                            line-height: 16px;
                            font-size: 18px;
                            margin-left: -19px;
                            padding-left: 5px;
                            border-radius: 16px;
                            height: 20px;
                            width: 20px;

                        }
                        .userimageclass{
                            width: 100px;
                            height: 100px;
                            margin: 5px;
                        }

                    </style>

                    <div style="clear:both"></div>



                </div>

            </div>

            <div class="col-md-3">
                <?php
                if ($update_info['operation'] == 'edit') {
                    ?>
                                                                                                                                                                                                                                                              <!--'<a style="width: 65%;margin-top: 6px;" class="btn btn-danger btn-sm m-r-5"  href="' . base_url() . 'index.php/ProductHandler/product_list/' . $update_info['product_id'] . '"><i class="fa fa-trash-o"></i> Delete</a>';-->
                    <?php
                    echo '<a style="margin:10px 0px;" class="btn btn-primary   m-r-5" href="' . base_url() . 'index.php/ProductHandler/relatedProduct/' . $update_info['product_id'] . '/' . $update_info['category'] . '"><i class="fa fa-chain"></i> Related Products</a>';
                    ?>
                    <div class="" role="group" aria-label="" style="text-align:left;width: 100%">

                        <?php
                        echo 'Currently: <b>', $edit_data[0]['publishing'] == 1 ? 'Published' : 'Unpublished', "</b>";

                        if ($edit_data[0]['publishing'] == '1') {
                            ?>


                            <a class="btn btn-danger" onclick="return confirm_alert(this);" href="<?php echo base_url() . 'index.php/ProductHandler/product_publishing/' . $update_info['product_id'] . '/' . '0' . '/' . $update_info['rdcategory']; ?>">
                                <i class="fa fa-ban "></i> Unpublished Now
                            </a>

                            <?php
                        } else {
                            ?>
                            <a class="btn btn-success" onclick="return confirm_alert(this);" href="<?php echo base_url() . 'index.php/ProductHandler/product_publishing/' . $update_info['product_id'] . '/' . '1' . '/' . $update_info['rdcategory']; ?>">
                                <i class="fa fa-send "></i> Published Now
                            </a>

                            <?php
                        }
//                        echo '<a style="" class="btn btn-success btn-sm m-r-5" href="' . base_url() . 'index.php/ProductHandler/relatedProduct/' . $update_info['product_id'] . '/' . $update_info['category'] . '"><i class="fa fa-edit"></i> Related Product</a>';
//                        
                        ?>
                        <?php
//                        echo '<a style="" class="btn btn-danger btn-sm m-r-5" href="' . base_url() . 'index.php/ProductHandler/relatedProduct/' . $update_info['product_id'] . '/' . $update_info['category'] . '"><i class="fa fa-edit"></i> Related Product</a>';
//                        
                        ?>
                    </div>




                    <br>

                    <div class="panel panel-info col-md-12 " style="    padding: 0px;margin-top: 12px;border:1px solid">
                        <div class="panel-heading">
                            <h4 class="panel-title">Add More Categories</h4>
                        </div>
                        <div class="panel-body">
                            <ul style="    padding: 5px 0px 0px 5px;">
                                <?php
                                foreach ($update_info['sub_category'] as $key => $value) {
                                    $cid = $value['category_id'];

                                    $main_caegory = $this->Product_model->get_parent($cid);
                                    echo "<li>", str_replace(", ", " => ", trim($main_caegory[0], ", ")), "";
                                    ?>
                                    <form method="post">
                                        <input type="hidden" name="new_cat_id" value="<?php echo $cid; ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $update_info['product_id'] ?>">
                                     
                                        &nbsp;&nbsp;&nbsp;<button type="submit" name="removesubcat" class='fa fa-remove btn btn-danger btn-xs pull-right'></button></li><hr>
                                    </form>
                                    <?php
                                }
                                ?>
                            </ul>

                            <button id="sub_category" type = "button" class = "btn btn-primary btn-xs " data-toggle = "modal" data-target = ".category_model" style="margin-top:10px;width:100%">Add New Category</button>    
                            <div class="add_sub_category">No Category Selected </div>
                            <form method="post">
                                <input type="hidden" name="new_cat_id" value="">
                                <input type="hidden" name="product_id" value="<?php echo $update_info['product_id'] ?>">
                                <button type="submit" name="addnewcat" class="btn btn-primary btn-xs" style="width:100%">Add Now</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>

<!--category editor-->
<div class="modal fade category_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: black">
                    <input id="category_type" type="hidden">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="    color: white;
                            font-weight: bold;
                            opacity: 2;"><span aria-hidden="true">&times;</span></button>
                    <p class="panel-title" style="color:white;font-size: 18px">Update Category</p>
                </div>
                <div class="panel-body" style=" height:550px;overflow: scroll;">
                    <style>
                        #continue {margin:0px 0;}
                        #continue a {margin:10px 0;}
                        .selectItem{
                            cursor: pointer;
                        }

                        .selectItem:hover{
                            background: #ccc;
                        }

                        .categoryDiv li{
                            cursor: pointer;
                            color: #000;
                            list-style: none;
                            padding: 5px;
                            margin: 2px;
                        }
                        .categoryDiv li a{
                            font-size: 15px;
                            color: blue;
                        }
                        hr{
                            border: 0;
                            border-top: 1px solid #ccc; 
                            width: 93%;
                            margin: 10px 0 10px 0;
                        }

                    </style>

                    <div class="" data-sortable-id="tree-view-1">


                        <div id="jstree-default" style="font-size: 17px;">

                            <?php

                            function parent_get($table, $column, $id) {
                                echo "<ul class='jstree-container-ul jstree-children main_ul'>";
                                $query = mysql_query("select * from $table where $column=$id order by index_menu");
                                while ($row = mysql_fetch_array($query)) {
                                    ?>    
                                    <li data-jstree='{"opened":true}' id="sortable-<?php echo $row['id']; ?>" >
                                        <?php
                                        // echo $row['name'];
                                        $cat[$row['id']] = child($table, $column, $row['id']);
                                        if (count($cat[$row['id']]) > 0) {
                                            echo $row['name'];
                                        } else {

                                            echo "<span class='product_add' id ='" . $row['id'] . "'<i class='fa fa-plus-circle'></i></a></span>";
                                        }
                                        echo "</li>";
                                    }
                                    echo "<ul>";
                                    return $cat;
                                }

                                function child($table, $column, $id) {
                                    echo "<ul id='main_ul'>";
                                    $query = mysql_query("select * from $table where $column=$id order by index_menu");
                                    $cat = array();
                                    while ($row = mysql_fetch_array($query)) {
                                        ?>
                                    <li data-jstree='{"opened":true}' id="sortable-<?php echo $row['id']; ?>" > 
                                        <?php
                                        $tt = child($table, $column, $row['id']);

                                        if (count($tt) > 0) {
                                            echo $row['name'];
                                        } else {

                                            echo "<span>" . $row['name'] . "&nbsp" . "<span class='product_add' id ='" . $row['id'] . "' ><i class='fa fa-plus-circle'></i></a></span></span>";
                                            //echo "<i class='fa fa-plus-circle'></i></a></span>";
                                        }
                                        $cat[$row['id']] = $tt;


                                        echo "</li>";
                                    }
                                    echo "</ul>";
                                    return $cat;
                                }

                                $cat = parent_get('nfw_category', 'parent', '0');
                                ?>
                        </div>

                    </div>


                    <!-- end col-6 -->


                </div>
            </div>
        </div>
    </div>
</div>
<!--end of category editor-->


<?php
$this->load->view('layout/layoutBottom');
?>
<script type="text/javascript">
    var list = [];
    function set_image_file(list, imageName) {
        //   $('input[name=image_name_list]').val(list);
        $('#modal-alert').modal("hide");
        var imageId = +$('input[name=image_name]').val() + <?php echo end($imageId)['id']; ?>;
        //$('input[name=image_name]').val(imageId);
        var htmls = '';
        for (i in list) {
            // $('input[name=image_name_list[]]').val(list[i]);
            htmls += '<div class="col-sm-6 col-md-2">';
            htmls += '<input type="hidden" class="ajax_image" name="image_name_list[]" value="' + list[i] + '">';
            htmls += '<div class="thumbnail" style="height: 125px;">';
            htmls += '<img src="http://nf1.costcokart.com/nfw/small/' + list[i] + '" alt="..." style="height: 90px;width:140px">';
            htmls += '<div class="col-md-12 col-md-push-3" style="margin-top: 3px;">';
            htmls += '<button type="button" class="btn btn-danger btn-xs" listData = "' + list + '" id="ajax_image_' + i + '" onclick="delete_image_info(this)" value="' + list[i] + '"><i class="fa fa-trash"></i></button>';
            htmls += '</div>';
            htmls += '</div>';
            htmls += ' </div>';
        }
        $('#imageInfo').html(htmls);
    }
    function delete_image_info(obj) {
        var r = confirm("Do you want to delete!");
        if (r == true) {
            var id = $(obj).attr('id');
            var val1 = $(obj).val();
            list = $(obj).attr('listData');
            // list = ["172.jpeg", "173.jpeg", "174.jpeg"];
            list = list.split(',');
            list = jQuery.grep(list, function (value) {
                return value != val1;
            });
            console.log(list, 'check');
            $('#' + id).parents().eq(2).remove();
        } else {
        }
    }
    function delete_database_image(obj) {
        var id = $(obj).attr('id');
        var product_id = $(obj).attr('product_id');

        var r = confirm("Do you want to delete!");
        if (r == true) {
            $.ajax({
                url: "<?php echo base_url('index.php/ProductHandler/delete_product_image_ajax'); ?>", // Url to which the request is send
                type: "GET", // Type of request to be send, called as method
                data: {'id': id, 'product_id': product_id}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                // dataType : 'json'
                success: function (rdata)   // A function to be called if request succeeds
                {

                    var imageList = jQuery.parseJSON(rdata);
                    //  console.log(imageList);
                    var htmls = '';
                    for (i in imageList) {
                        htmls += '<div class="col-sm-6 col-md-2">';
                        htmls += '<div class="thumbnail" style="height: 125px;">';
                        htmls += '<img src="http://nf1.costcokart.com/nfw/small/' + imageList[i]['image'] + '" alt="..." style="height: 90px;width:140px">';
                        htmls += '<div class="col-md-12 col-md-push-3" style="margin-top: 3px;">';
                        htmls += '<button type="button" class="btn btn-danger btn-xs" onclick="delete_database_image(this)" product_id="' + imageList[i]['nfw_product_id'] + '" id="' + imageList[i]['id'] + '"><i class="fa fa-trash"></i></button>';
                        htmls += '</div>';
                        htmls += '</div>';
                        htmls += ' </div>';
                    }
                    $('#databaseImageDdata').html(htmls);
                }
            });
        } else {
        }
    }
</script>
<script>

    function set_image_gallery() {
        var fileName = $('#file').val();
        if (fileName) {
            var formData = new FormData($("#uploadimage")[0]);
            console.log(formData);
            $('#loading').removeAttr('class').addClass('fa fa-spinner');
            $.ajax({
                url: "http://costcointernational.com/imageUploadFunction.php", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (rdata)   // A function to be called if request succeeds
                {

                    $('#loading').removeAttr('class').addClass('fa fa-upload');
                    var imageName = jQuery.parseJSON(rdata);
                    console.log(imageName)
                    list.push(imageName);
                    console.log(list);
                    set_image_file(list, imageName);
                }
            });
        }
    }
</script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo base_url(); ?>assets_main/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/form-wysiwyg.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(function () {




        var jsonData = <?php echo $data11; ?>;
        // console.log(jsonData);
        if (jsonData[0]) {
            var title = jsonData[0]['title'];
            $('#productName').text(title);
        }
        for (key in jsonData[0]) {
            var value = jsonData[0][key];
            $('[name=' + key + ']').val(value);
            $('#addProduct').attr('name', 'update');
        }
        var jsonStock = <?php echo $stockData; ?>;
        if (jsonStock) {
            $('select[name=stock_status]').val(jsonStock[0]['stock_status']);
        }
        var tagJson = jQuery.parseJSON(<?php echo json_encode($tagConnData != 'null' ? $tagConnData : "[]"); ?>);



        for (var i = 0; i < tagJson.length; i++) {

            var tagId = tagJson[i]['tag_id'];
            var tagPrice = tagJson[i]['price'];
            var tagSalePrice = tagJson[i]['sale_price'];
            $('#check_' + tagId).attr('checked', 'checked');
            $('#check_' + tagId).parent().parent().find('td:nth-child(3) input').val(tagPrice);
            $('#check_' + tagId).parent().parent().find('td:nth-child(4) input').val(tagSalePrice);
        }


        //update product color

        var colorjson = jQuery.parseJSON('<?php echo json_encode($product_color ? $product_color : ''); ?>');
        console.log(colorjson);
        for (var i = 0; i < colorjson.length; i++) {
            var colorid = colorjson[i];
            var colorobj = $('input[name="color_id[]"][value=' + colorid['nfw_color_id'] + ']');
            colorobj[0].checked = true;
            $(".selected_colors").append(colorobj.parents(".col-md-4"));
        }

        //


    })
</script>
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        FormWysihtml5.init();
    });





</script>


<script type="text/javascript">
    function confirm_alert(node) {
        return confirm("Do you really want to do this action?");
    }
</script> 

<script src="<?php echo base_url(); ?>assets_main/plugins/jstree/dist/jstree.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/ui-tree.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jquery-tag-it/js/tag-it.min.js"></script>


<script>
    $(document).ready(function () {

        TreeView.init();
        $('.product_add').click(function () {
            $("input[name=product_category").val(this.id);
            //$("#addProduct").click();
        });

        $("#change_category").click(function () {
            $("#category_type").val("category");
        })


        $("#sub_category").click(function () {
            $("#category_type").val("subcategory");

        })


        $(document).on("click", ".jstree-node span", function () {
            var parents = [];
            var child_id = "";
            $(this).parents(".jstree-node").each(function (i) {
                parents.push($(this).find(".jstree-anchor:first").text());
                if (i == 0) {
                    child_id = $(this).find(".jstree-anchor:first")[0].id
                }
            })
            // console.log("<?php echo $product_id; ?>")
            var pid = (child_id.replace("sortable-", "").replace("_anchor", ""));
            //console.log(pid)
            var parents = parents.reverse().join(" -> ");
            var categorytype = $("#category_type").val();

            $("input[name='new_cat_id']").val(pid);
            $(".add_sub_category").text(parents);

            if (categorytype == "category") {
                $("input[name=product_category").val(pid);
                $(".product_category").text(parents);
            }
            else {
                $("input[name=product_sub_category").val(pid);
                $(".product_sub_category").text(parents);
            }
            $('.category_model').modal('hide')
        })


    });










</script>


<script>

    function imageList() {
        $(".imageclass").html("");
        $(".vfileContainer input[name='file_name']").each(function () {
            var imagename = this.value;
            var htmls = "<input name='image_name_list[]' value='" + imagename + "'>";
            $(".imageclass").append(htmls);
        })
    }
    imageList();


    function addNew() {
        var newDiv = $(".template_image").first().clone().show().removeClass(".template_image");
        $(newDiv).find(".delete_image").show()
        $(newDiv).find("input[name=image_name]").val(Number($("input[name=image_name]").val()) + <?php echo end($imageId)['id']; ?>);
        $(".vfileContainer").append(newDiv);
    }

    // 
    //
    var imageUploadCdn = "<?php echo image_server; ?>imageUploadFunction.php";
    var imagePrePath = "<?php echo image_server; ?>nfw/small/";


    function FileUploader() {
        this.init = function (parent) {
            this.parent = parent;
            this.vuploadFile = $(parent).find(".vuploadFile");
            this.vfileTag = $(parent).find(".vfileTag");
            this.votherFile = $(parent).find(".votherFile");
            this.vfile = $(parent).find(".vfile");
            this.vuploadFile = $(parent).find(".vuploadFile");
            this.vuploadButton = $(parent).find(".vuploadButton");
            this.vuploadText = $(parent).find(".vuploadText");
            this.vuploadIcon = $(parent).find(".vuploadIcon");
            this.vprogress_bar = $(parent).find(".vprogress-bar");
            this.filename = $(parent).find("input[name='file_name']");
            this.vdisplayprogress = $(parent).find(".vdisplayprogress");
            this.chooseButton = $(parent).find(".group-span-filestyle");
        }
        this.uploaded = function () {
        };
        this.uploading = function () {
        };
        this.uploader = function (obj) {



            $(this.vdisplayprogress).show(100);
            // $(this.vfile).hide();
            $(this.vuploadButton).attr("disabled", "true");
            $(this.vuploadText).text("Uploading")
            $(this.vuploadIcon).removeClass("fa-upload").addClass("fa-spinner fa-pulse");
            var thisobj = this;
            var formData = new FormData(obj);

            var request = $.ajax({
                xhr: function () {
                    $(thisobj).trigger('uploading', thisobj.uploading);
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total * 100;
                            $(thisobj.vprogress_bar).stop().animate({width: "" + percentComplete + "%"}, 100);
                        } else {
                            console.log("lengthComputable evaluated to false;")
                        }
                    }, false);
                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total * 100;
                        }
                        else {

                        }
                    }, false);
                    return xhr;
                },
                url: imageUploadCdn, // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (rdata)   // A function to be called if request succeeds
                {
                    console.log(formData);
                    console.log(rdata);
                    var imageName = jQuery.parseJSON(rdata);
                    var originalImage = imagePrePath + imageName;
                    console.log(imageName);
                    $(thisobj.filename).val(imageName);

                    $("#imagedata").val($("#imagedata").val() + "," + imageName);
                    $(thisobj.vdisplayprogress).hide();
                    $(thisobj).parents("form").first().find("input[name='image_name']").val(imageName);
                    $(thisobj.vuploadButton).attr("disabled", false);
                    $(thisobj.vuploadText).text("Change File");
                    $(thisobj.vuploadIcon).removeClass("fa-spinner fa-pulse").addClass("fa-check-circle");
                    $(thisobj.vprogress_bar).stop().animate({width: "0%"}, 100);
                    $(thisobj.vuploadButton).removeClass("btn-primary").addClass("btn-success");
                    $(thisobj.vuploadButton).attr("disabled", false);
                    $(thisobj).trigger('uploaded', thisobj.uploaded);
                    //$(thisobj.chooseButton).hide();
                    imageList()


                },
            });
        }

    }

    function check_extension(obj) {
        filename = obj.value;
        parent = $(".fileUploadDiv").last();
        //var newClone = $(parent).clone().hide();
        //$(".vfileContainer").append(newClone);
        var hash = {
            '.jpg': 1,
            '.jpeg': 1,
            '.png': 1, '.gif': 1, };
        var re = /\..+$/;
        var vfileTag = $(parent).find(".vfileTag");
        var votherFile = $(parent).find(".votherFile");
        var ext = filename.match(re);
        if (hash[ext[0]]) {
            $(vfileTag).show();
            $(votherFile).hide();
        } else {
            $(vfileTag).hide();
            $(votherFile).show();
        }
    }


    $(document).ready(function (e) {



        $(document).on('submit', "form.vuploadFile", (function (e) {
            var fileObj = new FileUploader();
            e.preventDefault();
            var parent = $(this).parents(".fileUploadDiv").last();
            fileObj.init(parent);
            console.log(this);
            fileObj.uploader(this);
            $(fileObj).on('uploaded', function () {
                $(".fileUploadDiv").last().show();
            });
            $(fileObj).on('uploading', function () {

            });
        }));


        $(document).on('change', "input[type=file]", function () {
            check_extension(this);
            var fileObj = new FileUploader();
            var parent = $(this).parents(".fileUploadDiv").last();
            fileObj.init(parent);
            $(fileObj.vuploadButton).attr("disabled", false);
            function imageIsLoaded(e) {
                $(fileObj.vfileTag).attr('src', e.target.result);
            }
            if (this.files) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[this.files.length - 1]);
            }
        })


        $(".vfileContainer .delete_image").each(function (i) {

            $(this).show();

        })

        $(document).on("click", ".delete_image", function () {


            var obj = $(this).parents(".fileUploadDiv").first()[0];
            $(obj).hide(100, function () {
                $(obj).remove();
                imageList();
            })

        })

        $(".vfileContainer").sortable({stop: function (event, ui) {

                imageList();
            }});


<?php
$searchData = $this->Product_model->get_table_information('nfw_product_search_tag');
$searchtag = "";
foreach ($searchData as $value) {
    $tagtitle = $value['tag_title'];
    $searchtag .= "'$tagtitle',";
}
?>
        $(".precolor").sortable();
        $(".selected_colors").sortable();
        $('#searchingtag').tagit({
            availableTags: [<?php echo $searchtag; ?>],
            allowSpaces: true

        });

    });
</script>

<?php
$this->load->view('layout/layoutFooter');
?>