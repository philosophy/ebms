<div id="new-schedule" class="modal-form" w=470>
    <?php echo form_open(site_url('employee_schedules/create/'), array('id' => 'new-employee-schedule-form', 'data-remote' => 'true', 'data-type' => 'json')); ?>
        <div id="employee-select">
            <label><?php echo lang('employee_name'); ?></label>
            <select name="employee">
            <?php foreach ($this->employees as $emp) { ?>
                <option value="<?php echo $emp['id']; ?>"><?php echo $emp['first_name'].' '.$emp['last_name']; ?></option>
            <?php } ?>
             </select>

        </div>
        <?php $this->load->view('personnel/employee_schedules/_schedule_details'); ?>
    <?php echo form_close(); ?>

</div>
