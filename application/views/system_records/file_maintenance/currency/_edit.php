<?php $currency = $this->currency; ?>
<?php
    $hidden = array('currency_id' => $currency->id);
    echo form_open('file_maintenance/currency/update/' . $currency->id, array('id' => 'currency-edit'));
?>
<fieldset>
    <label><?php echo lang('currency_name'); ?></label>
    <?php echo form_input(array('name' => 'currency_name', 'id' => 'currency-name', 'class' => 'required', 'placeholder'=>lang('currency_name'), 'value' => $currency->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-currency-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/currency/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>