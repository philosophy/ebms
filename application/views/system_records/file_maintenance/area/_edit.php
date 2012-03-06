<?php $area = $this->area; ?>
<?php
    $hidden = array('area_id' => $area->id);
    echo form_open('file_maintenance/area/update/' . $area->id, array('id' => 'area-edit'));
?>
<fieldset>
    <label><?php echo lang('area_name'); ?></label>
    <?php echo form_input(array('name' => 'area_name', 'id' => 'area-name', 'class' => 'required', 'placeholder'=>lang('area_name'), 'value' => $area->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-area-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/area/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>