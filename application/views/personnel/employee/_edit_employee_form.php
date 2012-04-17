<section>
    <ul>
        <li><a href="#edit-general">General</a></li>
        <li><a href="#edit-employment-info">Employment Info</a></li>
        <li><a href="#edit-educational-background">Background</a></li>
        <li><a href="#edit-payroll">Payroll Details</a></li>
    </ul>

    <div id="edit-general" class="general">
        <?php
            echo form_open('employees/update_general_info/'.$this->employee->id, array('id' => 'general-info-form', 'data-remote' => 'true', 'data-type' => 'json'));
            echo form_input(array('name' => 'id', 'value' => $this->employee->id, 'type' => 'hidden'));
        ?>
        <?php $this->load->view('personnel/employee/_edit_general_info', array('employee' => $this->employee)); ?>
        <?php echo form_close(); ?>
    </div>
    <div id="edit-employment-info" class="employment-info">
        <?php
            echo form_open('employees/update_employment_info/'.$this->employee->id, array('id' => 'edit-employment-info-form', 'data-remote' => 'true', 'data-type' => 'json'));
            echo form_input(array('name' => 'id', 'value' => $this->employee->id, 'type' => 'hidden'));
        ?>
        <?php $this->load->view('personnel/employee/_edit_employment_info', array('employee' => $this->employee)); ?>
        <?php echo form_close(); ?>
    </div>
    <div id="edit-educational-background" class="educational-background">
        <?php $this->load->view('personnel/employee/_edit_educational_background', array('employee' => $this->employee)); ?>
    </div>
    <div id="edit-payroll" class="payroll">
        <?php $this->load->view('personnel/employee/_edit_payroll', array('employee' => $this->employee)); ?>
    </div>
</section>