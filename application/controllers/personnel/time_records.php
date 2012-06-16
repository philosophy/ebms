<?php
    class Time_Records extends Employees_Base {
        public $employee_id;
        public $time_record_obj;
        public $time_record_list;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Time_Records_model');

            $this->time_record_obj = new $this->Time_Records_model();
            $method = $this->router->method;
            if ($method == 'index') {
                parent::load_employees();
            } else if ($method == 'time_in' || $method == 'time_out') {
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

        function time_out() {
            $record_id = $this->input->post('record_id', true);
            $result = $this->time_record_obj->time_out_user(array('employee_id' => $this->employee_id,
                    'record_id' => $record_id,
                    'company_id' => $this->current_avatar->company_id,
                    'last_updated_by' => $this->current_avatar->id
                ));

            if ($result) {
                $this->employeeObj->set_id($this->employee_id);
                $emp = $this->employeeObj->getEmployeeDetails();
                send_json_response(INFO_LOG, HTTP_OK, $emp->first_name.' checked out successfully',
                        array('flash_message' => true,
                                'status' => 'success',
                                'record_id' => $record_id,
                                'employee_id' => $this->employee_id,
                                'time_out' => readable_time(array('date' => $result['time_out']))
                        ));
            } else {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, lang('please_try_again'));
            }
        }
    }
?>