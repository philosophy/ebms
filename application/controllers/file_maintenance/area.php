<?php
    class Area extends Application {

        public $areas = null;
        public $area = null;
        private $areaObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Area_model');
            $this->areaObj = new $this->Area_model();
        }

        function index() {
            $data['title'] = $this->lang->line('area');
            $data['content'] = 'system_records/file_maintenance/area/index';
            $data['active'] = 'list';

            $this->areaObj->set_company_id($this->current_avatar->company_id);
            $this->areas = $this->areaObj->getAreas();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_area() {
            $data['title'] =  $this->lang->line('create_area');
            $data['content'] = 'system_records/file_maintenance/area/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_area() {
            /* These are only the required fields */
            $this->areaObj->set_name($this->input->post('area_name'));
            $this->areaObj->set_created_by($this->current_user()->id);
            $this->areaObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('area_name', 'area name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->areaObj->areaExists()) {

                $result = $this->areaObj->createArea();
                if ($result) {
                    redirect('file_maintenance/area', 'refresh');
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
                redirect('file_maintenance/area/new_area', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->areaObj->set_id($id);
                $this->areaObj->set_created_by($this->current_user()->id);
                $this->areaObj->set_company_id($this->current_user()->company_id);

                $result = $this->areaObj->deactivateArea();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted area', array('area_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete area');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/area/archive';
            $data['active'] = 'archive';

            $this->areaObj->set_active(0);
            $this->areaObj->set_company_id($this->current_user()->company_id);
            $this->areas = $this->areaObj->getAreas();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $area_name = $this->input->post('area_name');

                /* TODO */
                /* area len should not be less than 5 characters */
                /* area should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($area_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'area name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($area_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'area name must atleast be 5 characters long');
                    exit;
                }

                $this->areaObj->set_id($id);
                $this->areaObj->set_name($area_name);
                $this->areaObj->set_last_updated_by($this->current_user()->id);
                $this->areaObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->areaObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Area name already exists');
                    exit;
                }
                $result = $this->areaObj->updateArea();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated area ', array('msg' => 'success!', 'area_id' => $id, 'area_name' => $area_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_area_edit_form($id) {
            $this->area = $this->areaObj->getAreaDetails($id);
            if (!empty($this->area)) {
                send_json_response(INFO_LOG, HTTP_OK, 'area edit form', array('html' => $this->load->view('system_records/file_maintenance/area/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->areaObj->set_id($id);
                $this->areaObj->set_last_updated_by($this->current_user()->id);
                $this->areaObj->set_company_id($this->current_user()->company_id);

                $result = $this->areaObj->restoreArea();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore area', array('area_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore area');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->Area_model->getAreaDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>