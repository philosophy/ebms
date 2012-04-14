<?php

class Company_info extends Application {

    public $company_info = null;
    public $companyId_info = null;

    function __construct() {
        parent::__construct();
        Application::authenticate_user();
        $this->load->model('Company_info_model');
    }

    function index() {
        $data['content'] = 'system_records/file_maintenance/company_info/index';
        $data['title'] = lang('company_info');

        $company_info = new $this->Company_info_model();
        $company_info->set_id($this->current_avatar->id);
        $this->company_info = $company_info->getCompanyInfo();

        $this->parser->parse('layouts/application', $data);

        $this->output->enable_profiler(TRUE);
    }

    function edit($id) {
        $data['content'] = 'system_records/file_maintenance/company_info/edit';
        $data['title'] = lang('edit_company_info');

        $company_info = new $this->Company_info_model();
        $company_info->set_id($id);
        $this->company_info = $company_info->getCompanyInfo();

        $this->parser->parse('layouts/application', $data);

        $this->output->enable_profiler(TRUE);
    }

    function update($id) {
        $this->companyId_info = $id;
        $company_info = new $this->Company_info_model();
        $company_info->set_id($id);

        /* validate form */
        $this->load->library('form_validation');

        /* TODO add rules to the remaining fields */
        $this->form_validation->set_rules('name', 'Company Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email', 'required');
        $this->form_validation->set_rules('address', 'Address', 'trim');

        if ($this->form_validation->run() == TRUE) {

            if ($company_info->company_infoExists()) {
                $company_info->set_name($this->input->post('name'));
                $company_info->set_address($this->input->post('address'));
                $company_info->set_phone_no($this->input->post('phone_no'));
                $company_info->set_mobile_no($this->input->post('mobile_no'));
                $company_info->set_fax_no($this->input->post('fax_no'));
                $company_info->set_email_address($this->input->post('email_address'));
                $company_info->set_website($this->input->post('website'));
//                $company_info->set_logo($this->input->post('logo'));

                $result = $company_info->updateCompany_info();
                if ($result) {
                    $audit = new $this->Audit_trail_model();

                    $audit->set_user_id($this->current_avatar->id);
                    $audit->set_type(2);
                    $audit->set_subject_id($id);
                    $audit->set_details(lang('update_company_info_profile'));
                    $audit->set_date_created(date("Y-m-d H:i:s"));
                    $audit->insertUserActions();
                    /* success */
                    $this->session->set_flashdata('msg', 'Successfully update company_info info');
                    $this->session->set_flashdata('msg_class', 'info');
                    redirect('file_maintenance/company_info');
                } else {
                    /* error */
                    $this->session->set_flashdata('msg', 'An error has occured');
                    $this->session->set_flashdata('msg_class', 'error');
                }
            }
        } else {
            $this->session->set_flashdata('msg', 'Please fill in required fields');
            $this->session->set_flashdata('msg_class', 'warning');

            $data['content'] = 'system_records/file_maintenance/company_info/update';
            $data['title'] = lang('edit_company_info');

            $this->parser->parse('layouts/application', $data);
        }
    }

}

?>
