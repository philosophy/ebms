<?php

class City extends Application {

    public $city = null;
    public $cityId = null;

    function __construct() {
        parent::__construct();
        Application::authenticate_user();
        $this->load->model('City_manager');
    }

    function index() {        
        $data['content'] = 'system_records/file_maintenance/city_manager/index';
        $data['title'] = lang('city_manager');        
        
        $city = new $this->City_manager();
        $this->city = $city->getCityManagerInfo();

        $this->parser->parse('layouts/application', $data);

        $this->output->enable_profiler(TRUE);
    }

    function edit($id) {
        $data['content'] = 'system_records/file_maintenance/city_manager/edit';
        $data['title'] = lang('edit_company');

        $city = new $this->City_manager();
        $this->company = $city->getCityManagerInfo();

        $this->parser->parse('layouts/application', $data);

        $this->output->enable_profiler(TRUE);
    }

    function update($id) {
        $this->cityId = $id;
        $city = new $this->City_manager();
        $city->set_id($id);

        /* validate form */
        $this->load->library('form_validation');

        /* TODO add rules to the remaining fields */
        $this->form_validation->set_rules('name', 'City Name', 'required');
        //$this->form_validation->set_rules('email_address', 'Email', 'required');
        //$this->form_validation->set_rules('address', 'Address', 'trim');

        if ($this->form_validation->run() == TRUE) {

            if ($city->cityExists()) {
                $city->set_id($this->input->post('id'));
                $city->set_name($this->input->post('name'));
                

                $result = $city->updateCity();
                if ($result) {
                    $audit = new $this->Audit_trail_model();

                    $audit->set_user_id($this->current_avatar->id);
                    $audit->set_type(2);
                    $audit->set_subject_id($id);
                    $audit->set_details(lang('update_city'));
                    $audit->set_date_created(date("Y-m-d H:i:s"));
                    $audit->insertUserActions();
                    /* success */
                    $this->session->set_flashdata('msg', 'Successfully updated city info');
                    $this->session->set_flashdata('msg_class', 'info');
                    redirect('file_maintenance/company');
                } else {
                    /* error */
                    $this->session->set_flashdata('msg', 'An error has occured');
                    $this->session->set_flashdata('msg_class', 'error');
                }
            }
        } else {
            $this->session->set_flashdata('msg', 'Please fill in required fields');
            $this->session->set_flashdata('msg_class', 'warning');

            $data['content'] = 'system_records/file_maintenance/city_manager/update';
            $data['title'] = lang('edit_city');

            $this->parser->parse('layouts/application', $data);
        }
    }

}

?>
