<?php
    class Employees extends Application {

        public $employment_status;
        private $employeeObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Employee_status_model');
            $this->load->model('Department_model');
            $this->load->model('Position_model');
            $this->load->model('Employees_model');
            $this->employeeObj = new $this->Employees_model();
        }

        function index() {
            $data['content'] = 'personnel/employee/profile';
            $data['title'] = lang('employee_profile');
            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }

        function get_new_employee_form() {
            $this->Employee_status_model->set_company_id($this->current_avatar->company_id);
            $this->Department_model->set_company_id($this->current_avatar->company_id);
            $this->Position_model->set_company_id($this->current_avatar->company_id);

            $this->employment_status = $this->Employee_status_model->getEmployeeStatus();
            $this->positions = $this->Position_model->getPositions();
            $this->departments = $this->Department_model->getDepartments();

            send_json_response(INFO_LOG, HTTP_OK, 'new employee form', array('html' => $this->load->view('personnel/employee/_new_employee_form', '', true)));
        }

        function create() {
            $first_name = $this->input->post('first_name', TRUE);
            $middle_name = $this->input->post('middle_name', TRUE);
            $last_name = $this->input->post('last_name', TRUE);
            $address = $this->input->post('address', TRUE);
            $date_of_birth = $this->input->post('date_of_birth', TRUE);
            $gender = $this->input->post('gender', TRUE);
            $marital_status = $this->input->post('marital_status', TRUE);
            $home_phone = $this->input->post('home_phone', TRUE);
            $work_phone = $this->input->post('work_phone', TRUE);
            $date_hired = $this->input->post('date_hired', TRUE);
            $department = $this->input->post('department', TRUE);
            $position = $this->input->post('position', TRUE);
            $employment_status = $this->input->post('employment_status');

            $work_exp = $this->input->post('work_exp', TRUE);
            $educational_background = $this->input->post('educational_background', TRUE);

            $salary = $this->input->post('salary', TRUE);
            $sss_no = $this->input->post('sss_no', TRUE);
            $philhealth = $this->input->post('philhealth', TRUE);
            $tin_no = $this->input->post('tin_no', TRUE);
            $pagibig = $this->input->post('pagibig', TRUE);

            /* validate employee info */
            /* first_name must not be blank */
            /* last_name must not be blank */
            /* address must not be blank */

            if(is_empty_null_value($first_name)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('first_name_cant_be_blank'));
                exit;
            }

            if(is_empty_null_value($work_exp)) {
                $work_exp = array();
            }

            if(is_empty_null_value($educational_background)) {
                $educational_background = array();
            }
            $this->employeeObj->set_company_id($this->current_avatar->company_id);
            /* TODO generate employee code */

            $this->employeeObj->set_employee_code($this->generate_employee_code());
            $this->employeeObj->set_first_name($first_name);
            $this->employeeObj->set_middle_name($middle_name);
            $this->employeeObj->set_last_name($last_name);
            $this->employeeObj->set_address($address);
            $this->employeeObj->set_date_of_birth($date_of_birth);
            $this->employeeObj->set_gender($gender);
            $this->employeeObj->set_marital_status($marital_status);
            $this->employeeObj->set_home_phone($home_phone);
            $this->employeeObj->set_work_phone($work_phone);
            $this->employeeObj->set_date_hired($date_hired);
            $this->employeeObj->set_department_id($department);
            $this->employeeObj->set_position_id($position);
            $this->employeeObj->set_employee_status_id($employment_status);
            $this->employeeObj->set_salary($salary);
            $this->employeeObj->set_sss_no($sss_no);
            $this->employeeObj->set_philhealth($philhealth);
            $this->employeeObj->set_tin_no($tin_no);
            $this->employeeObj->set_pagibig($pagibig);
            $this->employeeObj->set_created_by($this->current_avatar->id);
            $this->employeeObj->set_work_experience($work_exp);
            $this->employeeObj->set_educational_background($educational_background);

            $result = $this->employeeObj->createEmployee();
            if ($result) {
                send_json_response(INFO_LOG, HTTP_OK, 'new employee form', array('html' => 'test'));
            } else {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('please_try_again'));
            }
        }

        private function generate_employee_code() {
            $this->employeeObj->set_company_id($this->current_avatar->company_id);
            $empId = $this->employeeObj->getMaxEmpID();
            $code = ($empId > 0) ? substr(100000 + $empId, 1) : '000001';
            return $this->employeeObj->empPrefix.date('Y').'-'.$code;
        }
    }
?>