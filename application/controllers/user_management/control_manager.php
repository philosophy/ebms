<?php
    class Control_Manager extends Application {

        public $users = null;
        public $user = null;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }

        function index() {
            $tab = '';
            $title = $this->lang->line('control_manager');
            $content = 'system_records/user_management/control_manager/index';
            $active = 'list';

            $tab = $this->uri->segment(3, 'list');
            switch($tab) {
                case 'list':
                    $title = $this->lang->line('user_list');
                    $content = 'system_records/user_management/control_manager/index';
                    $active = 'list';
                    $this->db->where('archive =', 0);
                    $this->users = $this->ion_auth->get_users();
                break;

                case 'create':

                break;

                case 'archive':
                    $title = $this->lang->line('archive');
                    $content = 'system_records/user_management/control_manager/index';
                    $active = 'archive';
                break;
            }

            $data['title'] = $title;
            $data['content'] = $content;
            $data['active'] = $active;

            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }

        function new_user() {
            $data['title'] =  $this->lang->line('create_user');
            $data['content'] = 'system_records/user_management/control_manager/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }

        function create_user() {
            $user = new $this->User_model();

            /* These are only the required fields */
            $user->set_username($this->input->post('username'));
            $user->set_first_name($this->input->post('first_name'));
            $user->set_last_name($this->input->post('last_name'));
            $user->set_address($this->input->post('address'));
            $user->set_email($this->input->post('email'));
            $user->set_password($this->input->post('password'));
            $user->set_group_id($this->input->post('group_id'));

            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == TRUE) {
                $result = $user->createUser();
                if ($result) {
                    redirect('user_management/control_manager', 'refresh');
                } else {
                    /* return with errors */
                }

            } else {
                /* return with errors */
                $data['title'] =  $this->lang->line('create_user');
                $data['content'] = 'system_records/user_management/control_manager/new';
                $data['active'] = 'create';

                $this->parser->parse('layouts/application', $data);
            }
            $this->output->enable_profiler(TRUE);
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/user_management/control_manager/archive';
            $data['active'] = 'archive';

            $this->db->where('archive =', 1);
            $this->users = $this->ion_auth->get_users();

            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }

        function get_useredit_form($id){
            $this->user = $this->ion_auth->get_user($id);
            if ($this->user) {
                send_json_response(INFO_LOG, HTTP_OK, 'user edit account form', array('html' => $this->load->view('system_records/user_management/control_manager/_edit', '', true)));
            } else {
                send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'bad request');
            }
        }

        function update_user($id) {
            if ($this->_user_exist($id)) {
                $user = new $this->User_model;

                $username = $_POST['username'];
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $gender = $_POST['gender'];
                $date_of_birth = $_POST['date_of_birth'];
                $status_id = $_POST['status_id'];
                $home_phone = $_POST['home_phone'];
                $work_phone = $_POST['work_phone'];
                $group_id = $_POST['group_id'];

                /* TODO */

                /* validate email if correct syntax */

                /* validate email */
                $user->set_userid($id);
                $user->set_email($email);

                if($user->emailExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Email already exists');
                    exit;
                }
                /* validate first name if empty*/
                if(is_empty_null_value($first_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'first name is required');
                    exit;
                }
                /*check the string length*/
                if(is_length_valid($first_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'It must be more than 4 characters');
                    exit;
                }
                /*letters only*/
                if(no_number($first_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Letters only');
                    exit;
                }

                /***********************************************************************************/

                /* validate last name */
                if(is_empty_null_value($last_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'last name is required');
                    exit;
                }

                /*check the string length*/
                if(is_length_valid($last_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'It must be more than 4 characters');
                    exit;
                }
                /*letters only*/
                if(no_number($last_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'Letters only');
                    exit;
                }

                /* add additional validation for group */

                $user->set_userid($id);
                $user->set_username($username);
                $user->set_first_name($first_name);
                $user->set_middle_name($middle_name);
                $user->set_last_name($last_name);
                $user->set_email($email);
                $user->set_address($address);
                $user->set_gender($gender);
                $user->set_date_of_birth($date_of_birth);
                $user->set_status_id($status_id);
                $user->set_home_phone($home_phone);
                $user->set_work_phone($work_phone);
                $user->set_group_id($group_id);

                $result = $user->update_user();

                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully update user profile', array('msg' => 'success!', 'userid' => $id, 'username' => $username, 'email' => $email, 'name' => $first_name.' '.$last_name));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error($lang('unable_to_process_transaction'));
            }
        }

        private function _user_exist($id) {
            $this->user = $this->ion_auth->get_user($id);
            if(empty($this->user)) {
                return false;
            } else {
                return true;
            }
        }
    }
?>