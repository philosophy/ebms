<?php
    class Department_Manager extends Application {

        public $departments = null;
        public $dept = null;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }

        function index() {
            $data['title'] = $this->lang->line('department_manager');
            $data['content'] = 'system_records/file_maintenance/department_manager/index';
            $data['active'] = 'list';
            
            $this->load->model('Department_model');
            
            $this->departments = $this->Department_model->getDepartments();            
            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }
    }
 ?>