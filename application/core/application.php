<?php
    class Application extends CI_Controller {
        public $current_avatar;

        public function __construct() {
            parent::__construct();
            $this->current_avatar = $this->current_user();
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

        function enableProfiler() {
            if (ENVIRONMENT == 'development') {
                $this->output->enable_profiler(TRUE);
            }
        }

        function sample_pages_for_admin_only() {
            if (ENVIRONMENT != 'development' && !$this->current_avatar->id == 1) {
                redirect('home/index', 'refresh');
            }
        }

        function authorize_action($options) {
            if (isset($options['employee_id'])) {
                $this->employeeObj->set_id($options['employee_id']);
                $emp = $this->employeeObj->getEmployeeDetails();
                if ($emp->company_id != $this->current_avatar->company_id) {
                    show_error('message', 401);
                }
            }
        }
    }

?>