<?php
$this->load->view('layout/layoutTop');
?>
<!--======================== firsr_block====================-->
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">

            <a href="javascript:;" class="btn btn-xs  btn-primary pull-right" title=""><i class="fa fa-backward"></i> Back</a>

            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;"><i class="fa fa-file-text-o"></i> Selected Related Product Report - <span id="productName" style="font-weight: 700;color: #27EF9D;"><?php echo $mainProduct[0]['title']; ?></span></h4>
        </div>
        <div class="panel-body">
            <form method="post" onsubmit="return confirm('Are you sure?');">
                <div class="table-responsive" id="relatedProduct">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 7%;">S.No.</th>
                                <th style="width: 12%;">Item Code</th>
                                <th style="width: 12%;">SKU</th>
                                <th style="width: 9%;">Image</th>
                                <th style="width: 62%;">Feature</th>
                                <th style="width: 8%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($check_related_product) {
                                $count = 1;
                                foreach ($check_related_product as $key => $value) {
                                    echo '<tr>';
                                    echo '<td>' . $count . '</td>';
                                    echo '<td>' . $value['title'] . '</td>';
                                    echo '<td>' . $value['sku'] . '</td>';
                                    echo '<td><img src="' . image_server . '/nfw/small/' . $value['image'] . '" style="height:45px;width:60px;"/></td>';
                                    echo '<td>' . substr($value['product_speciality'], 0, 150) . '..</td>';
                                    echo '<td><button style="margin-left: 4px;" type="submit" name="delete" value="' . $value['id'] . '" class="btn btn-danger btn-sm m-r-5"><i class="fa fa-trash-o"></i></button></td>';
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
<!--======================end block========================---->
<hr/>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">

            <h4 class="panel-title" style="font-size: 17px; font-weight: 500;"><i class="fa fa-file-text-o"></i> Related Product Report Of - 
                <span id="productName" style="font-weight: 700;color: #27EF9D;"><?php echo $mainProduct[0]['title']; ?></span></h4>
        </div>
        <div class="panel-body"> 
            <form method="post">    
                <div class='well well-sm'>
                    <button type = "submit" class="btn btn-warning change btn-sm m-r-5" name="submit" id="Edit" >Submit</button> 
                </div>
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 3%;">
                        <div class="checkbox"><label><input id="checkbox_select_all" name="featured_product[]" type="checkbox"  ></label></div>

                        </th>
                        <th style="width: 7%;">S.No.</th>
                        <th style="width: 13%;">Item Code</th>
                        <th style="width: 13%;">SKU</th>
                        <th style="width: 9%;">Image</th>
                        <th style="width: 45%;">Feature</th>
                        </tr> 
                        </thead>                  
                        <tbody>
                            <?php
                            if ($related_product) {
                                $count = 1;
                                foreach ($related_product as $key => $value) {
                                    echo '<tr>';
                                    echo '<td><div class="checkbox"><label> <input class="checkbox_select" type="checkbox" name = "related_product[]" value=" ' . $value['id'] . '"> </label></div></td>';
                                    echo '<td>' . $count . '</td>';
                                    echo '<td>' . $value['title'] . '</td>';
                                    echo '<td>' . $value['sku'] . '</td>';
                                    echo '<td><img src="' . image_server . '/nfw/small/' . $value['image'] . '" style="height:45px;width:60px;"/></td>';
                                    echo '<td>' . substr($value['product_speciality'], 0, 150) . '...</td>';

                                    echo '</tr>';
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class='well well-sm'>
                    <button type = "submit" class="btn btn-warning change btn-sm m-r-5" name="submit" id="Edit" >Submit</button> 
                </div>
            </form>                          
        </div>
    </div>
</div>

<?php
$this->load->view('layout/layoutBottom');
?>
<script>
    $(function () {
        $('#relatedProduct table').dataTable();
    });
</script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        //  FormMultipleUpload.init();
    });

    $("#checkbox_select_all").click(function () {
        if (this.checked) {
            $(".checkbox_select").attr("checked", true);
        }
        else {
            $(".checkbox_select").attr("checked", false);
        }
    })

    $(".checkbox_select").click(function () {
        if (this.checked) {

        }
        else {
            $("#checkbox_select_all").attr("checked", false);
        }
    })


</script>
<?php
$this->load->view('layout/layoutFooter');
?> 