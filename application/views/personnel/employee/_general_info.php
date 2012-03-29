<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>
<fieldset>
    <label>First Name:</label>
    <?php echo form_input(array('name' => 'first_name', 'id' => 'first-name', 'placeholder' => lang('first_name'))); ?>
</fieldset>        
<fieldset>
    <label>Middle Name:</label>
    <?php echo form_input(array('name' => 'middle_name', 'id' => 'middle-name', 'placeholder' => lang('middle_name'))); ?>
</fieldset>      
<fieldset>
    <label>Last Name:</label>
    <?php echo form_input(array('name' => 'last_name', 'id' => 'last-name', 'placeholder' => lang('last_name'))); ?>
</fieldset>      
<fieldset>
    <label>Address:</label>
    <?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'placeholder' => lang('address_name'), 'rows' => '5')); ?>
</fieldset>      
<fieldset>
    <label>Date of Birth:</label>
    <?php echo form_input(array('name' => 'date_of_birth', 'id' => 'date-of-birth', 'placeholder' => lang('date_of_birth'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
</fieldset>      
<fieldset>
    <label>Gender:</label>
    <select name="gender">
        <option value="0">Male</option>
        <option value="1">Female</option>
    </select>
</fieldset>      
<fieldset>
    <label>Marital Status:</label>
    <select name="marital_status">
        <option value="0">Single</option>
        <option value="1">Married</option>
        <option value="1">Widowed</option>
    </select>
</fieldset>      
<fieldset>
    <label>Home Phone Number:</label>
    <?php echo form_input(array('name' => 'home_phone', 'id' => 'home-phone', 'placeholder' => lang('home_phone'))); ?>
</fieldset>      
<fieldset>
    <label>Work Phone Number:</label>
    <?php echo form_input(array('name' => 'work_phone', 'id' => 'work-phone', 'placeholder' => lang('work_phone'))); ?>
</fieldset> 
<div class="buttons-wrapper">
    <?php echo form_button(array('class' => 'next-button', 'data-step' => '1', 'content' => 'Next')); ?>
</div>        