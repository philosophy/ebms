<?php $areaType = $this->areaType; ?>
<?php
    $hidden = array('area_type_id' => $areaType->id);
    echo form_open('file_maintenance/area_type/update/' . $areaType->id, array('id' => 'area-type-edit'));
?>
<fieldset>
    <label><?php echo lang('area_type_name'); ?></label>
    <?php echo form_input(array('name' => 'area_type_name', 'id' => 'area-type-name', 'class' => 'required', 'placeholder'=>lang('area_type_name'), 'value' => $areaType->name)); ?>
</fieldset>
<fieldset>
    <label><?php echo lang('description'); ?>:</label>
    <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'placeholder' => lang('description'), 'value' => $areaType->description)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-department-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/department/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>