<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/7/17
 * Time: 2:45 PM
 */

class Auth {
    private $logged = false;
    private $logged_user = false;
    
    private $session_name = 'loggedin_user';
    
    public function __construct() {
        if(isset($_SESSION[$this->session_name]) && ! empty($_SESSION[$this->session_name])) {
            $this->logged_user = $_SESSION[$this->session_name];
            $this->logged = true;
        }
    }
    
    public function login($uname, $pass) {
        global $db;
        $hashed_pass = md5($pass);
        $rows = $db->get_rows('users', 'id', '1', "uname='$uname' and password='$hashed_pass'");
        if(count($rows) > 0) {
            $uid = $rows[0]['id'];
            $this->initiate_session($uid);
            return $uid;
        } else {
            return false;
        }
    }
    
    public function register($uname, $pass, $fullname = '', $email = '') {
        global $db;
        $user_id = $db->insert('users', [
            'uname'    => $uname,
            'password' => md5($pass),
            'fullname' => $fullname,
            'email'    => $email,
        ]);
        $this->initiate_session($user_id);
        return $user_id;
    }
    
    public function logout() {
        $this->terminate_session();
    }
    
    public function last_sql_error() {
        global $db;
        return $db->last_error();
    }
    
    public function isAuthenticated() {
        return $this->logged;
    }
    
    public function get_auth_user() {
        return $this->logged_user;
    }
    
    private function initiate_session($uid) {
        $_SESSION[$this->session_name] = $uid;
    }
    
    private function terminate_session() {
        $this->logged = false;
        $this->logged_user = false;
        session_unset();
        session_destroy();
    }
}
global $auth;
$auth = new Auth();