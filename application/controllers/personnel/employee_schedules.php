<?php
    class Employee_Schedules extends Employees_Base {

        public $employee_schedules, $emp_id, $days, $start_break_time, $end_break_time, $start_time, $end_time;
        public $schedule_info;
        public $sched_id;
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
            $this->employeeObj->set_company_id($this->current_avatar->company_id);

            $method = $this->router->method;
            if ($method == 'index' || $method == 'browse') {
                parent::set_config();
                $this->set_sched_config();
            } else if ($method == 'update_multiple_schedules') {
                $this->ensureScheduleRequired();
            } else if ($method == 'update_schedule') {
                $this->ensureScheduleRequired();
                $this->_ensure_schedule_exists();
            }
        }



        function index() {
            $data['content'] = 'personnel/employee_schedules/index';
            $data['title'] = lang('employee_schedule');

            $this->schedObj->set_limit($this->pagination_config['per_page']);
            $this->schedObj->set_offset($this->uri->segment(4));
            $this->employees = $this->schedObj->getEmployeesWithSchedule();
            $this->pagination->initialize($this->pagination_config);
            $data['pagination_links'] = $this->pagination->create_links();

            $this->parser->parse('layouts/application', $data);
            $this->output->enable_profiler(TRUE);
        }

        function browse($offset=0) {

            $name = $this->input->get('name', true);

            if (empty($name)) {
                $this->schedObj->set_limit($this->pagination_config['per_page']);
                $this->schedObj->set_offset((!empty($offset) && $offset != NULL) ? $offset : 0);
                $this->employees = $this->schedObj->getEmployeesWithSchedule();
                $this->pagination->initialize($this->pagination_config);
                $data['pagination_links'] = $this->pagination->create_links();

                $data['emp_len'] = count($this->employees);

                send_json_response(INFO_LOG, HTTP_OK, 'browse employee form', array('html' => $this->load->view('personnel/employee_schedules/_employee_schedule_list', $data, true), 'edit_emp_sched_link' => site_url('employee_schedules/get_edit_employee_sched_form/')));
            } else {
                $this->employeeObj->set_limit($this->pagination_config['per_page']);
                $this->employeeObj->set_offset((!empty($offset) && $offset != NULL) ? $offset : 0);
                $this->employees = $this->employeeObj->getEmployees();
                $this->pagination->initialize($this->pagination_config);
                $data['pagination_links'] = $this->pagination->create_links();
                $data['employees_len'] = count($this->employees);

                send_json_response(INFO_LOG, HTTP_OK, 'search employee form', array('html' => $this->load->view('personnel/employee_schedules/_employee_schedule_list', $data, true)));

            }

        }

        function get_new_employee_sched_form() {
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

        function get_edit_employee_sched_form($id) {
            $sched_id = $this->input->get('id', TRUE);
            $result = $this->schedObj->get_schedule_info(array('id' => $sched_id));
            $this->schedule_info = $result[0];

            send_json_response(INFO_LOG, HTTP_OK, 'edit employee sched form', array('html' => $this->load->view('personnel/employee_schedules/_edit_employee_schedule_form', '', true)));
        }

        function get_edit_multiple_sched() {
            send_json_response(INFO_LOG, HTTP_OK, 'edit multiple employee sched form', array('html' => $this->load->view('personnel/employee_schedules/_edit_multiple_sched', '', true)));
        }

        function update_schedule() {
            $result = $this->Employee_Schedules_model->update_employee_schedule(array(
                'employee_id' => $this->emp_id,
                'id' => $this->sched_id,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'start_break_time' => $this->start_break_time,
                'end_break_time' => $this->end_break_time,
                'last_updated_by' => $this->current_avatar->id,
                'last_updated_at' => date($this->config->item('date_format'))
            ));
            if ($result == true) {
                send_json_response(INFO_LOG, HTTP_OK, 'updated employee schedule successfully');
            } else {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('please_try_again'));
            }
        }

        function update_multiple_schedules() {
            $len = count($this->days);
            $has_error = false;
            for($i = 0; $i < $len; $i++) {
                $query = $this->db->get_where('employee_schedules', array('employee_id' => $this->emp_id, 'day' =>$this->days[$i]));
                if ($query->num_rows() > 0) {
                    //update
                    $this->Employee_Schedules_model->update_employee_schedule(array(
                        'employee_id' => $this->emp_id,
                        'day' => $this->days[$i],
                        'start_time' => $this->start_time,
                        'end_time' => $this->end_time,
                        'start_break_time' => $this->start_break_time,
                        'end_break_time' => $this->end_break_time,
                        'last_updated_by' => $this->current_avatar->id,
                        'last_updated_at' => date($this->config->item('date_format'))
                    ));
                } else {
                    //create new record
                    $data = array(
                        'day' => $this->days[$i],
                        'start_time' => $this->start_time,
                        'end_time' => $this->end_time,
                        'start_break_time' => $this->start_break_time,
                        'end_break_time' => $this->end_break_time,
                        'created_by' => $this->current_avatar->id,
                        'company_id' => $this->current_avatar->company_id,
                        'employee_id' => $this->emp_id
                    );
                    if (!$this->Employee_Schedules_model->create_employee_schedule($data)) {
                        $has_error = true;
                    }
                }
            }

            if ($has_error) {
                send_json_response(INFO_LOG, HTTP_OK, 'updated multiple employee schedule with some errors');
            } else {
                send_json_response(INFO_LOG, HTTP_OK, 'successfully updated multiple employee schedule');
            }
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

            if(isset($days)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('days_cant_be_blank'));
                exit;
            }

            $this->schedObj->set_days($days);
            $this->schedObj->set_start_time($time_in);
            $this->schedObj->set_end_time($time_out);
            $this->schedObj->set_start_break_time($start_break_time);
            $this->schedObj->set_end_break_time($end_break_time);
            $this->schedObj->set_employee_id($emp_id);
            $this->schedObj->set_created_by($this->current_avatar->id);

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

        private function _record_exist($options = array()) {
            $record = $this->schedObj->record_exists($options);
            if (count($record > 0)) {
                return true;
            } else {
                return false;
            }
        }

        private function set_sched_config() {
            $this->pagination_config['base_url'] = base_url().'employee_schedules/browse/';
            $this->pagination_config['total_rows'] = count($this->schedObj->getEmployeesWithSchedule());
            $this->pagination_config['per_page'] = 1;
        }

        private function ensureScheduleRequired() {
            $this->emp_id = $this->input->post('emp_id', TRUE);
            $this->days = $this->input->post('days', TRUE);
            $this->start_time = $this->input->post('time_in', TRUE);
            $this->end_time = $this->input->post('time_out', TRUE);
            $this->start_break_time = $this->input->post('start_break_time', TRUE);
            $this->end_break_time = $this->input->post('end_break_time', TRUE);

            if(empty($this->emp_id)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('employee_cant_be_blank'));
                exit;
            }

            if(empty($this->start_time)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('time_in_cant_be_blank'));
                exit;
            }

            if(empty($this->end_time)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('time_out_cant_be_blank'));
                exit;
            }

            if(empty($this->days)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('days_cant_be_blank'));
                exit;
            }
        }

        private function _ensure_schedule_exists() {
            $this->sched_id = $this->input->post('sched_id', TRUE);

            if (isset($this->sched_id) == false) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('schedule_cant_be_blank'));
                exit;
            }

            if (!$this->_record_exist(array('employee_id' => $this->emp_id, 'id' => $this->sched_id))) {
                send_json_response(ERROR_LOG, HTTP_NOT_FOUND, lang('record_cant_be_found'));
                exit;
            }
        }
    }
?>