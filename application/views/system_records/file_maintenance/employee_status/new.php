<article class="aside-left">

    <?php
       $this->load->view('common/nav/employee_status_manager');
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3><?php echo lang('create_employee_status'); ?></h3>

        <div class="employee-status-details">
            <?php
            echo form_open('file_maintenance/employee_status/create_employee_status/', array('id' => 'new-employee-status'));
            ?>
            <fieldset>
                <label><?php echo lang('employee_status_name'); ?>:</label>
                <?php echo form_input(array('name' => 'employee_status_name', 'id' => 'employee-status-name', 'class' => 'required', 'value' => set_value('employee_status_name'))); ?>
                <?php echo form_error('employee_status_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_employee_status_submit', 'Create', array('id' => 'new-employee-status-submit')); ?>
                <?php echo anchor('file_maintenance/employee_status', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>