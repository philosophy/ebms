<article class="aside-left">

    <?php $this->load->view('system_records/file_maintenance/leaves/_side_nav'); ?>

</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_leave'); ?></h3>

        <div class="leave-details">
            <?php
            echo form_open('file_maintenance/leaves/create_leave/', array('id' => 'new-leave-form'));
            ?>
            <fieldset>
                <label><?php echo lang('leave_name'); ?>:</label>
                <?php echo form_input(array('name' => 'name', 'id' => 'leave-name', 'class' => 'required', 'value' => set_value('name'))); ?>
                <?php echo form_error('name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset>
                <label><?php echo lang('maximum_days'); ?>:</label>
                <?php echo form_input(array('name' => 'days', 'id' => 'maximum-days', 'class' => 'required', 'value' => set_value('days'))); ?>
                <?php echo form_error('days', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_leave_submit', 'Create', array('id' => 'new-leave-submit')); ?>
                <?php echo anchor('file_maintenance/leaves', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>