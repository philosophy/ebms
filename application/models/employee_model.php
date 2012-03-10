<?php

    class Employee extends CI_Model {
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
        private $active;
        private $employee_status_id;
        private $department_id;
        private $position_id;
        private $created_by;
        private $date_created;
        private $last_updated_by;
        private $last_updated_at;
        private $company_id;
        
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
            $this->company_id = trim($val);
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
            return int($this->gender);
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
            return $this->active;
        }
        function get_employee_status_id() {
            return $this->employee_status_id;
        }
        function get_department_id() {
            return $this->department_id;
        }
        function get_position_id() {
            return $this->position_id;
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
        function get_company_id() {
            return $this->company_id;
        }        
    }

?>
