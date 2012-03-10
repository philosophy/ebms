<section>    
    <?php
        echo form_open('personnel/employees/create/', array('id' => 'new-employee-form'));
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
        Background tab
        <div class="buttons-wrapper">
            <?php echo form_button(array('class' => 'previous-button', 'data-step' => '1', 'content' => 'Previous')); ?>
            <?php echo form_button(array('class' => 'next-button', 'data-step' => '3', 'content' => 'Next')); ?>
        </div>
    </div>
    <div id="payroll">
        Payroll tab
        <div class="buttons-wrapper">            
            <?php echo form_button(array('class' => 'previous-button', 'data-step' => '2', 'content' => 'Previous')); ?>
            <?php echo form_submit('new_employee_submit', 'Submit'); ?>
        </div>    
    </div>
    <?php echo form_close(); ?>
</section>