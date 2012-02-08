<?php $user = $this->user; ?>
<?php
$hidden = array('user_id' => $user->id);
echo form_open('users/update_password_settings/' . $user->id, array('id' => 'user-edit-password-settings'));
?>
<fieldset>
    <label>Current Password:</label>
    <?php echo form_input(array('name' => 'current_password', 'id' => 'current-password', 'value' => '', 'placeholder' => 'Current Password', 'type' => 'password')); ?>
</fieldset>
<fieldset>
    <label>New Password:</label>
    <?php echo form_input(array('name' => 'new_password', 'id' => 'new-password', 'value' => '', 'placeholder' => 'New Password', 'type' => 'password')); ?>
</fieldset>
<fieldset>
    <label>Confirm Password</label>
    <?php echo form_input(array('name' => 'confirm_password', 'id' => 'confirm-password', 'value' => '', 'placeholder' => 'Confirm Password', 'type' => 'password')); ?>
</fieldset>
<?php echo form_submit('edit_password_submit', 'Update'); ?>
<?php echo anchor(site_url('users/' . $user->id), 'Cancel', array('class' => 'cancel-link')); ?>
<?php echo form_close(); ?>