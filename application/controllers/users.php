<?php
    class Users extends Application {

        public $user = null;
        public $gender = array(0=>'Male', 1=>'Female');
        public $status = array(0=>'Single', 1=>'Married', 2=>'Widowed');
        public $employee_status = array(0=>'Regular', 1=>'Probitionary', 2=>'Relief', 3=>'Contractual');
        public $security_question = array(0=>'What is your favorite snack?', 1=>"What is your mother's maiden name?", 2=>"What is your pet's name?");

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }

        function logout(){
            $this->ion_auth->logout();
            redirect('home', 'refresh');
//            $data['content'] = 'user/logout';
//            $data['message'] = '';
//            $this->parser->parse('layouts/application', $data);
        }

        function login() {
            redirect('home', 'refresh');
        }

        function show($id) {
            if ($this->_user_exist($id) === true) {
                $data['title'] = $this->lang->line('profile');
                $data['content'] = 'user/show';
                $this->user;

                $this->parser->parse('layouts/application', $data);
            } else {
                echo ('no user!');
                die();
            }
            $this->output->enable_profiler(TRUE);
        }

        function edit($id) {
            if ($this->_user_exist($id) && $id == Application::current_user()->id) {
                if($this->input->is_ajax_request()) {
                    send_json_response(INFO_LOG, HTTP_OK, 'user edit account form', array('html' => $this->load->view('user/edit', '', true)));
                } else {
                    $data['title'] = $this->lang->line('edit_profile');
                    $data['content'] = 'user/edit';
                    $this->parser->parse('layouts/application', $data);

                    $this->output->enable_profiler(TRUE);
                }
            } else {
                show_404();
            }
        }

        function edit_password_settings($id) {
            if ($this->_user_exist($id) && $id == Application::current_user()->id) {

                if($this->input->is_ajax_request()) {
                    send_json_response(INFO_LOG, HTTP_OK, 'user edit password settings form', array('html' => $this->load->view('user/form/password_settings', '', true)));
                }
            }
        }

        function edit_security_settings($id) {
            if ($this->_user_exist($id) && $id == Application::current_user()->id) {

                if($this->input->is_ajax_request()) {
                    send_json_response(INFO_LOG, HTTP_OK, 'user edit security settings form', array('html' => $this->load->view('user/form/security_settings', '', true)));
                }
            }
        }

        function update($id) {
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

                /* TODO */

                /* validate email if correct syntax */

                /* validate email */
                $user->set_userid($id);
                $user->set_email($email);

                if($user->emailExists()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'email already exists');
                    exit;
                }
                /* validate first name if empty*/
                if(is_empty_null_value($first_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'first?? name is required');
                    exit;
                }
                /* validate middle name if empty */
                if(is_empty_null_value($middle_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'middle name is required');
                    exit;
                }
                /* validate last name */
                /* validate address */
                /* validate date_of_birth */
                /* validate home_phone */
                /* validate work_phone */

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

                $result = $user->update_profile();

                if ($result) {
                    send_json_response(INFO_LOG, HTTP_OK, 'successfully update user profile', array('msg' => 'success!'));
                } else {
                    /* flash an error occured */
                }
            } else {
                show_error($lang('unable_to_process_transaction'));
            }
        }

        function update_security_settings($id) {
            if ($this->_user_exist($id)) {
                $userObj = $this->User_model;

                $security_question_id = $_POST['security_question'];
                $security_answer = $_POST['security_answer'];

                $userObj->set_userid($id);
                $userObj->set_securityQuestionId($security_question_id);
                $userObj->set_securityAnswer($security_answer);

                $result = $userObj->updateSecuritySettings();

                if ($result) {
                    /* set flash data */
                        $data['title'] = $this->lang->line('profile');
                        $data['content'] = 'user/show';

                        $this->session->set_flashdata('msg', 'Successfully updated security settings.');
                        $this->session->set_flashdata('msg_class', 'info');
                        redirect('users/'.$id);
                } else {
                    /* error */
                }
            }
        }

        function update_password_settings($id) {
            if ($this->_user_exist($id)) {
                $userObj = $this->User_model;

                $password = $_POST['current_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];

                /* TODO */
                /* validate if password is correct */
                /* validate if new password and confirm password match */
                /* validate password length */

                $userObj->set_userid($id);
                $userObj->set_password($new_password);
                $result = $userObj->updatePassword();
                 if ($result) {
                    /* set flash data */
                        $data['title'] = $this->lang->line('profile');
                        $data['content'] = 'user/show';

                        $this->session->set_flashdata('msg', 'Successfully updated password.');
                        $this->session->set_flashdata('msg_class', 'info');
                        redirect('users/'.$id);
                } else {
                    /* error */
                }
            }
        }

        function _user_exist($id) {
            $this->user = $this->ion_auth->get_user($id);
            if(empty($this->user)) {
                return false;
            } else {
                return true;
            }
        }
    }

?>