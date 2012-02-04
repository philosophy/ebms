<?php
    class Users extends Application {
        
        public $user = null;
        public $gender = array(0=>'Male', 1=>'Female');
        public $status = array(0=>'Single', 1=>'Married', 2=>'Widowed');
        public $employee_status = array(0=>'Regular', 1=>'Probitionary', 2=>'Relief', 3=>'Contractual');
        
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