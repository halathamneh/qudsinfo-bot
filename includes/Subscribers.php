<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/11/17
 * Time: 11:27 PM
 */

class Subscribers {
    public static function getAll() {
        global $db;
        $arr = $db->get_rows('subscribers');
        $ids = [];
        foreach ($arr as $item) {
            $ids[] = $item['user_id'];
        }
        return $ids;
    }
    
    public static function add($uid) {
        global $db;
        $db->insert('subscribers',['user_id' => $uid]);
    }
}