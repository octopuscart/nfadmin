<?php 
//$this->load->view('layout/layoutTop');
?>

<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
 
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>



<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-search"></i> Product Filtering</h4>
        </div>
        <div class="panel-body">
            
            <?php echo $output;?>
            
            
        </div>
    </div>
</div>


<?php
//$this->load->view('layout/layoutBottom');
?>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script>
<script>
    $(document).ready(function () {
        App.init();
       // TableManageDefault.init();
       TableManageTableTools.init();
    });
</script>
<?php
//$this->load->view('layout/layoutFooter');
?>