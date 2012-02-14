<?php

class Currency_manager extends CI_Model {

    private $id = '';
    private $name = '';
    private $symbol = '';
    private $deleted = '';
    private $flag = '';
    
    function __construct() {
        parent::__construct();
    }

    function set_id($val) {
        $this->id = $val;
    }

    function set_name($val) {
        $this->name = $val;
    }
    
    function set_symbol($val) {
        $this->symbol = $val;
    }
    
    function set_deleted($val) {
        $this->deleted = $val;
    }
    
    function set_flag($val) {
        $this->flag = $val;
    }
    
    function get_id() {
        return $this->id;
    }
    
    function get_name() {
        return $this->name;
    }
    
    function get_symbol() {
        return $this->symbol;
    }
    
    function get_deleted() {
        return $this->deleted;
    }
    
    function get_flag() {
        return $this->flag;
    }
    
    function getSymbolInfo() {
        $sql = "SELECT * FROM symbol limit 1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }       
    }
}

?>
