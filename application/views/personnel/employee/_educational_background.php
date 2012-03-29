<span class="tips">
    Note: <?php echo lang('with_asterisk_required'); ?>
</span>
<fieldset>
    <label>School Name:</label>
    <?php echo form_input(array('id' => 'school-name', 'placeholder' => lang('school_name'))); ?>
</fieldset>
<fieldset>
    <label>Year Graduated:</label>
    <?php echo form_input(array('id' => 'year-graduated', 'placeholder' => lang('year_graduated'))); ?>
</fieldset>
<fieldset>
    <label>Remarks:</label>
    <?php echo form_textarea(array('name' => 'remarks', 'id' => 'remarks', 'placeholder' => lang('remarks'), 'rows' => '5')); ?>
</fieldset>
<?php echo form_button(array('id'=>'add-educational-background', 'content' => lang('add'))); ?>
<div id="educational-background-details">
    <header>
        <ul>
            <li id="school-name">School Name</li>
            <li id="year-graduated">Year Graduated</li>
            <li id="remarks">Remarks</li>
        </ul>
    </header>
    <?php if ($is_employee && $edit_page) { ?>
        <article>
            <ul>
                <?php
                    $i = 0;
                    foreach($this->educational_background as $edu) {
                        $i++;
                ?>
                        <li>
                            <div class="delete-edu-background">
                                <a href="#" class="delete-edu edit confirm-link delete-data current" data-dialog-confirm-message="<?php echo lang('are_you_sure_you_want_to_remove_edu_background'); ?>" data-dialog-method="delete" data-dialog-title="<?php echo lang('remove_educational_background'); ?>" data-dialog-remote="true" data-class="delete" data-counter="<?php echo $i; ?>">X</a>
                            </div>
                            <div class="school-name-background"><?php echo $edu->school_name; ?></div>
                            <div class="year-graduated-background"><?php echo $edu->date_graduated; ?></div>
                            <div class="remarks-background"><?php echo $edu->remarks; ?></div>
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
<div class="buttons-wrapper">
    <?php echo form_button(array('class' => 'previous-button', 'data-step' => '1', 'content' => 'Previous')); ?>
    <?php echo form_button(array('class' => 'next-button', 'data-step' => '3', 'content' => 'Next')); ?>
</div>