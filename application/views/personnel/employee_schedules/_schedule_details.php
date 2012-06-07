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

    </div>

    <div class="button-panel">
        <button id="save" type="submit">Save</button>
    </div>
</div>