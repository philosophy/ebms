<?php

class Location_model extends CI_Model {

    private $id = '';
    private $name = '';
    private $created_by;
    private $date_created;
    private $last_updated_by;
    private $last_updated_at;
    private $active = 1;
    private $company_id;
    private $table_name = 'Locations';

    function __construct() {
        parent::__construct();
    }

    function set_id($val) {
        $this->id = $val;
    }

    function set_name($val) {
        $this->name = trim($val);
    }

    function set_active($val) {
        $this->active = $val;
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

    function set_company_id($val) {
        $this->company_id = $val;
    }

    function get_id() {
        return (int)$this->id;
    }

    function get_name() {
        return $this->name;
    }

    function get_created_by() {
        return $this->created_by;
    }

    function get_date_created() {
        return $this->date_created;
    }

    function get_last_updated_by() {
        return $this->last_updated_by;
    }

    function get_last_updated_at() {
        return $this->last_updated_at;
    }

    function get_active() {
        return $this->active;
    }

    function get_company_id() {
        return (int)$this->company_id;
    }

    function getLocations() {
        $sql = "SELECT * FROM location where active=? and company_id=?";
        $query = $this->db->query($sql, array('active' => $this->get_active(), 'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getLocationDetails($id) {
        $sql = "SELECT * FROM location where id=?";
        $query = $this->db->query($sql, array('id' => $id));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    function createLocation() {

        $this->db->trans_start();
        $sql = "INSERT INTO location (name, created_by, date_created, company_id) values (?, ?, ?, ?)";
        $this->db->query($sql,
            array(
                $this->get_name(),
                $this->get_created_by(),
                date($this->config->item('date_format')),
                $this->get_company_id()
            ));

        $sql = 'SELECT id from location where company_id = ? order by date_created desc limit 1';
        $query = $this->db->query($sql, array('company_id' => $this->get_company_id()));

        /* insert audit CREATE */
        parent::insertAuditTrail($this->get_created_by(), 1, $query->row()->id, lang('create_new_location'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function deactivateLocation() {
        $this->db->trans_start();
        $data = array('active' => 0);

        $this->db->where('id', $this->get_id());
        $this->db->update('locations', $data);

        /* insert audit DELETE */
        parent::insertAuditTrail($this->get_created_by(), 3, $this->get_id(), lang('deactivate_location'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function updateLocation() {
        $this->db->trans_start();
        $data = array(
            'name' => $this->get_name(),
            'last_updated_by' => $this->get_last_updated_by(),
            'last_updated_at' => date($this->config->item('date_format'))
        );

        $this->db->where('id', $this->get_id());
        $this->db->update('locations', $data);

        /* insert audit UPDATE */
        parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_id(), lang('update_location'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function restoreLocation() {
        $this->db->trans_start();
        $data = array('active' => 1,
            'last_updated_by' => $this->get_last_updated_by(),
            'last_updated_at' => date($this->config->item('date_format')
        ));

        $this->db->where('id', $this->get_id());
        $this->db->update('locations', $data);

        /* insert audit */
        parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_id(), lang('restore_location'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    function locationExists() {
        $sql = "SELECT * FROM location where name = ? and company_id = ?";
        $query = $this->db->query($sql, array('name' => $this->get_name(), 'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function recordExists() {
        $sql = "SELECT * FROM location where id!=? and name=? and company_id=?";
        $query = $this->db->query($sql, array('id' => $this->get_id(), 'name' => $this->get_name(), 'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>
