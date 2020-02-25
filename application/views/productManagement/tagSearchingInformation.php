<?php
$this->load->view('layout/layoutTop'); 
?>
<div class="col-md-9">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title"style="font-size: 17px; font-weight: 500;">Add Product Tag In <?php  if($product_data) echo $product_data[0]['title']; ?></h4>
        </div>
        <div class="panel-body">
            <div class="col-md-3" style="padding: 0px;">
                <a href="#modal-alert" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Tag</a>
            </div>
            <div class="col-md-push-2 pull-right">
                <a class="btn btn-primary" href="<?php echo base_url('index.php/productHandler/product_list'); ?>"><i class="fa fa fa-backward"></i> Back</a>
            </div>
            <div class="col-md-12">
                <table class="table table-hover" style="margin-top: 25px;">
                    <tbody class="searchable" id="categoryInfo">
                        <?php
                        if ($category_data) {
                            foreach ($category_data as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $value['tag_title'] . '<a class="btn btn-danger btn-xs pull-right" id="' . $value['tag_conn_id'] . '" onclick="delete_information(this)"><i class="fa fa-trash-o"></i> </a></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3" style="margin: 0px 0px 0px 0px;">  
    <div class="searchTable panel panel-default">
        <div class="panel-heading"><i style="font-size: 10px">Search tag and click for select tag.</i>
            <h5 style="text-align:center"><i class="glyphicon glyphicon-search"></i> Search Tag Here</h5>
            <input class="filterTables form-control" placeholder="Type here..." style="width:100%" type="text">
        </div>
        <div class="searchTableContainer panel-body" style="overflow-y: auto;overflow-x: hidden;">
            <table class="table table-hover" style="margin:0;">
                <tbody class="searchable" id="allCategoryInfo">
                    <?php
                    $allTag = $this->Product_model->get_table_information('nfw_product_tag');
                    if ($allTag) {
                        foreach ($allTag as $key => $value) {
                            echo '<tr onclick="add_category_data(this)" id="' . $value['id'] . '">';
                            echo '<td>' . $value['tag_title'] . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- #modal-alert -->
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Tag</h4>
            </div>
            <div class="modal-body panel-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Title</label>
                        <div class="col-md-9">
                            <input type="text" name="category" class="form-control" placeholder="Add Title">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                <button id="submit" class="btn btn-sm btn-danger" data-dismiss="modal">Add Tag</button>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('layout/layoutBottom');
?>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
    });

    $('#submit').click(function () {
        var category = $('input[name=category]').val();
        var product_id = $('input[name=product_id]').val();
        $.ajax({
            url: '<?php echo base_url() . 'index.php/ProductHandler/ajax_menu_category_information'; ?>',
            data: {'id': product_id, 'category': category, 'tag_id': '0'},
            dataType: 'json',
            type: 'GET',
            success: function (data) {
                console.log(data['category_data']);
                var jsonCategoryData = data['category_data'];
                var htmls = '';
                for (i in jsonCategoryData) {
                    htmls += '<tr>';
                    htmls += '<td>' + jsonCategoryData[i]['tag_title'] + '<a class="btn btn-danger btn-xs pull-right" id="' + jsonCategoryData[i]['tag_conn_id'] + '" onclick="delete_information(this)"><i class="fa fa-trash-o"></i> </a></td>';//tag_conn_id
                    htmls += '</tr>';
                }
                $('#categoryInfo').html(htmls);
                console.log(data['all_category_data']);
                var all_cat_json = data['all_category_data'];
                var htmls_c = '';

                for (i in all_cat_json) {
                    htmls_c += '<tr  onclick="add_category_data(this)" id="' + all_cat_json[i]['id'] + '">';
                    htmls_c += '<td>' + all_cat_json[i]['tag_title'] + '<a class="btn btn-danger btn-xs pull-right" id="' + all_cat_json[i]['tag_conn_id'] + '" onclick="delete_information(this)"><i class="fa fa-trash-o"></i> </a></td>';
                    htmls_c += '</tr>';
                }

                $('#allCategoryInfo').html(htmls_c);
            }
        });
    });
    function add_category_data(obj) {

        if (confirm("Are you sure?")) {
            var categoryData = [];
            $('#categoryInfo tr').each(function () {
                var val = $(this).text();
                var val1 = jQuery.trim(val);
                categoryData.push(val1);
            });
            var tag_id = obj.id;
            var addText = $('#' + tag_id).text();
            console.log(categoryData, tag_id, addText);
            if (jQuery.inArray(addText, categoryData) != -1) {
                alert('Your tag is already in product');
            } else {
                var product_id = <?php echo $product_id; ?>;
                $.ajax({
                    url: '<?php echo base_url() . 'index.php/ProductHandler/ajax_menu_category_information'; ?>',
                    data: {'id': product_id, 'tag_id': tag_id},
                    dataType: 'json', type: 'GET',
                    success: function (data) {
                        var jsonCategoryData = data['category_data'];
                        var htmls = '';
                        for (i in jsonCategoryData) {
                            console.log(jsonCategoryData[i]);
                            htmls += '<tr>';
                            htmls += '<td>' + jsonCategoryData[i]['tag_title'] + '<a class="btn btn-danger btn-xs pull-right" id="' + jsonCategoryData[i]['tag_conn_id'] + '" onclick="delete_information(this)"><i class="fa fa-trash-o"></i> </a></td>';
                            htmls += '</tr>';
                        }
                        $('#categoryInfo').html(htmls);
                    }
                });
            }

        }
    }
    function delete_information(obj) {
        var id = obj.id;
        $.ajax({
            url: '<?php echo base_url() . 'index.php/ProductHandler/delete_data_ajax'; ?>',
            data: {'id': id, 'table_name': 'nfw_product_tag_connection'},
            type: 'GET',
            success: function (data) {
                window.location.reload();
            }
        });
    }
</script>
<?php
$this->load->view('layout/layoutFooter');
?>