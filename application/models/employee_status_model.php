<?php

class Employee_status_manager extends CI_Model {

    private $id = '';
    private $status = '';
    
    function __construct() {
        parent::__construct();
    }

    function set_id($val) {
        $this->id = $val;
    }

    function set_status($val) {
        $this->status = $val;
    }
    
    function get_id() {
        return $this->id;
    }
    
    function get_status() {
        return $this->status;
    }
    
    function getEmployeeStatusInfo() {
        $sql = "SELECT * FROM employee_status limit 1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }       
    }
}

?>
