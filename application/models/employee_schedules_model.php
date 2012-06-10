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

        function create_employee_schedule($options=array()) {
            $this->db->trans_start();
            $sql = "INSERT INTO employee_schedules(day, start_time, end_time, start_break_time, end_break_time, ".
                    "created_by, date_created, company_id, employee_id) ".
                    "values (?, ?, ?, ?, ?, ?, ?, ? ,?)";

            $this->db->query($sql, array(
                $options['day'],
                $options['start_time'],
                $options['end_time'],
                $options['start_break_time'],
                $options['end_break_time'],
                $options['created_by'],
                date($this->config->item('date_format')),
                $options['company_id'],
                $options['employee_id']
            ));

            $this->db->trans_complete();
            return $this->db->trans_status();
        }

        function get_schedule_info($options=array()){
            if (isset($options['id'])) {
                $this->db->where('id', $options['id']);
            }

            $this->db->select('*');
            $this->db->from('employee_schedules');

            $query = $this->db->get();
            return $query->result_array();
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
            $sql = "SELECT distinct e.* FROM employees AS e INNER JOIN employee_schedules as sched on sched.employee_id = e.id where e.company_id=? order by e.first_name, sched.day asc LIMIT ? OFFSET ?";
            $query = $this->db->query($sql, array('company_id' => $this->get_company_id(), 'LIMIT' => $this->get_limit(), 'OFFSET' => $this->get_offset()));

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return null;
            }
        }

        function get_employees_by_search($name) {
            $sql = "SELECT distinct e.* FROM employees AS e INNER JOIN employee_schedules as sched on sched.employee_id = e.id where e.company_id=? and e.first_name LIKE ? order by e.first_name, sched.day asc LIMIT ? OFFSET ?";
            $query = $this->db->query($sql, array('company_id' => $this->get_company_id(), $name, 'LIMIT' => $this->get_limit(), 'OFFSET' => $this->get_offset()));

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

        function record_exists($options=array()) {
            if (isset($options['employee_id'])) {
                $this->db->where('employee_id', (int)$options['employee_id']);
            }
            if (isset($options['day'])) {
                $this->db->where('day', $options['day']);
            }
            if (isset($options['id'])) {
                $this->db->where('id', (int)$options['id']);
            }
            $this->db->select('*');
            $this->db->from('employee_schedules');
            $query = $this->db->get();

            return $query->result_array();
        }

        function update_employee_schedule($options=array()) {
            $this->db->trans_start();
            if (isset($options['employee_id'])) {
                $this->db->where('employee_id', $options['employee_id']);
            }
            if (isset($options['day'])) {
                $this->db->where('day', $options['day']);
            }

            if (isset($options['id'])) {
                $this->db->where('id', $options['id']);
            }

            if (isset($options['start_time'])) {
                $this->db->set('start_time', $options['start_time']);
            }
            if (isset($options['end_time'])) {
                $this->db->set('end_time', $options['end_time']);
            }
            if (isset($options['start_break_time'])) {
                $this->db->set('start_break_time', $options['start_break_time']);
            }
            if (isset($options['end_break_time'])) {
                $this->db->set('end_break_time', $options['end_break_time']);
            }
            $this->db->update('employee_schedules');

            /* insert audit UPDATE */
//            parent::insertAuditTrail($options['last_updated_by'], 2, $this->get_id(), lang('update_employee'), $this->get_company_id(), $this->table_name);

            $this->db->trans_complete();

            if ($this->db->trans_status()) {
                return true;
            } else {
                return false;
            }
        }
    }

?>
