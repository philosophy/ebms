<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/company/index', 'text' => lang('company_list')),
                      'create' => array('link' => 'file_maintenance/company/new_company', 'text' => lang('create_new_company')),
                      'archive' => array('link' => 'file_maintenance/company/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_company'); ?></h3>

        <div class="company-details">
            <?php
            echo form_open('file_maintenance/company/create_company', array('id' => 'new-company'));
            ?>
            <fieldset>
                <label><?php echo lang('company_name'); ?>:</label>
                <?php echo form_input(array('name' => 'company_name', 'id' => 'company-name', 'class' => 'required', 'value' => set_value('company_name'))); ?>
                <?php echo form_error('company_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_company_submit', 'Create', array('id' => 'new-company-submit')); ?>
                <?php echo anchor('file_maintenance/company', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>