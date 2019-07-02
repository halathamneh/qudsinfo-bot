<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/8/17
 * Time: 3:22 PM
 */

$u_errs = array();
$uname = '';
$fullname = '';
$email = '';

if ( isset($_POST['action']) && $_POST['action'] == 'user_register' ) {
    $validation = true;
    
    if ( ! isset($_POST['uname']) || empty($_POST['uname']) ) {
        $u_errs['uname'] = "اسم المستخدم اجباري";
        $validation = false;
    } else {
        $uname = trim($_POST['uname']);
    }
    if ( ! isset($_POST['password']) || empty($_POST['password']) ) {
        $u_errs['password'] = "كلمة المرور اجبارية";
        $validation = false;
    } else {
        $password = trim($_POST['password']);
    }
    if ( $validation && (! isset($_POST['confirm_pass']) || empty($_POST['confirm_pass']) || $_POST['confirm_pass'] != $_POST['password']) ) {
        $u_errs['confirm_pass'] = "كلمة المرور مختلفة";
        $validation = false;
    }
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    
    if ( $validation ) {
        echo "validated";
        if ( $user_id = $auth->register($uname, $password, $fullname, $email) ) {
            redirect('index.php');
        } else
            $u_errs['db'] = $auth->last_sql_error();
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'user_login') {
    $validation = true;
    if ( ! isset($_POST['uname']) || empty($_POST['uname']) ) {
        $u_errs['uname'] = "أدخل اسم المستخدم";
        $validation = false;
    } else {
        $uname = trim($_POST['uname']);
    }
    if ( ! isset($_POST['password']) || empty($_POST['password']) ) {
        $u_errs['password'] = "أدخل كلمة المرور";
        $validation = false;
    } else {
        $password = trim($_POST['password']);
    }
    if($auth->login($uname, $password))
        redirect('index.php');
    else
        $u_errs[] = 'خطأ في تسجيل الدخول';
}