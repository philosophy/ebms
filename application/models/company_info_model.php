<?php

class Company_info_model extends CI_Model {

    private $id = '';
    private $name = '';
    private $address = '';
    private $phone_no = '';
    private $mobile_no = '';
    private $fax_no = '';
    private $email_address = '';
    private $website = '';
    private $logo = '';
    private $table_name = 'company_info';

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
        $sql = "SELECT * FROM company_info limit 1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function company_infoExists() {
        $sql = "SELECT * FROM company_info WHERE id = ?";
        $query = $this->db->query($sql, array($this->get_id()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateCompany_info() {
        $data = array(
                    'name' => $this->get_name(),
                    'address' => $this->get_address(),
                    'phone_no' => $this->get_phone_no(),
                    'mobile_no' => $this->get_mobile_no(),
                    'fax_no' => $this->get_fax_no(),
                    'email_address' => $this->get_email_address(),
                    'website' => $this->get_website(),
                    'logo' => $this->get_logo()
                );

        $this->db->where('id', $this->get_id());

        /* insert audit UPDATE */
//        parent::insertAuditTrail($this->get_created_by(), 1, $query->row()->id, lang('create_new_unit'), $this->get_company_info_id(), $this->table_name);

        return $this->db->update('company_info', $data);
    }

}

?>
