<?php
    class Earning extends Application {

        public $earnings = null;
        public $earning = null;
        private $earningObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Earning_model');
            $this->earningObj = new $this->Earning_model();
        }

        function index() {
            $data['title'] = $this->lang->line('earning');
            $data['content'] = 'system_records/file_maintenance/earning/index';
            $data['active'] = 'list';

            $this->earningObj->set_company_id($this->current_avatar->company_id);
            $this->earnings = $this->earningObj->getEarnings();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_earning() {
            $data['title'] =  $this->lang->line('create_earning');
            $data['content'] = 'system_records/file_maintenance/earning/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_earning() {
            /* These are only the required fields */
            $this->earningObj->set_name($this->input->post('earning_name'));
            $this->earningObj->set_created_by($this->current_user()->id);
            $this->earningObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('earning_name', 'earning name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->earningObj->earningExists()) {

                $result = $this->earningObj->createEarning();
                if ($result) {
                    redirect('file_maintenance/earning', 'refresh');
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
                redirect('file_maintenance/earning/new_earning', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->earningObj->set_id($id);
                $this->earningObj->set_created_by($this->current_user()->id);
                $this->earningObj->set_company_id($this->current_user()->company_id);

                $result = $this->earningObj->deactivateEarning();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted earning', array('earning_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete earning');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/earning/archive';
            $data['active'] = 'archive';

            $this->earningObj->set_active(0);
            $this->earningObj->set_company_id($this->current_user()->company_id);
            $this->earnings = $this->earningObj->getEarnings();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $earning_name = $this->input->post('earning_name');

                /* TODO */
                /* earning len should not be less than 5 characters */
                /* earning should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($earning_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'earning name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($earning_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'earning name must atleast be 5 characters long');
                    exit;
                }

                $this->earningObj->set_id($id);
                $this->earningObj->set_name($earning_name);
                $this->earningObj->set_last_updated_by($this->current_user()->id);
                $this->earningObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->earningObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Earning name already exists');
                    exit;
                }
                $result = $this->earningObj->updateEarning();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated earning ', array('msg' => 'success!', 'earning_id' => $id, 'earning_name' => $earning_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_earning_edit_form($id) {
            $this->earning = $this->earningObj->getEarningDetails($id);
            if (!empty($this->earning)) {
                send_json_response(INFO_LOG, HTTP_OK, 'earning edit form', array('html' => $this->load->view('system_records/file_maintenance/earning/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->earningObj->set_id($id);
                $this->earningObj->set_last_updated_by($this->current_user()->id);
                $this->earningObj->set_company_id($this->current_user()->company_id);

                $result = $this->earningObj->restoreEarning();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore earning', array('earning_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore earning');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->Earning_model->getEarningDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>