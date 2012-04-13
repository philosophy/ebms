<?php
    class Company extends Application {

        public $companies = null;
        public $company = null;
        private $companyObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Company_model');
            $this->companyObj = new $this->Company_model();
        }

        function index() {
            $data['title'] = $this->lang->line('company');
            $data['content'] = 'system_records/file_maintenance/company/index';
            $data['active'] = 'list';

            $this->companyObj->set_company_id($this->current_avatar->company_id);
            $this->companies = $this->companyObj->getCompanies();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_company() {
            $data['title'] =  $this->lang->line('create_company');
            $data['content'] = 'system_records/file_maintenance/company/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_company() {
            /* These are only the required fields */
            $this->companyObj->set_name($this->input->post('company_name'));
            $this->companyObj->set_created_by($this->current_user()->id);
            $this->companyObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('company_name', 'company name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->companyObj->companyExists()) {

                $result = $this->companyObj->createCompany();
                if ($result) {
                    redirect('file_maintenance/company', 'refresh');
                } else {
                    /* TODO: return with errors */
                }
            } else {
                $this->session->set_flashdata('msg', lang('an_error_occured'));
                $this->session->set_flashdata('msg_class', 'error');
                redirect('file_maintenance/company/new_company', 'refresh');
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->companyObj->set_id($id);
                $this->companyObj->set_created_by($this->current_user()->id);
                $this->companyObj->set_company_id($this->current_user()->company_id);

                $result = $this->companyObj->deactivateCompany();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted company', array('company_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete company');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/company/archive';
            $data['active'] = 'archive';

            $this->companyObj->set_active(0);
            $this->companyObj->set_company_id($this->current_user()->company_id);
            $this->companies = $this->companyObj->getCompanies();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $company_name = $this->input->post('company_name');

                /* TODO */
                /* company len should not be less than 5 characters */
                /* company should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($company_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'company name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($company_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'company name must atleast be 5 characters long');
                    exit;
                }

                $this->companyObj->set_id($id);
                $this->companyObj->set_name($company_name);
                $this->companyObj->set_last_updated_by($this->current_user()->id);
                $this->companyObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->companyObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Company name already exists');
                    exit;
                }
                $result = $this->companyObj->updateCompany();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated company ', array('msg' => 'success!', 'company_id' => $id, 'company_name' => $company_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_company_edit_form($id) {
            $this->company = $this->companyObj->getCompanyDetails($id);
            if (!empty($this->company)) {
                send_json_response(INFO_LOG, HTTP_OK, 'company edit form', array('html' => $this->load->view('system_records/file_maintenance/company/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->companyObj->set_id($id);
                $this->companyObj->set_last_updated_by($this->current_user()->id);
                $this->companyObj->set_company_id($this->current_user()->company_id);

                $result = $this->companyObj->restoreCompany();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore company', array('company_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore company');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->Company_model->getCompanyDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>