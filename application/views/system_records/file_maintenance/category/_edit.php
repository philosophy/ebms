<?php $category = $this->category; ?>
<?php
    $hidden = array('category_id' => $category->id);
    echo form_open('file_maintenance/category/update/' . $category->id, array('id' => 'category-edit'));
?>
<fieldset>
    <label><?php echo lang('code'); ?>:</label>
    <?php echo form_input(array('name' => 'code', 'id' => 'category-code', 'placeholder' => lang('code'), 'value' => $category->code)); ?>
</fieldset>
<fieldset>
    <label><?php echo lang('category_name'); ?></label>
    <?php echo form_input(array('name' => 'category_name', 'id' => 'category-name', 'class' => 'required', 'placeholder'=>lang('category_name'), 'value' => $category->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-category-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/category/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>