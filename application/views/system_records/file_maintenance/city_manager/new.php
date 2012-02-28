<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/city/index', 'text' => lang('city_list')),
                      'create' => array('link' => 'file_maintenance/city/new_city', 'text' => lang('create_new_city')),
                      'archive' => array('link' => 'file_maintenance/city/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_city'); ?></h3>

        <div class="city-details">
            <?php
            echo form_open('file_maintenance/city/create_city', array('id' => 'new-city'));
            ?>
            <fieldset>
                <label><?php echo lang('city_name'); ?>:</label>
                <?php echo form_input(array('name' => 'city_name', 'id' => 'city-name', 'class' => 'required', 'value' => set_value('city_name'))); ?>
                <?php echo form_error('city_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_city_submit', 'Create', array('id' => 'new-city-submit')); ?>
                <?php echo anchor('file_maintenance/city', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>