<?php

class Company extends Application {

    public $company = null;
    public $companyId = null;

    function __construct() {
        parent::__construct();
        Application::authenticate_user();
        $this->load->model('Company_model');
    }

    function index() {
        $data['content'] = 'system_records/file_maintenance/company/index';
        $data['title'] = lang('company_info');

        $company = new $this->Company_model();
        $this->company = $company->getCompanyInfo();

        $this->parser->parse('layouts/application', $data);

        $this->output->enable_profiler(TRUE);
    }

    function edit($id) {
        $data['content'] = 'system_records/file_maintenance/company/edit';
        $data['title'] = lang('edit_company');

        $company = new $this->Company_model();
        $this->company = $company->getCompanyInfo();

        $this->parser->parse('layouts/application', $data);

        $this->output->enable_profiler(TRUE);
    }

    function update($id) {
        $this->companyId = $id;
        $company = new $this->Company_model();
        $company->set_id($id);

        /* validate form */
        $this->load->library('form_validation');

        /* TODO add rules to the remaining fields */
        $this->form_validation->set_rules('name', 'Company Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Address', 'trim');

        if ($this->form_validation->run() == TRUE) {

            if ($company->companyExists()) {
                $company->set_name($this->input->post('name'));
                $company->set_address($this->input->post('address'));
                $company->set_phone_no($this->input->post('phone_no'));
                $company->set_mobile_no($this->input->post('mobile_no'));
                $company->set_fax_no($this->input->post('fax_no'));
                $company->set_email_address($this->input->post('email_address'));
                $company->set_website($this->input->post('website'));
                $company->set_logo($this->input->post('logo'));

                $result = $company->updateCompany();
                if ($result) {
                    $audit = new $this->Audit_trail_model();

                    $audit->set_user_id($this->current_avatar->id);
                    $audit->set_type(2);
                    $audit->set_subject_id($id);
                    $audit->set_details(lang('update_company_profile'));
                    $audit->set_date_created(date("Y-m-d H:i:s"));
                    $audit->insertUserActions();
                    /* success */
                    $this->session->set_flashdata('msg', 'Successfully update company info');
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

            $data['content'] = 'system_records/file_maintenance/company/update';
            $data['title'] = lang('edit_company');

            $this->parser->parse('layouts/application', $data);
        }
    }

}

?>
