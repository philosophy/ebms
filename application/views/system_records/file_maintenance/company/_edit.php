<?php $company = $this->company; ?>
<?php
    $hidden = array('company_id' => $company->id);
    echo form_open('file_maintenance/company/update/' . $company->id, array('id' => 'company-edit'));
?>
<fieldset>
    <label><?php echo lang('company_name'); ?></label>
    <?php echo form_input(array('name' => 'company_name', 'id' => 'company-name', 'class' => 'required', 'placeholder'=>lang('company_name'), 'value' => $company->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-company-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/company/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>