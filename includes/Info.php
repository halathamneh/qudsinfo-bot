<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/10/17
 * Time: 1:00 PM
 */

class Info {
    
    public $id;
    
    public $content;
    public $excerpt;
    
    public $image;
    
    public $send_date;
    public $send_date_str;
    public $sent;
    
    public $user_id;
    
    public $user_fullname;
    
    public function __construct($info_fields) {
        $this->id = $info_fields->id;
        $this->content = $info_fields->content;
        $this->excerpt = $info_fields->excerpt;
        $this->image = $info_fields->image;
        $this->user_id = $info_fields->user_id;
        $this->send_date = $info_fields->send_date;
        $this->send_date_str = $info_fields->send_date_str;
        $this->sent = $info_fields->sent;
        if ( isset($info_fields->fullname) )
            $this->user_fullname = $info_fields->fullname;
    }
    
    public static function load_infos($target = 'all', $limit = 30) {
        global $db;
        if ( $target == 'sent' )
            $sql = "SELECT infos.*, users.fullname FROM infos INNER JOIN users ON infos.user_id=users.id WHERE infos.sent=1 ORDER BY infos.send_date ASC LIMIT $limit;";
        elseif ( strtolower($target) == 'not sent' )
            $sql = "SELECT infos.*, users.fullname FROM infos INNER JOIN users ON infos.user_id=users.id WHERE infos.sent=0 ORDER BY infos.send_date ASC LIMIT $limit;";
        else
            $sql = "SELECT infos.*, users.fullname FROM infos INNER JOIN users ON infos.user_id=users.id ORDER BY infos.send_date ASC LIMIT $limit;";
        Log::write($sql);
        $sql_result = $db->raw($sql);
        if ( $sql_result->num_rows > 0 ) {
            $infos = $sql_result->fetch_all(MYSQLI_ASSOC);
            $infos = Info::prepareInfos($infos);
            if ( count($infos) > 1 ) {
                $out = [];
                foreach ($infos as $info) {
                    $out[] = new Info($info);
                }
                return $out;
            } else {
                return new Info($infos[0]);
            }
        }
        return [];
    }
    
    /**
     * @param $info
     * @return object
     */
    public static function prepareInfo($info) {
        $check_day = strtotime('yesterday');
        $fixed_info = $info;
        $fixed_info['send_date_str'] = date('d/m/Y', $info['send_date']);
        $fixed_info['content'] = nl2br($info['content']);
        $fixed_info['excerpt'] = substrwords($info['content'], 100);
        $fixed_info['sent'] = $info['sent'] != 0;
        return (object) $fixed_info;
    }
    
    /**
     * @param $infos
     * @return array
     */
    public static function prepareInfos($infos) {
        $fixed = array_map('Info::prepareInfo', $infos);
        return $fixed;
    }
    
    public function sent(bool $val = NULL) {
        global $db;
        if ( $val == NULL ) {
            return $this->sent;
        } else {
            $this->sent = $val;
            $db->update('infos', 'sent', $val, 'id=' . $this->id);
            if($val)
                $db->update('infos', 'send_date', time(), 'id=' . $this->id);
        }
    }
    
    public function get_json() {
        return json_encode([
            'text'  => $this->content,
            'image' => $this->image,
        ]);
    }
}