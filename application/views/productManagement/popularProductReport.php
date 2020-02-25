<?php
$this->load->view('layout/layoutTop');
?>

<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <form method="post">
                    <button class="btn btn-info btn-xs" name="generateXls"><i class="fa fa-file-excel-o"></i></button>
                </form>
            </div>
            <h4 class="panel-title" style="font-size: 17px; font-weight: 500; "><i class="fa fa-list"></i> Popular Product Report</h4>
        </div>
        <div class="panel-body" id="test"> 
<!--                <a class="btn btn-primary btn-xs" data-toggle="" data-placement="left" title="Download Pdf"  style="margin-right: -10%" target="_blanck" href="<?php echo base_url('index.php/ProductHandler/product_list_report_pdf/D') ?>"><i class="fa fa-download"></i> PDF</a>
                <a class="btn btn-danger btn-xs"  data-toggle="" data-placement="left" title="View Pdf" style="margin-left: 10%" target="_blanck" href="<?php echo base_url('index.php/ProductHandler/product_list_report_pdf/I') ?>"><i class="fa fa-eye"></i> PDF</a>
            -->
            <div class="col-md-2 pull-right" style="padding: 0px;margin-top: 13px">
                <div class="btn-group pull-right" role="group" aria-label="..." style="padding: 0px;margin-top: -10%;">
                    <a class="btn btn-default"  data-toggle="" data-placement="left" title="Download Pdf"  style="margin-right: -10%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/ProductHandler/product_list_report_pdf/D/') ?>"><i class="fa fa-download"></i> </a>
                    <a class="btn btn-default"   data-toggle="" data-placement="left" title="View Pdf"  style="margin-left: 10%;background: black;border-color: gray" target="_blanck" href="<?php echo base_url('index.php/ProductHandler/product_list_report_pdf/I/') ?>"><i class="fa fa-eye"></i> </a>
                </div>

            </div>

            <div style="clear: both"></div>

            <hr>
            <table id="data-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th style="width:5%;">S.No.</th>
                    <th style="width:7%;">Item Code</th>
                    <th style="width:7%;">Sku</th>
                    <th style="width:5%;">Image</th>
                    <th style="width:8%;">Frequency</th>
                    <th style="width:15%;">Short Description</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php
                    if ($popularProduct) {
                        $count = 1;
                        foreach ($popularProduct as $key => $value) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $value['title'] . '</td>';
                            echo '<td>' . $value['sku'] . '</td>';
                            echo '<td><img src="' . image_server . 'nfw/small/' . $value['image'] . '" style="height:45px;width:60px;"/></td>';
                            echo '<td>' . $value['quantity'] . '</td>';
                            echo '<td>' . $value['short_description'] . '</td>';
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