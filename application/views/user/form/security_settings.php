<?php $user = $this->user; ?>
<?php
$hidden = array('user_id' => $user->id);
echo form_open('users/update_security_settings/' . $user->id, array('id' => 'user-edit-security-settings'));
?>            
<fieldset>
    <label>Current Password:</label>
    <?php echo form_input(array('name' => 'password', 'id' => 'password', 'value' => '', 'placeholder' => 'Current Password', 'type' => 'password')); ?>
</fieldset>
<fieldset>
    <label>New Password:</label>
    <?php echo form_input(array('name' => 'new_password', 'id' => 'new_password', 'value' => '', 'placeholder' => 'New Password', 'type' => 'password')); ?>
</fieldset>
<fieldset>
    <label>Confirm Password</label>
    <?php echo form_input(array('name' => 'confirm_password', 'id' => 'confirm_password', 'value' => '', 'placeholder' => 'Confirm Password', 'type' => 'password')); ?>
</fieldset>
<fieldset>
    <label>Security Question:</label>
    <select name="security_question">
        <option value="0" selected=<?php echo ($user->security_question_id == 0) ? 'selected' : ''; ?>><?php echo $this->security_question[0]; ?></option>
        <option value="1" selected=<?php echo ($user->security_question_id == 1) ? 'selected' : ''; ?>><?php echo $this->security_question[1]; ?></option>
        <option value="2" selected=<?php echo ($user->security_question_id == 1) ? 'selected' : ''; ?>><?php echo $this->security_question[2]; ?></option>
    </select>
</fieldset>
<fieldset>
    <label>Security Answer:</label>
    <?php echo form_input(array('name' => 'security_answer', 'id' => 'security_answer', 'value' => $user->security_answer, 'placeholder' => 'Security Answer')); ?>
</fieldset>
<?php echo form_submit('edit_security_submit', 'Update'); ?>
<?php echo anchor(site_url('users/' . $user->id), 'Cancel', array('class' => 'cancel-link')); ?>
<?php echo form_close(); ?>