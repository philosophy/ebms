<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>
<fieldset>
    <label>School Name:</label>
    <?php echo form_input(array('class' => 'school-name', 'placeholder' => lang('school_name'))); ?>
</fieldset>
<fieldset>
    <label>Year Graduated:</label>
    <?php echo form_input(array('class' => 'year-graduated', 'placeholder' => lang('year_graduated'))); ?>
</fieldset>
<fieldset>
    <label>Remarks:</label>
    <?php echo form_textarea(array('name' => 'remarks', 'class' => 'remarks', 'placeholder' => lang('remarks'), 'rows' => '5')); ?>
</fieldset>
<?php echo form_button(array('class'=>'add-educational-background', 'content' => lang('add'))); ?>
<div class="educational-background-details">
    <header>
        <ul>
            <li class="school-name">School Name</li>
            <li class="year-graduated">Year Graduated</li>
            <li class="remarks">Remarks</li>
        </ul>
    </header>
    <article>
        <ul>
            <?php
                if(count($this->educational_background) > 0) {
                    foreach($this->educational_background as $edu) { ?>
                        <li class="current">
                            <div class="delete-edu-background"><a href="<?php echo site_url('employees/educational_background/'.$edu->id.'/delete') ?>" class="remove-edu-background confirm-link" data-dialog-confirm-message="<?php echo lang('are_you_sure_you_want_to_remove_edu_background'); ?>" data-dialog-method="delete" data-dialog-remote='true' data-dialog-title="<?php echo lang('remove_educational_background');?>" data-dialog-type='json' data-class='delete-edu-background'>X</a></div>
                            <div class="school-name-background"><?php echo $edu->school_name; ?></div>
                            <div class="year-graduated-background"><?php echo $edu->date_graduated; ?></div>
                            <div class="remarks-background"><?php echo $edu->remarks; ?></div>
                        </li>
            <?php
                    }
                }
            ?>
        </ul>
    </article>
</div>
<div class="buttons-wrapper">
    <?php echo form_submit(array('class' => 'update-button', 'value' => 'Update')); ?>
    <?php echo form_button(array('class' => 'close-button', 'content' => 'Close')); ?>