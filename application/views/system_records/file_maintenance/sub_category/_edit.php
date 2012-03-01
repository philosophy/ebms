<?php $subCategory = $this->sub_category; ?>
<?php
    $hidden = array('sub_category_id' => $subCategory->id);
    echo form_open('file_maintenance/sub_category/update/' . $subCategory->id, array('id' => 'sub-category-edit'));
?>
<fieldset>
    <label>Category:</label>
    <select name="category">        
        <?php foreach ($this->categories as $category) { ?>
            <option value=<?php echo $category->id; echo ($category->id == $subCategory->category_id) ? ' selected="selected"' : ''; ?>><?php echo $category->name; ?></option>
        <?php } ?>
    </select>
</fieldset>
<fieldset>
    <label><?php echo lang('code'); ?></label>
    <?php echo form_input(array('name' => 'code', 'id' => 'sub-category-code', 'class' => 'required', 'placeholder'=>lang('sub_category_code'), 'value' => $subCategory->code)); ?>
</fieldset>
<fieldset>
    <label><?php echo lang('sub_category_name'); ?></label>
    <?php echo form_input(array('name' => 'sub_category_name', 'id' => 'sub-category-name', 'class' => 'required', 'placeholder'=>lang('sub_category_name'), 'value' => $subCategory->name)); ?>
</fieldset>
<fieldset class="form-buttons">
    <?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-sub-category-submit')); ?>
    <?php echo anchor(site_url('file_maintenance/sub_category/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>