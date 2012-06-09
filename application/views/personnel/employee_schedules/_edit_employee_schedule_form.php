<div id="edit-schedule" class="modal-form">
    <?php echo form_open(site_url('employee_schedules/update_schedule/'), array('id' => 'edit-schedule-form', 'data-remote' => 'true', 'data-type' => 'json')); ?>
        <?php echo form_input(array('name' => 'emp_id', 'type' => 'hidden', 'class' => 'emp-id')); ?>
        <?php echo form_input(array('name' => 'sched_id', 'type' => 'hidden', 'class' => 'sched-id', 'value' => $this->schedule_info['id'])); ?>
        <div class="employee-select">
            <label><?php echo lang('employee_name'); ?>:</label>
            <span class="emp-name"></span>
        </div>
        <?php $this->load->view('personnel/employee_schedules/_schedule_details'); ?>
    <?php echo form_close(); ?>

</div>