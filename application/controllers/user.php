<?php
    class User extends CI_Controller {
        function logout(){
            $data['content'] = 'user/logout';
            $data['message'] = '';            
            $this->parser->parse('layouts/application', $data);
        }
    }

?>