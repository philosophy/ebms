<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/customer/index', 'text' => lang('customer_list')),
                      'create' => array('link' => 'file_maintenance/customer/new_customer', 'text' => lang('create_new_customer')),
                      'archive' => array('link' => 'file_maintenance/customer/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_customer'); ?></h3>

        <div class="customer-details">
            <?php
            echo form_open('file_maintenance/customer/create_customer', array('id' => 'new-customer'));
            ?>
            <fieldset>
                <label><?php echo lang('customer_name'); ?>:</label>
                <?php echo form_input(array('name' => 'customer_name', 'id' => 'customer-name', 'class' => 'required', 'value' => set_value('customer_name'))); ?>
                <?php echo form_error('customer_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_customer_submit', 'Create', array('id' => 'new-customer-submit')); ?>
                <?php echo anchor('file_maintenance/customer', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>