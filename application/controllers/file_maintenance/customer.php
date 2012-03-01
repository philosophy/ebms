<?php
    class Customer extends Application {

        public $customers = null;
        public $customer = null;
        private $customerObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Customer_model');
            $this->customerObj = new $this->Customer_model();
        }

        function index() {
            $data['title'] = $this->lang->line('customer');
            $data['content'] = 'system_records/file_maintenance/customer/index';
            $data['active'] = 'list';

            $this->customerObj->set_company_id($this->current_user()->company_id);
            $this->customers = $this->customerObj->getCustomers();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_customer() {
            $data['title'] =  $this->lang->line('create_customer');
            $data['content'] = 'system_records/file_maintenance/customer/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_customer() {
            /* These are only the required fields */
            $this->customerObj->set_name($this->input->post('customer_name'));
            $this->customerObj->set_created_by($this->current_user()->id);
            $this->customerObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('customer_name', 'customer name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->customerObj->customerExists()) {

                $result = $this->customerObj->createCustomer();
                if ($result) {
                    redirect('file_maintenance/customer', 'refresh');
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
                redirect('file_maintenance/customer/new_customer', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->customerObj->set_id($id);
                $this->customerObj->set_created_by($this->current_user()->id);
                $this->customerObj->set_company_id($this->current_user()->company_id);

                $result = $this->customerObj->deactivateCustomer();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted customer', array('customer_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete customer');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/customer/archive';
            $data['active'] = 'archive';

            $this->customerObj->set_active(0);
            $this->customerObj->set_company_id($this->current_user()->company_id);
            $this->customers = $this->customerObj->getCustomers();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $customer_name = $this->input->post('customer_name');
                $description = $this->input->post('description');

                /* TODO */
                /* description len should not be less than 5 characters */
                /* description should not be empty */

                /* validate unit name if empty*/
                if(is_empty_null_value($customer_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'customer name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($customer_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'customer name must atleast be 5 characters long');
                    exit;
                }

                $this->customerObj->set_id($id);
                $this->customerObj->set_name($customer_name);
                $this->customerObj->set_description($description);
                $this->customerObj->set_last_updated_by($this->current_user()->id);
                $this->customerObj->set_company_id($this->current_user()->company_id);

                /* unit should not be the same name with other department */
                if($this->customerObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Customer name already exists');
                    exit;
                }
                $result = $this->customerObj->updateCustomer();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated customer ', array('msg' => 'success!', 'customer_id' => $id, 'customer_name' => $customer_name_name ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_customer_edit_form($id) {
            $this->status = $this->customerObj->getCustomerDetails($id);
            if (!empty($this->status)) {
                send_json_response(INFO_LOG, HTTP_OK, 'customer edit form', array('html' => $this->load->view('system_records/file_maintenance/customer/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->customerObj->set_id($id);
                $this->customerObj->set_last_updated_by($this->current_user()->id);
                $this->customerObj->set_company_id($this->current_user()->company_id);

                $result = $this->customerObj->restoreCustomer();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore customer', array('customer_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore customer');
                }
            }
        }


        private function _record_exist($id) {
            $this->status = $this->Customer_model->getCustomerDetails($id);
            if (empty($this->status)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>