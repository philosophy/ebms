<?php
    class PDF extends Application {

        public function __construct() {
            parent::__construct();
            Application::authenticate_user();
            Application::sample_pages_for_admin_only();
        }

        function index() {
//            $data['content'] = 'sample/pdf/index';
//            $data['title'] = 'File Upload';
//
//            $this->parser->parse('layouts/application', $data);
            $html = $this->load->view('sample/pdf/_sample_report');
            $this->load->helper('dompdf_helper');
            pdf_create($html, 'filename', false);

            parent::enableProfiler();
        }
    }

?>