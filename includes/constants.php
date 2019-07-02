<?php
if ( ! defined('BOT_SITE_URL') )
    define('BOT_SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/bot/');
if ( ! defined('IMG_UPLOAD_PATH') )
    define('IMG_UPLOAD_PATH', __DIR__ . '/../info_images/');
if ( ! defined('LOG_FILE') )
    define('LOG_FILE', __DIR__ . '/../logs/log.txt');
if ( ! defined('DB_SERVER') )
    define('DB_SERVER', 'localhost');
if ( ! defined('DB_NAME') )
    define('DB_NAME', 'qudsinfo_bot_DB');
if ( ! defined('DB_USER') )
    define('DB_USER', 'root');
if ( ! defined('DB_PASS') )
    define('DB_PASS', 'himohna');