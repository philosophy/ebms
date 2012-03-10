<?php $brand = $this->brand; ?>
<?php
$hidden = array('brand_id' => $brand->id);
echo form_open('file_maintenance/brand/update/' . $brand->id, array('id' => 'brand-edit'));
?>
<fieldset>    
    <label>Category:</label>
    <select name="category" id="category">        
        <?php foreach ($this->categories as $category) { ?>
            <option value=<?php echo $category->id;
        echo ($category->id == $this->sub_category->category_id) ? ' selected="selected"' : ''; ?>><?php echo $category->name; ?></option>
<?php } ?>
    </select>
    <select name="sub_category" id="sub-category">        
        <?php foreach ($this->sub_categories as $sub) { ?>
            <option value=<?php echo $sub->id;
            echo ($sub->id == $brand->sub_category_id) ? ' selected="selected"' : ''; ?>><?php echo $sub->name; ?></option>
<?php } ?>
    </select>
</fieldset>
<fieldset>
    <label><?php echo lang('brand'); ?></label>
    <?php echo form_input(array('name' => 'brand_name', 'id' => 'brand-name', 'class' => 'required', 'placeholder' => lang('brand_name'), 'value' => $brand->name)); ?>
</fieldset>
<fieldset class="form-buttons">
<?php echo form_submit('edit_form_submit', 'Update', array('id' => 'edit-brand-submit')); ?>
<?php echo anchor(site_url('file_maintenance/brand/'), 'Cancel', array('class' => 'cancel-link')); ?>
</fieldset>
<?php echo form_close(); ?>