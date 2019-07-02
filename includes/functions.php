<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/7/17
 * Time: 2:52 PM
 */

function redirect($location) {
    header('Location: '.$location);
    exit();
}

function substrwords($text, $maxchar, $end='...') {
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output)+strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            }
            else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    }
    else {
        $output = $text;
    }
    return $output;
}

function is_page($page_name) {
    $name_ext = basename($_SERVER['SCRIPT_FILENAME']);
    return substr($name_ext,0,strpos($name_ext, '.')) == $page_name;
}