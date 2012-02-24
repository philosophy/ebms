<?php
    class Audit_Trail extends Application {

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }

        function index() {
            $auditTrail = new $this->Audit_trail_model();

            $config['base_url'] = base_url().'user_management/audit_trail/index/';
            $config['total_rows'] = $auditTrail->countUserActions();
            $config['per_page'] = 10;
            $config['next_link'] = '&gt;';
            $config['prev_link'] = '&lt;';
            $config['num_links'] = 2;
            $config['uri_segment'] = 4;

            $auditTrail->set_limit($config['per_page']);
            $auditTrail->set_offset($this->uri->segment(4));
            $data['actions'] = $auditTrail->getUserActions();;
            $data['title'] = lang('audit_trail');
            $data['content'] = 'system_records/user_management/audit_trail/index';

            $this->pagination->initialize($config);
            $data['pagination_links'] = $this->pagination->create_links();

            $this->parser->parse('layouts/application', $data);
            $this->output->enable_profiler(TRUE);
        }

        function browse() {

        }

    }
?>