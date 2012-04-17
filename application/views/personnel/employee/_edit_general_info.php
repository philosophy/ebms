<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>
<fieldset>
    <label>First Name*:</label>
    <?php echo form_input(array('name' => 'first_name', 'class' => 'first-name', 'placeholder' => lang('first_name'), 'value' => $employee->first_name)); ?>
</fieldset>
<fieldset>
    <label>Middle Name*:</label>
    <?php echo form_input(array('name' => 'middle_name', 'class' => 'middle-name', 'placeholder' => lang('middle_name'), 'value' => $employee->middle_name)); ?>
</fieldset>
<fieldset>
    <label>Last Name*:</label>
    <?php echo form_input(array('name' => 'last_name', 'class' => 'last-name', 'placeholder' => lang('last_name'), 'value' => $employee->last_name)); ?>
</fieldset>
<fieldset>
    <label>Address*:</label>
    <?php echo form_textarea(array('name' => 'address', 'class' => 'address', 'placeholder' => lang('address_name'), 'rows' => '5', 'value' => $employee->address)); ?>
</fieldset>
<fieldset>
    <label>Date of Birth*:</label>
    <?php echo form_input(array('name' => 'date_of_birth', 'class' => 'date-of-birth', 'placeholder' => lang('date_of_birth'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'), 'value' => $employee->date_of_birth)); ?>
</fieldset>
<fieldset>
    <label>Gender:</label>
    <select name="gender">
        <option value="0" <?php echo ($employee->gender == 0) ? 'selected="selected"' : ''; ?>>Male</option>
        <option value="1" <?php echo ($employee->gender == 1) ? 'selected="selected"' : ''; ?>>Female</option>
    </select>
</fieldset>
<fieldset>
    <label>Marital Status:</label>
    <select name="marital_status">
        <option value="0" <?php echo ($employee->marital_status == 0) ? 'selected="selected"' : ''; ?>>Single</option>
        <option value="1" <?php echo ($employee->marital_status == 1) ? 'selected="selected"' : ''; ?>>Married</option>
        <option value="2" <?php echo ($employee->marital_status == 1) ? 'selected="selected"' : ''; ?>>Widowed</option>
    </select>
</fieldset>
<fieldset>
    <label>Home Phone Number:</label>
    <?php echo form_input(array('name' => 'home_phone', 'class' => 'home-phone', 'placeholder' => lang('home_phone'))); ?>
</fieldset>
<fieldset>
    <label>Work Phone Number:</label>
    <?php echo form_input(array('name' => 'work_phone', 'class' => 'work-phone', 'placeholder' => lang('work_phone'))); ?>
</fieldset>
<div class="buttons-wrapper">
    <?php echo form_submit(array('class' => 'update-button', 'value' => 'Update')); ?>
    <?php echo form_button(array('class' => 'close-button', 'content' => 'Close')); ?>
</div>