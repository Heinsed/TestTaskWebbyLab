<?php 

require_once('wp-load.php');

date_default_timezone_set('Europe/Kiev');

global $wpdb;

$start = date('Y-m-d 00:00:00');
$end = date('Y-m-d 23:59:59');

echo $start;
echo ' | ';
echo $end;
echo ' | ';

$query = "SELECT COUNT(*) FROM `wp_cf7_submit` WHERE `sub_date` BETWEEN '$start' AND '$end'";
$count = $wpdb->get_var($query);

echo $count;

$to = 'vkinev6@gmail.com';
$subject = 'Count';
$message = $count;
$headers = array('Content-Type: text/html; charset=UTF-8');

if($count >= 1 || !empty($count)){
    if (wp_mail($to, $subject, $message, $headers)) {
        echo ' | ';
        echo 'Mail was sent successfully';
    } else {
        echo ' | ';
        echo 'Error sending mail';
    }
}else{
    echo '$count = 0';
}


