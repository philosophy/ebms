<?php

    class Employee_Leaves_model extends CI_Model {

        private $table_name = 'employee_leaves';

        function __construct() {
            parent::__construct();
        }

        function create_employee_leave($options=array()) {

            $this->db->trans_start();
            $this->db->insert('employee_leaves', $options);

            $id = $this->db->insert_id();

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                //insert audit trail
                parent::insertAuditTrail($options['created_by'], 1, $id, lang('created_new_employee_leave'), $options['company_id'], $this->table_name);
                return true;
            } else {
                return false;
            }
        }

        function update_leave($options=array()) {

            $this->db->trans_start();
            if (isset($options['id'])) {
                $this->db->where('id', $options['id']);
            }
            if (isset($options['company_id'])) {
                $this->db->where('company_id', $options['company_id']);
            }
            if (isset($options['name'])) {
                $this->db->set('name', $options['name']);
            }
            if (isset($options['days'])) {
                $this->db->set('days', $options['days']);
            }
            if (isset($options['employee_id'])) {
                $this->db->set('last_updated_by', $options['employee_id']);
            }
            if (isset($options['last_updated_at'])) {
                $this->db->set('last_updated_at', $options['last_updated_at']);
            }
            if (isset($options['active'])) {
                $this->db->set('active', $options['active']);
            }

            $this->db->update('leaves');
            $this->db->trans_complete();

            if ($this->db->trans_status() === TRUE) {
                //update audit trail
//                parent::insertAuditTrail($options['created_by'], 1, $id, lang('created_new_leave'), $options['company_id'], $this->table_name);
                return true;
            } else {
                return false;
            }
        }

        function get_leaves_list($options=array()) {
            if (isset($options['company_id'])) {
                $this->db->where('company_id', $options['company_id']);
            }
            if (isset($options['active'])) {
                $this->db->where('active', $options['active']);
            } else {
                $this->db->where('active', 1);
            }
            if (isset($options['id'])) {
                $this->db->where('id', $options['id']);
            }

            $this->db->order_by('name', 'asc');
            $query = $this->db->get('leaves');

            return $query->result();
        }

    }
?>
