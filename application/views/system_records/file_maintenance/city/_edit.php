<?php $city = $this->city; ?>
<?php
    $hidden = array('city_id' => $city->id);
    echo form_open('file_maintenance/city/update/' . $city->id, array('id' => 'city-edit'));
?>
<fieldset>
    <label><?php echo lang('city_name'); ?></label>
    <?php echo form_input(array('name' => 'city_name', 'id' => 'city-name', 'class' => 'required', 'placeholder'=>lang('city_name'), 'value' => $city->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-city-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/city/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>