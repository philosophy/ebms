<?php
    class Leaves extends Application {

        public $leave;
        public $leaves_list;

        private $leaveObj;
        private $name;
        private $days;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();

            $this->load->model('Leave_model');
            $this->leaveObj = new $this->Leave_model();

            $method = $this->router->method;
            if ($method == 'create_leave' || $method == 'update') {
                $this->_ensure_required_fields();
            }
        }

        function index() {
            $data['title'] = $this->lang->line('employee_leaves');
            $data['content'] = 'system_records/file_maintenance/leaves/index';
            $data['active'] = 'list';

            $this->leaves_list = $this->leaveObj->get_leaves_list(array(
                'company_id' => $this->current_avatar->company_id
            ));

            $this->parser->parse('layouts/application', $data);
            parent::enableProfiler();
        }

        function new_leave() {
            $data['title'] =  $this->lang->line('create_leave');
            $data['content'] = 'system_records/file_maintenance/leaves/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function create_leave() {
            $result = $this->leaveObj->create_leave(array(
                'name' => $this->name,
                'days' => $this->days,
                'created_by' => $this->current_avatar->id,
                'company_id' => $this->current_avatar->company_id,
                'date_created' => date($this->config->item('date_format'))
            ));

            if ($result) {
                $this->session->set_flashdata('msg', 'successfully created new employee leave');
                $this->session->set_flashdata('msg_class', 'success');
                redirect('file_maintenance/leaves', 'refresh');
            } else {
                $this->session->set_flashdata('msg', lang('an_error_occured'));
                $this->session->set_flashdata('msg_class', 'error');
                redirect('file_maintenance/leaves/new_leave', 'refresh');
            }

        }

        function update($id) {
            $result = $this->leaveObj->update_leave(array(
                'id' => $id,
                'name' => $this->name,
                'days' => $this->days,
                'employee_id' => $this->current_avatar->id,
                'last_updated_at' => date($this->config->item('date_format'))
            ));

            if ($result) {
                send_json_response(INFO_LOG, HTTP_OK, 'successfully updated leave', array('msg' => 'success!', 'leave_id' => $id, 'name' => $this->name, 'days' => $this->days ));
            } else {

            }
        }

        function get_leave_edit_form($id) {
            $this->leave = $this->leaveObj->get_leaves_list(array('id' => $id));

            if (!empty($this->leave)) {
                $this->leave = $this->leave[0];
                send_json_response(INFO_LOG, HTTP_OK, 'leave edit form', array('html' => $this->load->view('system_records/file_maintenance/leaves/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function delete($id) {
            $result = $this->leaveObj->update_leave(array(
                'id' => $id,
                'employee_id' => $this->current_avatar->id,
                'last_updated_at' => date($this->config->item('date_format')),
                'active' => 0
            ));
            if ($result) {
                send_json_response(INFO_LOG, HTTP_OK, 'successfully deleted leave', array('leave_id' => $id));
            } else {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to delete leave');
            }
        }

        function restore($id) {
            $result = $this->leaveObj->update_leave(array(
                'id' => $id,
                'employee_id' => $this->current_avatar->id,
                'last_updated_at' => date($this->config->item('date_format')),
                'active' => 1
            ));
            if ($result) {
                send_json_response(INFO_LOG, HTTP_OK, 'successfully restored leave', array('leave_id' => $id));
            } else {
                send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'unable to restore leave');
            }
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/file_maintenance/leaves/archive';
            $data['active'] = 'archive';

            $this->leaves_list = $this->leaveObj->get_leaves_list(array(
                'company_id' => $this->current_avatar->company_id,
                'active' => 0
            ));

            $this->parser->parse('layouts/application', $data);
            parent::enableProfiler();
        }

        private function _ensure_required_fields() {
            $this->days = $this->input->post('days', true);
            $this->name = $this->input->post('name', true);
            $has_error = false;
            if (empty($this->name)) {
                $has_error = true;
                $msg = lang('leave_name_cant_be_blank');
            } else if (empty($this->days)) {
                $has_error = true;
                $msg = lang('leave_days_cant_be_blank');
            } else if (!is_numeric($this->days)) {
                $has_error = true;
                $msg = lang('leave_days_must_be_a_number');
            }

            if ($has_error) {
                if ($this->input->is_ajax_request()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, $msg);
                    exit;
                } else {
                    $this->session->set_flashdata('msg', $msg);
                    $this->session->set_flashdata('msg_class', 'error');
                    redirect('file_maintenance/leaves/new_leave', 'refresh');
                    exit;
                }
            }
        }
    }
?>