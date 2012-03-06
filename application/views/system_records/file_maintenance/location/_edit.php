<?php $location = $this->location; ?>
<?php
    $hidden = array('location_id' => $location->id);
    echo form_open('file_maintenance/location/update/' . $location->id, array('id' => 'location-edit'));
?>
<fieldset>
    <label><?php echo lang('location_name'); ?></label>
    <?php echo form_input(array('name' => 'location_name', 'id' => 'location-name', 'class' => 'required', 'placeholder'=>lang('location_name'), 'value' => $location->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-location-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/location/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>