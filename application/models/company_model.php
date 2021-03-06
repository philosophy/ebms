<?php

class Company_model extends CI_Model {

    private $id = '';
    private $name = '';
    private $created_by;
    private $date_created;
    private $last_updated_by;
    private $last_updated_at;
    private $active = 1;
    private $company_id;
    private $table_name = 'company';

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

    function getCompanies() {
        $sql = "SELECT * FROM company where active=?";
        $query = $this->db->query($sql, array('active' => $this->get_active()));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getCompanyDetails($id) {
        $sql = "SELECT * FROM company where id=?";
        $query = $this->db->query($sql, array('id' => $id));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    function createCompany() {

        $this->db->trans_start();
        $sql = "INSERT INTO company (name, created_by, date_created) values (?, ?, ?)";
        $this->db->query($sql,
            array(
                $this->get_name(),
                $this->get_created_by(),
                date($this->config->item('date_format'))
            ));

        $query = $this->db->query('SELECT id from company order by date_created desc limit 1');
        $company_id = $this->db->insert_id();
        /* insert audit CREATE */
        parent::insertAuditTrail($this->get_created_by(), 1, $company_id, lang('create_new_company'), $company_id, $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function deactivateCompany() {
        $this->db->trans_start();
        $data = array('active' => 0);

        $this->db->where('id', $this->get_id());
        $this->db->update('company', $data);

        /* insert audit DELETE */
        parent::insertAuditTrail($this->get_created_by(), 3, $this->get_id(), lang('deactivate_company'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function updateCompany() {
        $this->db->trans_start();
        $data = array(
            'name' => $this->get_name(),
            'last_updated_by' => $this->get_last_updated_by(),
            'last_updated_at' => date($this->config->item('date_format'))
        );

        $this->db->where('id', $this->get_id());
        $this->db->update('company', $data);

        /* insert audit UPDATE */
        parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_id(), lang('update_company'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function restoreCompany() {
        $this->db->trans_start();
        $data = array('active' => 1,
            'last_updated_by' => $this->get_last_updated_by(),
            'last_updated_at' => date($this->config->item('date_format')
        ));

        $this->db->where('id', $this->get_id());
        $this->db->update('company', $data);

        /* insert audit */
        parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_id(), lang('restore_company'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    function companyExists() {
        $sql = "SELECT * FROM company where name = ?";
        $query = $this->db->query($sql, array('name' => $this->get_name()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function recordExists() {
        $sql = "SELECT * FROM company where id!=? and name=?";
        $query = $this->db->query($sql, array('id' => $this->get_id(), 'name' => $this->get_name()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>
