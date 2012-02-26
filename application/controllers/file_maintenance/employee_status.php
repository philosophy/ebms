<?php
    class Employee_Status extends Application {

        public $employeeStatus = null;
        public $status = null;
        private $statusObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('employee_status_model');
            $this->statusObj = new $this->employee_status_model();
        }

        function index() {
            $data['title'] = $this->lang->line('employee_status');
            $data['content'] = 'system_records/file_maintenance/employee_status/index';
            $data['active'] = 'list';

            $this->statusObj->set_company_id($this->current_user()->company_id);
            $this->employeeStatus = $this->statusObj->getEmployeeStatus();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_employee_status() {
            $data['title'] =  $this->lang->line('create_employee_status');
            $data['content'] = 'system_records/file_maintenance/employee_status/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_employee_status() {
            /* These are only the required fields */
            $this->statusObj->set_name($this->input->post('employee_status_name'));
            $this->statusObj->set_created_by($this->current_user()->id);
            $this->statusObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('employee_status_name', 'Employee status name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->statusObj->employeeStatusExists()) {

                $result = $this->statusObj->createEmployeeStatus();
                if ($result) {
                    redirect('file_maintenance/employee_status', 'refresh');
                } else {
                    /* TODO: return with errors */
                }
            } else {
                /* return with errors */
//                $data['title'] =  $this->lang->line('create_department');
//                $data['content'] = 'system_records/file_maintenance/department/new';
//                $data['active'] = 'create';

                $this->session->set_flashdata('msg', lang('an_error_occured'));
                $this->session->set_flashdata('msg_class', 'error');
                redirect('file_maintenance/employee_status/new_employee_status', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->statusObj->set_id($id);
                $this->statusObj->set_created_by($this->current_user()->id);
                $this->statusObj->set_company_id($this->current_user()->company_id);

                $result = $this->statusObj->deactivateEmployeeStatus();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted employee_status', array('employee_status_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete employee status');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/employee_status/archive';
            $data['active'] = 'archive';

            $this->statusObj->set_active(0);
            $this->statusObj->set_company_id($this->current_user()->company_id);
            $this->employeeStatus = $this->statusObj->getEmployeeStatus();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $employee_status_name = $this->input->post('employee_status_name');
                $description = $this->input->post('description');

                /* TODO */
                /* description len should not be less than 5 characters */
                /* description should not be empty */

                /* validate employee status name if empty*/
                if(is_empty_null_value($employee_status_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'employee status name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($employee_status_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'employee status name must atleast be 5 characters long');
                    exit;
                }

                $this->statusObj->set_id($id);
                $this->statusObj->set_name($employee_status_name);
                $this->statusObj->set_description($description);
                $this->statusObj->set_last_updated_by($this->current_user()->id);
                $this->statusObj->set_company_id($this->current_user()->company_id);

                /* employee status should not be the same name with other department */
                if($this->statusObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Department name already exists');
                    exit;
                }
                $result = $this->statusObj->updateEmployeeStatus();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated department ', array('msg' => 'success!', 'employee_status_id' => $id, 'employee_status_name' => $employee_status_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_employee_status_edit_form($id) {
            $this->status = $this->statusObj->getEmployeeStatusDetails($id);
            if (!empty($this->status)) {
                send_json_response(INFO_LOG, HTTP_OK, 'employee status edit form', array('html' => $this->load->view('system_records/file_maintenance/employee_status/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->statusObj->set_id($id);
                $this->statusObj->set_last_updated_by($this->current_user()->id);
                $this->statusObj->set_company_id($this->current_user()->company_id);

                $result = $this->statusObj->restoreEmployeeStatus();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore employee status', array('employee_status_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore employee status');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->employee_status_model->getEmployeeStatusDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>