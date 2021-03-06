<?php

class Product_model extends CI_Model {

    private $details;               /* additional info */
    private $user_id;
    private $subject_id;            /* user_id, employee_id, product_id */
    private $type;                  /* Actions: 1=add, 2=edit/update, 3=delete */
    private $date_created;
    private $from_date;
    private $to_date;
    private $limit = 10;
    private $offset = 0;                /* start of data row selection */
    private $company_id;
    private $table_name;

    function __construct() {
        parent::__construct();
    }

    function set_details($val) {
        $this->details = trim($val);
    }

    function set_user_id($val) {
        $this->user_id = trim($val);
    }

    function set_subject_id($val) {
        $this->subject_id = trim($val);
    }

    function set_type($val) {
        $this->type = trim($val);
    }

    function set_date_created($val) {
        $this->date_created = trim($val);
    }

    function set_from_date($val) {
        $this->from_date = trim($val);
    }

    function set_to_date($val) {
        $this->to_date = trim($val);
    }

    function set_limit($val) {
        $this->limit = trim($val);
    }

    function set_offset($val) {
        $this->offset = $val;
    }
    function set_company_id($val) {
        $this->company_id = $val;
    }
    function set_table_name($val) {
        $this->table_name = $val;
    }

    function get_details() {
        return $this->details;
    }
    function get_user_id() {
        return $this->user_id;
    }
    function get_subject_id() {
        return $this->subject_id;
    }
    function get_type() {
        return $this->type;
    }
    function get_date_created() {
        return $this->date_created;
    }
    function get_from_date() {
        return $this->from_date;
    }
    function get_to_date() {
        return $this->to_date;
    }
    function get_limit() {
        return (int)$this->limit;
    }
    function get_offset() {
        return (int)$this->offset;
    }
    function get_company_id() {
        return (int)$this->company_id;
    }
    function get_table_name() {
        return $this->table_name;
    }

    function insertUserActions() {
        $sql = "INSERT INTO audit_trail (details, user_id, subject_id, type, date_created, company_id, table_name) values (?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->query($sql,
                array(
                    $this->get_details(),
                    $this->get_user_id(),
                    $this->get_subject_id(),
                    $this->get_type(),
                    $this->get_date_created(),
                    $this->get_company_id(),
                    $this->get_table_name()
                ));

        return $this->db->affected_rows();
    }

    function countUserActions() {
        $query = $this->db->query('SELECT * FROM audit_trail');
        return $query->num_rows();
    }

    function getUserActions() {
        $sql = "SELECT * FROM audit_trail as trail inner join users as u where u.id = trail.user_id LIMIT ? OFFSET ?";
        $query = $this->db->query($sql, array($this->get_limit(), $this->get_offset()));

        return $query->result();
    }

    function getUserActionsByDate() {
//        $sql = "SELECT * FROM audit_trail as trail inner join users as u where u.id = trail.user_id and  LIMIT ? OFFSET ?"
    }

}

?>
