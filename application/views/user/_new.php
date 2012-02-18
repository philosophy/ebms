<?php
    echo form_open('user_management/control_manager/create_user/', array('id' => 'new-user'));
?>
<fieldset>
    <label>Username:</label>
    <?php echo form_input(array('name' => 'username', 'id' => 'username', 'class' => 'required', 'value'=>set_value('username'))); ?>
    <?php echo form_error('username', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>Password:</label>
    <?php echo form_input(array('name' => 'password', 'id' => 'password', 'class' => 'required', 'value'=>set_value('password'))); ?>
    <?php echo form_error('password', '<label class="error">', '</label>'); ?>
</fieldset>
<fieldset>
    <label>First Name:</label>
    <?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'value'=>set_value('first_name'))); ?>
</fieldset>
<fieldset>
    <label>Middle Name:</label>
    <?php echo form_input(array('name' => 'middle_name', 'id' => 'middle_name', 'value'=>set_value('middle_name'))); ?>
</fieldset>
<fieldset>
    <label>Last Name:</label>
    <?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'value'=>set_value('last_name'))); ?>
</fieldset>
<fieldset>
    <label>Email:</label>
    <?php echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'required', 'value'=>set_value('email'))); ?>
</fieldset>
<fieldset>
    <label>Address:</label>
    <?php echo form_input(array('name' => 'address', 'id' => 'address', 'value'=>set_value('address'))); ?>
</fieldset>
<fieldset>
    <label>Gender:</label>
    <select name="gender">
        <option value="0">Male</option>
        <option value="1">Female</option>
    </select>
</fieldset>
<fieldset>
    <label>Birthdate:</label>
    <?php echo form_input(array('name' => 'date_of_birth', 'id' => 'date_of_birth', 'value'=>set_value('date_of_birth'))); ?>
</fieldset>
<fieldset id="marital-status">
    <label>Marital Status:</label>
    <div class="marital-stat-group">
        <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '0')); ?>
        <span>Single</span>
    </div>
    <div class="marital-stat-group">
        <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '1')); ?>
        <span>Married</span>
    </div>
    <div class="marital-stat-group">
        <?php echo form_radio(array('name' => 'status_id', 'class' => 'status_id', 'value' => '2')); ?>
        <span>Widowed</span>
    </div>

</fieldset>
<fieldset>
    <label>Home Phone:</label>
    <?php echo form_input(array('name' => 'home_phone', 'id' => 'home_phone', 'value'=>set_value('home_phone'))); ?>
</fieldset>
<fieldset>
    <label>Work Phone:</label>
    <?php echo form_input(array('name' => 'work_phone', 'id' => 'work_phone', 'value'=>set_value('work_phone'))); ?>
</fieldset>
<fieldset>
    <label>User Level:</label>
    <select name="group_id">
        <option value="1">Admin</option>
        <option value="2">General User</option>
    </select>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('new_user_submit', 'Create', array('id' => 'new-user-submit')); ?>
    <?php echo anchor('user_management/control_manager', 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>