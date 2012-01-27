<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    class Home extends CI_Controller {
        function index() {
            if (!$this->ion_auth->logged_in()) {
                $data['message'] = '';
                $data['content'] = 'home/index';
            } else {
                $data['dashboard'] = 'dashboard/index';
            }



            $this->parser->parse('layouts/application', $data);

            $this->output->enable_profiler(TRUE);
        }

    }

?>