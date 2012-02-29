<?php
    class Category extends Application {

        public $categories = null;
        public $category = null;
        private $categoryObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Category_model');
            $this->categoryObj = new $this->Category_model();
        }

        function index() {
            $data['title'] = $this->lang->line('category');
            $data['content'] = 'system_records/file_maintenance/category/index';
            $data['active'] = 'list';

            $this->categoryObj->set_company_id($this->current_user()->company_id);
            $this->categories = $this->categoryObj->getCategories();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_category() {
            $data['title'] =  $this->lang->line('create_category');
            $data['content'] = 'system_records/file_maintenance/category/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_category() {
            /* These are only the required fields */
            $this->categoryObj->set_code($this->input->post('code'));
            $this->categoryObj->set_name($this->input->post('category_name'));
            $this->categoryObj->set_created_by($this->current_user()->id);
            $this->categoryObj->set_company_id($this->current_user()->company_id);

            $this->form_validation->set_rules('code', 'category code', 'required');
            $this->form_validation->set_rules('category_name', 'category name', 'required');

            /* TODO: validate if department name exist */
            if ($this->form_validation->run() == TRUE && !$this->categoryObj->categoryExists()) {

                $result = $this->categoryObj->createCategory();
                if ($result) {
                    redirect('file_maintenance/category', 'refresh');
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
                redirect('file_maintenance/category/new_category', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->categoryObj->set_id($id);
                $this->categoryObj->set_created_by($this->current_user()->id);
                $this->categoryObj->set_company_id($this->current_user()->company_id);

                $result = $this->categoryObj->deactivateCategory();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted category', array('category_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete category');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/category/archive';
            $data['active'] = 'archive';

            $this->categoryObj->set_active(0);
            $this->categoryObj->set_company_id($this->current_user()->company_id);
            $this->categories = $this->categoryObj->getCategories();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $category_code = $this->input->post('code');
                $category_name = $this->input->post('category_name');

                /* TODO */
                /* code len should not be less than 5 characters */
                /* code should not be empty */

                /* validate category name if empty*/
                if(is_empty_null_value($category_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'category name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($category_name) < 5) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'category name must atleast be 5 characters long');
                    exit;
                }

                $this->categoryObj->set_id($id);
                $this->categoryObj->set_code($category_code);
                $this->categoryObj->set_name($category_name);
                $this->categoryObj->set_last_updated_by($this->current_user()->id);
                $this->categoryObj->set_company_id($this->current_user()->company_id);

                /* category should not be the same name with other department */
                if($this->categoryObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Department name already exists');
                    exit;
                }
                $result = $this->categoryObj->updatecategory();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated department ', array('msg' => 'success!', 'category_id' => $id, 'category_name' => $category_name, 'code' => $category_code ));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_category_edit_form($id) {
            $this->category = $this->categoryObj->getCategoryDetails($id);
            if (!empty($this->category)) {
                send_json_response(INFO_LOG, HTTP_OK, 'category edit form', array('html' => $this->load->view('system_records/file_maintenance/category/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->categoryObj->set_id($id);
                $this->categoryObj->set_last_updated_by($this->current_user()->id);
                $this->categoryObj->set_company_id($this->current_user()->company_id);

                $result = $this->categoryObj->restoreCategory();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore category', array('category_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore category');
                }
            }
        }


        private function _record_exist($id) {
            $this->category = $this->Category_model->getCategoryDetails($id);
            if (empty($this->category)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>