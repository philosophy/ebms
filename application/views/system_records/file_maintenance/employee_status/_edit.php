<?php $employee_status = $this->employee_status; ?>
<?php
    $hidden = array('employee_status_id' => $employee_status->id);
    echo form_open('file_maintenance/employee_status/update/' . $employee_status->id, array('id' => 'employee-status-edit'));
?>
<fieldset>
    <label><?php echo lang('employee_status_name'); ?></label>
    <?php echo form_input(array('name' => 'employee_status_name', 'id' => 'employee-status-name', 'class' => 'required', 'placeholder'=>lang('employee_status_name'), 'value' => $employee_status->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-employee-status-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/employee_status/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>