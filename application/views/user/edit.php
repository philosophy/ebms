<?php $user = $this->user; ?>
<?php
$hidden = array('user_id' => $user->id);
echo form_open('users/update/' . $user->id, array('id' => 'user-edit'));
?>
<fieldset>
    <label>Username:</label>
    <?php echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'required', 'placeholder'=>lang(''), 'value' => $user->username)); ?>
</fieldset>
<fieldset>
    <label>First Name:</label>
    <?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'value' => $user->first_name)); ?>
</fieldset>
<fieldset>
    <label>Middle Name:</label>
    <?php echo form_input(array('name' => 'middle_name', 'id' => 'middle_name', 'value' => $user->middle_name)); ?>
</fieldset>
<fieldset>
    <label>Last Name:</label>
    <?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'value' => $user->last_name)); ?>
</fieldset>
<fieldset>
    <label>Email:</label>
    <?php echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'required', 'value' => $user->email)); ?>
</fieldset>
<fieldset>
    <label>Address:</label>
    <?php echo form_input(array('name' => 'address', 'id' => 'address', 'value' => $user->address)); ?>
</fieldset>
<fieldset>
    <label>Gender:</label>
    <select name="gender">
        <option value="0" <?php echo ($user->gender == 0) ? 'selected="selected"' : ''; ?>>Male</option>
        <option value="1" <?php echo ($user->gender == 1) ? 'selected="selected"' : ''; ?>>Female</option>
    </select>
</fieldset>
<fieldset>
    <label>Birthdate:</label>
    <?php echo form_input(array('name' => 'date_of_birth', 'id' => 'date_of_birth', 'value' => $user->date_of_birth)); ?>
</fieldset>
<fieldset id="marital-status">
    <label>Marital Status:</label>
    <div class="marital-stat-group">
        <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '0', 'checked' => ($user->status_id == 0) ? TRUE : FALSE)); ?>
        <span>Single</span>
    </div>
    <div class="marital-stat-group">
        <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '1', 'checked' => ($user->status_id == 1) ? TRUE : FALSE)); ?>
        <span>Married</span>
    </div>
    <div class="marital-stat-group">
        <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '2', 'checked' => ($user->status_id == 2) ? TRUE : FALSE)); ?>
        <span>Widowed</span>
    </div>

</fieldset>
<fieldset>
    <label>Home Phone:</label>
    <?php echo form_input(array('name' => 'home_phone', 'id' => 'home_phone', 'value' => $user->home_phone)); ?>
</fieldset>
<fieldset>
    <label>Work Phone:</label>
    <?php echo form_input(array('name' => 'work_phone', 'id' => 'work_phone', 'value' => $user->work_phone)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-profile-submit')); ?>
    <?php echo anchor(site_url('users/' . $user->id), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>