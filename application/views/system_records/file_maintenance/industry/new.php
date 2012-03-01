<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/industry/index', 'text' => lang('industry_list')),
                      'create' => array('link' => 'file_maintenance/industry/new_industry', 'text' => lang('create_new_industry')),
                      'archive' => array('link' => 'file_maintenance/industry/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_industry'); ?></h3>

        <div class="industry-details">
            <?php
            echo form_open('file_maintenance/industry/create_industry', array('id' => 'new-industry'));
            ?>
            <fieldset>
                <label><?php echo lang('industry_name'); ?>:</label>
                <?php echo form_input(array('name' => 'industry_name', 'id' => 'industry-name', 'class' => 'required', 'value' => set_value('industry_name'))); ?>
                <?php echo form_error('industry_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_industry_submit', 'Create', array('id' => 'new-industry-submit')); ?>
                <?php echo anchor('file_maintenance/industry', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>