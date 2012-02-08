<?php

class Department_model extends CI_Model {

    private $id = '';
    private $name = '';
    
    function __construct() {
        parent::__construct();
    }

    function set_id($val) {
        $this->id = $val;
    }

    function set_name($val) {
        $this->name = $val;
    }
    
    function get_id() {
        return $this->id;
    }
    
    function get_name() {
        return $this->name;
    }
  
    function getDepartments() {
        $sql = "SELECT * FROM department";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->rows();
        } else {
            return false;
        }       
    }
}

?>
