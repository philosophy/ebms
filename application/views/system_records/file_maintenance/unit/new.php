<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/unit/index', 'text' => lang('unit_list')),
                      'create' => array('link' => 'file_maintenance/unit/new_unit', 'text' => lang('create_unit')),
                      'archive' => array('link' => 'file_maintenance/unit/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_unit'); ?></h3>

        <div class="unit-details">
            <?php
            echo form_open('file_maintenance/unit/create_unit/', array('id' => 'new-unit'));
            ?>
            <fieldset>
                <label><?php echo lang('unit_name'); ?>:</label>
                <?php echo form_input(array('name' => 'unit_name', 'id' => 'unit-name', 'class' => 'required', 'value' => set_value('unit_name'))); ?>
                <?php echo form_error('unit_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_unit_submit', 'Create', array('id' => 'new-unit-submit')); ?>
                <?php echo anchor('file_maintenance/unit', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>