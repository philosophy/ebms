<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/area/index', 'text' => lang('area_list')),
                      'create' => array('link' => 'file_maintenance/area/new_area', 'text' => lang('create_new_area')),
                      'archive' => array('link' => 'file_maintenance/area/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_area'); ?></h3>

        <div class="area-details">
            <?php
            echo form_open('file_maintenance/area/create_area', array('id' => 'new-area'));
            ?>
            <fieldset>
                <label><?php echo lang('area_name'); ?>:</label>
                <?php echo form_input(array('name' => 'area_name', 'id' => 'area-name', 'class' => 'required', 'value' => set_value('area_name'))); ?>
                <?php echo form_error('area_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_area_submit', 'Create', array('id' => 'new-area-submit')); ?>
                <?php echo anchor('file_maintenance/area', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>