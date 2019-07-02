<?php
/**
 * Created by PhpStorm.
 * User: haitham
 * Date: 8/7/17
 * Time: 2:49 PM
 */

class DB {
    
    private $conn;
    
    public function __construct($server, $user, $pass, $dbname) {
        $this->conn = new mysqli($server, $user, $pass, $dbname);
        //$this->fixIDs();
    }
    
    private function clearStoredResults() {
        while ( $this->conn->next_result() ) {
            if ( $l_result = $this->conn->store_result() ) {
                $this->conn->free();
            }
        }
    }
    
    private function fixIDs() {
        $sql = "ALTER TABLE infos DROP id";
        $this->conn->query($sql);
        $sql = "ALTER TABLE infos ADD id INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
        $this->conn->query($sql);
        $sql = "ALTER TABLE users DROP id";
        $this->conn->query($sql);
        $sql = "ALTER TABLE users ADD id INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
        $this->conn->query($sql);
        $sql = "ALTER TABLE sent DROP id";
        $this->conn->query($sql);
        $sql = "ALTER TABLE sent ADD id INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
        $this->conn->query($sql);
        
    }
    
    public function insert($into, $data) {
        $sql = "INSERT INTO $into ";
        if ( $this->isAssoc($data) ) {
            $fields = array_keys($data);
            $sql .= "(" . join(',', $fields) . ") ";
        }
        $values = $this->prepare_values(array_values($data));
        $sql .= "VALUES (" . join(', ', $values) . ")";
        Log::write($sql);
        if ( $this->conn->query($sql) === true )
            return true;
        return false;
    }
    
    public function select($from, $fields, $limit = '', $where = '', $orderby = '', $order = 'asc') {
        $fields = is_array($fields) ? join(',', $fields) : $fields;
        $sql = "SELECT $fields FROM $from";
        $sql .= ! empty($where) ? " WHERE $where" : "";
        $sql .= ! empty($orderby) ? " ORDER BY $orderby $order" : "";
        $sql .= ! empty($limit) ? " LIMIT $limit" : "";
        $result = $this->conn->query($sql);
        echo $this->conn->error;
        return $result;
    }
    
    public function get_rows($from, $fields='*', $limit = '', $where = '', $orderby = '', $order = 'asc') {
        $result = $this->select($from, $fields, $limit, $where, $orderby, $order);
        if ( $result->num_rows > 0 ) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
    
    public function get_rows_object($from, $fields='*', $limit = '', $where = '', $orderby = '', $order = 'asc') {
        $result = $this->select($from, $fields, $limit, $where, $orderby, $order);
        $infos = [];
        if ( $result->num_rows > 0 ) {
            while ( $info = $result->fetch_object() ) {
                $infos[] = $info;
            }
            return $infos;
        }
        return [];
    }
    
    public function raw($sql) {
        return $this->conn->query($sql);
    }
    
    public function rows_count($table, $where = ''): int {
        $sql = "SELECT COUNT(*) AS rows_count FROM $table";
        $sql .= ! empty($where) ? " WHERE $where" : "";
        $result = $this->conn->query($sql);
        if ( $result->num_rows > 0 )
            return $result->fetch_assoc()['rows_count'];
        return 0;
    }
    
    public function update($table, $field, $new_value, $where){
        $val = $this->prepare_value($new_value);
        $sql = "UPDATE $table SET $field=$val WHERE $where";
        $result = $this->conn->query($sql);
        if($result === TRUE)
            return true;
        else
            return $this->last_error();
    }
    
    public function last_error() {
        return $this->conn->error;
    }
    
    public function getValue($name, $value_field = 'value', $condition_field = 'name', $table = 'settings') {
        $sql = "SELECT $value_field FROM $table WHERE $condition_field='$name' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0)
            return $result->fetch_array()[0];
        return null;
    }
    
    private function isAssoc($arr) {
        if ( array() === $arr ) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
    
    private function prepare_values($values) {
        $out = [];
        foreach ($values as $value) {
            $out[] = $this->prepare_value($value);
        }
        return $out;
    }
    private function prepare_value($value) {
        if(is_string($value))
            return "'$value'";
        elseif($value == '')
            return 'null';
        elseif (is_bool($value))
            return $value ? 1 : 0;
        else
            return $value;
    }
}

global $db;
$db = new DB(DB_SERVER, DB_USER, DB_PASS, DB_NAME);