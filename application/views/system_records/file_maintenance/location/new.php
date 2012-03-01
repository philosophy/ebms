<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/location/index', 'text' => lang('location_list')),
                      'create' => array('link' => 'file_maintenance/location/new_location', 'text' => lang('create_new_location')),
                      'archive' => array('link' => 'file_maintenance/location/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_location'); ?></h3>

        <div class="location-details">
            <?php
            echo form_open('file_maintenance/location/create_location', array('id' => 'new-location'));
            ?>
            <fieldset>
                <label><?php echo lang('location_name'); ?>:</label>
                <?php echo form_input(array('name' => 'location_name', 'id' => 'location-name', 'class' => 'required', 'value' => set_value('location_name'))); ?>
                <?php echo form_error('location_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_location_submit', 'Create', array('id' => 'new-location-submit')); ?>
                <?php echo anchor('file_maintenance/location', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>