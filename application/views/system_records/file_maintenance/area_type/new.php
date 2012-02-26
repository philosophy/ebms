<article class="aside-left">

    <?php
       $this->load->view('common/nav/area_type_manager');
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_area_type'); ?></h3>

        <div class="area-type-details">
            <?php
            echo form_open('file_maintenance/area_type/create_area_type/', array('id' => 'new-area-type'));
            ?>
            <fieldset>
                <label><?php echo lang('area_type_name'); ?>:</label>
                <?php echo form_input(array('name' => 'area_type_name', 'id' => 'area-type-name', 'class' => 'required', 'value' => set_value('area_type_name'))); ?>
                <?php echo form_error('area_type_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset>
                <label><?php echo lang('description'); ?>:</label>
                <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'value' => set_value('description'))); ?>
                <?php echo form_error('description', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_area_type_submit', 'Create', array('id' => 'new-area-type-submit')); ?>
                <?php echo anchor('file_maintenance/area_type', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>