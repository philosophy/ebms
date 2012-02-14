<?php

class Deduction_manager extends CI_Model {

    private $no = '';
    private $name = '';
    private $description = '';
    private $deleted = '';
    private $flag = '';
    
    function __construct() {
        parent::__construct();
    }

    function set_no($val) {
        $this->no = $val;
    }

    function set_name($val) {
        $this->name = $val;
    }
    
    function set_description($val) {
        $this->description = $val;
    }
    
    function set_deleted($val) {
        $this->deleted = $val;
    }
    
    function set_flag($val) {
        $this->flag = $val;
    }
    
    function get_no() {
        return $this->no;
    }
    
    function get_name() {
        return $this->name;
    }
    
    function get_description() {
        return $this->description;
    }
    
    function get_deleted() {
        return $this->deleted;
    }
    
    function get_flag() {
        return $this->flag;
    }
    
    function getDeductionInfo() {
        $sql = "SELECT * FROM deduction limit 1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }       
    }
}

?>
