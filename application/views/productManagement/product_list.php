<?php
$this->load->view('layout/layoutTop');

//print_r($product_report);
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"/>
<style>
    .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: white !important; 
    }

    .price_table{
        width:100%
    }
    .price_table td:first-child{
        width:100px;
    }

</style>	



<div class="panel panel-inverse" data-sortable-id="index-5">
    <div class="panel-heading">Product Report
    </div>
    <div class="panel-body">



        <div class="col-md-12" style="padding:0px">
            <form method="get">
                <div class="col-md-4" >

                    <div class="input-group  input-group-sm" style="width: 100%;">
                        <span class="input-group-addon" id="basic-addon1">Tagged Item :</span>
                        <select name="tag_id" class="form-control "   style="    background: #FFFFFF;
                                opacity: 1;width:100%" >
                                <?php
                                echo "<option value='0'>All</option>";
                                ?>
                                <?php
                                foreach ($tag as $key => $value) {
                                    ?>
                                <option value="<?php echo $value['id'] ?>"><?php echo $value['tag_title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <span class="input-group-addon" id="basic-addon1">Publish Type:</span>
                        <select name="publishing" class="form-control">
                            <option value="2">All</option>
                            <option value="1">Published</option>
                            <option value="0">Unpublished</option>
                        </select>
                    </div>

                </div>
                <div class="col-md-4" >
                    <button type="submit" class="btn btn-success btn-sm">
                        Show Data
                    </button>
                </div>
            </form>


        </div>


        <div class="col-md-12" style="margin-top:20px">



            <form method="post">

                <div class="col-md-2 pull-right" style="    margin-top: -50px;padding:0px">
                    <button type="submit" name="submit_pdf" class="btn btn-success btn-sm pull-right" onclick="this.form.target = '_blank';
                            return true;">
                        <i class="fa fa-download"></i>   Download below item into PDF file
                    </button>

                </div>

                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th style ="">S.No.</th>
                        <th style ="">Image</th>
                        <th style ="">Item Code</th>
                        <th style ="">SKU</th>
                        <th style ="">Item Feature</th>
                        <th style ="width:30%">Item Price</th>
                        <th style ="">Product Category</th>
                        <th style ="">Publishing</th>
                        <th style =""></th>


                        </tr>
                    </thead>

                </table>

            </form>
        </div>
    </div>
</div>

<?php
$this->load->view('layout/layoutBottom');
?> 

<script>

    $(document).ready(function () {
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url() . 'index.php/ProductHandler/listData/' . (isset($_REQUEST['tag_id']) ? $_REQUEST['tag_id'] : 0).'/'.(isset($_REQUEST['publishing']) ? $_REQUEST['publishing'] : 2); ?>",
                "type": "GET",
            },
            "columns": [
                {"data": "serial_number"},
                {"data": "image"},
                {"data": "title"},
                {"data": "sku"},
                {"data": "product_speciality"},
                {"data": "tag_price"},
                {"data": "category"},
                {"data": "publishing"},
                {"data": "edit"}


            ]
        });
    });
</script>

<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 
<script>
    $(document).ready(function () {

        $("select[name='tag_id']").val("<?php echo (isset($_REQUEST['tag_id']) ? $_REQUEST['tag_id'] : 0); ?>");
        $("select[name='publishing']").val("<?php echo (isset($_REQUEST['publishing']) ? $_REQUEST['publishing'] : 2); ?>");
        App.init();
        TableManageDefault.init();
        FormPlugins.init();
        TableManageTableTools.init();

    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>