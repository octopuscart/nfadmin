<?php
$this->load->view('layout/layoutTop');
?>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-search"></i> Product Category Tag Connection</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table  class="table table-striped table-bordered nowrap" id="data-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="width: ">S.No.</th>
                                        <th style="width:">Tag Title</th>
                                    </tr>
                                </thead>
                                <tbody id="status_report"> 
                                    <?php
                                    if ($tagData) {
                                        $count = 1;
                                        foreach ($tagData as $key => $value) {

                                            echo '<tr>';
                                            echo '<td><input type="checkbox" name="tag_data[]" value="' . $value['id'] . '"></td>';
                                            echo '<td>' . $count . '</td>';
                                            echo '<td>' . $value['tag_title'] . '</td>';

                                            echo '</tr>';
                                            $count++;
                                        }
                                    }
                                    ?> 

                                </tbody> 
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive" id="categoryId">
                            <table  class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th style="width: ">S.No.</th>
                                        <th style="width:">Category Title</th>
                                    </tr>
                                </thead>
                                <tbody id="status_report"> 
                                    <?php
                                    if ($categoryData) {
                                        $count = 1;
                                        foreach ($categoryData as $key => $value) {

                                            echo '<tr>';
                                            echo '<td><input type="checkbox" name="category_data[]" value="' . $value['id'] . '"></td>';
                                            echo '<td>' . $count . '</td>';
                                            echo '<td>' . $value['name'] . '</td>';
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
                <div class="col-md-12">
                    <div class="col-md-3" style="margin-top: 20px;"><button class="btn btn-info" name="submit">Submit</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;"><i class="fa fa-search"></i> Product Category Tag Connection Report</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive" id="categoryTagId">
                <table  class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10%;">S.No.</th>
                            <th style="width:40%;">Category</th>
                            <th style="width:30%;">Tag </th>
                            <th style="width:10%;"> </th>
                        </tr>
                    </thead>
                    <tbody id="status_report"> 
                        <?php
                        if ($tagCategoryConn) {
                            $count = 1;
                            foreach ($tagCategoryConn as $key => $value) {

                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $value['category'] . '</td>';
                                echo '<td>' . $value['tag_title'] . '</td>';
                                echo '<td><form onsubmit="return confirm('."'Are you sure ?'".');"><button class="btn btn-danger btn-xs" name="delete" value="' . $value['id'] . '">Remove</button></form></td>';
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
        $('#categoryId table').dataTable();
        $('#categoryTagId table').dataTable();
        $("#data-table_length").hide();
        $("#data-table_filter").hide();
        $("#DataTables_Table_0_length").hide();
        $("#DataTables_Table_0_filter").hide();
        $("select[name='data-table_length']").hide();
    });
</script>
<?php
$this->load->view('layout/layoutFooter');
?>
