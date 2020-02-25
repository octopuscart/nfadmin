<?php
$this->load->view('layout/layoutTop');
?> 
<div class="col-md-12" style="margin-top: 12px;">
    <div class="panel panel-inverse" data-sortable-id="tree-view-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;">Add Menu Structure</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-8">
                <form method="post">
                    <div id="jstree-default" style="font-size: 17px;">

                        <?php   
                       $database = $this->session->userdata('database');
                            $conn = mysql_connect($database['host_name'], $database['user_name'], $database['password']);
                            mysql_select_db($database['database'], $conn);


                        function parent_get($table, $column, $id) {
                            echo "<ul>";
                            $query = mysql_query("select * from $table where $column=$id order by menu_index");
                            while ($row = mysql_fetch_array($query)) {
                                ?>    
                                <li data-jstree='{"opened":true}'  id="sortable-<?php echo $row['id']; ?>" >
                                    <?php
                                    echo "<span class='product_add'>" . $row['name'] . "&nbsp";
                                    echo "<a href='#modal-alert'data-toggle='modal' style='margin: 5px;' class='btn btn-info btn-icon btn-circle btn-xs' onclick='product_menu_info(this)' id='" . $row['id'] . "'><i class='fa fa-plus'></i></a>"
                                    . "<a class='delete_menu btn btn-danger btn-icon btn-circle btn-xs' value='" . $row['id'] . "'><i class ='fa fa-times'></i></a><a style='margin-left : 5px;' class='btn btn-warning btn-icon btn-circle btn-xs' onclick='updateMenuInfo(this)' parent='" . $row['parent'] . "' value='" . $row['id'] . "' url='" . $row['menu_page'] . "' index='" . $row['menu_index'] . "'><i class ='fa fa fa-edit'></i></a></span>";
                                    $cat[$row['id']] = child($table, $column, $row['id']);

                                    echo "</li>";
                                }
                                echo "<ul>";
                                return $cat;
                            }

                            function child($table, $column, $id) {
                                echo "<ul>";
                                $query = mysql_query("select * from $table where $column=$id order by menu_index");
                                $cat = array();
                                while ($row = mysql_fetch_array($query)) {
                                    ?>
                                <li data-jstree='{"opened":true}'  id="sortable-<?php echo $row['id']; ?>">
                                    <?php
                                    $tt = child($table, $column, $row['id']);

                                    if (count($tt) > 0) {

                                        echo "<span class='product_add'>" . $row['name'] . "&nbsp";

                                        echo "<a href='#modal-alert'data-toggle='modal' class='btn btn-info btn-icon btn-circle btn-xs' onclick='product_menu_info(this)' id='" . $row['id'] . "'><i class='fa fa-plus'></i></a> <a style='margin-right: 4px;' class='delete_menu btn btn-danger btn-icon btn-circle btn-xs' value='" . $row['id'] . "'><i class ='fa fa-times'></i></a>"
                                        . " <a style='margin-left : 5px;' class='btn btn-warning btn-icon btn-circle btn-xs' onclick='updateMenuInfo(this)' parent='" . $row['parent'] . "' value='" . $row['id'] . "' url='" . $row['menu_page'] . "'  index='" . $row['menu_index'] . "'><i class ='fa fa fa-edit'></i></a></span>";
                                    } else {

                                        echo "<span class='product_add'>" . $row['name'] . "&nbsp";

                                        echo "<a href='#modal-alert'data-toggle='modal' class='btn btn-info btn-icon btn-circle btn-xs' onclick='product_menu_info(this)' id='" . $row['id'] . "'><i class='fa fa-plus'></i></a> <a  class='delete_menu btn btn-danger btn-icon btn-circle btn-xs' value='" . $row['id'] . "'><i class ='fa fa-times'></i></a> "
                                        . " <a  class='btn btn-warning btn-icon btn-circle btn-xs' onclick='updateMenuInfo(this)' parent='" . $row['parent'] . "' value='" . $row['id'] . "' url='" . $row['menu_page'] . "'  index='" . $row['menu_index'] . "'><i class ='fa fa fa-edit'></i></a></span>";
                                    }
                                    $cat[$row['id']] = $tt;


                                    echo "</li>";
                                }
                                echo "</ul>";
                                return $cat;
                            }

                            $cat = parent_get('nfw_menu', 'parent', '0');
                            ?>

                    </div>
                </form>
            </div>
            <div class="col-md-4" style ="  
    background-border: 6px;
    margin-top: 25px;
    background-color: aliceblue;
    padding-bottom: 33px;
    padding-top: 15px;
    box-shadow: ghostwhite;
