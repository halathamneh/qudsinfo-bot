<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/5/17
 * Time: 7:10 PM
 */
session_start();

include_once 'constants.php';

require_once 'Log.php';
require_once 'DB.php';
require_once 'Auth.php';
require_once 'Info.php';
require_once 'Bot.php';

require_once 'functions.php';

if ( is_page('login') && (isset($_GET['action']) && $_GET['action'] == 'logout') )
    $auth->logout();

if ( ! $auth->isAuthenticated() && ! is_page('login') ) {
    redirect('login.php');
}
