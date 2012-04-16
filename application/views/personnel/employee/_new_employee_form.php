<section>
    <?php
        echo form_open('employees/create/', array('id' => 'new-employee-form', 'data-remote' => 'true', 'data-type' => 'json'));
    ?>
    <ul>
        <li><a href="#general">General</a></li>
        <li><a href="#employment-info">Employment Info</a></li>
        <li><a href="#educational-background">Background</a></li>
        <li><a href="#payroll">Payroll Details</a></li>
    </ul>

    <div id="general">
        <?php $this->load->view('personnel/employee/_general_info'); ?>
    </div>
    <div id="employment-info">
        <?php $this->load->view('personnel/employee/_employment_info'); ?>
    </div>
    <div id="educational-background">
        <?php $this->load->view('personnel/employee/_educational_background'); ?>
    </div>
    <div id="payroll">
        <?php $this->load->view('personnel/employee/_payroll'); ?>
    </div>
    <?php echo form_close(); ?>
</section>