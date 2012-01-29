<?php

class Migrate extends CI_Controller {

    function create_new() {
        $this->load->library('migration');
        
        if (!$this->migration->current()) {
            show_error($this->migration->error_string());
        }

        $this->output->enable_profiler(TRUE);
    }

}

?>