<?php
    class Audit_Trail extends Application {

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
            $this->load->library('pagination');
        }

        function index() {
            $auditTrail = new $this->Audit_trail_model();
            $actions = $auditTrail->getUserActions();

            $config['base_url'] = site_url('user_management/audit_trail/browse/?');
            $config['total_rows'] = count($actions);
            $config['per_page'] = $auditTrail->countUserActions();
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['num_links'] = 3;

            $data['actions'] = $actions;
            $data['title'] = lang('audit_trail');
            $data['content'] = 'system_records/user_management/audit_trail/index';

            $this->pagination->initialize($config);
            $data['pagination_links'] = $this->pagination->create_links($config);

            $this->parser->parse('layouts/application', $data);
            $this->output->enable_profiler(TRUE);
        }

        function browse() {

            $page = $this->input->get('per_page', TRUE);
            $offset = (($page -1) * 10);

            $auditTrail = new $this->Audit_trail_model();
            $auditTrail->set_offset($offset);
            $actions = $auditTrail->getUserActions();

            $config['base_url'] = site_url('user_management/audit_trail/browse/?');
            $config['total_rows'] = count($actions);
            $config['per_page'] = $auditTrail->countUserActions();
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['num_links'] = 3;

            $data['actions'] = $actions;
            $data['title'] = lang('audit_trail');
            $data['content'] = 'system_records/user_management/audit_trail/index';

            $this->pagination->initialize($config);
            $data['pagination_links'] = $this->pagination->create_links($config);

            $this->parser->parse('layouts/application', $data);
            $this->output->enable_profiler(TRUE);
        }
    }
?>