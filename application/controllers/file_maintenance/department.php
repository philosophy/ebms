<?php
    class Department extends Application {

        public $departments = null;
        public $department = null;
        private $deptObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Department_model');
            $this->deptObj = new $this->Department_model();
        }

        function index() {
            $data['title'] = $this->lang->line('department_manager');
            $data['content'] = 'system_records/file_maintenance/department/index';
            $data['active'] = 'list';

            $this->deptObj->set_company_id($this->current_user()->company_id);
            $this->departments = $this->deptObj->getDepartments();
            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_department() {
            $data['title'] =  $this->lang->line('create_user');
            $data['content'] = 'system_records/file_maintenance/department/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_department() {
            /* These are only the required fields */
            $this->deptObj->set_name($this->input->post('department_name'));
            $this->deptObj->set_created_by($this->current_user()->id);
            $this->deptObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('department_name', 'Department name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->deptObj->departmentExists()) {

                $result = $this->deptObj->createDepartment();
                if ($result) {
                    redirect('file_maintenance/department', 'refresh');
                } else {
                    /* return with errors */
                }

            } else {
                /* return with errors */
//                $data['title'] =  $this->lang->line('create_department');
//                $data['content'] = 'system_records/file_maintenance/department/new';
//                $data['active'] = 'create';

                /* Investigate why this ain't showing up */
                $this->session->set_flashdata('msg', lang('department_name_exists'));
                $this->session->set_flashdata('msg_class', 'error');
                redirect('file_maintenance/department/new_department', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->deptObj->set_id($id);
                $this->deptObj->set_company_id($this->current_user()->company_id);
                $result = $this->deptObj->deactivateDepartment();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted department', array('department_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete department');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/department/archive';
            $data['active'] = 'archive';

            $this->deptObj->set_active(0);
            $this->deptObj->set_company_id($this->current_user()->company_id);
            $this->departments = $this->deptObj->getDepartments();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $department_name = $this->input->post('department_name');

                /* TODO */

                /* department len should not be less than 5 characters */
                /* department should not be empty */

                /* validate first name if empty*/
                if(is_empty_null_value($department_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'department name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($department_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'department name must atleast be 5 characters long');
                    exit;
                }

                $this->deptObj->set_id($id);
                $this->deptObj->set_name($department_name);
                $this->deptObj->set_last_updated_by($this->current_user()->id);
                $this->deptObj->set_company_id($this->current_user()->company_id);

                /* department should not be the same name with other department */
                if($this->deptObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Department name already exists');
                    exit;
                }
                $result = $this->deptObj->updateDepartment();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated department ', array('msg' => 'success!', 'department_id' => $id, 'department_name' => $department_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_deptedit_form($id) {
            $this->department = $this->deptObj->getDepartment($id);
            if (!empty($this->department)) {
                send_json_response(INFO_LOG, HTTP_OK, 'department edit form', array('html' => $this->load->view('system_records/file_maintenance/department/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {
                $this->deptObj->set_id($id);
                $this->deptObj->set_company_id($this->current_user()->company_id);
                $result = $this->deptObj->restoreDepartment();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore department', array('department_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore department');
                }
            }
        }


        private function _record_exist($id) {
            $this->department = $this->deptObj->getDepartment($id);
            if (empty($this->department)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>