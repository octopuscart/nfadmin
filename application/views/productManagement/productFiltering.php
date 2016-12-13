<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-search"></i> Product Filtering Reports</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-md-2 control-label" style="width: 9%;">Select Tag:</label>
                <div class="col-md-2" style="margin-top:0px">
                    <select name="tagName" class="form-control"> 
                        <?php
                        foreach ($tag as $key => $value) {
                            ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['tag_title'] ?></option>
                        <?php } $portid = $this->uri->segment(3)?>
                    </select>
                </div>
            </div>
            
            <div class="col-md-2 pull-right" style="padding: 0px;">
                        <div class="btn-group pull-right" role="group" aria-label="..." style="padding: 0px;margin-top: -10%;">
                           <a class="btn btn-default"   data-toggle="" data-placement="left" title="View Pdf"  style="background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/ProductHandler/product_filtering_pdf/I/' . $portid) ?>"><i class="fa fa-eye"></i> </a>
                            <a class="btn btn-default"  data-toggle="" data-placement="left" title="Download Pdf"  style="margin-right: -10%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/ProductHandler/product_filtering_pdf/D/' . $portid) ?>"><i class="fa fa-download"></i> </a>
                            
                        </div>

                    </div>
              <div style="clear: both"></div>
            <hr>
            <div class="col-md-12">

                <table  class="table table-striped table-bordered data_table">
                    <thead>
                        <tr>
                            <th style="width:5px">S.No.</th>
                            <th style="width:8px">Item Code</th>
                            <th style="width:8px">Product Speciality</th>
                            <th style="width:198px !important;">Description</th>
                            <th style="width:5px">Price</th>
                        </tr>
                    </thead>
                    <tbody id="status_report"> 
                        <?php
                        $count = 1;
                        //print_r($test);
                        if ($result) {
                            foreach ($result as $key => $value) {

                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['title'] . '</td>';
                                echo '<td>' . $value['product_speciality'] . '</td>';
                                echo '<td>' . $value['short_description'] . '</td>';
                                echo '<td>' . '$' . $value['price'] . '</td>';
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
</div>

<?php
$this->load->view('layout/layoutBottom');
?>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script>

<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        //FormPlugins.init();
        TableManageTableTools.init();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>
<script>
    $(function(){
        $(".data_table").DataTable();
        $("select[name='tagName']").change(function(){ 
            var tt = $(this).val(); 
            window.location.href = '<?php echo base_url(); ?>index.php/productHandler/product_filtering/' + tt;
        });
        
         $("select[name='tagName']").val('<?php  echo $portid = $this->uri->segment(3);   ?>');
    });
</script>