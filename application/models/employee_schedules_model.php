<?php

    class Employee_Schedules_model extends Employee_Base_Model {

        public function __construct() {
            parent::__construct();
        }
        public $days_of_week = array(1=>'Monday', 2=>'Tuesday', 3=>'Wednesday', 4=>'Thursday', 5=>'Friday', 6=>'Saturday', 7=>'Sunday');

        private $id;
        private $days;
        private $start_time;
        private $end_time;
        private $start_break_time;
        private $end_break_time;
        private $active = 1;
        private $employee_id;
        private $employee_status_id;
        private $department_id;
        private $position_id;
        private $created_by;
        private $date_created;
        private $last_updated_by;
        private $last_updated_at;
        private $table_name = 'employee_schedule';
        private $search = '';

        function set_id($val) {
            $this->id = $val;
        }
        function set_days($val) {
            $this->days = $val;
        }
        function set_start_time($val) {
            $this->start_time = $val;
        }
        function set_end_time($val) {
            $this->end_time = $val;
        }
        function set_start_break_time($val) {
            $this->start_break_time = $val;
        }
        function set_end_break_time($val) {
            $this->end_break_time = $val;
        }
        function set_active($val) {
            $this->active = $val;
        }
        function set_employee_id($val) {
            $this->employee_id = trim($val);
        }
        function set_employee_status_id($val) {
            $this->employee_status_id = trim($val);
        }
        function set_department_id($val) {
            $this->department_id = trim($val);
        }
        function set_position_id($val) {
            $this->position_id = trim($val);
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
        function set_limit($val) {
            $this->limit = $val;
        }
        function set_offset($val) {
            $this->offset = $val;
        }
        function set_search($val) {
            $this->search = trim($val);
        }
        function get_id() {
            return (int)$this->id;
        }
        function get_days() {
            return $this->days;
        }
        function get_start_time() {
            return $this->start_time;
        }
        function get_end_time() {
            return $this->end_time;
        }
        function get_start_break_time() {
            return $this->start_break_time;
        }
        function get_end_break_time() {
            return $this->end_break_time;
        }
        function get_active() {
            return (int)$this->active;
        }
        function get_employee_id() {
            return (int)$this->employee_id;
        }
        function get_employee_status_id() {
            return (int)$this->employee_status_id;
        }
        function get_department_id() {
            return (int)$this->department_id;
        }
        function get_position_id() {
            return (int)$this->position_id;
        }
        function get_created_by() {
            return (int)$this->created_by;
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
        function get_company_id() {
            return (int)$this->company_id;
        }
        function get_limit() {
            return (int)$this->limit;
        }
        function get_offset() {
            return (int)$this->offset;
        }
        function get_search() {
            return $this->search;
        }

        function createEmployeeSchedule(){
            $this->db->trans_start();
                foreach($this->get_days() as $day) {
                    $sql = "INSERT INTO employee_schedules (day, start_time, end_time, start_break_time, end_break_time, ".
                        "created_by, date_created, company_id, employee_id) ".
                        "values (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $this->db->query($sql,
                        array(
                            $day,
                            $this->get_start_time(),
                            $this->get_end_time(),
                            $this->get_start_break_time(),
                            $this->get_end_break_time(),
                            $this->get_created_by(),
                            date($this->config->item('date_format')),
                            $this->get_company_id(),
                            $this->get_employee_id()
                        ));

                    $employee_id = $this->db->insert_id();

                    parent::insertAuditTrail($this->get_created_by(), 1, $employee_id, lang('create_new_employee_schedule'), $this->get_company_id(), $this->table_name);
                }

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        function getEmployeeScheduleBySearch() {
            $sql = "SELECT e.*, d.name as department, p.name as position, s.name as status  FROM employees AS e INNER JOIN departments as d on d.id = e.department_id INNER JOIN employee_status AS s ON s.id = e.employee_status_id INNER JOIN positions AS p on p.id = e.position_id where e.company_id=? and e.first_name LIKE ? order by e.active desc, e.first_name LIMIT ? OFFSET ?";
            $query = $this->db->query($sql, array('company_id' => $this->get_company_id(), 'like' => '%'.$this->get_search().'%', 'LIMIT' => $this->get_limit(), 'OFFSET' => $this->get_offset()));

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return null;
            }
        }

        function countEmployeeScheduleBySearch() {
            $sql = "SELECT * from employees where company_id = ? and (first_name like ? or last_name like ?)";
            $query = $this->db->query($sql, array(
               'company_id' => $this->get_company_id(),
               'first_name' => $this->get_search(),
               'last_name' => $this->get_search()
            ));
            return $query->num_rows();
        }

        function getEmployeesWithSchedule() {
            $sql = "SELECT distinct e.* FROM employees AS e INNER JOIN employee_schedules as sched on sched.employee_id = e.id where e.company_id=? order by e.active desc, e.first_name LIMIT ? OFFSET ?";
            $query = $this->db->query($sql, array('company_id' => $this->get_company_id(), 'LIMIT' => $this->get_limit(), 'OFFSET' => $this->get_offset()));

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return null;
            }
        }

        function getEmployeeDetails() {
            $sql = "SELECT * FROM employees where id = ?";
            $query = $this->db->query($sql, array('id' => $this->get_id()));

            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return null;
            }
        }

        function getEmployeeSched($options=array()) {
            if (isset($options['employee_id'])) {
                $this->db->where('employee_id', $options['employee_id']);
            }

            $this->db->select('sched.*');
            $this->db->from('employees');
            $this->db->join('employee_schedules as sched', 'employees.id = sched.employee_id');

            $query = $this->db->get();
            return $query->result_array();
        }

        function updateGeneralInfo() {
            $this->db->trans_start();

            $data = array(
                'first_name' => $this->get_first_name(),
                'middle_name' => $this->get_middle_name(),
                'last_name' => $this->get_last_name(),
                'address' => $this->get_address(),
                'date_of_birth' => $this->get_date_of_birth(),
                'gender' => $this->get_gender(),
                'marital_status' => $this->get_marital_status(),
                'home_phone' => $this->get_home_phone(),
                'work_phone' => $this->get_work_phone(),
                'last_updated_by' => $this->get_last_updated_by(),
                'last_updated_at' => date($this->config->item('date_format'))
            );

            $this->db->where('id', $this->get_id());
            $this->db->update('employees', $data);

            /* insert audit UPDATE */
            parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_id(), lang('update_employee'), $this->get_company_id(), $this->table_name);

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        function updateEmployee() {
            $this->db->trans_start();
            $id = $this->get_id();
            $date_hired = $this->get_date_hired();
            $dept_id = $this->get_department_id();
            $pos_id = $this->get_position_id();
            $emp_status_id = $this->get_employee_status_id();
            $salary = $this->get_salary();
            $sss_no = $this->get_sss_no();
            $philhealth = $this->get_philhealth();
            $tin_no = $this->get_tin_no();
            $pagibig = $this->get_pagibig();
            $active = $this->get_active();

            if (isset($id)) {
                $this->db->where('id', $id);
            }
            if (isset($date_hired)) {
                $this->db->set('date_hired', $date_hired);
            }
            if (isset($dept_id) && $dept_id != 0 ) {
                $this->db->set('department_id', $dept_id);
            }
            if (isset($pos_id) && $pos_id != 0) {
                $this->db->set('position_id', $pos_id);
            }
            if (isset($emp_status_id) && $emp_status_id != 0) {
                $this->db->set('employee_status_id', $emp_status_id);
            }
            if (isset($salary)) {
                $this->db->set('salary', $salary);
            }
            if (isset($sss_no)) {
                $this->db->set('sss_no', $sss_no);
            }
            if (isset($philhealth)) {
                $this->db->set('philhealth', $philhealth);
            }
            if (isset($tin_no)) {
                $this->db->set('tin_no', $tin_no);
            }
            if (isset($pagibig)) {
                $this->db->set('pagibig', $pagibig);
            }
            if (isset($active)) {
                $this->db->set('active', $active);
            }

            $this->db->update('employees');

            /* insert into work experience */
            foreach($this->get_work_experience() as $exp) {
                $sql = 'INSERT INTO work_experience (company_name, date_started, date_ended, work_description, created_by, date_created, employee_id) '.
                       'values (?, ?, ?, ?, ?, ?, ?)';

                $this->db->query($sql,
                        array(
                            $exp['company_name'],
                            $exp['date_started'],
                            $exp['date_ended'],
                            $exp['work_description'],
                            $this->get_last_updated_by(),
                            date($this->config->item('date_format')),
                            $id
                        ));
            }

            /* insert education */
            foreach($this->get_educational_background() as $edu) {
                $sql = 'INSERT INTO educational_background (school_name, date_graduated, remarks, created_by, date_created, employee_id) '.
                       'values (?, ?, ?, ?, ?, ?)';

                $this->db->query($sql,
                        array(
                            $edu['school_name'],
                            $edu['date_graduated'],
                            $edu['remarks'],
                            $this->get_last_updated_by(),
                            date($this->config->item('date_format')),
                            $id
                        ));

            }

            /* insert audit UPDATE */
            parent::insertAuditTrail($this->get_last_updated_by(), 2, $this->get_id(), lang('update_employee'), $this->get_company_id(), $this->table_name);

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        function deactivateEmployee() {
            $this->db->trans_start();
            $data = array('active' => 0);

            $this->db->where('id', $this->get_id());
            $this->db->update('employees', $data);

            /* insert audit DELETE */
            parent::insertAuditTrail($this->get_created_by(), 3, $this->get_id(), lang('delete_employee'), $this->get_company_id(), $this->table_name);

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        function restoreEmployee() {
            $this->db->trans_start();
            $data = array('active' => 1);

            $this->db->where('id', $this->get_id());
            $this->db->update('employees', $data);

            /* insert audit DELETE */
            parent::insertAuditTrail($this->get_created_by(), 2, $this->get_id(), lang('restore_employee'), $this->get_company_id(), $this->table_name);

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        function countEmployees() {
            $query = $this->db->get_where('employees', array('company_id'=>$this->get_company_id()));
            return $query->num_rows();
        }

        function recordExists($id=null) {
            $query = $this->db->get_where('employees', array('company_id'=>$this->get_company_id(), 'id'=>$id));
            return $query->num_rows();
        }

        function deleteWorkExperience($id) {
            $this->db->trans_start();

            $this->db->where('id', $id);
            $this->db->delete('work_experience');

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        function deleteEducationalBackground($id) {
            $this->db->trans_start();

            $this->db->where('id', $id);
            $this->db->delete('educational_background');

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        function _required($required, $data) {
            foreach ($required as $field) {
                if (!isset($data[$field])) {
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

?>
