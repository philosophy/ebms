<?php
    class Dashboard extends Application {
        
        public function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }
        
        function index() {
            $data['content'] = 'dashboard/index';
            $data['active_link'] = 'home';
            $data['title'] = 'Dashboard';
            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }

    }

?>