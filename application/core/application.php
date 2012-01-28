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
    }

?>