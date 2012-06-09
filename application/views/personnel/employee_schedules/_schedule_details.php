<div id="schedule-details" class="schedule-details">
    <div id="days-list" class="days-list">
        <legend><?php echo lang('select_days'); ?></legend>
        <ul>
            <?php foreach ($this->Employee_Schedules_model->days_of_week as $key => $day) {
                echo '<li>';
                if (isset($this->schedule_info) && !empty($this->schedule_info)) {
                    if ($this->schedule_info['day'] == $key) {
                        echo form_input(array('name' => 'days[]', 'type' => 'checkbox', 'value' => $key, 'checked' => 'checked', 'readonly' => true));
                        echo '<label class="font-bold">';
                    } else {
                        echo form_input(array('name' => 'days[]', 'type' => 'checkbox', 'value' => $key, 'disabled' => 'disabled'));
                        echo '<label>';
                    }
                } else {
                    echo form_input(array('name' => 'days[]', 'type' => 'checkbox', 'value' => $key));
                    echo '<label>';
                }
                echo $day;
                echo '</label>';
                echo '</li>';
            } ?>
        </ul>
    </div>

    <div id="time-wrapper">
        <?php if (empty($this->schedule_info)) { ?>
            <fieldset>
                <label>Time In</label>
            <input type="text" class="time-in timepicker" name="time_in">
            </fieldset>
            <fieldset>
                <label>Time Out</label>
            <input type="text" class="time-out timepicker" name="time_out">
            </fieldset>

            <fieldset>
                <label>Start Break Time</label>
            <input type="text" class="start-breaktime timepicker" name="start_break_time">
            </fieldset>

            <fieldset>
                <label>End Break Time</label>
            <input type="text" class="end-breaktime timepicker" name="end_break_time">
            </fieldset>
        <?php } else {
            $time_in = $this->schedule_info['start_time'];
            $time_out = $this->schedule_info['end_time'];
            $start_break_time = $this->schedule_info['start_break_time'];
            $end_break_time = $this->schedule_info['end_break_time'];
        ?>
            <fieldset>
                <label>Time In</label>
                <input type="text" class="time-in timepicker" name="time_in" value="<?php echo $time_in ? $time_in : '' ?>">
            </fieldset>
            <fieldset>
                <label>Time Out</label>
                <input type="text" class="time-out timepicker" name="time_out" value="<?php echo $time_out ? $time_out : '' ?>">
            </fieldset>

            <fieldset>
                <label>Start Break Time</label>
                <input type="text" class="start-breaktime timepicker" name="start_break_time" value="<?php echo $start_break_time ? $start_break_time : '' ?>">
            </fieldset>

            <fieldset>
                <label>End Break Time</label>
                <input type="text" class="end-breaktime timepicker" name="end_break_time" value="<?php echo $end_break_time ? $end_break_time : '' ?>">
            </fieldset>
        <?php } ?>

    </div>

    <div class="button-panel">
        <button id="save" type="submit">Save</button>
    </div>
</div>