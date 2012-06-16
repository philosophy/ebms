<?php
    class Leaves extends Employees_Base {
        public $employee_id;
        public $leave_obj;
        private $leave_id, $from_date, $to_date, $payroll_id, $flag;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->leave_obj = new $this->Leave_model();
            $method = $this->router->method;

            if ($method == 'index') {
                parent::load_employees();
            } else if ($method == 'new_leave') {
                $this->_ensure_required_fields();
                Application::authorize_action(array('employee_id' => $this->employee_id));
            }
        }

        function index() {
            $data['content'] = 'personnel/time_records/index';
            $data['title'] = lang('employee_time_sheet_records');

            $this->time_record_list = $this->time_record_obj->get_time_records_list(array('company_id' => $this->current_avatar->company_id, 'current_day' => true));
            $this->parser->parse('layouts/application', $data);
            $this->output->enable_profiler(TRUE);
        }

        function new_leave() {
            $result = $this->leave_obj->create_employee_leave(array(
                'employee_id' => $this->employee_id,
                'leave_id' => $this->leave_id,
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'created_by' => $this->current_avatar->id,
                'date_created' => date($this->config->item('date_format')),
                'company_id' => $this->current_avatar->company_id
            ));

            if($result) {
                $employee = $this->employeeObj->get_data(array('id', $this->employee_id));
                send_json_response(INFO_LOG, HTTP_OK, 'Successfully filed leave for '.$employee->first_name.' ',
                        array('flash_message' => true,
                                'status' => 'success',
                                'employee_id' => $this->employee_id
                        ));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, lang('please_try_again'));
            }
        }

        function time_in() {
            $result = $this->time_record_obj->time_in_user(array('employee_id' => $this->input->post('employee', true),
                'created_by' => $this->current_avatar->id,
                'company_id' => $this->current_avatar->company_id
                ));

            if ($result == true) {
                $this->employeeObj->set_id($this->employee_id);
                $emp = $this->employeeObj->getEmployeeDetails();
                send_json_response(INFO_LOG, HTTP_OK, $emp->first_name.' checked in successfully',
                        array('flash_message' => true,
                                'status' => 'success',
                                'record_id' => $result['record_id'],
                                'name' => $emp->first_name.' '.$emp->last_name,
                                'time_in' => $result['time_in']
                        ));
            } else {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('please_try_again'));
            }
        }

        private function _ensure_required_fields() {
            $this->employee_id = $this->input->post('employee', true);
            $this->leave_id = $this->input->post('leave', true);
            $this->from_date = $this->input->post('from_date', true);
            $this->to_date = $this->input->post('to_date', true);

            if(empty($this->employee_id)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('employee_cant_be_blank'));
                exit;
            }

            if(empty($this->leave_id)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('leave_cant_be_blank'));
                exit;
            }

            if(empty($this->from_date)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('from_date_cant_be_blank'));
                exit;
            }

            if(empty($this->to_date)) {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('from_date_cant_be_blank'));
                exit;
            }
        }

    }
?>