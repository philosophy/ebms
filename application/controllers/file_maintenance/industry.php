<?php
    class Industry extends Application {

        public $industries = null;
        public $industry = null;
        private $industryObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('industry_model');
            $this->industryObj = new $this->industry_model();
        }

        function index() {
            $data['title'] = $this->lang->line('industry');
            $data['content'] = 'system_records/file_maintenance/industry/index';
            $data['active'] = 'list';

            $this->industryObj->set_company_id($this->current_user()->company_id);
            $this->industries = $this->industryObj->getindustries();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_industry() {
            $data['title'] =  $this->lang->line('create_industry');
            $data['content'] = 'system_records/file_maintenance/industry/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_industry() {
            /* These are only the required fields */
            $this->industryObj->set_name($this->input->post('industry_name'));
            $this->industryObj->set_created_by($this->current_user()->id);
            $this->industryObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('industry_name', 'industry name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->industryObj->industryExists()) {

                $result = $this->industryObj->createindustry();
                if ($result) {
                    redirect('file_maintenance/industry', 'refresh');
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
                redirect('file_maintenance/industry/new_industry', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->industryObj->set_id($id);
                $this->industryObj->set_created_by($this->current_user()->id);
                $this->industryObj->set_company_id($this->current_user()->company_id);

                $result = $this->industryObj->deactivateindustry();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted industry', array('industry_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete industry');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/industry/archive';
            $data['active'] = 'archive';

            $this->industryObj->set_active(0);
            $this->industryObj->set_company_id($this->current_user()->company_id);
            $this->industries = $this->industryObj->getindustries();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $industry_name = $this->input->post('industry_name');
                

                /* TODO */
                /* validate unit name if empty*/
                if(is_empty_null_value($industry_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'industry name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($industry_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'industry name must atleast be 5 characters long');
                    exit;
                }

                $this->industryObj->set_id($id);
                $this->industryObj->set_name($industry_name);
                $this->industryObj->set_last_updated_by($this->current_user()->id);
                $this->industryObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->industryObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'industry name already exists');
                    exit;
                }
                $result = $this->industryObj->updateindustry();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated industry ', array('msg' => 'success!', 'industry_id' => $id, 'industry_name' => $industry_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_industry_edit_form($id) {
            $this->industry = $this->industryObj->getindustryDetails($id);
            if (!empty($this->industry)) {
                send_json_response(INFO_LOG, HTTP_OK, 'industry edit form', array('html' => $this->load->view('system_records/file_maintenance/industry/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->industryObj->set_id($id);
                $this->industryObj->set_last_updated_by($this->current_user()->id);
                $this->industryObj->set_company_id($this->current_user()->company_id);

                $result = $this->industryObj->restoreindustry();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore industry', array('industry_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore industry');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->industry_model->getindustryDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>