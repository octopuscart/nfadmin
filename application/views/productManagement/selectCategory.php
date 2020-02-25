<?php
$this->load->view('layout/layoutTop'); 
?>
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
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="tree-view-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title" style="font-size: 18px;font-weight: 500;">Add New Product</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-10">
                <div id="jstree-default" style="font-size: 17px;">

                    <?php
                     $database = $this->session->userdata('database');
                    $conn = mysql_connect($database['host_name'], $database['user_name'], $database['password']);
                    mysql_select_db($database['database'], $conn);

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

                                    echo "<span class='product_add'><a  style='font-size: 15px;' class='btn btn-icon btn-circle btn-xs' href=" . base_url() . "index.php/ProductHandler/add_product_information/" . $row['id'] . "/new/" . $row['id'] . "/>" . $row['name'] . "&nbsp" . "<i class='fa fa-plus-circle'></i></a></span>";
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

                                    echo "<span>" . $row['name'] . "&nbsp" . "<span class='product_add'><a style='font-size: 17px;' class='btn btn-icon btn-circle btn-xs' href='" . base_url() . "index.php/ProductHandler/add_product_information/" . $row['id'] . "/new/" . $row['id'] . "'><i class='fa fa-plus-circle'></i></a></span></span>";
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
        </div>
    </div>
</div> 
<!-- end col-6 -->

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
        $('.product_add').click(function () {
            window.open($(this).find('a').attr('href'), "_self");
        });
        // $("ul").sortable(); 
    });
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
                    data: {'sr_data': data1,'table_name' : 'nfw_category','column_name': 'index_menu'},
                    success: function (data)
                    { 
                    }
                });
            }
        });
    })
</script>
<?php
$this->load->view('layout/layoutFooter');
?> 