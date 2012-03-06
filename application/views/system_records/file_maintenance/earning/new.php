<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/earning/index', 'text' => lang('earning_list')),
                      'create' => array('link' => 'file_maintenance/earning/new_earning', 'text' => lang('create_new_earning')),
                      'archive' => array('link' => 'file_maintenance/earning/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_earning'); ?></h3>

        <div class="earning-details">
            <?php
            echo form_open('file_maintenance/earning/create_earning', array('id' => 'new-earning'));
            ?>
            <fieldset>
                <label><?php echo lang('earning_name'); ?>:</label>
                <?php echo form_input(array('name' => 'earning_name', 'id' => 'earning-name', 'class' => 'required', 'value' => set_value('earning_name'))); ?>
                <?php echo form_error('earning_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_earning_submit', 'Create', array('id' => 'new-earning-submit')); ?>
                <?php echo anchor('file_maintenance/earning', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>