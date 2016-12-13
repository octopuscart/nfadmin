<?php
$this->load->view('layout/layoutTop');

?> 
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-list"></i>&nbsp;&nbsp; Selected New Arrival Product Report</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" id="data-table">
                        <thead>
                            <tr>
                                <th style ="width:7%;">S.No.</th>
                                <th style ="width:14%;">Item Code</th>
                                <th style ="width:14%;">SKU</th>
                                <th style ="width:12%;">Image</th>
                                <th style ="width:33%;">Item Feature</th>
                                <th style ="width:10%;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            if ($product_report) {
                                //print_r($product_report);
                                foreach ($product_report as $key => $value) {
                                    echo '<tr>';
                                    // echo '<td><div class="checkbox"><label> <input type="checkbox" name = "related_product[]" value=" '.$value['id'].'"> </label></div></td>';
                                    echo '<td>' . $count . '</td>';
                                    echo '<td>' . $value['title'] . '</td>';
                                    echo '<td>' . $value['sku'] . '</td>';
                                    echo '<td><img src='.image_server.'nfw/smaller/'.  $value['image'] . ' style="height:45px;width:60px;"/></td>';
                                   echo '<td>' . $value['product_speciality'] . '</td>';
                                    echo '<td><button style="margin-left: 4px;" type="submit" name="delete" value="' . $value['id'] . '" class="btn btn-danger btn-sm m-r-5" onclick="deleteInfo(this)"><i class="fa fa-trash-o"></i></button></td>';
                                    echo '</tr>';
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-th-list"></i>&nbsp;&nbsp; Product Report, You Can Choose New Arrival Product From Here</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="table-responsive" id="featureProduct">
                    <table class="table table-striped table-bordered">
                        <thead> 
                            <tr>
                                <th style ="width:5%;"></th>
                                <th style ="width:7%;">S.No.</th>
                                <th style ="width:12%;">Title</th>
                                <th style ="width:12%;">SKU</th>
                                <th style ="width:9%;">Image</th>
                                <th style ="width:45%;">Item Feature</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            if ($most_popular_product) { 
                                foreach ($most_popular_product as $key => $value) {
                                    echo '<tr>';
                                    echo '<td><div class="checkbox"><label><input name="featured_product[]" type="checkbox" value="' . $value['id'] . '"></label></div></td>';
                                    echo '<td>' . $count . '</td>';
                                    echo '<td>' . $value['title'] . '</td>';
                                    echo '<td>' . $value['sku'] . '</td>';
                                    echo '<td><img src='.image_server.'nfw/smaller/'.  $value['image'] . ' style="height:45px;width:60px;"/></td>';
                                    echo '<td>' . $value['product_speciality'] . '</td>';

                                    echo '</tr>';
                                    $count++;
                                }
                            }
                            ?>

                        </tbody>

                    </table>

                </div>
                <div class="well well-sm" style="margin-top: 20px;background: whitesmoke;"><button type="submit" class="btn btn-sm btn-primary m-r-5" name="submit">Submit</button></div>
            </form>                          
        </div>
    </div>
</div>
<?php
$this->load->view('layout/layoutBottom');
?> 
<script>
    $(function () {
        $('#featureProduct table').dataTable();
    });
</script>
<script>
    function deleteInfo(obj) {
        var r = confirm("Do you want to delete!");
        if (r == true) {
        } else {
            window.location.reload();
            $('button[name=delete]').attr('name', 'test')
        }
    }
</script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        FormPlugins.init();
        TableManageTableTools.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>