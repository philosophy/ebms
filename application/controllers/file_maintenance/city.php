<?php
    class City extends Application {

        public $cities = null;
        public $city = null;
        private $cityObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('City_model');
            $this->cityObj = new $this->City_model();
        }

        function index() {
            $data['title'] = $this->lang->line('city');
            $data['content'] = 'system_records/file_maintenance/city/index';
            $data['active'] = 'list';

            $this->cityObj->set_company_id($this->current_user()->company_id);
            $this->cities = $this->cityObj->getCities();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_city() {
            $data['title'] =  $this->lang->line('create_city');
            $data['content'] = 'system_records/file_maintenance/city/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_city() {
            /* These are only the required fields */
            $this->cityObj->set_name($this->input->post('city_name'));
            $this->cityObj->set_created_by($this->current_user()->id);
            $this->cityObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('city_name', 'city name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->cityObj->cityExists()) {

                $result = $this->cityObj->createCity();
                if ($result) {
                    redirect('file_maintenance/city', 'refresh');
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
                redirect('file_maintenance/city/new_city', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->cityObj->set_id($id);
                $this->cityObj->set_created_by($this->current_user()->id);
                $this->cityObj->set_company_id($this->current_user()->company_id);

                $result = $this->cityObj->deactivateCity();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted city', array('city_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete city');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/city/archive';
            $data['active'] = 'archive';

            $this->cityObj->set_active(0);
            $this->cityObj->set_company_id($this->current_user()->company_id);
            $this->cities = $this->cityObj->getCities();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $city_name = $this->input->post('city_name');
                $description = $this->input->post('description');

                /* TODO */
                /* description len should not be less than 5 characters */
                /* description should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($city_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'city name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($city_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'city name must atleast be 5 characters long');
                    exit;
                }

                $this->cityObj->set_id($id);
                $this->cityObj->set_name($city_name);
                $this->cityObj->set_description($description);
                $this->cityObj->set_last_updated_by($this->current_user()->id);
                $this->cityObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->cityObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'City name already exists');
                    exit;
                }
                $result = $this->cityObj->updateCity();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated city ', array('msg' => 'success!', 'city_id' => $id, 'city_name' => $city_name_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_city_edit_form($id) {
            $this->status = $this->cityObj->getCityDetails($id);
            if (!empty($this->status)) {
                send_json_response(INFO_LOG, HTTP_OK, 'city edit form', array('html' => $this->load->view('system_records/file_maintenance/city/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->cityObj->set_id($id);
                $this->cityObj->set_last_updated_by($this->current_user()->id);
                $this->cityObj->set_company_id($this->current_user()->company_id);

                $result = $this->cityObj->restoreCity();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore city', array('city_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore city');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->City_model->getCityDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>