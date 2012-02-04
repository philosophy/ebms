<?php
    class Application extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
        }
        
        function authenticate_user() {
            if (!$this->ion_auth->logged_in()) {
                redirect('home/index', 'refresh');
            } 
        }
        
        function is_user_logged_in() {
            if ($this->ion_auth->logged_in()) {
                return true;
            } else {
                return false;
            }
        }
        
        function current_user() {
            return $this->ion_auth->get_user();
        }
        
        function get_user($id=null) {            
            $user = null;
            if (isset($id)) {
                $user = $this->ion_auth->get_user($id);
            } 
            
            return $user;
        }
    }

?>