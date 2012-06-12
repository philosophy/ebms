<?php
    class Time_Sheets extends Employees_Base {
        public $employee_id;
        public $time_record_obj;
        public $time_sheet_list;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->model('Time_Records_model');

            $this->time_record_obj = new $this->Time_Records_model();
            $method = $this->router->method;
            if ($method == 'index') {
                parent::load_employees();
            }
        }

        function index(){
            $data['content'] = 'personnel/time_sheets/index';
            $data['title'] = lang('employee_time_sheets');

            $this->time_sheet_list = $this->time_record_obj->get_time_records_list(array('company_id' => $this->current_avatar->company_id));
            $this->parser->parse('layouts/application', $data);
            $this->output->enable_profiler(TRUE);
        }
    }
?>