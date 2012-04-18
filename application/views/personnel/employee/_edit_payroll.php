<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>

<fieldset>
    <label>Regular Salary*:</label>
    <?php echo form_input(array('name' => 'salary', 'placeholder' => lang('salary'), 'value' => $this->employee->salary)); ?>
</fieldset>

<section id="other-payroll">
    <h1>Others</h1>
    <fieldset>
        <label>SSS Number:</label>
        <?php echo form_input(array('name' => 'sss_no', 'placeholder' => lang('sss_number'), 'value' => $this->employee->sss_no)); ?>
    </fieldset>
    <fieldset>
        <label>Philhealth:</label>
        <?php echo form_input(array('name' => 'philhealth', 'placeholder' => lang('philhealth_number'), 'value' => $this->employee->philhealth)); ?>
    </fieldset>
    <fieldset>
        <label>Tin Number:</label>
        <?php echo form_input(array('name' => 'tin_no', 'placeholder' => lang('tin_number'), 'value' => $this->employee->tin_no)); ?>
    </fieldset>
    <fieldset>
        <label>Pagibig Number:</label>
        <?php echo form_input(array('name' => 'pagibig', 'placeholder' => lang('pagibig_number'), 'value' => $this->employee->pagibig)); ?>
    </fieldset>
</section>

<div class="buttons-wrapper">
    <?php echo form_submit(array('class' => 'update-button', 'value' => 'Update')); ?>
    <?php echo form_button(array('class' => 'close-button', 'content' => 'Close')); ?>
</div>