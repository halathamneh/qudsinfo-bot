<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/10/17
 * Time: 2:29 PM
 */

class Log {
    public static function write($str = "") {
        $file = LOG_FILE;
        file_put_contents($file, $str.PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}