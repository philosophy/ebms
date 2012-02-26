<?php
    class Position extends Application {

        public $positions = null;
        public $position = null;
        private $positionObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('position_model');
            $this->positionObj = new $this->position_model();
        }

        function index() {
            $data['title'] = $this->lang->line('position');
            $data['content'] = 'system_records/file_maintenance/position/index';
            $data['active'] = 'list';

            $this->positionObj->set_company_id($this->current_user()->company_id);
            $this->positions = $this->positionObj->getPositions();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_position() {
            $data['title'] =  $this->lang->line('create_position');
            $data['content'] = 'system_records/file_maintenance/position/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_position() {
            /* These are only the required fields */
            $this->positionObj->set_name($this->input->post('position_name'));
            $this->positionObj->set_created_by($this->current_user()->id);
            $this->positionObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('position_name', 'Employee status name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->positionObj->positionExists()) {

                $result = $this->positionObj->createPosition();
                if ($result) {
                    redirect('file_maintenance/position', 'refresh');
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
                redirect('file_maintenance/position/new_position', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->positionObj->set_id($id);
                $this->positionObj->set_created_by($this->current_user()->id);
                $this->positionObj->set_company_id($this->current_user()->company_id);

                $result = $this->positionObj->deactivatePosition();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted position', array('position_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete area type');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/position/archive';
            $data['active'] = 'archive';

            $this->positionObj->set_active(0);
            $this->positionObj->set_company_id($this->current_user()->company_id);
            $this->positions = $this->positionObj->getPositions();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $position_name = $this->input->post('position_name');
                $description = $this->input->post('description');

                /* TODO */
                /* description len should not be less than 5 characters */
                /* description should not be empty */

                /* validate area type name if empty*/
                if(is_empty_null_value($position_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'area type name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($position_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'area type name must atleast be 5 characters long');
                    exit;
                }

                $this->positionObj->set_id($id);
                $this->positionObj->set_name($position_name);
                $this->positionObj->set_description($description);
                $this->positionObj->set_last_updated_by($this->current_user()->id);
                $this->positionObj->set_company_id($this->current_user()->company_id);

                /* area type should not be the same name with other department */
                if($this->positionObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Department name already exists');
                    exit;
                }
                $result = $this->positionObj->updatePosition();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated department ', array('msg' => 'success!', 'position_id' => $id, 'position_name' => $position_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_position_edit_form($id) {
            $this->areaType = $this->positionObj->getPositionDetails($id);
            if (!empty($this->areaType)) {
                send_json_response(INFO_LOG, HTTP_OK, 'area type edit form', array('html' => $this->load->view('system_records/file_maintenance/position/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->positionObj->set_id($id);
                $this->positionObj->set_last_updated_by($this->current_user()->id);
                $this->positionObj->set_company_id($this->current_user()->company_id);

                $result = $this->positionObj->restorePosition();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore area type', array('position_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore area type');
                }
            }
        }


        private function _record_exist($id) {
            $this->areaType = $this->position_model->getPositionDetails($id);
            if (empty($this->areaType)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>