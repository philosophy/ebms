<?php
    echo form_open('file_maintenance/leaves/update/' . $this->leave->id, array('id' => 'leave-edit'));
?>
<fieldset>
    <label><?php echo lang('leave_name'); ?></label>
    <?php echo form_input(array('name' => 'name', 'id' => 'leave-name', 'class' => 'required', 'placeholder'=>lang('name'), 'value' => $this->leave->name)); ?>
</fieldset>
<fieldset>
    <label><?php echo lang('maximum_days'); ?></label>
    <?php echo form_input(array('name' => 'days', 'id' => 'leave-name', 'class' => 'required', 'placeholder'=>lang('number_of_days'), 'value' => $this->leave->days)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-leave-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/leaves/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>