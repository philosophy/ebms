<?php
    class Employee_Schedule extends Application {

        public $employment_status;
        public $employees;
        private $employeeObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Employee_status_model');
            $this->load->model('Department_model');
            $this->load->model('Position_model');
            $this->load->model('Employees_model');
            $this->employeeObj = new $this->Employees_model();
            $this->employeeObj->set_company_id($this->current_avatar->company_id);
        }

        function index() {
            $data['content'] = 'personnel/employee/profile';
            $data['title'] = lang('employee_profile');

            $config['base_url'] = base_url().'employees/profile/browse/';
            $config['total_rows'] = $this->employeeObj->countEmployees();
            $config['per_page'] = $this->config->item('pagination_per_page');
            $config['next_link'] = $this->config->item('pagination_next_link');
            $config['prev_link'] = $this->config->item('pagination_prev_link');
            $config['num_links'] = $this->config->item('pagination_num_links');
            $config['uri_segment'] = $this->config->item('pagination_uri_segment');
            $config['anchor_class'] = $this->config->item('pagination_anchor_class');

            $this->employeeObj->set_limit($config['per_page']);
            $this->employeeObj->set_offset($this->uri->segment(4));
            $this->employees = $this->employeeObj->getEmployees();
            $this->pagination->initialize($config);
            $data['pagination_links'] = $this->pagination->create_links();

            $this->parser->parse('layouts/application', $data);
            $this->output->enable_profiler(TRUE);
        }

        function browse($offset=0) {

            $name = $this->input->get('name', true);

            if (empty($name)) {
                $config['base_url'] = base_url().'employees/profile/browse/';
                $config['per_page'] = $this->config->item('pagination_per_page');
                $config['next_link'] = $this->config->item('pagination_next_link');
                $config['prev_link'] = $this->config->item('pagination_prev_link');
                $config['num_links'] = $this->config->item('pagination_num_links');
                $config['uri_segment'] = $this->config->item('pagination_uri_segment');
                $config['anchor_class'] = $this->config->item('pagination_anchor_class');
                $config['total_rows'] = $this->employeeObj->countEmployees();

                $this->employeeObj->set_limit($config['per_page']);
                $this->employeeObj->set_offset((!empty($offset) && $offset != NULL) ? $offset : 0);
                $this->employees = $this->employeeObj->getEmployees();
                $this->pagination->initialize($config);
                $data['pagination_links'] = $this->pagination->create_links();
                $data['employees_len'] = count($this->employees);

                send_json_response(INFO_LOG, HTTP_OK, 'browse employee form', array('html' => $this->load->view('personnel/employee/_employee_list', $data, true)));
            } else {
                $config['base_url'] = base_url().'employees/profile/browse/';
                $config['per_page'] = $this->config->item('pagination_per_page');
                $config['next_link'] = $this->config->item('pagination_next_link');
                $config['prev_link'] = $this->config->item('pagination_prev_link');
                $config['num_links'] = $this->config->item('pagination_num_links');
                $config['uri_segment'] = $this->config->item('pagination_uri_segment');
                $config['anchor_class'] = $this->config->item('pagination_anchor_class');


                $this->employeeObj->set_limit($config['per_page']);
                $this->employeeObj->set_offset((!empty($offset) && $offset != NULL) ? $offset : 0);
                $this->employeeObj->set_search($name);
                $this->employees = $this->employeeObj->getEmployeesBySearch();
                $employees_len = $this->employeeObj->countEmployeesBySearch();
                $config['total_rows'] = $employees_len;
                $this->pagination->initialize($config);
                $data['pagination_links'] = $this->pagination->create_links();

                $data['employees_len'] = $employees_len;

                send_json_response(INFO_LOG, HTTP_OK, 'search employee form', array('html' => $this->load->view('personnel/employee/_employee_list', $data, true), 'count' => $employees_len));
            }

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
            /* TODO generate employee code */
            $employee_no = $this->generate_employee_code();
            $this->employeeObj->set_employee_code($employee_no);
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
                $name = $first_name.' '.$last_name;
                $department_name = $this->Department_model->getDepartment($department)->name;
                $position_name = $this->Position_model->getPosition($position)->name;
                $status_name = $this->Status_model->getPosition($status)->name;
                send_json_response(INFO_LOG, HTTP_OK, lang('successfully_created_employee'), array('employee' => array('employee_no' => $employee_no, 'name' => $name, 'department' => $department_name, 'status' => $status_name)));
            } else {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('please_try_again'));
            }
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->employeeObj->set_id($id);
                $this->employeeObj->set_created_by($this->current_avatar->id);

                $result = $this->employeeObj->deactivateEmployee();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted employee', array('employee_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete employee');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {
                $this->employeeObj->set_id($id);
                $this->employeeObj->set_created_by($this->current_avatar->id);

                $result = $this->employeeObj->restoreEmployee();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restored employee', array('employee_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore employee');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        private function generate_employee_code() {
            $this->employeeObj->set_company_id($this->current_avatar->company_id);
            $empId = $this->employeeObj->getMaxEmpID();
            $code = ($empId > 0) ? substr(100000 + $empId, 1) : '000001';
            return $this->employeeObj->empPrefix.date('Y').'-'.$code;
        }

        private function _record_exist($id) {
            $record = $this->employeeObj->recordExists((int)$id);
            if ($record > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
?>