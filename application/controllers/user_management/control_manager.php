<?php
    class Control_Manager extends Application {

        public $users;

        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }

        function index() {
            $tab = '';
            $title = $this->lang->line('control_manager');
            $content = 'system_records/user_management/control_manager/index';
            $active = 'list';

            $tab = $this->uri->segment(3, 'list');
            switch($tab) {
                case 'list':
                    $title = $this->lang->line('user_list');
                    $content = 'system_records/user_management/control_manager/index';
                    $active = 'list';
                    $this->db->where('archive =', 0);
                    $this->users = $this->ion_auth->get_users();
                break;

                case 'create':

                break;

                case 'archive':
                    $title = $this->lang->line('archive');
                    $content = 'system_records/user_management/control_manager/index';
                    $active = 'archive';
                break;
            }

            $data['title'] = $title;
            $data['content'] = $content;
            $data['active'] = $active;

            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }

        function new_user() {
            $data['title'] =  $this->lang->line('create_user');
            $data['content'] = 'system_records/user_management/control_manager/new';
            $data['active'] = 'create';

            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }

        function create_user() {
            $user = new $this->User_model();

            $user->set_username($this->input->post('username'));
            $user->set_first_name($this->input->post('first_name'));
            $user->set_last_name($this->input->post('last_name'));
            $user->set_address($this->input->post('address'));
            $user->set_email($this->input->post('email'));
            $user->set_password($this->input->post('password'));



            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == TRUE) {
                $result = $user->createUser();
                if ($result) {
                    redirect('system_records/user_management/control_manager', 'refresh');
                } else {
                    /* return with errors */
                }

            } else {
                /* return with errors */
                $data['title'] =  $this->lang->line('create_user');
                $data['content'] = 'system_records/user_management/control_manager/new';
                $data['active'] = 'create';

                $this->parser->parse('layouts/application', $data);
            }
            $this->output->enable_profiler(TRUE);
        }

        function archive() {
            $data['title'] =  $this->lang->line('archive');
            $data['content'] = 'system_records/user_management/control_manager/archive';
            $data['active'] = 'archive';

            $this->db->where('archive =', 1);
            $this->users = $this->ion_auth->get_users();

            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }
    }
?>