<?php $deduction = $this->deduction; ?>
<?php
    $hidden = array('deduction_id' => $deduction->id);
    echo form_open('file_maintenance/deduction/update/' . $deduction->id, array('id' => 'deduction-edit'));
?>
<fieldset>
    <label><?php echo lang('deduction_name'); ?></label>
    <?php echo form_input(array('name' => 'deduction_name', 'id' => 'deduction-name', 'class' => 'required', 'placeholder'=>lang('deduction_name'), 'value' => $deduction->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-deduction-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/deduction/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>