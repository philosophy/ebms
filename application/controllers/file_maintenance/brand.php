<?php
    class Brand extends Application {

        public $brands = null;
        public $brand = null;
        public $categories = null;
        public $sub_categories = null;
        public $sub_category = null;
        private $brandObj;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Brand_model');
            $this->brandObj = new $this->Brand_model();
        }

        function index() {
            $data['title'] = $this->lang->line('brand');
            $data['content'] = 'system_records/file_maintenance/brand/index';
            $data['active'] = 'list';

            $this->brandObj->set_company_id($this->current_avatar->company_id);
            $this->brands = $this->brandObj->getBrands();

            $this->sub_categories = $this->brandObj->getSubCategories();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function new_brand() {
            $data['title'] =  $this->lang->line('create_brand');
            $data['content'] = 'system_records/file_maintenance/brand/new';
            $data['active'] = 'create';

            $this->brandObj->set_company_id($this->current_avatar->company_id);
            $this->sub_categories = $this->brandObj->getSubCategories();
            $this->categories = $this->brandObj->getCategories();
            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_brand() {
            /* These are only the required fields */
            $this->brandObj->set_name($this->input->post('brand_name'));
            $this->brandObj->set_sub_category_id($this->input->post('sub_category'));
            $this->brandObj->set_created_by($this->current_avatar->id);
            $this->brandObj->set_company_id($this->current_avatar->company_id);

            $this->form_validation->set_rules('sub_category', 'sub category', 'required');
            $this->form_validation->set_rules('brand_name', 'brand name', 'required');

            /* TODO: validate if sub category name exist */
            if ($this->form_validation->run() == TRUE && !$this->brandObj->brandExists()) {

                $result = $this->brandObj->createBrand();
                if ($result) {
                    redirect('file_maintenance/brand', 'refresh');
                } else {
                    /* TODO: return with errors */
                }
            } else {
                /* return with errors */
//                $data['title'] =  $this->lang->line('create_sub category');
//                $data['content'] = 'system_records/file_maintenance/sub category/new';
//                $data['active'] = 'create';

                $this->session->set_flashdata('msg', lang('an_error_occured'));
                $this->session->set_flashdata('msg_class', 'error');
                redirect('file_maintenance/brand/new_brand', 'refresh');
//                $this->parser->parse('layouts/application', $data);
            }

            parent::enableProfiler();
        }

        function delete($id) {
            if ($this->_record_exist($id)) {
                $this->brandObj->set_id($id);
                $this->brandObj->set_created_by($this->current_avatar->id);
                $this->brandObj->set_company_id($this->current_avatar->company_id);

                $result = $this->brandObj->deactivateBrand();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted brand', array('brand_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete brand');
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/brand/archive';
            $data['active'] = 'archive';

            $this->brandObj->set_active(0);
            $this->brandObj->set_company_id($this->current_avatar->company_id);
            $this->brands = $this->brandObj->getBrands();

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function update($id) {

            /* check if record exist */
             if ($this->_record_exist($id)) {
                $brand_name = $this->input->post('brand_name');
                $sub_category_id = $this->input->post('sub_category');

                /* TODO */
                /* sub category id should not be empty */
                /* brand name should not be empty */

                /* validate sub_category name if empty*/
                if(is_empty_null_value($sub_category_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'brand name is required');
                    exit;
                }
                /*check the string length*/
                if(strlen($sub_category_name) < 3) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'brand name must atleast be 3 characters long');
                    exit;
                }

                $this->brandObj->set_id($id);
                $this->brandObj->set_name($brand_name);
                $this->brandObj->set_sub_category_id($sub_category_id);
                $this->brandObj->set_last_updated_by($this->current_avatar->id);
                $this->brandObj->set_company_id($this->current_avatar->company_id);

                /* sub_category should not be the same name with other sub category */
                if($this->brandObj->recordExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'brand name must be unique');
                    exit;
                }
                $result = $this->brandObj->updateBrand();
                if ($result) {
                    /* push audit trail */
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully updated brand', array('msg' => 'success!', 'brand_id' => $id, 'brand_name' => $brand_name, 'sub_category_id' => $sub_category_id));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error(lang('unable_to_process_transaction'));
            }
        }

        function get_brand_edit_form($id) {
            $this->brandObj->set_company_id($this->current_avatar->id);
            $this->brand = $this->brandObj->getBrandDetails($id);
            $this->brandObj->set_company_id($this->current_avatar->company_id);
            $this->categories = $this->brandObj->getCategories();

            /* get category_id of subcategory */
            $this->load->model('Sub_category_model');
            $this->sub_category = $this->Sub_category_model->getSubCategoryDetails($this->brand->sub_category_id);

            $this->Sub_category_model->set_category_id($this->sub_category->category_id);
            $this->Sub_category_model->set_company_id($this->current_avatar->company_id);

            /* select sub categories for a particular */
            $this->sub_categories = $this->Sub_category_model->getSubCategoriesByCategoryId();

            if (!empty($this->brand)) {
                send_json_response(INFO_LOG, HTTP_OK, 'brand edit form', array('html' => $this->load->view('system_records/file_maintenance/brand/_edit', '', true), 'category_id' => $this->sub_category->sub_category_id));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function restore($id) {
            if ($this->_record_exist($id)) {

                $this->brandObj->set_id($id);
                $this->brandObj->set_last_updated_by($this->current_avatar->id);
                $this->brandObj->set_company_id($this->current_avatar->company_id);

                $result = $this->brandObj->restoreBrand();
                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully restore brand', array('brand_id' => $id));
                } else {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore brand');
                }
            }
        }


        private function _record_exist($id) {
            $this->brand = $this->Brand_model->getBrandDetails($id);
            if (empty($this->brand)) {
                return false;
            } else {
                return true;
            }
        }

}
 ?>