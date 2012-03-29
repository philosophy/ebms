<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>

<fieldset>
    <label>Date Hired:</label>
    <?php echo form_input(array('name' => 'date_hired', 'id' => 'date-hired', 'value' => ($is_employee && $this->employee) ? $this->employee->date_hired : '', 'placeholder' => lang('date_hired'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
</fieldset>
<fieldset>
    <label>Department:</label>
    <select name="department">
        <option>Select Department</option>
            <?php foreach ($this->departments as $dept) { ?>
                <option value=<?php echo $dept->id; ?> <?php echo ($is_employee && $this->employee->department_id == $dept->id) ? ' selected="selected"' : ''; ?>><?php echo $dept->name; ?></option>
            <?php } ?>
    </select>
</fieldset>
<fieldset>
    <label>Position:</label>
    <select name="position">
        <option>Select Position</option>
            <?php foreach ($this->positions as $position) { ?>
                <option value=<?php echo $position->id; ?> <?php echo ($is_employee && $this->employee->position_id == $this->employee->position_id) ? 'selected="selected"' : ''; ?>><?php echo $position->name; ?></option>
            <?php } ?>
    </select>
</fieldset>
<fieldset>
    <label>Employment Status:</label>
    <select name="employment_status" id="employment-status">
        <option>Select Status</option>
        <?php foreach ($this->employment_status as $status) { ?>
            <option value=<?php echo $status->id; ?> <?php echo ($is_employee && $this->employee->employee_status_id == $status->id) ? 'selected="selected"' : ''; ?>><?php echo $status->name; ?></option>
        <?php } ?>
    </select>
</fieldset>
<section id="work-experience">
    <h1>Work Experience</h1>
    <fieldset>
        <label>Company Name:</label>
        <?php echo form_input(array('id' => 'company-name', 'placeholder' => lang('company_name'))); ?>
    </fieldset>
    <fieldset>
        <label>Date Started:</label>
        <?php echo form_input(array('id' => 'date-work-started', 'placeholder' => lang('date_work_started'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
    </fieldset>
    <fieldset>
        <label>Date Ended:</label>
        <?php echo form_input(array('id' => 'date-work-ended', 'placeholder' => lang('date_work_ended'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
    </fieldset>
    <fieldset>
        <label>Work Description:</label>
        <?php echo form_textarea(array('name' => 'work_description', 'id' => 'work-description', 'placeholder' => lang('work_description'), 'rows' => '2')); ?>
    </fieldset>
    <?php echo form_button(array('id'=>'add-work-experience', 'content' => 'Add')); ?>

    <div id="work-experience-details">
        <header>
            <ul>
                <li id="company-title">Company Name</li>
                <li id="start-date">Start Date</li>
                <li id="end-date">End Date</li>
                <li id="work-desc">Work Description</li>
            </ul>
        </header>
        <?php if ($is_employee && $edit_page) { ?>
            <article>
                <ul>
                    <?php
                        $i = 0;
                        foreach($this->work_experience as $exp) {
                            $i++;
                    ?>
                            <li>
                                <div class="delete-work-exp">
                                    <a href="#" class="delete-work edit confirm-link delete-data current" data-dialog-confirm-message="<?php echo lang('are_you_sure_you_want_to_remove_work_exp'); ?>" data-dialog-method="delete" data-dialog-title="<?php echo lang('remove_work_experience'); ?>" data-dialog-remote="true" data-class="delete" data-counter="<?php echo $i; ?>">X</a>
                                </div>
                                <div class="company-work-exp"><?php echo $exp->company_name; ?></div>
                                <div class="date-work-exp"><?php echo $exp->date_started; ?></div>
                                <div class="date-work-exp"><?php echo $exp->date_ended; ?></div>
                                <div class="desc-work-exp"><?php echo $exp->work_description; ?></div>
                            </li>
                    <?php } ?>
                </ul>
            </article>
        <?php } else { ?>
        <article>
            <ul></ul>
        </article>
        <?php } ?>
    </div>
</section>

<div class="buttons-wrapper">
    <?php echo form_button(array('class' => 'previous-button', 'data-step' => '0', 'content' => 'Previous')); ?>
    <?php echo form_button(array('class' => 'next-button', 'data-step' => '2', 'content' => 'Next')); ?>
</div>