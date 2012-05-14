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
        <div id="schedule-details">
            <div id="days-list">
                <legend><?php echo lang('select_days'); ?></legend>
                <ul>
                    <?php foreach ($this->Employee_Schedules_model->days_of_week as $key => $day) {
                        echo '<li>';
                        echo form_input(array('name' => 'days[]', 'type' => 'checkbox', 'value' => $key));
                        echo '<label>';
                        echo $day;
                        echo '</label>';
                        echo '</li>';
                    } ?>
                </ul>
            </div>

            <div id="time-wrapper">
                <fieldset>
                    <label>Time In</label>
                    <input type="text" id="time-in" class="timepicker" name="time_in">
                </fieldset>
                <fieldset>
                    <label>Time Out</label>
                    <input type="text" id="time-out" class="timepicker" name="time_out">
                </fieldset>

                <fieldset>
                    <label>Start Break Time</label>
                    <input type="text" id="start-breaktime" class="timepicker" name="start_break_time">
                </fieldset>

                <fieldset>
                    <label>End Break Time</label>
                    <input type="text" id="end-breaktime" class="timepicker" name="end_break_time">
                </fieldset>

            </div>

            <div class="button-panel">
                <button id="save" type="submit">Save</button>
            </div>
        </div>
    <?php echo form_close(); ?>

</div>
