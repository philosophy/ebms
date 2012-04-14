<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>

<fieldset>
    <label>Regular Salary*:</label>
    <?php echo form_input(array('name' => 'salary', 'id' => 'salary', 'placeholder' => lang('salary'))); ?>
</fieldset>

<section id="other-payroll">
    <h1>Others</h1>
    <fieldset>
        <label>SSS Number:</label>
        <?php echo form_input(array('name' => 'sss_no', 'id' => 'sss-no', 'placeholder' => lang('sss_number'))); ?>
    </fieldset>
    <fieldset>
        <label>Philhealth:</label>
        <?php echo form_input(array('name' => 'philhealth', 'id' => 'sss-no', 'placeholder' => lang('philhealth_number'))); ?>
    </fieldset>
    <fieldset>
        <label>Tin Number:</label>
        <?php echo form_input(array('name' => 'tin_no', 'id' => 'sss-no', 'placeholder' => lang('tin_number'))); ?>
    </fieldset>
    <fieldset>
        <label>Pagibig Number:</label>
        <?php echo form_input(array('name' => 'pagibig', 'id' => 'sss-no', 'placeholder' => lang('pagibig_number'))); ?>
    </fieldset>
</section>

<div class="buttons-wrapper">
    <?php echo form_button(array('class' => 'previous-button', 'data-step' => '2', 'content' => 'Previous')); ?>
    <?php echo form_submit('new_employee_submit', 'Submit'); ?>
    <span class="loader hide"></span>
</div>