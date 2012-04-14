<?php

class Brand_model extends CI_Model {

    private $id = '';
    private $name = '';
    private $created_by;
    private $date_created;
    private $last_updated_by;
    private $last_updated_at;
    private $active = 1;
    private $company_id;
    private $table_name = 'brands';
    private $sub_category_id;

    function __construct() {
        parent::__construct();
    }

    function set_id($val) {
        $this->id = $val;
    }
    function set_code($val) {
        $this->code = trim($val);
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
    function set_sub_category_id($val) {
        $this->sub_category_id = $val;
    }
    function set_category_id($val) {
        $this->category_id = $val;
    }

    function get_id() {
        return (int)$this->id;
    }
    function get_code() {
        return $this->code;
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
    function get_sub_category_id() {
        return (int)$this->sub_category_id;
    }
    function get_category_id() {
        return (int)$this->category_id;
    }

    function getCategories() {
        $sql = "SELECT * FROM category where active=? and company_id=?";
        $query = $this->db->query($sql, array('active' => $this->get_active(), 'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getSubCategoriesByCategory() {
        $sql = "SELECT * FROM sub_category where active=? and company_id=?";
        $query = $this->db->query($sql, array('active' => $this->get_active(), 'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getSubCategories() {
        $sql = "SELECT * FROM sub_category where active=? and company_id=?";
        $query = $this->db->query($sql, array('active' => $this->get_active(), 'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getBrands() {
        $sql = "SELECT b.id as id, b.name as name, s.name as sub_category, c.name as category FROM brands as b inner join sub_category as s inner join category as c where b.sub_category_id = s.id and c.id = s.category_id and b.active=? and s.company_id=?";
        $query = $this->db->query($sql, array('active' => $this->get_active(), 'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getBrandDetails($id) {
        $sql = "SELECT b.id as id, b.name as name, b.sub_category_id, s.name as sub_category, c.name as category FROM brands as b inner join sub_category as s inner join category as c where b.sub_category_id = s.id and c.id = s.category_id and b.id = ?";
        $query = $this->db->query($sql, array('id' => (int)$id));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    function createBrand() {
        $this->db->trans_start();
        $sql = "INSERT INTO brands (name, created_by, date_created, company_id, sub_category_id) values (?, ?, ?, ?, ?)";
        $this->db->query($sql,
            array(
                $this->get_name(),
                $this->get_created_by(),
                date($this->config->item('date_format')),
                $this->get_company_id(),
                $this->get_sub_category_id()
            ));

        $sql = 'SELECT id from brands where company_id = ? and sub_category_id = ? order by date_created desc limit 1';
        $query = $this->db->query($sql, array('company_id' => $this->get_company_id(), 'sub_category_id' => $this->get_sub_category_id()));

        /* insert audit CREATE */
        parent::insertAuditTrail($this->get_created_by(), 1, $query->row()->id, lang('create_new_brand'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function deactivateBrand() {
        $this->db->trans_start();
        $data = array('active' => 0);

        $this->db->where('id', $this->get_id());
        $this->db->update('brands', $data);

        /* insert audit DELETE */
        parent::insertAuditTrail($this->get_created_by(), 3, $this->get_id(), lang('deactivate_brand'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function updateBrand() {
        $this->db->trans_start();
        $data = array(
            'name' => $this->get_name(),
            'sub_category_id' => $this->get_sub_category_id(),
            'last_updated_by' => $this->get_last_updated_by(),
            'last_updated_at' => date($this->config->item('date_format'))
        );

        $this->db->where('id', $this->get_id());
        $this->db->update('brands', $data);

        /* insert audit UPDATE */
        parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_id(), lang('update_brand'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function restoreBrand() {
        $this->db->trans_start();
        $data = array('active' => 1,
            'last_updated_by' => $this->get_last_updated_by(),
            'last_updated_at' => date($this->config->item('date_format')
        ));

        $this->db->where('id', $this->get_id());
        $this->db->update('brands', $data);

        /* insert audit */
        parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_id(), lang('restore_brand'), $this->get_company_id(), $this->table_name);

        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            return true;
        } else {
            return false;
        }
    }


    function brandExists() {
        $sql = "SELECT * FROM brands where name = ? and company_id = ?";
        $query = $this->db->query($sql, array('name' => $this->get_name(), 'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function recordExists() {
        $sql = "SELECT * FROM brands where name = ? and id!=? and company_id=?";
        $query = $this->db->query($sql, array('name' => $this->get_name(), 'id' => $this->get_id(),  'company_id' => $this->get_company_id()));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>
