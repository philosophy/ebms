<?php
    class Sub_Category extends Application {

        public $sub_categories = null;
        public $sub_category = null;
        private $subCategoryObj;
        public $categories = null;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Sub_category_model');
            $this->subCategoryObj = new $this->Sub_category_model();
        }

        function index() {
            $data['title'] = $this->lang->line('category');
            $data['content'] = 'system_records/file_maintenance/sub_category/index';
            $data['active'] = 'list';

            $this->subCategoryObj->set_company_id($this->current_user()->company_id);
            $this->sub_categories = $this->subCategoryObj->getSubCategories();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_sub_category() {
            $data['title'] =  $this->lang->line('create_sub_category');
            $data['content'] = 'system_records/file_maintenance/sub_category/new';
            $data['active'] = 'create';

            $this->subCategoryObj->set_company_id($this->current_avatar->company_id);
            $this->categories = $this->subCategoryObj->getCategories();
            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_sub_category() {
            /* These are only the required fields */
            $this->subCategoryObj->set_code($this->input->post('code'));
            $this->subCategoryObj->set_name($this->input->post('sub_category_name'));
            $this->subCategoryObj->set_created_by($this->current_user()->id);
            $this->subCategoryObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('code', 'sub category code', 'required');
            $this->form_validation->set_rules('sub_category_name', 'sub category name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->subCategoryObj->subCategoryExists()) {

                $result = $this->subCategoryObj->createCategory();
                if ($result) {
                    redirect('file_maintenance/sub_category', 'refresh');
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
                redirect('file_maintenance/sub_category/new_sub_category', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->subCategoryObj->set_id($id);
                $this->subCategoryObj->set_created_by($this->current_user()->id);
                $this->subCategoryObj->set_company_id($this->current_user()->company_id);

                $result = $this->subCategoryObj->deactivateCategory();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted sub category', array('sub_category_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete sub category');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/sub_category/archive';
            $data['active'] = 'archive';

            $this->subCategoryObj->set_active(0);
            $this->subCategoryObj->set_company_id($this->current_user()->company_id);
            $this->sub_categories = $this->subCategoryObj->getCategories();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $sub_category_code = $this->input->post('code');
                $sub_category_name = $this->input->post('sub_category_name');

                /* TODO */
                /* code len should not be less than 5 characters */
                /* code should not be empty */

                /* validate sub_category name if empty*/
                if(is_empty_null_value($sub_category_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'sub category name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($sub_category_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'sub category name must atleast be 5 characters long');
                    exit;
                }

                $this->subCategoryObj->set_id($id);
                $this->subCategoryObj->set_code($sub_category_code);
                $this->subCategoryObj->set_name($sub_category_name);
                $this->subCategoryObj->set_last_updated_by($this->current_user()->id);
                $this->subCategoryObj->set_company_id($this->current_user()->company_id);

                /* sub_category should not be the same name with other department */
                if($this->subCategoryObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Department name already exists');
                    exit;
                }
                $result = $this->subCategoryObj->updateSubCategory();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated department ', array('msg' => 'success!', 'sub_category_id' => $id, 'sub_category_name' => $sub_category_name, 'code' => $sub_category_code ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_sub_category_edit_form($id) {
            $this->sub_category = $this->subCategoryObj->getCategoryDetails($id);
            if (!empty($this->sub_category)) {
                send_json_response(INFO_LOG, HTTP_OK, 'sub category edit form', array('html' => $this->load->view('system_records/file_maintenance/sub_category/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->subCategoryObj->set_id($id);
                $this->subCategoryObj->set_last_updated_by($this->current_user()->id);
                $this->subCategoryObj->set_company_id($this->current_user()->company_id);

                $result = $this->subCategoryObj->restoreCategory();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore sub category', array('sub_category_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore sub category');
                }
            }
        }


        private function _record_exist($id) {
            $this->sub_category = $this->Category_model->getCategoryDetails($id);
            if (empty($this->sub_category)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>