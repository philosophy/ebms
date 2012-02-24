<article class="aside-left">

    <?php
        $this->load->view('common/nav/department_manager');
    ?>
</article>
<article class="primary">
    <section id="" class="aligned-details">
        <h3>Create Account</h3>

        <div class="user-details">
            <?php
            echo form_open('file_maintenance/department/create_department/', array('id' => 'new-department'));
            ?>
            <fieldset>
                <label><?php echo lang('dept_name'); ?>:</label>
                <?php echo form_input(array('name' => 'department_name', 'id' => 'department-name', 'class' => 'required', 'value' => set_value('department_name'))); ?>
                <?php echo form_error('department_name', '<label class="error">', '</label>'); ?>
            </fieldset>
            <fieldset class="form-buttons">
                <?php echo form_submit('new_department_submit', 'Create', array('id' => 'new-dept-submit')); ?>
                <?php echo anchor('file_maintenance/department', 'Cancel', array('class' => 'cancel-link')); ?>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </section>
</article>