<?php $customer = $this->customer; ?>
<?php
    $hidden = array('customer_id' => $customer->id);
    echo form_open('file_maintenance/customer/update/' . $customer->id, array('id' => 'customer-edit'));
?>
<fieldset>
    <label><?php echo lang('customer_name'); ?></label>
    <?php echo form_input(array('name' => 'customer_name', 'id' => 'customer-name', 'class' => 'required', 'placeholder'=>lang('customer_name'), 'value' => $customer->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-customer-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/customer/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>