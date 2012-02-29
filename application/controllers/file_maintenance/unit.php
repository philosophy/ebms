<?php
    class Unit extends Application {

        public $units = null;
        public $unit = null;
        private $unitObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Unit_model');
            $this->unitObj = new $this->Unit_model();
        }

        function index() {
            $data['title'] = $this->lang->line('unit');
            $data['content'] = 'system_records/file_maintenance/unit/index';
            $data['active'] = 'list';

            $this->unitObj->set_company_id($this->current_user()->company_id);
            $this->units = $this->unitObj->getUnits();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_unit() {
            $data['title'] =  $this->lang->line('create_unit');
            $data['content'] = 'system_records/file_maintenance/unit/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_unit() {
            /* These are only the required fields */
            $this->unitObj->set_name($this->input->post('unit_name'));
            $this->unitObj->set_created_by($this->current_user()->id);
            $this->unitObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('unit_name', 'unit name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->unitObj->unitExists()) {

                $result = $this->unitObj->createUnit();
                if ($result) {
                    redirect('file_maintenance/unit', 'refresh');
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
                redirect('file_maintenance/unit/new_unit', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->unitObj->set_id($id);
                $this->unitObj->set_created_by($this->current_user()->id);
                $this->unitObj->set_company_id($this->current_user()->company_id);

                $result = $this->unitObj->deactivateUnit();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted unit', array('unit_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete unit');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/unit/archive';
            $data['active'] = 'archive';

            $this->unitObj->set_active(0);
            $this->unitObj->set_company_id($this->current_user()->company_id);
            $this->units = $this->unitObj->getUnits();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $unit_name = $this->input->post('unit_name');

                /* TODO */
                /* unit should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($unit_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unit name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($unit_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unit name must atleast be 5 characters long');
                    exit;
                }

                $this->unitObj->set_id($id);
                $this->unitObj->set_name($unit_name);
                $this->unitObj->set_last_updated_by($this->current_user()->id);
                $this->unitObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->unitObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Department name already exists');
                    exit;
                }
                $result = $this->unitObj->updateUnit();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated department ', array('msg' => 'success!', 'unit_id' => $id, 'unit_name' => $unit_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_unit_edit_form($id) {
            $this->unit = $this->unitObj->getUnitDetails($id);
            if (!empty($this->unit)) {
                send_json_response(INFO_LOG, HTTP_OK, 'unit edit form', array('html' => $this->load->view('system_records/file_maintenance/unit/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->unitObj->set_id($id);
                $this->unitObj->set_last_updated_by($this->current_user()->id);
                $this->unitObj->set_company_id($this->current_user()->company_id);

                $result = $this->unitObj->restoreUnit();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore unit', array('unit_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore unit');
                }
            }
        }


        private function _record_exist($id) {
            $this->unit = $this->Unit_model->getUnitDetails($id);
            if (empty($this->unit)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>