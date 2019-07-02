<?php
include "../includes/api-common.php";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
    echo json_encode(Subscribers::getAll());
elseif ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userId']) ) {
    $users = Subscribers::getAll();
    $to_add = $_POST['userId'];
    if ( ! in_array($to_add, $users) ) {
        Subscribers::add($to_add);
        echo "success";
    }
}