<?php
$this->load->view('layout/layoutTop');
?>

<div class="panel panel-inverse" data-sortable-id="index-5">
    <div class="panel-heading">
        <b>Create Mail Template</b>
    </div>
    <div class="panel-body">
        <form method="post">
            <div class="col-md-12">
                <h4>
                    <select name="template">
                        <?php
                        foreach ($template_data as $key => $value) {
                            echo "<option value='" . $value['id'] . "'>" . $value['template_title'] . "</options>";
                        }
                        ?>
                    </select>
                </h4>
            </div>
            <div class="col-md-12">
                <h3>Header Section</h3>
                <div>
                    <textarea id="elm1" name="elm1" rows="15" cols="80" style="width:100%" ><?php echo $template_data_detail['header'];?></textarea>

                </div>


                <hr style="">
                <h3>Footer Section</h3>
                <div>
                    <textarea id="elm3" name="elm3" rows="15" cols="80" style="width:100%" ><?php echo $template_data_detail['footer'];?></textarea>
                </div>
                <br>

                <button type="submit" name="submit" class="btn btn-primary btn-sm"><b>Submit Template</b></button>
            </div>
        </form>
    </div>
</div>


<?php
$this->load->view('layout/layoutBottom');
?> 
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script> 

<script>
    $(document).ready(function () {


        App.init();
    });
</script>

<?php
$this->load->view('layout/layoutFooter');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_main/js/tinymce/jscripts/tiny_mce/tiny_mce_dev.js"></script>

<!-- TinyMCE -->
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode: "textareas",
        theme: "advanced",
        plugins: "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
        // Theme options
        theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
        theme_advanced_toolbar_location: "top",
        theme_advanced_toolbar_align: "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true,
        // Example content CSS (should be your site CSS)
        // using false to ensure that the default browser settings are used for best Accessibility
        // ACCESSIBILITY SETTINGS
        content_css: false,
        // Use browser preferred colors for dialogs.
        browser_preferred_colors: true,
        detect_highcontrast: true,
        // Drop lists for link/image/media/template dialogs
        template_external_list_url: "tinymce/examples/lists/template_list.js",
        external_link_list_url: "tinymce/examples/lists/link_list.js",
        external_image_list_url: "tinymce/examples/lists/image_list.js",
        media_external_list_url: "tinymce/examples/lists/media_list.js",
        // Style formats
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
        // Replace values for the template plugin
        template_replace_values: {
            username: "Some User",
            staffid: "991234"
        }

    });
</script>
<!-- /TinyMCE -->
<script type="text/javascript">
    if (document.location.protocol == 'file:') {
        alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
    }
    
    
    $(function(){
        $("select[name='template']").val("<?php echo $template_id;?>");
        $("select[name='template']").change(function(){
            window.location = "<?php echo base_url(); ?>/index.php/userRecordManagement/mail_template_creation/"+$(this).val();
        })
    })
    
    
</script>
</body>
</html>