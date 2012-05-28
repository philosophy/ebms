<?php

    class Employee_Base_model extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        protected $company_id;
        protected $limit = 10;
        protected $offset = 0;

    }

?>
