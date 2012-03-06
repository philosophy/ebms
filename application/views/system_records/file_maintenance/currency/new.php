<article class="aside-left">

    <?php
       $data = array('list' => array('link' => 'file_maintenance/currency/index', 'text' => lang('currency_list')),
                      'create' => array('link' => 'file_maintenance/currency/new_currency', 'text' => lang('create_new_currency')),
                      'archive' => array('link' => 'file_maintenance/currency/archive', 'text' => lang('archive'))
            );
       $this->load->view('common/nav/left_nav_manager', $data);
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_new_currency'); ?></h3>

        <div class="currency-details">
            <?php
            echo form_open('file_maintenance/currency/create_currency', array('id' => 'new-currency'));
            ?>
            <fieldset>
                <label><?php echo lang('currency_name'); ?>:</label>
                <?php echo form_input(array('name' => 'currency_name', 'id' => 'currency-name', 'class' => 'required', 'value' => set_value('currency_name'))); ?>
                <?php echo form_error('currency_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_currency_submit', 'Create', array('id' => 'new-currency-submit')); ?>
                <?php echo anchor('file_maintenance/currency', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>