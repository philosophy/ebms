<?php $earning = $this->earning; ?>
<?php
    $hidden = array('earning_id' => $earning->id);
    echo form_open('file_maintenance/earning/update/' . $earning->id, array('id' => 'earning-edit'));
?>
<fieldset>
    <label><?php echo lang('earning_name'); ?></label>
    <?php echo form_input(array('name' => 'earning_name', 'id' => 'earning-name', 'class' => 'required', 'placeholder'=>lang('earning_name'), 'value' => $earning->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-earning-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/earning/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>