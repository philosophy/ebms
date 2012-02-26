<article class="aside-left">

    <?php
       $this->load->view('common/nav/position_manager');
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_position'); ?></h3>

        <div class="position-details">
            <?php
            echo form_open('file_maintenance/position/create_position/', array('id' => 'new-position'));
            ?>
            <fieldset>
                <label><?php echo lang('position_name'); ?>:</label>
                <?php echo form_input(array('name' => 'position_name', 'id' => 'position-name', 'class' => 'required', 'value' => set_value('position_name'))); ?>
                <?php echo form_error('position_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_position_submit', 'Create', array('id' => 'new-position-submit')); ?>
                <?php echo anchor('file_maintenance/position', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>