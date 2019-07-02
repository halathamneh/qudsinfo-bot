<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/4/17
 * Time: 11:17 PM
 */

/**
 * Class Bot
 */
class Bot {
    
    /**
     * @var false|int
     */
    private $check_day;
    
    /**
     * @var object
     */
    private $settings;
    
    /**
     * @var object
     */
    private $infos = [];
    private $sent_infos = [];
    private $waiting_infos = [];
    
    /**
     * Bot constructor.
     */
    public function __construct() {
        $this->load_settings();
        $this->check_day = strtotime('yesterday');
        $this->infos = Info::load_infos();
        foreach ($this->infos as $info) {
            if($info->sent)
                $this->sent_infos[] = $info;
            else
                $this->waiting_infos[] = $info;
        }
    }
    
    public function load_settings() {
        global $db;
        $settings_raw = $db->get_rows_object('settings', 'name,value');
        $this->settings = $this->parseSettings($settings_raw);
    }
    
    /**
     * @param int $limit
     * @return array
     */
    public function getInfos($limit=-1) {
        return $limit==-1 ? $this->infos : array_slice($this->infos,0,$limit);
    }
    
    /**
     * @param int $limit
     * @return array
     */
    public function getSent($limit=-1) {
        return $limit==-1 ? $this->sent_infos : array_slice($this->sent_infos,0,$limit);
    }
    
    /**
     * @param int $limit
     * @return array
     */
    public function getWaiting($limit=-1) {
        return $limit==-1 ? $this->waiting_infos : array_slice($this->waiting_infos,0,$limit);
    }
    
    
    /**
     * @param $content
     * @param $image
     * @param $send_date
     * @return bool
     */
    public function saveInfo($content, $image, $send_date) {
        global $db, $auth;
        return $db->insert('infos', [
            "content"   => $content,
            "image"     => $image,
            "send_date" => $send_date,
            "user_id"   => $auth->get_auth_user(),
        ]);
    }
    
    /**
     * @return int
     */
    public function getInfosCount() {
        return count($this->infos);
    }
    
    /**
     * @return int
     */
    public function getSentCount(): int {
        return count($this->sent_infos);
    }
    
    /**
     * @return int
     */
    public function getWaitingCount(): int {
        return count($this->waiting_infos);
    }
    
    public function parseSettings($raw_settings) {
        $settings = [];
        foreach ($raw_settings as $raw_setting) {
            $settings[$raw_setting->name] = $raw_setting->value;
        }
        return (object) $settings;
    }
    
    public function getSubscribers() {
        global $db;
        $rows = $db->get_rows('subscribers', '*');
        $subscribers = [];
        foreach ($rows as $row) {
            $subscribers[] = $row['user_id'];
        }
        return $subscribers;
    }
    
    public function getSubscribersCount(): int {
        global $db;
        return $db->rows_count('subscribers');
    }
    
    public function getNextInfo() {
    
    }
}

