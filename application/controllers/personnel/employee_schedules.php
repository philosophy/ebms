<?php
    class Employee_Schedules extends Employees_Base {

        public $employee_schedules;
        public $employees;
        private $employeeObj;
        private $schedObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Employee_status_model');
            $this->load->model('Department_model');
            $this->load->model('Position_model');
            $this->load->model('Employees_model');
            $this->load->model('Employee_Schedules_model');
            $this->employeeObj = new $this->Employees_model();
            $this->schedObj = new $this->Employee_Schedules_model();
            $this->schedObj->set_company_id($this->current_avatar->company_id);
        }

        function index() {
            $data['content'] = 'personnel/employee_schedules/index';
            $data['title'] = lang('employee_schedule');

            $config['base_url'] = base_url().'employees/employee_schedule/browse/';
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

        function get_new_employee_sched_form() {
            $this->schedObj->set_company_id($this->current_avatar->id);

            $this->employeeObj->set_limit(100);
            $this->employeeObj->set_company_id($this->current_avatar->company_id);
            $employees = $this->employeeObj->getEmployeesData();
            $employeesWithSched = $this->employeeObj->getEmployeesWithSchedule();

            function array_compare($v1, $v2) {
                if ($v1===$v2) {
                    return 0;
                }
                return 1;
            }

            $this->employees = array_udiff($employees, $employeesWithSched, 'array_compare');
            send_json_response(INFO_LOG, HTTP_OK, 'new employee sched form', array('html' => $this->load->view('personnel/employee_schedules/_new_employee_schedule_form', '', true)));
        }

        function create() {
            $emp_id = $this->input->post('employee', TRUE);
            $days = $this->input->post('days', TRUE);
            $time_in = $this->input->post('time_in', TRUE);
            $time_out = $this->input->post('time_out', TRUE);
            $start_break_time = $this->input->post('start_break_time', TRUE);
            $end_break_time = $this->input->post('end_break_time', TRUE);

            /* validate employee schedule */
            /* employee must not be blank */
            /* time_in must not be blank */
            /* time_out must not be blank */
            /* timein must be less than timeout */
            if(empty($emp_id)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('employee_cant_be_blank'));
                exit;
            }

            if(empty($time_in)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('time_in_cant_be_blank'));
                exit;
            }

            if(empty($time_out)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('time_out_cant_be_blank'));
                exit;
            }

            $this->schedObj->set_days($days);
            $this->schedObj->set_start_time($time_in);
            $this->schedObj->set_end_time($time_out);
            $this->schedObj->set_start_break_time($start_break_time);
            $this->schedObj->set_end_break_time($end_break_time);
            $this->schedObj->set_employee_id($emp_id);
            $this->schedObj->set_created_by($this->current_avatar->id);
            $this->schedObj->set_company_id($this->current_avatar->company_id);

            $result = $this->schedObj->createEmployeeSchedule();
            if ($result) {
                send_json_response(INFO_LOG, HTTP_OK, lang('successfully_created_emp_schedule'), array('employee' => array('employee_no' => $emp_id)));
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