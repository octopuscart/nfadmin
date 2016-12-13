<?php
//error_reporting(0);
$this->load->view('layout/layoutTop');
//$dataProduct = array_chunk($product_list, 4);
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500; "><i class="fa fa-file-text-o"></i> Product Reports</h4>
        </div>
        <div class="panel-body" id="test"> 
                  <div class="col-md-2 pull-right" style="padding: 0px;margin-top: 13px">
                        <div class="btn-group pull-right" role="group" aria-label="..." style="padding: 0px;margin-top: -10%;">
                            <a class="btn btn-default"  data-toggle="" data-placement="left" title="Download Pdf"  style="margin-right: -10%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/ProductHandler/product_list_report_pdf/D/') ?>"><i class="fa fa-download"></i> </a>
                            <a class="btn btn-default"   data-toggle="" data-placement="left" title="View Pdf"  style="margin-left: 10%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/ProductHandler/product_list_report_pdf/I/') ?>"><i class="fa fa-eye"></i> </a>
                        </div>

                    </div>
              <div style="clear: both"></div> 
            <hr>
          
            <table  class="table table-striped table-bordered nowrap" id="data-table">
                <thead>
                    <tr>
                        <th style="width: 7%;">S.No.</th>
                        <th style="width: 15%;">Item Code</th>
                        <th style="width: 15%;">SKU</th>
                        <th style="width: 10%;">Image</th>
                        <th style="width: 43%;">Item Feature</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php
                    if ($product_list) {
                        $count = 1;
                        foreach ($product_list as $key => $value) {
                         
                         
                            echo '<tr>';
                            echo '<td>'.$count.'</td>';
                            echo '<td>'.$value['title'].'</td>';
                            echo '<td>'.$value['sku'].'</td>';
                            echo '<td><img src="'.image_server.'/nfw/small/' . $value['image'] . '"  alt="..."  style="height: 40px;width:65px"></td>';
                            echo '<td>'.$value['product_speciality'].'</td>';
                            echo '<td><a style="margin-left: 15px;" class="btn btn-success btn-sm m-r-5" onclick="editInfo(this)" id="' . $value['id'] . '" category="' . $value['product_category'] . '" href="'. base_url().'index.php/ProductHandler/add_product_information/'. $value['id'] . '/edit/'. $value['product_category'] .'"><i class="fa fa-external-link"></i> Edit</a></td>';
                          
                            echo '</tr>';
                            $count++;
                        }
                    }
                    ?>
                </tbody>
            </table>      
        </div>
    </div> 
</div>
<?php
$this->load->view('layout/layoutBottom');
?>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    function editInfo(obj) {
        var id = obj.id;
        console.log(id);
        var category = $('#' + id).attr('category');
        console.log(category);
        var url = '<?php echo base_url(); ?>index.php/ProductHandler/add_product_information/' + id + '/edit/' + category;
        console.log(url);
        window.location.replace(url);
    }
</script>
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