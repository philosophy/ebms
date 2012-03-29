<section>
    <?php
        echo form_open($url, array('id' => $form_id, 'data-remote' => 'true', 'data-type' => 'json'));
        $is_employee = isset($this->employee) && !empty($this->employee);
    ?>
    <ul>
        <li><a href="#general">General</a></li>
        <li><a href="#employment-info">Employment Info</a></li>
        <li><a href="#educational-background">Background</a></li>
        <li><a href="#payroll">Payroll Details</a></li>
    </ul>

    <div id="general">
        <?php $this->load->view('personnel/employee/_general_info', array('is_employee' => $is_employee, 'edit_page' => $edit)); ?>
    </div>
    <div id="employment-info">
        <?php $this->load->view('personnel/employee/_employment_info', array('is_employee' => $is_employee, 'edit_page' => $edit)); ?>
    </div>
    <div id="educational-background">
        <?php $this->load->view('personnel/employee/_educational_background', array('is_employee' => $is_employee, 'edit_page' => $edit)); ?>
    </div>
    <div id="payroll">
        <?php $this->load->view('personnel/employee/_payroll', array('is_employee' => $is_employee, 'edit_page' => $edit)); ?>
    </div>
    <?php echo form_close(); ?>
</section>

<script>
    var employmentStatus = <?php echo json_encode($this->employment_status); ?>;
</script>