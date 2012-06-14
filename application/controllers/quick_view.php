<?php
    class Quick_View extends CI_Controller {
        function about_us() {
//            send_json_response(INFO_LOG, HTTP_OK, 'about us markup', array('html' => $this->load->view('layouts/application/quick_view/_about_us', '', true)));
            echo $this->load->view('layouts/application/quick_view/_about_us');
        }

        function user_guide() {
            echo $this->load->view('layouts/application/quick_view/_user_guide');
        }

        function cheat_sheet() {
            echo $this->load->view('layouts/application/quick_view/_cheat_sheet');
        }
    }
?>