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
            echo $id;
        }
    }

?>