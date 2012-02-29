<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/category/index', 'text' => lang('category_list')),
                      'create' => array('link' => 'file_maintenance/category/new_category', 'text' => lang('create_category')),
                      'archive' => array('link' => 'file_maintenance/category/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_category'); ?></h3>

        <div class="category-details">
            <?php
            echo form_open('file_maintenance/category/create_category/', array('id' => 'new-category'));
            ?>
            <fieldset>
                <label><?php echo lang('code'); ?>:</label>
                <?php echo form_input(array('name' => 'code', 'id' => 'category-code', 'class' => 'required', 'value' => set_value('code'))); ?>
                <?php echo form_error('code', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset>
                <label><?php echo lang('category_name'); ?>:</label>
                <?php echo form_input(array('name' => 'category_name', 'id' => 'category-name', 'class' => 'required', 'value' => set_value('category_name'))); ?>
                <?php echo form_error('category_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_category_submit', 'Create', array('id' => 'new-category-submit')); ?>
                <?php echo anchor('file_maintenance/category', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>