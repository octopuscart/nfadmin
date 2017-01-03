<?php
$this->load->view('typeahead.php');
?> 
<script>
    $(document).ready(function () {
        var customers = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('order_no'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: "<?php echo base_url('index.php/UserRecordManagement/search_order_information'); ?>/?searchText=%QUERY%",
                wildcard: '%QUERY%'
            }
        });


        customers.initialize(); // customer mobile search init


        /////////////////// Search Customer type ahead ////////////////////////////////////
        $('#searchCustomer').typeahead({highlight: true},
        {
            name: 'customers',
            displayKey: 'order_no',
            limit: 8,
            source: customers.ttAdapter(),
            templates: {
                header: '<b class="typeaheadgroup text-primary"><i class="fa fa-search"></i>&nbsp;User Order Information</b>',
            },
        }).bind('typeahead:selected', function (obj, datum) {
            var orderId = datum.id;
            var billing = datum.billing_id;
            var shipping = datum.shipping_id;
            var userId = datum.user_id;
            var link = '<?php echo base_url('index.php/UserRecordManagement/update_order_status'); ?>/' + orderId + '/' + userId;
            window.open(link, "_self");
        });
        var temp = window.location.origin + window.location.pathname;
        $('a[href="' + temp + '"]').css("color", "white").parents(".has-sub").addClass("expand").addClass("active")
    });

    function isNumber(obj) {
        var inValue = $(obj).val();
        if (Number(inValue)>-1 ) {
        }
        else {
            if (inValue == '') {
            }
            else {
               
                $(obj).val('');
            }
        }
    }
    
    $(document).on("keyup", ".is_number", function(){
        isNumber(this);
    });

</script> 
</body>
</html>