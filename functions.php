<?php 

add_action('wp_head', 'create_db');
function create_db() {
    global $wpdb;
    
    $table = $wpdb->prefix . 'cf7_submit';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(11) NOT NULL AUTO_INCREMENT,
        sub_date DATETIME NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}




add_action('wpcf7_mail_sent', 'write_submit_in_db');
function write_submit_in_db($contact_form) {
    global $wpdb;
    $submission = WPCF7_Submission::get_instance();
    
    date_default_timezone_set('Europe/Kiev'); 
    
    $date = date("Y-m-d H:i:s");

    $table = $wpdb->prefix . 'cf7_submit';
    if ($submission) {
        $wpdb->insert(
            $table,
            array(
                'sub_date' => $date,
            ),
            array(
                '%s',
            )
        );
    }
}
