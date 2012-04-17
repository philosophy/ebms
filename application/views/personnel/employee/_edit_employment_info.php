<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>

<fieldset>
    <label>Date Hired*:</label>
    <?php echo form_input(array('name' => 'date_hired', 'id' => 'date-hired', 'placeholder' => lang('date_hired'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'), 'value' => $employee->date_hired)); ?>
</fieldset>
<fieldset>
    <label>Department:</label>
    <select name="department">
<!--        <option>Select Department</option>-->
            <?php foreach ($this->departments as $dept) { ?>
                <option value=<?php echo $dept->id; ?> <?php echo ($employee->department_id == $dept->id) ? 'selected="selected"' : ''; ?>><?php echo $dept->name; ?></option>
            <?php } ?>
    </select>
</fieldset>
<fieldset>
    <label>Position:</label>
    <select name="position">
<!--        <option>Select Position</option>-->
        <?php if (count($this->positions) > 0) {
             foreach ($this->positions as $position) { ?>
                <option value=<?php echo $position->id; ?> <?php echo ($employee->position_id == $position->id) ? 'selected="selected"' : ''; ?>><?php echo $position->name; ?></option>
            <?php }
        } ?>
    </select>
</fieldset>
<fieldset>
    <label>Employment Status:</label>
    <select name="employment_status" id="employment-status">
<!--        <option>Select Status</option>-->
        <?php if (count($this->employment_status) > 0) {
            foreach ($this->employment_status as $status) { ?>
                <option value=<?php echo $status->id; ?> <?php echo ($employee->employee_status_id == $status->id) ? 'selected="selected"' : ''; ?>><?php echo $status->name; ?></option>
            <?php }
        } ?>
    </select>
</fieldset>
<section id="work-experience">
    <h1>Work Experience</h1>
    <fieldset>
        <label>Company Name:</label>
        <?php echo form_input(array('class' => 'company-name', 'placeholder' => lang('company_name'))); ?>
    </fieldset>
    <fieldset>
        <label>Date Started:</label>
        <?php echo form_input(array('class' => 'date-work-started', 'placeholder' => lang('date_work_started'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
    </fieldset>
    <fieldset>
        <label>Date Ended:</label>
        <?php echo form_input(array('class' => 'date-work-ended', 'placeholder' => lang('date_work_ended'), 'data-datepicker-img-url' => image_asset_url('calendar.gif'))); ?>
    </fieldset>
    <fieldset>
        <label>Work Description:</label>
        <?php echo form_textarea(array('name' => 'work_description', 'class' => 'work-description', 'placeholder' => lang('work_description'), 'rows' => '2')); ?>
    </fieldset>
    <?php echo form_button(array('class'=>'add-work-experience', 'content' => 'Add')); ?>

    <div class="work-experience-details">
        <header>
            <ul>
                <li class="company-title">Company Name</li>
                <li class="start-date">Start Date</li>
                <li class="end-date">End Date</li>
                <li class="work-desc">Work Description</li>
            </ul>
        </header>
        <article>
            <ul>
                <?php
                    if(count($this->work_experience) > 0) {
                        foreach($this->work_experience as $exp) { ?>
                            <li class="current">
                                <div class="delete-work-exp"><a href=<?php echo site_url('employees/work_experience/'.$exp->id.'/delete') ?> class="remove-work-exp confirm-link" data-dialog-confirm-message="<?php echo lang('are_you_sure_you_want_to_remove_work_exp'); ?>" data-dialog-method="delete" data-dialog-remote='true' data-dialog-title="<?php echo lang('remove_work_experience');?>" data-dialog-type='json' data-class='delete-work-exp'>X</a></div>
                                <div class="company-work-exp"><?php echo $exp->company_name; ?></div>
                                <div class="date-work-exp"><?php echo $exp->date_started; ?></div>
                                <div class="date-work-exp"><?php echo $exp->date_ended; ?></div>
                                <div class="desc-work-exp"><?php echo $exp->work_description; ?></div>
                            </li>
                <?php
                        }
                    }
                ?>
            </ul>
        </article>
    </div>
</section>

<div class="buttons-wrapper">
    <?php echo form_submit(array('class' => 'update-button', 'value' => 'Update')); ?>
    <?php echo form_button(array('class' => 'close-button', 'content' => 'Close')); ?>
</div>