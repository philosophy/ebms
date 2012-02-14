<?php

class Category_type_manager extends CI_Model {

    private $id = '';
    private $name = '';
    private $deleted = '';
    private $code = '';
    
    function __construct() {
        parent::__construct();
    }

    function set_id($val) {
        $this->id = $val;
    }

    function set_name($val) {
        $this->name = $val;
    }
    
    function set_deleted($val) {
        $this->deleted = $val;
    }
    
    function set_code($val) {
        $this->code = $val;
    }
    
    function get_id() {
        return $this->id;
    }
    
    function get_name() {
        return $this->name;
    }
    
    function get_deleted() {
        return $this->deleted;
    }
    
    function get_code() {
        return $this->code;
    }
    
    function getCustomerTypeInfo() {
        $sql = "SELECT * FROM customer_type limit 1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }       
    }
}

?>
