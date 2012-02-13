<?php

class Company_model extends CI_Model {

    private $id = '';
    private $name = '';
    private $address = '';
    private $phone_no = '';
    private $mobile_no = '';
    private $fax_no = '';
    private $email_address = '';
    private $website = '';
    private $logo = '';

    function __construct() {
        parent::__construct();
    }

    function set_id($val) {
        $this->id = $val;
    }

    function set_name($val) {
        $this->name = $val;
    }

    function set_address($val) {
        $this->address = $val;
    }

    function set_phone_no($val) {
        $this->phone_no = $val;
    }

    function set_mobile_no($val) {
        $this->mobile_no = $val;
    }

    function set_fax_no($val) {
        $this->fax_no = $val;
    }

    function set_email_address($val) {
        $this->email_address = $val;
    }

    function set_website($val) {
        $this->website = $val;
    }

    function set_logo($val) {
        $this->logo = $val;
    }

    function get_id() {
        return $this->id;
    }
    
    function get_name() {
        return $this->name;
    }
    
    function get_address() {
        return $this->address;
    }
    
    function get_phone_no() {
        return $this->phone_no;
    }
    
    function get_mobile_no() {
        return $this->mobile_no;
    }
    
    function get_fax_no() {
        return $this->fax_no;
    }
    
    function get_email_address() {
        return $this->email_address;
    }
    
    function get_website() {
        return $this->website;
    }
    
    function get_logo() {
        return $this->logo;
    }

    function getCompanyInfo() {
        $sql = "SELECT * FROM company limit 1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }       
    }
}

?>
