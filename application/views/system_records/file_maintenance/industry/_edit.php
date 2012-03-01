<?php $industry = $this->industry; ?>
<?php
    $hidden = array('industry_id' => $industry->id);
    echo form_open('file_maintenance/industry/update/' . $industry->id, array('id' => 'industry-edit'));
?>
<fieldset>
    <label><?php echo lang('industry_name'); ?></label>
    <?php echo form_input(array('name' => 'industry_name', 'id' => 'industry-name', 'class' => 'required', 'placeholder'=>lang('industry_name'), 'value' => $industry->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-industry-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/industry/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>