">
                <p style = "font-weight: 500;font-size: 16px;"> Add Main Menu From Here</p>
                <form class="form-horizontal" method="post" style =" padding-top: 12px;">
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <div class="col-md-3">
                                <label class="control-label">Title</label>

                            </div>
                            <div class="col-md-9">
                                <input type="text" name ="name" class="form-control" placeholder="Title">
                                <input type="hidden" name ="parent"  value ="0"class="form-control" placeholder="Category">
                                <input type="hidden" name="update_id">
                            </div>                      
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <div class="col-md-3">
                                <label class="control-label">Url</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name ="menu_page" class="form-control" placeholder="Page Url">
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12 col-md-push-6">
                        <button type="submit" name ="submit" id="addProduct" class="btn btn-sm btn-success" style = "margin-left: 55px;">Submit</button>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!---=========Model open===============---->
<!-- #modal-alert -->
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Sub Menu From Here</h4>
            </div>
            <div class="modal-body panel-body">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sub Menu</label>
                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" placeholder="Sub Menu">
                            <input type="hidden" name="parent">
                        </div>
                    </div>
                </div> 
                <!---================1======----->


                <div class="col-md-12" style="margin-top: 11px;">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Page Url</label>
                        <div class="col-md-9">
                            <input type="text" name="menu_page1" class="form-control" placeholder="Page Url">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                <button id="submit" class="btn btn-sm btn-info" data-dismiss="modal"><i class="fa fa-upload"></i>&nbsp;&nbsp;Add Menu</button>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->  
<!--=========Model close===============---->
<?php
$this->load->view('layout/layoutBottom');
?> 
<script src="<?php echo base_url(); ?>assets_main/plugins/jstree/dist/jstree.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/ui-tree.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        TreeView.init();
        $('.delete_menu').click(function () {
            var r = confirm("Do you want to delete!");
            if (r == true) {
                var delete_id = $(this).attr('value');
                window.location.href = '<?php echo base_url(); ?>index.php/productHandler/product_menu_information/' + delete_id + '/delete';
            }
        })
    });
</script> 
<script>
    function product_menu_info(obj) {
        var id = obj.id;
        $('input[name=parent]').val(id);
    }

    $('#submit').click(function () {
        var title = $('input[name=title]').val();
        var parent = $('input[name=parent]').val();
        var page = $('input[name=menu_page1]').val();

        $.ajax({
            url: '<?php echo base_url() . 'index.php/ProductHandler/ajax_sub_category_information'; ?>', 
            data: {'title': title, 'parent': parent, 'page': page},
            //  dataType: 'json',
            type: 'GET',
            success: function (data) {
                console.log(data);
                window.location.reload();
            }
        });
    });
    function  updateMenuInfo(obj) {
        var id = $(obj).attr('value');
        var r = confirm("Do you want to Edit!");
        if (r == true) {
            var title = $(obj).parent().text();
            var url = $(obj).attr('url');

            var parent = $(obj).attr('parent');
            var title = title.trim();
            $('input[name=name]').val(title);
            $('input[name=menu_page]').val(url);
            $('input[name=update_id]').val(id);
            $('input[name=parent]').val(parent);
            $('#addProduct').attr('name', 'update');
        }

    }
    $(function () {
        $('.panel-body ul').addClass('forSort');
        $(".forSort").sortable();
        $(".panel-body ul").sortable({
            cursor: 'move',
            opacity: 0.65,
            stop: function (event, ui) {
                var data1 = $(this).sortable('toArray');
                //   console.log(data1); // This should print array of IDs, but returns empty string/array
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/ProductHandler/drag_n_drop_tree_menu",
                    data: {'sr_data': data1, 'table_name': 'nfw_menu', 'column_name': 'menu_index'},
                    success: function (data)
                    {
                        console.log(data);
                    }
                });
            }
        });
    });

</script>
<?php
$this->load->view('layout/layoutFooter');
?>