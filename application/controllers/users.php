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
        
        function edit_security_settings($id) {
            if ($this->_user_exist($id) && $id == Application::current_user()->id) {
                
                /* validate password */
                
                /* check if current and new password match */
                
                /* check if password length is correct */
                
                if($this->input->is_ajax_request()) {
                    send_json_response(INFO_LOG, HTTP_OK, 'user edit security settings form', array('html' => $this->load->view('user/form/security_settings', '', true)));                    
                }
            }
        }
        
        function update($id) {            
            if ($this->_user_exist($id)) {
                $userObj = $this->User_model;
                
                $this->load->library('form_validation');                
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('first_name', 'First Name', 'required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'required');
                $this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('date_of_birth', 'Birth Date', 'required');
                $this->form_validation->set_rules('gender', 'gender', 'required');
                $this->form_validation->set_rules('status_id', 'Marital Status', 'required');
                    
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
                
                if ($this->form_validation->run() == true) {
                    
                    /* TODO */
                    /* validate email */
                    /* validate first name len */
                    /* validate middle name len */
                    /* validate last name len */
                    
                    $userObj->set_userid($id);
                    $userObj->set_username($username);
                    $userObj->set_first_name($first_name);
                    $userObj->set_middle_name($middle_name);
                    $userObj->set_last_name($last_name);
                    $userObj->set_email($email);
                    $userObj->set_address($address);
                    $userObj->set_gender($gender);
                    $userObj->set_date_of_birth($date_of_birth);
                    $userObj->set_status_id($status_id);
                    $userObj->set_home_phone($home_phone);
                    $userObj->set_work_phone($work_phone);
                    
                    $result = $userObj->update_profile();
                    
                    if ($result) {
                        /* set flash data */
                        $data['title'] = $this->lang->line('profile');
                        $data['content'] = 'user/show';
                        
                        $this->session->set_flashdata('msg', 'Successfully updated account.');
                        $this->session->set_flashdata('msg_class', 'info');
                        redirect('users/'.$userObj->get_userid());
                    } else {
                        /* flash an error occured */
                    }
                    
                } else {
                    /* render error! */
                    redirect('users/edit/'.$id);
                }
            } else {
                show_error($lang('unable_to_process_transaction'));
            }
            $this->output->enable_profiler(TRUE);
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