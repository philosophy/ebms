<?php $unit = $this->unit; ?>
<?php
    $hidden = array('unit_id' => $unit->id);
    echo form_open('file_maintenance/unit/update/' . $unit->id, array('id' => 'unit-edit'));
?>
<fieldset>
    <label><?php echo lang('unit_name'); ?></label>
    <?php echo form_input(array('name' => 'unit_name', 'id' => 'unit-name', 'class' => 'required', 'placeholder'=>lang('unit_name'), 'value' => $unit->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-unit-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/unit/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>