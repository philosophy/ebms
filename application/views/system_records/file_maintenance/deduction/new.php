<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/deduction/index', 'text' => lang('deduction_list')),
                      'create' => array('link' => 'file_maintenance/deduction/new_deduction', 'text' => lang('create_new_deduction')),
                      'archive' => array('link' => 'file_maintenance/deduction/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_deduction'); ?></h3>

        <div class="deduction-details">
            <?php
            echo form_open('file_maintenance/deduction/create_deduction', array('id' => 'new-deduction'));
            ?>
            <fieldset>
                <label><?php echo lang('deduction_name'); ?>:</label>
                <?php echo form_input(array('name' => 'deduction_name', 'id' => 'deduction-name', 'class' => 'required', 'value' => set_value('deduction_name'))); ?>
                <?php echo form_error('deduction_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_deduction_submit', 'Create', array('id' => 'new-deduction-submit')); ?>
                <?php echo anchor('file_maintenance/deduction', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>