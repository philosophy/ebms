<div id="edit-multiple-schedule" class="modal-form" w=470>
    <?php echo form_open(site_url('employee_schedules/update_multiple_schedules/'), array('id' => 'edit-multiple-schedule-form', 'data-remote' => 'true', 'data-type' => 'json')); ?>
        <?php echo form_input(array('name' => 'emp_id', 'type' => 'hidden', 'class' => 'emp-id')); ?>
        <div id="employee-select">
            <label><?php echo lang('employee_name'); ?>:</label>
            <span class="emp-name"></span>
        </div>
        <?php $this->load->view('personnel/employee_schedules/_schedule_details'); ?>
    <?php echo form_close(); ?>

</div>
