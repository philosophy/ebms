<?php $dept = $this->department; ?>
<?php
    $hidden = array('department_id' => $dept->id);
    echo form_open('file_maintenance/department/update/' . $dept->id, array('id' => 'department-edit'));
?>
<fieldset>
    <label><?php echo lang('dept_name'); ?></label>
    <?php echo form_input(array('name' => 'department_name', 'id' => 'department-name', 'class' => 'required', 'placeholder'=>lang('dept_name'), 'value' => $dept->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-department-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/department/' . $dept->id), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>