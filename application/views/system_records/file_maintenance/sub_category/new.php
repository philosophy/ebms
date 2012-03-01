<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/sub_category/index', 'text' => lang('sub_category_list')),
                      'create' => array('link' => 'file_maintenance/sub_category/new_sub_category', 'text' => lang('create_sub_category')),
                      'archive' => array('link' => 'file_maintenance/sub_category/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_sub_category'); ?></h3>

        <div class="sub-category-details">
            <?php
            echo form_open('file_maintenance/sub_category/create_sub_category/', array('id' => 'new-sub-category'));
            ?>
            <fieldset>
                <label>Gender:</label>
                <select name="category">
                    <?php foreach ($this->categories as $category) { ?>
                        <option value=<?php echo $category->id; ?>><?php echo $category->name; ?></option>
                    <?php } ?>
                </select>
            </fieldset>
            <fieldset>
                <label><?php echo lang('code'); ?>:</label>
                <?php echo form_input(array('name' => 'code', 'id' => 'sub-category-code', 'class' => 'required', 'value' => set_value('code'))); ?>
                <?php echo form_error('code', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset>
                <label><?php echo lang('sub_category_name'); ?>:</label>
                <?php echo form_input(array('name' => 'sub_category_name', 'id' => 'sub_category-name', 'class' => 'required', 'value' => set_value('sub_category_name'))); ?>
                <?php echo form_error('sub_category_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_sub_category_submit', 'Create', array('id' => 'new-sub-category-submit')); ?>
                <?php echo anchor('file_maintenance/sub_category', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>