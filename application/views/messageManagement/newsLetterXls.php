<h5>
    <?php
    echo $frequency = isset($_REQUEST['frequency']) ? $_REQUEST['frequency'] : 'Full Experience';
    ?>

</h5>

<table class="table table-striped table-bordered dataTable no-footer" id="data-table">
    <thead>
        <tr>

            <th style="">S.No.</th>
            <th style="">Client Name</th>
            <th style="">Client Code</th>
            <th style="width:300px">Email</th>
            <th style="">Contact No.</th>
            <th style="">Frequency</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $subquery = " join nfw_news_letters_frequency as nnlf on nnlf.user_id = au.id";
        if ($frequency == 'All Type') {
            $subquery2='';
        } else {
            $subquery2 = "and nnlf.frequency = '$frequency'";
        }
        $userData = $this->db->query("select au.*, nnlf.frequency from auth_user as au $subquery
                                                         where au.email not in (select nlu.email_id from nfw_news_letters_unsubscribe as nlu )
                                                          $subquery2 group by au.email
                                                          ");
        $count = 1;
        if ($userData) {
            foreach ($userData->result_array() as $key => $value) {
                echo '<tr>';

                echo '<td>' . $count . '</td>';
                echo '<td>' . $value['first_name'] . ' ' . $value['last_name'] . '</td>';
                echo '<td>' . $value['registration_id'] . '</td>';
                echo '<td>' . $value['email'] . '</td>';
                echo '<td>' . $value['contact_no'] . '</td>';
                echo '<td>' . $value['frequency'] . '</td>';
                echo '</tr>';
                $count++;
            }
        }
        ?>
    </tbody>
</table>