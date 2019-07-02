<?php
include "../includes/api-common.php";

if(isset($_GET['action']) && $_GET['action']=='next') {
    $next_info = Info::load_infos('not sent',1);
    $today = new DateTime();
    $info_time = new DateTime(date('d-m-Y',$next_info->send_date));
    if( $today->diff($info_time)->d == 0 ) {
        $next_info->sent(true);
        echo $next_info->get_json();
    }
}
