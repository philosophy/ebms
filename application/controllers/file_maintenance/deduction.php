<?php
    class Deduction extends Application {

        public $deductions = null;
        public $deduction = null;
        private $deductionObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Deduction_model');
            $this->deductionObj = new $this->Deduction_model();
        }

        function index() {
            $data['title'] = $this->lang->line('deduction');
            $data['content'] = 'system_records/file_maintenance/deduction/index';
            $data['active'] = 'list';

            $this->deductionObj->set_company_id($this->current_avatar->company_id);
            $this->deductions = $this->deductionObj->getDeductions();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_deduction() {
            $data['title'] =  $this->lang->line('create_deduction');
            $data['content'] = 'system_records/file_maintenance/deduction/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_deduction() {
            /* These are only the required fields */
            $this->deductionObj->set_name($this->input->post('deduction_name'));
            $this->deductionObj->set_created_by($this->current_user()->id);
            $this->deductionObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('deduction_name', 'deduction name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->deductionObj->deductionExists()) {

                $result = $this->deductionObj->createDeduction();
                if ($result) {
                    redirect('file_maintenance/deduction', 'refresh');
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
                redirect('file_maintenance/deduction/new_deduction', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->deductionObj->set_id($id);
                $this->deductionObj->set_created_by($this->current_user()->id);
                $this->deductionObj->set_company_id($this->current_user()->company_id);

                $result = $this->deductionObj->deactivateDeduction();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted deduction', array('deduction_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete deduction');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/deduction/archive';
            $data['active'] = 'archive';

            $this->deductionObj->set_active(0);
            $this->deductionObj->set_company_id($this->current_user()->company_id);
            $this->deductions = $this->deductionObj->getDeductions();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $deduction_name = $this->input->post('deduction_name');

                /* TODO */
                /* deduction len should not be less than 5 characters */
                /* deduction should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($deduction_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'deduction name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($deduction_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'deduction name must atleast be 5 characters long');
                    exit;
                }

                $this->deductionObj->set_id($id);
                $this->deductionObj->set_name($deduction_name);
                $this->deductionObj->set_last_updated_by($this->current_user()->id);
                $this->deductionObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->deductionObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Deduction name already exists');
                    exit;
                }
                $result = $this->deductionObj->updateDeduction();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated deduction ', array('msg' => 'success!', 'deduction_id' => $id, 'deduction_name' => $deduction_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_deduction_edit_form($id) {
            $this->deduction = $this->deductionObj->getDeductionDetails($id);
            if (!empty($this->deduction)) {
                send_json_response(INFO_LOG, HTTP_OK, 'deduction edit form', array('html' => $this->load->view('system_records/file_maintenance/deduction/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->deductionObj->set_id($id);
                $this->deductionObj->set_last_updated_by($this->current_user()->id);
                $this->deductionObj->set_company_id($this->current_user()->company_id);

                $result = $this->deductionObj->restoreDeduction();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore deduction', array('deduction_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore deduction');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->Deduction_model->getDeductionDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>