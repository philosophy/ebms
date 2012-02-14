<?php

class Company extends Application {

    public $company = null;

    function __construct() {
        parent::__construct();
        Application::authenticate_user();
    }

    function index() {

        $this->load->model('Company_model');

        $data['content'] = 'system_records/file_maintenance/company/index';
        $data['active_link'] = 'home';
        $data['title'] = 'Dashboard';


        $company = new $this->Company_model();
        $this->company = $company->getCompanyInfo();

        $this->parser->parse('layouts/application', $data);

        $this->output->enable_profiler(TRUE);
    }
}

?>
