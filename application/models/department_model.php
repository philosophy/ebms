<?php

class Department_model extends CI_Model {

    private $id = '';
    private $name = '';
    private $created_by;
    private $date_created;
    private $last_updated_by;
    private $last_updated_at;
    private $active = 1;

    function __construct() {
        parent::__construct();
    }

    function set_id($val) {
        $this->id = $val;
    }
    function set_name($val) {
        $this->name = $val;
    }
    function set_created_by($val) {
        $this->created_by = $val;
    }
    function set_date_created($val) {
        $this->date_created = $val;
    }
    function set_last_updated_by($val) {
        $this->last_updated_by = $val;
    }
    function set_last_updated_at($val) {
        $this->last_updated_at = $val;
    }
    function set_active($val) {
        $this->active = $val;
    }

    function get_id() {
        return (int)$this->id;
    }
    function get_name() {
        return $this->name;
    }
    function get_created_by() {
        return (int)$this->created_by;
    }
    function get_date_created() {
        return $this->date_created;
    }
    function get_last_updated_by() {
        return (int)$this->last_updated_by;
    }
    function get_last_updated_at() {
        return $this->last_updated_at;
    }
    function get_active() {
        return (int)$this->active;
    }

    function getDepartments() {
        $sql = "SELECT * FROM departments where active=?";
        $query = $this->db->query($sql, array('active' => $this->get_active()));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getDepartment($id) {
        $sql = "SELECT * FROM departments where id = ?";
        $query = $this->db->query($sql, array('id' => $id));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    function createDepartment() {
        $sql = "INSERT INTO departments (name, created_by, date_created) values (?, ?, ?)";
        $query = $this->db->query($sql,
                array(
                    $this->get_name(),
                    $this->get_created_by(),
                    date($this->config->item('date_format'))
                ));

        return $this->db->affected_rows();
    }

    function deactivateDepartment() {
        $this->db->trans_start();
        $data = array('active' => 0);

        $this->db->where('id', $this->get_id());
        $this->db->update('departments', $data);

        /* insert audit */
        parent::insertAuditTrail($this->current_avatar->id, 3, $this->get_id(), lang('deactivate_department'));

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function restoreDepartment() {
        $this->db->trans_start();
        $data = array('active' => 1);

        $this->db->where('id', $this->get_id());
        $this->db->update('departments', $data);

        /* insert audit */
        parent::insertAuditTrail($this->current_avatar->id, 2, $this->get_id(), lang('restore_department'));

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function departmentExists() {
        $sql = "SELECT * FROM departments where id != ? and name = ?";
        $query = $this->db->query($sql, array('id' => $this->get_id(), 'name' => $this->get_name()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function updateDepartment() {
        $this->db->trans_start();
        $data = array(
            'name' => $this->get_name(),
            'last_updated_by' => $this->get_last_updated_by(),
            'last_updated_at' => date($this->config->item('date_format'))
        );

        $this->db->where('id', $this->get_id());
        $this->db->update('departments', $data);

        /* insert audit */
        parent::insertAuditTrail($this->current_avatar->id, 2, $this->get_id(), lang('update_department'));

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

}

?>
