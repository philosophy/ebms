<?php
    class Currency extends Application {

        public $currencies = null;
        public $currency = null;
        private $currencyObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Currency_model');
            $this->currencyObj = new $this->Currency_model();
        }

        function index() {
            $data['title'] = $this->lang->line('currency');
            $data['content'] = 'system_records/file_maintenance/currency/index';
            $data['active'] = 'list';

            $this->currencyObj->set_company_id($this->current_avatar->company_id);
            $this->currencies = $this->currencyObj->getCurrencies();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_currency() {
            $data['title'] =  $this->lang->line('create_currency');
            $data['content'] = 'system_records/file_maintenance/currency/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_currency() {
            /* These are only the required fields */
            $this->currencyObj->set_name($this->input->post('currency_name'));
            $this->currencyObj->set_created_by($this->current_user()->id);
            $this->currencyObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('currency_name', 'currency name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->currencyObj->currencyExists()) {

                $result = $this->currencyObj->createCurrency();
                if ($result) {
                    redirect('file_maintenance/currency', 'refresh');
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
                redirect('file_maintenance/currency/new_currency', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->currencyObj->set_id($id);
                $this->currencyObj->set_created_by($this->current_user()->id);
                $this->currencyObj->set_company_id($this->current_user()->company_id);

                $result = $this->currencyObj->deactivateCurrency();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted currency', array('currency_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete currency');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/currency/archive';
            $data['active'] = 'archive';

            $this->currencyObj->set_active(0);
            $this->currencyObj->set_company_id($this->current_user()->company_id);
            $this->currencies = $this->currencyObj->getCurrencies();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $currency_name = $this->input->post('currency_name');

                /* TODO */
                /* currency len should not be less than 5 characters */
                /* currency should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($currency_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'currency name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($currency_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'currency name must atleast be 5 characters long');
                    exit;
                }

                $this->currencyObj->set_id($id);
                $this->currencyObj->set_name($currency_name);
                $this->currencyObj->set_last_updated_by($this->current_user()->id);
                $this->currencyObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->currencyObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Currency name already exists');
                    exit;
                }
                $result = $this->currencyObj->updateCurrency();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated currency ', array('msg' => 'success!', 'currency_id' => $id, 'currency_name' => $currency_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_currency_edit_form($id) {
            $this->currency = $this->currencyObj->getCurrencyDetails($id);
            if (!empty($this->currency)) {
                send_json_response(INFO_LOG, HTTP_OK, 'currency edit form', array('html' => $this->load->view('system_records/file_maintenance/currency/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->currencyObj->set_id($id);
                $this->currencyObj->set_last_updated_by($this->current_user()->id);
                $this->currencyObj->set_company_id($this->current_user()->company_id);

                $result = $this->currencyObj->restoreCurrency();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore currency', array('currency_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore currency');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->Currency_model->getCurrencyDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>