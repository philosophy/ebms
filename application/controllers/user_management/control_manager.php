<?php
    class Control_Manager extends Application {

        function __construct() {
            parent::__construct();
        }

        function index() {
            $data['title'] = $this->lang->line('control_manager');
            $data['content'] = 'user_management/control_manager/index';

            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }
    }
?>