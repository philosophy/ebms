<?php

    class Employees_model extends CI_Model {
        private $id;
        private $employee_code;
        private $first_name;
        private $middle_name;
        private $last_name;
        private $address;
        private $date_of_birth;
        private $gender;
        private $marital_status;
        private $home_phone;
        private $work_phone;
        private $date_hired;
        private $sss_no;
        private $tin_no;
        private $philhealth;
        private $pagibig;
        private $salary;
        private $active = 1;
        private $employee_status_id;
        private $department_id;
        private $position_id;
        private $created_by;
        private $date_created;
        private $last_updated_by;
        private $last_updated_at;
        private $company_id;
        private $work_experience = array();
        private $educational_background = array();
        private $table_name = 'employees';
        private $search = '';
        private $limit = 10;
        private $offset = 0;
        public $empPrefix = 'EMP-';

        function set_id($val) {
            $this->id = $val;
        }
        function set_employee_code($val) {
            $this->employee_code = trim($val);
        }
        function set_first_name($val) {
            $this->first_name = trim($val);
        }
        function set_middle_name($val) {
            $this->middle_name = trim($val);
        }
        function set_last_name($val) {
            $this->last_name = trim($val);
        }
        function set_address($val) {
            $this->address = trim($val);
        }
        function set_date_of_birth($val) {
            $this->date_of_birth = trim($val);
        }
        function set_gender($val) {
            $this->gender = $val;
        }
        function set_marital_status($val) {
            $this->marital_status = $val;
        }
        function set_home_phone($val) {
            $this->home_phone = trim($val);
        }
        function set_work_phone($val) {
            $this->work_phone = trim($val);
        }
        function set_date_hired($val) {
            $this->date_hired = trim($val);
        }
        function set_sss_no($val) {
            $this->sss_no = trim($val);
        }
        function set_tin_no($val) {
            $this->tin_no = trim($val);
        }
        function set_philhealth($val) {
            $this->philhealth = trim($val);
        }
        function set_pagibig($val) {
            $this->pagibig = trim($val);
        }
        function set_salary($val) {
            $this->salary = $val;
        }
        function set_active($val) {
            $this->active = $val;
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
        function set_work_experience($val) {
            $this->work_experience = $val;
        }
        function set_educational_background($val) {
            $this->educational_background = $val;
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
        function get_employee_code() {
            return $this->employee_code;
        }
        function get_first_name() {
            return $this->first_name;
        }
        function get_middle_name() {
            return $this->middle_name;
        }
        function get_last_name() {
            return $this->last_name;
        }
        function get_address() {
            return $this->address;
        }
        function get_date_of_birth() {
            return $this->date_of_birth;
        }
        function get_gender() {
            return (int)$this->gender;
        }
        function get_marital_status() {
            return (int)$this->marital_status;
        }
        function get_home_phone() {
            return $this->home_phone;
        }
        function get_work_phone() {
            return $this->work_phone;
        }
        function get_date_hired() {
            return $this->date_hired;
        }
        function get_sss_no() {
            return $this->sss_no;
        }
        function get_tin_no() {
            return $this->tin_no;
        }
        function get_philhealth() {
            return $this->philhealth;
        }
        function get_pagibig() {
            return $this->pagibig;
        }
        function get_salary() {
            return $this->salary;
        }
        function get_active() {
            return (int)$this->active;
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
        function get_work_experience() {
            return $this->work_experience;
        }
        function get_educational_background() {
            return $this->educational_background;
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

        function createEmployee(){
            $this->db->trans_start();
            $sql = "INSERT INTO employees (employee_code, first_name, middle_name, last_name, address, date_of_birth, gender, marital_status, home_phone, work_phone, date_hired, ".
                    "sss_no, tin_no, philhealth, pagibig, salary, employee_status_id, department_id, position_id, created_by, date_created, company_id) ".
                    "values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->db->query($sql,
                array(
                    $this->get_employee_code(),
                    $this->get_first_name(),
                    $this->get_middle_name(),
                    $this->get_last_name(),
                    $this->get_address(),
                    $this->get_date_of_birth(),
                    $this->get_gender(),
                    $this->get_marital_status(),
                    $this->get_home_phone(),
                    $this->get_work_phone(),
                    $this->get_date_hired(),
                    $this->get_sss_no(),
                    $this->get_tin_no(),
                    $this->get_philhealth(),
                    $this->get_pagibig(),
                    $this->get_salary(),
                    $this->get_employee_status_id(),
                    $this->get_department_id(),
                    $this->get_position_id(),
                    $this->get_created_by(),
                    date($this->config->item('date_format')),
                    $this->get_company_id(),
                ));

            $employee_id = $this->db->insert_id();

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
                            $this->get_created_by(),
                            date($this->config->item('date_format')),
                            $employee_id
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
                            $this->get_created_by(),
                            date($this->config->item('date_format')),
                            $employee_id
                        ));

            }

            parent::insertAuditTrail($this->get_created_by(), 1, $employee_id, lang('create_new_employee'), $this->get_company_id(), $this->table_name);

            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        function getMaxEmpId() {
            $sql = "SELECT max(id) as id from employees where company_id = ?";

            $query = $this->db->query($sql, array('company_id' => $this->get_company_id()));
            if($query->num_rows() > 0) {
                return (int)$query->row()->id;
            } else {
                return 0;
            }
        }

        function getEmployeesBySearch() {
            $sql = "SELECT e.*, d.name as department, p.name as position, s.name as status  FROM employees AS e INNER JOIN departments as d on d.id = e.department_id INNER JOIN employee_status AS s ON s.id = e.employee_status_id INNER JOIN positions AS p on p.id = e.position_id where e.company_id=? and e.first_name LIKE ? order by e.active desc, e.first_name LIMIT ? OFFSET ?";
            $query = $this->db->query($sql, array('company_id' => $this->get_company_id(), 'like' => '%'.$this->get_search().'%', 'LIMIT' => $this->get_limit(), 'OFFSET' => $this->get_offset()));

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return null;
            }
        }

        function getWorkExperience($id=null) {
            $sql = "SELECT * from work_experience where employee_id=?";
            $query = $this->db->query($sql, array('employee_id' => ($id != NULL) ? $id : $this->get_id()));
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return NULL;
            }
        }

        function getEducationalBackground($id=null) {
            $sql = "SELECT * from educational_background where employee_id=?";
            $query = $this->db->query($sql, array('employee_id' => ($id != NULL) ? $id : $this->get_id()));
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return NULL;
            }
        }

        function countEmployeesBySearch() {
            $sql = "SELECT * from employees where company_id = ? and (first_name like ? or last_name like ?)";
            $query = $this->db->query($sql, array(
               'company_id' => $this->get_company_id(),
               'first_name' => $this->get_search(),
               'last_name' => $this->get_search()
            ));
            return $query->num_rows();
        }

        function getEmployees() {
            $sql = "SELECT e.*, d.name as department, p.name as position, s.name as status  FROM employees AS e INNER JOIN departments as d on d.id = e.department_id INNER JOIN employee_status AS s ON s.id = e.employee_status_id INNER JOIN positions AS p on p.id = e.position_id where e.company_id=? order by e.active desc, e.first_name LIMIT ? OFFSET ?";
            $query = $this->db->query($sql, array('company_id' => $this->get_company_id(), 'LIMIT' => $this->get_limit(), 'OFFSET' => $this->get_offset()));
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return null;
            }
        }

        function getEmployeesData($options=array()) {
            if (isset($options['id'])) {
                $this->db->where('id', $options['id']);
            }

            if (isset($options['company_id'])) {
                $this->db->where('company_id', $options['company_id']);
            }

            $query = $this->db->get('employees');
            return $query->result_array();
        }

        function getEmployeesWithSchedule($options=array()) {
            $sql = "SELECT e.* FROM employees as e INNER JOIN employee_schedules AS es ON es.employee_id = e.id WHERE e.company_id = ?";
            $query = $this->db->query($sql, array('company_id' => $this->get_company_id()));

            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        }

        function getEmployeeDetails($options=array()) {
            $sql = "SELECT * FROM employees where id = ?";
            if (isset($options['employee_id'])) {
                $emp_id = $options['employee_id'];
            } else {
                $emp_id = $this->get_id();
            }
            $query = $this->db->query($sql, array('id' => $emp_id));

            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return null;
            }
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
