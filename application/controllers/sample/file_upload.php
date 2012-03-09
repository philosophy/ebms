<?php
    class File_Upload extends Application {

        public function __construct() {
            parent::__construct();
            Application::authenticate_user();
        }

        function index() {
            $data['content'] = 'sample/file_upload/index';
            $data['title'] = 'File Upload';
            $data['error'] = '';
            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

        function do_upload() {
            $data['title'] = 'File Upload';

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 'None';
            $config['max_width'] = 'None';
            $config['max_height'] = 'None';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $data['error'] = $this->upload->display_errors();
                $data['content'] = 'sample/file_upload/index';
//                $this->load->view('upload_form', $error);
            } else {
                $data['upload_data'] = $this->upload->data();
                $data['content'] = 'sample/file_upload/success';
//                $this->load->view('upload_success', $data);
            }

            $this->parser->parse('layouts/application', $data);

            parent::enableProfiler();
        }

    }

?>