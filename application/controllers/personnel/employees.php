<?php
    class Employees extends Application {
        
        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }
        
        function index() {
            $data['content'] = 'personnel/employee/profile';
            $data['title'] = lang('employee_profile');
            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }
        
        function get_new_employee_form() {
            send_json_response(INFO_LOG, HTTP_OK, 'new employee form', array('html' => $this->load->view('personnel/employee/_new_employee_form', '', true)));
        }
    }
?>