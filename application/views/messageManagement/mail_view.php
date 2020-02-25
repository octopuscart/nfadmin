<?php

$mailboxes = array(
    array(
        'label' => 'Nita Fashions',
        'enable' => true,
        'mailbox' => '{imap.nitafashions.com:143/imap}INBOX',
        'username' => 'noreply@nitafashions.com',
        'password' => 'India$2017'
    )
);

// a function to decode MIME message header extensions and get the text
function decode_imap_text($str) {
    $result = '';
    $decode_header = imap_mime_header_decode($str);
    foreach ($decode_header AS $obj) {
        $result .= htmlspecialchars(rtrim($obj->text, "\t"));
    }
    return $result;
}
?>
<div class="col-md-12">
    <div id="mailboxes">
        <? if (!count($mailboxes)) { ?>
        <p>Please configure at least one IMAP mailbox.</p>
        <? } else { 

        foreach ($mailboxes as $current_mailbox) {
        ?>
        <div class="mailbox">
            <h2><?= $current_mailbox['label'] ?></h2>
            <?
            if (!$current_mailbox['enable']) {
            ?>
            <p>This mailbox is disabled.</p>
            <?
            } else {

            // Open an IMAP stream to our mailbox
            $stream = @imap_open($current_mailbox['mailbox'], $current_mailbox['username'], $current_mailbox['password']);

            if (!$stream) { 
            ?>
            <p>Could not connect to: <?= $current_mailbox['label'] ?>. Error: <?= imap_last_error() ?></p>
            <?
            } else {
            // Get our messages from the last 5 year
            // Instead of searching for last 5 year's message you could search for all the messages in your inbox using: $emails = imap_search($stream,'ALL');
            $emails = imap_search($stream, 'SINCE '. date('d-M-Y',strtotime("-5 year")));

            if (!count($emails)){
            ?>
            <p>No e-mails found.</p>
            <?
            } else {

            // If we've got some email IDs, sort them from new to old and show them
            rsort($emails);

            foreach($emails as $email_id){

            // Fetch the email's overview and show subject, from and date. 
            $overview = imap_fetch_overview($stream,$email_id,0);	
           //print_r($overview);
            ?>
            <div class="email_item clearfix <?= $overview[0]->seen ? 'read' : 'unread' ?>"> <? // add a different class for seperating read and unread e-mails ?>
                <span class="subject" title="<?= decode_imap_text($overview[0]->subject) ?>"><?= decode_imap_text($overview[0]->subject) ?></span>
                <span class="from" title="<?= decode_imap_text($overview[0]->from) ?>"><?= decode_imap_text($overview[0]->from) ?></span>
                <span class="date"><?= $overview[0]->date ?></span>
            </div>
            <?
            } 
            } 
            imap_close($stream); 
            }

            } 
            ?>
        </div>
        <?
        } // end foreach 
        } ?>
    </div>

</div><!-- #main -->
