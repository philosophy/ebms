<?php
    class Location extends Application {

        public $locations = null;
        public $location = null;
        private $locationObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Location_model');
            $this->locationObj = new $this->Location_model();
        }

        function index() {
            $data['title'] = $this->lang->line('location');
            $data['content'] = 'system_records/file_maintenance/location/index';
            $data['active'] = 'list';

            $this->locationObj->set_company_id($this->current_avatar->company_id);
            $this->locations = $this->locationObj->getLocations();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_location() {
            $data['title'] =  $this->lang->line('create_location');
            $data['content'] = 'system_records/file_maintenance/location/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_location() {
            /* These are only the required fields */
            $this->locationObj->set_name($this->input->post('location_name'));
            $this->locationObj->set_created_by($this->current_user()->id);
            $this->locationObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('location_name', 'location name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->locationObj->locationExists()) {

                $result = $this->locationObj->createLocation();
                if ($result) {
                    redirect('file_maintenance/location', 'refresh');
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
                redirect('file_maintenance/location/new_location', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->locationObj->set_id($id);
                $this->locationObj->set_created_by($this->current_user()->id);
                $this->locationObj->set_company_id($this->current_user()->company_id);

                $result = $this->locationObj->deactivateLocation();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted location', array('location_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete location');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/location/archive';
            $data['active'] = 'archive';

            $this->locationObj->set_active(0);
            $this->locationObj->set_company_id($this->current_user()->company_id);
            $this->locations = $this->locationObj->getLocations();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $location_name = $this->input->post('location_name');

                /* TODO */
                /* location len should not be less than 5 characters */
                /* location should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($location_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'location name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($location_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'location name must atleast be 5 characters long');
                    exit;
                }

                $this->locationObj->set_id($id);
                $this->locationObj->set_name($location_name);
                $this->locationObj->set_last_updated_by($this->current_user()->id);
                $this->locationObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->locationObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Location name already exists');
                    exit;
                }
                $result = $this->locationObj->updateLocation();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated location ', array('msg' => 'success!', 'location_id' => $id, 'location_name' => $location_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_location_edit_form($id) {
            $this->location = $this->locationObj->getLocationDetails($id);
            if (!empty($this->location)) {
                send_json_response(INFO_LOG, HTTP_OK, 'location edit form', array('html' => $this->load->view('system_records/file_maintenance/location/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->locationObj->set_id($id);
                $this->locationObj->set_last_updated_by($this->current_user()->id);
                $this->locationObj->set_company_id($this->current_user()->company_id);

                $result = $this->locationObj->restoreLocation();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore location', array('location_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore location');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->Location_model->getLocationDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>