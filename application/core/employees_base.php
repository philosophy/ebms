<?php
    class Employees_Base extends Application {
        public $current_avatar;
        public $pagination_config;

        public function __construct() {
            parent::__construct();
        }

        protected function set_config() {
            $this->pagination_config['testing'] = 'booyeah';
            $this->pagination_config['next_link'] = $this->config->item('pagination_next_link');
            $this->pagination_config['prev_link'] = $this->config->item('pagination_prev_link');
            $this->pagination_config['num_links'] = $this->config->item('pagination_num_links');
            $this->pagination_config['uri_segment'] = 3;
            $this->pagination_config['anchor_class'] = $this->config->item('pagination_anchor_class');
        }
    }

?>