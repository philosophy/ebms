<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/brand/index', 'text' => lang('brand_list')),
                      'create' => array('link' => 'file_maintenance/brand/new_brand', 'text' => lang('create_brand')),
                      'archive' => array('link' => 'file_maintenance/brand/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_brand'); ?></h3>

        <div class="brand-details">
            <?php
                echo form_open('file_maintenance/brand/create_brand/', array('id' => 'new-brand'));
            ?>
            <fieldset>
                <label>Category:</label>
                <select name="category" id="category">
                    <option>Select Category</option>
                    <?php foreach ($this->categories as $category) { ?>
                        <option value=<?php echo $category->id; ?>><?php echo $category->name; ?></option>
                    <?php } ?>
                </select>
            </fieldset>
            <fieldset>
                <label>Sub Category:</label>
                <select name="sub_category" id="sub-category">
                    <option>Select Sub Category</option>                    
                </select>
            </fieldset>
            <fieldset>
                <label><?php echo lang('brand_name'); ?>:</label>
                <?php echo form_input(array('name' => 'brand_name', 'id' => 'brand-name', 'class' => 'required', 'value' => set_value('brand_name'))); ?>
                <?php echo form_error('brand_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_brand_submit', 'Create', array('id' => 'new-brand-submit')); ?>
                <?php echo anchor('file_maintenance/brand', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>

<script>
    var sub_categories = <?php echo json_encode($this->sub_categories); ?>
</script>