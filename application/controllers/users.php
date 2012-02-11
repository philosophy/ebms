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
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, $email);
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
                if(is_empty_null_value($last_name)) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'last name is required');
                    exit;
                }
                /* validate address */
                //if(is_empty_null_value($address))  {
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
                $user = new $this->User_model;

                $security_question_id = $_POST['security_question_id'];
                $security_answer = $_POST['security_answer'];

                $user->set_userid($id);
                $user->set_securityQuestionId($security_question_id);
                $user->set_securityAnswer($security_answer);

                $result = $user->updateSecuritySettings();
                if ($result) {
                    if ($this->input->is_ajax_request()) {
                        send_json_response(INFO_LOG, HTTP_OK, 'security settings updated successfully', array('security_question_id' => $security_question_id));
                    }
                } else {
                    /* error */
                    if ($this->input->is_ajax_request()) {
                        send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'an error has occured');
                    }
                }
            }
        }

        function update_password_settings($id) {
            if ($this->_user_exist($id)) {
                $user = $this->User_model;

                $current_password = $_POST['current_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];

                $user->set_userid($id);
                $email = $user->retrieveUserEmail();
                $user->set_email($email);
                /* TODO */
                /* validate if current password is not empty */
                /* validate if current password is correct */
                $user->set_password($current_password);
                if (!$user->verifyOldPassword()) {
                    send_json_response(ERROR_LOG, HTTP_FAIL_PRECON, 'incorrect password');
                    exit;
                }
                /* validate if new password is not empty */
                /* validate if confirm password is not empty */
                /* validate if new password and confirm password match */
                /* validate password length */

                $user->set_new_password($new_password);
                $result = $user->updatePassword();
                 if ($result) {
                     if($this->input->is_ajax_request()) {
                        send_json_response(INFO_LOG, HTTP_OK, 'updated password successfully');
                     }
                } else {
                    /* error */
                    if($this->input->is_ajax_request()) {
                        send_json_response(ERROR_LOG, HTTP_BAD_REQUEST, 'an error has occured');
                    }
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