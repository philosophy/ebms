<?php
    class Users extends Application {
        
        function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }
        
        function logout(){            
            $this->ion_auth->logout();
            redirect('home', 'refresh');
//            $data['content'] = 'user/logout';
//            $data['message'] = '';            
//            $this->parser->parse('layouts/application', $data);
        }
        
        function login() {
            redirect('home', 'refresh');
        }
        
        function show($id) {            
            $data['title'] = $this->lang->line('profile');            
            $data['content'] = 'profile/show';
            
            $this->parser->parse('layouts/application', $data);
            $this->output->enable_profiler(TRUE);
        }
    }

?>