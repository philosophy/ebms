<?php

    class Time_Records_model extends Employee_Base_Model {
        function time_in_user($options=array()) {
            if (empty($options)) {return false;}
            $now = date($this->config->item('date_format'));
            $this->db->trans_start();
            $sql = "INSERT INTO employee_time_records(record_date, time_in, employee_id, created_by, date_created, company_id) ".
                    "values (?, ?, ?, ?, ?, ?)";

            $this->db->query($sql, array(
                $now,
                $now,
                $options['employee_id'],
                $options['created_by'],
                $now,
                $options['company_id']
            ));
            $record_id = $this->db->insert_id();
            $this->db->trans_complete();

            return array('time_in' => $now, 'record_id' => $record_id);
        }

        function time_out_user($options=array()) {
            if (empty($options)) { return false; }
            $now = date($this->config->item('date_format'));

            $this->db->trans_start();
            if (isset($options['employee_id'])) {
                $this->db->where('employee_id', $options['employee_id']);
            }
            if (isset($options['id'])) {
                $this->db->where('id', $options['id']);
            }
            $this->db->set('last_updated_by', $options['last_updated_by']);
            $this->db->set('last_updated_at', $now);
            $this->db->set('time_out', $now);
            $this->db->update('employee_time_records');
            // insert to audit trail;

            $this->db->trans_complete();

            return array('time_out' => $now);
        }

        function get_time_records_list($options=array()) {
            if (isset($options['employee_id'])) {
                $this->db->where('employee_id', $options['employee_id']);
            }
            if (isset($options['company_id'])) {
                $this->db->where('company_id', $options['company_id']);
            }
            if (isset($options['current_day'])) {
                $this->db->where('date_created >= DATE_SUB(Now(), Interval 1 day)');
            }
            $this->db->select('*');
            $this->db->from('employee_time_records');
            $this->db->order_by('date_created', 'desc');

            $query = $this->db->get();
            return $query->result_array();
        }
    }

?>