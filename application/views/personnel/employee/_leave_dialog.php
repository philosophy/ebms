<section class="leave-container aligned-details">
    <?php
        echo form_open('employees/leave/new_leave', array('id' => 'employee-leave-form', 'data-remote' => 'true', 'data-type' => 'json'));
        echo form_input(array('name' => 'id', 'type' => 'hidden', 'class' => 'action-employee-id'));
    ?>
    <fieldset>
        <label>Employee:</label>
        <?php echo form_input(array('class' => 'employee-name', 'placeholder' => lang('employee_name'), 'readonly' => true)); ?>
    </fieldset>
    <fieldset>
        <label>Leave Type:</label>
        <select name="leave" id="leave-types">
            <?php
                foreach($this->leaves_list as $leave) {
                    echo '<option value="'.$leave->id.'" data-maximum-days="'.$leave->days.'">'.$leave->name.'</option>';
                }
            ?>
        </select>
    </fieldset>
    <fieldset>
        <label>Maximum Days:</label>
        <?php echo form_input(array('class' => 'max-days', 'placeholder' => lang('days'), 'readonly' => true)); ?>
    </fieldset>
    <fieldset>
        <label>Date From:</label>
        <?php echo form_input(array('class' => 'date-from', 'placeholder' => lang('date_from'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
    </fieldset>
    <fieldset>
        <label>Date To:</label>
        <?php echo form_input(array('class' => 'date-to', 'placeholder' => lang('date_to'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
    </fieldset>
    <?php echo create_button(array('class'=>'submit-leave prettify-button', 'type'=>'submit', 'text' => 'Submit', 'data_attributes'=>array('data-disable-with'=>'true'))); ?>
    <?php echo form_close(); ?>
</section>