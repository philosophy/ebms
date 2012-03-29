<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>
<fieldset>
    <label>First Name:</label>
    <?php echo form_input(array('name' => 'first_name', 'id' => 'first-name', 'value' => $is_employee ? $this->employee->first_name : null, 'placeholder' => lang('first_name'))); ?>
</fieldset>
<fieldset>
    <label>Middle Name:</label>
    <?php echo form_input(array('name' => 'middle_name', 'id' => 'middle-name', 'value' => $is_employee ? $this->employee->middle_name : null, 'placeholder' => lang('middle_name'))); ?>
</fieldset>
<fieldset>
    <label>Last Name:</label>
    <?php echo form_input(array('name' => 'last_name', 'id' => 'last-name', 'value' => $is_employee ? $this->employee->last_name : null, 'placeholder' => lang('last_name'))); ?>
</fieldset>
<fieldset>
    <label>Address:</label>
    <?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'value' => $is_employee ? $this->employee->address : null, 'placeholder' => lang('address'), 'rows' => '5')); ?>
</fieldset>
<fieldset>
    <label>Date of Birth:</label>
    <?php echo form_input(array('name' => 'date_of_birth', 'id' => 'date-of-birth', 'value' => $is_employee ? $this->employee->date_of_birth : null, 'placeholder' => lang('date_of_birth'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
</fieldset>
<fieldset>
    <label>Gender:</label>
    <select name="gender">
        <option value="0" <?php echo ($is_employee && $this->employee->gender == 0) ? 'selected="selected"' : ''; ?>>Male</option>
        <option value="1" <?php echo ($is_employee && $this->employee->gender == 1) ? 'selected="selected"' : ''; ?>>Female</option>
    </select>
</fieldset>
<fieldset>
    <label>Marital Status:</label>
    <select name="marital_status">
        <option value="0" <?php echo ($is_employee && $this->employee->marital_status == 0) ? 'selected="selected"' : ''; ?>>Single</option>
        <option value="1" <?php echo ($is_employee && $this->employee->marital_status == 1) ? 'selected="selected"' : ''; ?>>Married</option>
        <option value="1" <?php echo ($is_employee && $this->employee->marital_status == 2) ? 'selected="selected"' : ''; ?>>Widowed</option>
    </select>
</fieldset>
<fieldset>
    <label>Home Phone Number:</label>
    <?php echo form_input(array('name' => 'home_phone', 'id' => 'home-phone', 'value' => $is_employee ? $this->employee->home_phone : null, 'placeholder' => lang('home_phone'))); ?>
</fieldset>
<fieldset>
    <label>Work Phone Number:</label>
    <?php echo form_input(array('name' => 'work_phone', 'id' => 'work-phone', 'value' => $is_employee ? $this->employee->work_phone : null,'placeholder' => lang('work_phone'))); ?>
</fieldset>
<div class="buttons-wrapper">
    <?php echo form_button(array('class' => 'next-button', 'data-step' => '1', 'content' => 'Next')); ?>
</div>