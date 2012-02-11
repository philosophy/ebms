<?php
    class Home extends CI_Controller {
        function index() {
            if (!$this->ion_auth->logged_in()) {
                $data['message'] = $this->ion_auth->errors();
                $data['content'] = 'home/index';
                $data['active_link'] = 'home';

                $this->parser->parse('layouts/application', $data);
            } else {
                redirect('dashboard/index', 'refresh');
            }

            $this->output->enable_profiler(TRUE);
        }
    }
?>