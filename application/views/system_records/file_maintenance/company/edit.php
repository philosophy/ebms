<?php
echo form_open('user_management/control_manager/create_user/', array('id' => 'new-user'));
?>

<fieldset>
    <label>Company Name:</label>
    <?php echo form_input(array('name' => 'name', 'id' => 'username', 'class' => 'required', 'value' => isset(set_value('name')) ? set_value('name') : $this->company->name)); ?>
    <?php echo form_error('username', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>Address:</label>
    <?php echo form_input(array('name' => 'address', 'id' => 'username', 'class' => 'required', 'value' => set_value('address'))); ?>
    <?php echo form_error('address', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>Phone Number:</label>
    <?php echo form_input(array('name' => 'phone_no', 'id' => 'username', 'class' => 'required', 'value' => set_value('phone_no'))); ?>
    <?php echo form_error('phone_no', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>Mobile Number:</label>
    <?php echo form_input(array('name' => 'mobile_no', 'id' => 'username', 'class' => 'required', 'value' => set_value('mobile_no'))); ?>
    <?php echo form_error('mobile_no', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>Fax Number:</label>
    <?php echo form_input(array('name' => 'fax_no', 'id' => 'username', 'class' => 'required', 'value' => set_value('fax_no'))); ?>
    <?php echo form_error('fax_no', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>Email Address:</label>
    <?php echo form_input(array('name' => 'email_address', 'id' => 'username', 'class' => 'required', 'value' => set_value('email_address'))); ?>
    <?php echo form_error('email_address', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>Website:</label>
    <?php echo form_input(array('name' => 'website', 'id' => 'username', 'class' => 'required', 'value' => set_value('website'))); ?>
    <?php echo form_error('website', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>Logo:</label>
    <?php echo form_input(array('name' => 'logo', 'id' => 'username', 'class' => 'required', 'value' => set_value('logo'))); ?>
    <?php echo form_error('logo', '<label class="error">', '</label>'); ?>
</fieldset>

<?php echo form_close(); ?>