<?php
    class Documentation extends CI_Controller {
        function index() {            
            $data['title'] = 'EBMS Documentation';
            $this->parser->parse('documentation/index', $data);
        }
    }
?>